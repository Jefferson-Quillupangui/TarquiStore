<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\Collaborator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{

    public static $collaborator = 'App\\Models\\Collaborator';

    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'identification' => ['required', 'string', 'max:25'],
            'phone' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ], 
        [
            'identification.required'   => 'El número de cédula es necesario',
            'phone.required'            => 'El número de teléfono es necesario',
        ]
        )->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]),function (User $user) use ($input) {
                $this->createTeam($user);
                $this->createCollaborator($user,$input);
                
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    protected function createCollaborator(User $user, array $input ){
        
       // $user->userCollaborator()->save(Collaborator::forceCreate([
           $user->userCollaboratorModel()->save(Collaborator::forceCreate([
            'user_id' => $user->id,
            'identification' =>$input['identification'],
            'name' =>   $input['name'],
            'phone' =>  $input['phone'],
        ]));  

       
    }




    // protected function userCollaborator()
    // {
    //     //return $this->hasMany(Jetstream::collaboratorModel());
    //     return $this->hasMany(static::$collaborator);
    // }

    // public static function collaboratorModel()
    // {
    //     return static::$collaborator;
    // }

}
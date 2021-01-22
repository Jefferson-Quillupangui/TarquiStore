<div class="col-md-4">
    <div class="col-12 col-lg-6 col-sm-6 ">
        <img class="img-fluid mb-4" src="/img/create.svg" alt="Ingreso de datos">
    </div>
 </div> 
 
 <div class="row">
        <div class="col-md-6">
            <label for="name">Nombre:</label>
    
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::text('name',null,['class' => 'form-control'. ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el nombre del rol']) !!}                 
                
                @error('name')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror                
            </div>
        </div>
    </div>

<strong>Permisos:</strong><br>

@error('permissions')
<small class="text-danger">
    <strong>{{$message}}</strong>
</small><br>
@enderror

@foreach ($permissions as $permission)

    <div>
        <label>
            {!! Form::checkbox('permissions[]',$permission->id,null,['class' => 'mr-1']) !!}
            {{$permission->name}}     
        </label>
    </div>
    
@endforeach
{{-- pulgin para los toast --}}
<link href="{{ asset('/jquery_toast_plugin/css/jquery.toast.css') }}" rel="stylesheet">

<x-guest-layout>
    <form action="{{ route('validar.identificacion') }}" id="form-validar-identificacion" class="d-none"></form>

    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
            {{-- Reemplazar logo de jet --}}
            <x-AppLogo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="identification" value="{{ __('Cédula') }}" />
                <x-jet-input id="identification" class="block mt-1 w-full" type="number" name="identification"
                    :value="old('identification')" required autofocus autocomplete="identification" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="flex flex-row ... mt-4">
                <div>
                    <x-jet-label for="birth_date" value="{{ __('Fecha de nacimiento') }}" />
                    <x-jet-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                        :value="old('birth_date')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="sex" class="ml-3 mx-16" value="{{ __('Sexo') }}" />
                    <select name="sex" id="sex"
                        class="border-gray-300 ml-3 mx-16 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                        required>
                        <option value="H">Hombre</option>
                        <option value="M">Mujer</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Teléfono') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')"
                    required autofocus autocomplete="phone" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado ?') }}
                </a>

                <x-jet-button class="ml-4" disabled="disabled" id="btn-registar">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/jquery_toast_plugin/js/jquery.toast.js') }}"></script>

<script type="text/javascript">
    $(document).on("change", "#identification", function() {
        var $txt_identificacion = $('#identification').val();
        var $txt_tipo_identificacion = '05'; //$('#input-tipo-identificacion').val();


        validarDocumento($txt_identificacion, $txt_tipo_identificacion)

    });


    function validarDocumento($txt_identificacion, $txt_tipo_identificacion) {
        $.ajax({
            type: 'GET',
            url: $('#form-validar-identificacion').attr("action"),
            data: {
                identificacion: $txt_identificacion,
                tipoDocumt: $txt_tipo_identificacion
            },
            // dataType: "dataType",
            beforeSend: function() {
                // $('.loaders').removeClass('d-none');
            },
            success: function(response) {
                //console.log(response.data);
                let obj = response.data;
                if (obj.out_cod === 7) {
                    $('#btn-registar').prop('disabled', false);
                   // document.getElementById('btn-guardar').disabled = false;
                    $.toast({
                        heading: 'Success',
                        text: obj.out_msj,
                        showHideTransition: 'fade',
                        icon: 'success',
                        position: 'top-right'
                    })

                } else if (obj.out_cod === 6) {
                    $('#btn-registar').prop('disabled', true);
                   // document.getElementById('btn-guardar').disabled = true;
                    $.toast({
                        heading: 'Error',
                        text: obj.out_msj,
                        showHideTransition: 'fade',
                        icon: 'error',
                        position: 'top-right'
                    })
                }

            },
            complete: function() {
                // $('.loaders').addClass('d-none');
            }
        });
    }

</script>

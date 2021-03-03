

<div class="form-group">

    {{-- <p id="selct_cod_identificacion">{{$client->type_identification_cod}}</p> --}}
    <input type="hidden" id="selct_cod_identificacion" value="{{isset($client->type_identification_cod)}}" readonly>

    <div class="row">
        <div class="col-md-5">
            <label for="identification">Identificación</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                </div>
                {!! Form::number('identification', null, ['class' => 'form-control' . ($errors->has('identification') ? ' is-invalid' : ''), 'placeholder' => 'Identificación', 'id' => 'input-identificacion', 'verificacion'=>0]) !!}
                @error('identification')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <label for="type_identification">Tipo de identificación</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"></i></span>
                </div>

                {!! Form::select('type_identification_cod', $type_identification, 0, ['class' => 'custom-select', 'id' => 'input-tipo-identificacion']) !!}
            {{-- 
                <select class="form-control" value="{{ isset($client->type_identification_cod) }}" name="type_identification" id="input-tipo-identificacion">
                    <option value="">Ninguna</option>
                    @foreach ($type_identification as $typeid)
                        <option value="{{$typeid->codigo}}">{{$typeid->name}}</option>
                        <option value="{{$typeid->codigo}}">{{$typeid->name}}</option>
                    @endforeach
                </select> --}}

                @error('type_identification')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-2">
            <label for="type_identification">Aplica Identificacion:</label>
            <div class="custom-control custom-checkbox">
                <input name="check-no-aplica-identificacion[]" checked
                    class="custom-control-input check-no-aplica-identificacion" type="checkbox" id="customCheckbox2">
                <label for="customCheckbox2" class="custom-control-label"></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="name">Nombre(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                </div>
                {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del cliente', 'required']) !!}
                @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <label for="last_name">Apellido</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                </div>
                {!! Form::text('last_name', null, ['class' => 'form-control' . ($errors->has('last_name') ? ' is-invalid' : ''), 'placeholder' => 'Apellido del cliente']) !!}
                @error('last_name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="phone1">Teléfono1(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-square"></i></span>
                </div>
                {!! Form::number('phone1', null, ['class' => 'form-control' . ($errors->has('phone1') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono del cliente', 'required']) !!}
                @error('phone1')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label for="phone2">Teléfono2:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-square"></i></span>
                </div>
                {!! Form::number('phone2', null, ['class' => 'form-control' . ($errors->has('phone2') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono del cliente']) !!}
                @error('phone2')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="email">Correo electrónico:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                </div>
                {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo electrónico del cliente']) !!}
                @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
        <div class="col-md-5">
            <label for="sex">Sexo(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"></i></span>
                </div>
                {{-- <select class="form-control" name="sex" value="{{$client->sex}}">
                        <option value="H">Hombre</option>
                        <option value="M">Mujer</option>
                </select> --}}
                {!! Form::select('sex', ['H' => 'Hombre', 'M' => 'Mujer', 'N' => 'NO APLICA'], null, ['class' => 'form-control']) !!}

                @error('sex')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label for="address">Dirección(*)</label>
            <div class="input-group mb-3 ">
                <div class="input-group resize:none">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                    </div>
                    {!! Form::textarea('address', null, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese dirección del cliente', 'rows' => '4', 'required']) !!}
                    @error('address')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

    </div>
    <div class="row">

    </div>
</div>

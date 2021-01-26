<div class="col-md-4">
    <div class="col-12 col-lg-6 col-sm-6 ">
        <img class="img-fluid mb-4" src="/img/create.svg" alt="Ingreso de datos">
    </div>
 </div>

<div class="row">
    <div class="col-md-5">
        <label for="name">Nombre:</label>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
            </div>
            {!! Form::text('name',null,['class' => 'form-control'. ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del estado de orden']) !!}                 
            
            @error('name')
            <span class="invalid-feedback">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <label for="description">Descripción:</label>
        <div class="input-group mb-3 ">
            <div class="input-group resize:none">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::textarea('description',null,['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 
                                                'placeholder' => 'Ingrese descripción del estado de orden', 
                                                'rows'  => '3']) !!}

                @error('description')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
              </div>
        </div>  
    </div>
</div>



<div class="form-group">
    <div class="row">
        <div class="col-md-5">
            <label for="name">Nombre:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::text('name',null,['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del producto']) !!}
                @error('name')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <label for="image">Imagen: </label>
            <div class="input-group mb-4">
                <div class="form-input">
                    {!! Form::file('image',null,['class' => ($errors->has('image') ? 'is-invalid' : ''),'accept' => 'image/png,image/jpeg']) !!}
                    @error('image')
                        <br>
                        <small class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="price">Precio:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                </div>
                {!! Form::text('price',null,['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Precio de venta del producto',
                                                'step'=>'any',
                                                'id'=>'in_price',
                                                'onkeypress'=> 'return ((event.charCode >= 48 && event.charCode <= 57 ) || (event.charCode == 46))']) !!}
                @error('price')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>  
            <label for="comission">Comisión:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                </div>
                {!! Form::text('comission',null,['class' => 'form-control' . ($errors->has('comission') ? ' is-invalid' : ''), 'placeholder' => 'Valor de comisión del producto',
                                        'step'=>'any', 
                                        'id' => 'in_comission',
                                        'onkeypress'=> 'return ((event.charCode >= 48 && event.charCode <= 57 ) || (event.charCode == 46))']) !!}
                @error('comission')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>  
        </div>
        <div class="col-md-5">
            <label for="description">Descripción:</label>
            <div class="input-group mb-3 ">
                <div class="input-group resize:none">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                    </div>
                    {!! Form::textarea('description',null,['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese descripción del producto', 'rows' => '4 ']) !!}
                    @error('description')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror                 
                </div>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="discount">Porcentaje descuento:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                </div>
                {!! Form::text('discount',0.00,['class' => 'form-control' . ($errors->has('discount') ? ' is-invalid' : ''), 
                                    'placeholder' => 'Valor de descuento del producto',
                                    'step'=>'any', 
                                    'id' => 'in_discount_porcent',
                                    'onkeypress'=> 'return ((event.charCode >= 48 && event.charCode <= 57 ) || (event.charCode == 46))',
                                    'max' => '2']) !!}
                @error('discount')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>   
        </div>
        <div class="col-md-5">
            <label for="price_discount">Precio descuento:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                </div>
                {!! Form::text('price_discount',0.00,['class' => 'form-control' . ($errors->has('price_discount') ? ' is-invalid' : ''), 
                            'placeholder' => 'Precio del producto con descuento',
                            'step'=>'any','id'=>'in_price_discount',
                            'onkeypress'=> 'return ((event.charCode >= 48 && event.charCode <= 57 ) || (event.charCode == 46))',
                            'readonly']) !!}
                @error('price_discount')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label for="quantity">Cantidad:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                </div>
                {!! Form::text('quantity',null,['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 
                                'placeholder'   => 'Cantidad disponible',
                                'onkeypress'    => 'return (event.charCode >= 48 && event.charCode <= 57 )']) !!}
                @error('quantity')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>  
        </div>
        <div class="col-md-5">
            <label for="category">Categorias:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"></i></span>
                </div>
                    {!! Form::select('category', $category,0,['class' => 'custom-select']) !!}
                @error('category')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>   
        </div>
    </div>
</div>

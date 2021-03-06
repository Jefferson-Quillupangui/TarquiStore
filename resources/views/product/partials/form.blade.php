@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $message)
            @if($message=='Ingrese la imagen del producto'||$message=='Debe ingresar una imagen del producto')
                <strong>Error!</strong> {{ $message }}
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        arial-label="close">
                    <span aria-hidden="true">&times; </span>
                </button>
            @endif
        @endforeach
    </div>
@endif
<div class="form-group">

    @isset($product->price_discount)
        <input type="hidden" id="select_price_discount" value="{{$product->price_discount}}" readonly>
    @endisset

    @isset($product->price_discount)
        <input type="hidden" id="select_porcent_desc" value="{{$product->discount}}" readonly>
    @endisset

    
    @isset($product->category_id)
        <input type="hidden" id="select_id_category" value="{{$product->category_id}}" readonly>
    @endisset
    
    <div class="row">
        <div class="col-md-5">
            <label for="name">Nombre(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::text('name',null,['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del producto', 'required' => true]) !!}
                @error('name')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <label for="category">Categorias(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"></i></span>
                </div>
                    {!! Form::select('category', $category,0,['class' => 'custom-select', 'required' => true, 'id' => 'select_id_cat']) !!}
                @error('category')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>   
            <label for="price">Precio(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                </div>
                {!! Form::text('price',null,['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Precio de venta del producto',
                                                'step'=>'any',
                                                'id'=>'in_price',
                                                'onkeypress'=> 'return ((event.charCode >= 48 && event.charCode <= 57 ) || (event.charCode == 46))',
                                                'required' => true]) !!}
                @error('price')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>  
            <label for="comission">Comisión(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                </div>
                {!! Form::text('comission',null,['class' => 'form-control' . ($errors->has('comission') ? ' is-invalid' : ''), 'placeholder' => 'Valor de comisión del producto',
                                        'step'=>'any', 
                                        'id' => 'in_comission',
                                        'onkeypress'=> 'return ((event.charCode >= 48 && event.charCode <= 57 ) || (event.charCode == 46))',
                                        'required' => true]) !!}
                @error('comission')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>
            <label for="discount">Porcentaje descuento(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                </div>
                {!! Form::text('discount',null,['class' => 'form-control' . ($errors->has('discount') ? ' is-invalid' : ''), 
                                    'placeholder' => 'Valor de descuento del producto',
                                    'step'=>'any', 
                                    'id' => 'in_discount_porcent',
                                    'onkeypress'=> 'return check(event,value)',
                                    'onInput' => 'checkLength()',
                                    'max' => '2',
                                    'required' => true]) !!}
                @error('discount')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>
            <label for="price_discount">Precio descuento</label>
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
            <label for="quantity">Cantidad(*)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                </div>
                {!! Form::text('quantity',null,['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 
                                'placeholder'   => 'Cantidad disponible',
                                'onkeypress'    => 'return (event.charCode >= 48 && event.charCode <= 57 )',
                                'required' => true]) !!}
                @error('quantity')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror 
            </div>       
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="image">Imagen(*)</label>
                <div class="form-input">
                    <input name ="image" id="file" type="file" accept="image/png,image/jpeg"/>
                    {{-- {!! Form::file('image',null,['class' => 'form-control-file',
                                    'accept' => 'image/png,image/jpeg', 'id' => 'image']) !!} --}}
                    @error('image')
                        <br>
                        <small class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </small>
                    @enderror
                </div>
            </div>
            <div class="card my-4" style="width: 20rem;">  
                <div class="image-wrapper">
                    @isset($product->image)
                        <img id="picture" src="{{$product->image}}" alt="" style="max-width:100%;width:auto;height:auto;">
                    @else 
                        <img id="picture" src="https://fesu.edu.co/wp-content/themes/simbolo/assets/images/no-icono.png" alt="" style="max-width:100%;width:auto;height:auto;">    
                    @endisset
                </div>
            </div>
            <label for="description">Descripción(*)</label>
            <div class="input-group mb-3 ">
                <div class="input-group resize:none">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                    </div>
                    {!! Form::textarea('description',null,['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 
                                            'placeholder' => 'Ingrese descripción del producto', 
                                            'rows'  => '4',
                                            'id'    =>  'descript',
                                            'required' => true]) !!}
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
 
        </div>
        <div class="col-md-5">



        </div>
    </div>
    
</div>

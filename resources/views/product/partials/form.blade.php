<div class="form-group">
    {!! Form::label('name','Nombre:') !!}     
    {!! Form::text('name',null,['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el nombre del producto']) !!}

    @error('name')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror
    
    <br>
    <input id="file-input" name="imagenesperfil" type="file"/>
    <br>

    @error('image')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror

    {!! Form::label('price','Descripción:') !!}     
    {!! Form::text('price',null,['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el precio']) !!}

    
    @error('price')
    <span class="invalid-feedback">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    {!! Form::label('description','Descripción:') !!}     
    {!! Form::text('description',null,['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la descripción']) !!}

    
    @error('description')
    <span class="invalid-feedback">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    {!! Form::label('comission','Descripción:') !!}     
    {!! Form::text('comission',null,['class' => 'form-control' . ($errors->has('comission') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el valor de comisión']) !!}

    
    @error('comission')
    <span class="invalid-feedback">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    {!! Form::label('quantity','Descripción:') !!}     
    {!! Form::text('quantity',null,['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese cantidad disponible']) !!}

    
    @error('quantity')
    <span class="invalid-feedback">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    {!! Form::label('disccount','Descripción:') !!}     
    {!! Form::text('disccount',null,['class' => 'form-control' . ($errors->has('disccount') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese valor de descuento']) !!}

    
    @error('disccount')
    <span class="invalid-feedback">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    
    {!! Form::label('disccount','Descripción:') !!}     
    {!! Form::text('disccount',null,['class' => 'form-control' . ($errors->has('disccount') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese valor de descuento']) !!}



    @error('disccount')
    <span class="invalid-feedback">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    <div class="form-group">
        <h1>Categorias</h1>
        <select class="form-control">
            @foreach($categories as $category)
            <option>{{$category->name}}</option>
            @endforeach
        </select>
    </div>

</div>


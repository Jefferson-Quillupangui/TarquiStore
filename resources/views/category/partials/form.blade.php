<div class="form-group">
    {!! Form::label('name','Nombre:') !!}     
    {!! Form::text('name',null,['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el nombre de la categoria']) !!}

    @error('name')
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

</div>


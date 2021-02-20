@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    {{-- <h1><i class="fas fa-users"></i> Detalles del producto:</h1> --}}
@stop

@section('content')
  <!--Section: Block Content-->


    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
  
        <div id="mdb-lightbox-ui"></div>
  
        <div class="mdb-lightbox">

          <div class="row product-gallery mx-1">

              <div class="col-12 mb-0">

              <figure class="view overlay rounded z-depth-1 main-img">
                <a href="{{ asset($product->image) }}"
                  data-size="710x823">
                  <img src="{{ asset($product->image) }}"
                    class="img-fluid z-depth-1">
                </a>
              </figure>

            </div>

          </div>

        </div>
  
      </div>
      <div class="col-md-6">
  
        <h5>{{$product->name}}</h5>
        <p class="mb-2 text-muted text-uppercase small">{{ $product->Category->name }}</p>
            <p><span class="mr-1"><strong>${{$product->price}}</strong></span></p>
        <p class="pt-1">{{ $product->description}}</p>
        <div class="table-responsive">
          <table class="table table-sm table-borderless mb-0">
            <tbody>
              <tr>
                <th class="pl-0 w-25" scope="row"><strong>Comisión</strong></th>
                <td>${{ $product->comission}}</td>
              </tr>
              <tr>
                <th class="pl-0 w-25" scope="row"><strong>% Descto.</strong></th>
                <td>{{ $product->discount}}%</td>
              </tr>
              <tr>
                <th class="pl-0 w-25" scope="row"><strong>Precio Descto.</strong></th>
                <td>${{ $product->price_discount}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <hr>
        <div class="table-responsive mb-2">
          <table class="table table-sm table-borderless">
            <tbody>
              <tr>
                <td class="pl-0 pb-0 w-25">Cantidad disponible:</td>
                {{-- <td class="pb-0">Select size</td> --}}
              </tr>
              <tr>
                <td class="pl-0">
                  <div class="def-number-input number-input safari_only mb-0 ">
                    <p class="form-control col-md-3">&nbsp;{{ $product->quantity}} UND</p>
                  </div>
                </td>
                {{-- <td>
                  <div class="mt-1">
                    <div class="form-check form-check-inline pl-0">
                      <input type="radio" class="form-check-input" id="small" name="materialExampleRadios"
                        checked>
                      <label class="form-check-label small text-uppercase card-link-secondary"
                        for="small">Small</label>
                    </div>
                    <div class="form-check form-check-inline pl-0">
                      <input type="radio" class="form-check-input" id="medium" name="materialExampleRadios">
                      <label class="form-check-label small text-uppercase card-link-secondary"
                        for="medium">Medium</label>
                    </div>
                    <div class="form-check form-check-inline pl-0">
                      <input type="radio" class="form-check-input" id="large" name="materialExampleRadios">
                      <label class="form-check-label small text-uppercase card-link-secondary"
                        for="large">Large</label>
                    </div>
                  </div>
                </td> --}}
              </tr>
            </tbody>
          </table>
        </div>
        <a class="btn btn-info btn-md mr-1 mb-2"
                href="{{ route('products.index') }}">
                <i class="fas fa-long-arrow-alt-left pr-2"></i>Regresar</a>
        {{-- <button type="button" class="btn btn-light btn-md mr-1 mb-2"><i
            class="fas fa-long-arrow-alt-left pr-2"></i>Regresar</button> --}}
      </div>
    </div>
  

  <!--Section: Block Content-->
@stop

@section('css')

@stop

@section('js')

@stop
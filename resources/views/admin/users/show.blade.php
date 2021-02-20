@extends('adminlte::page')

@section('title', 'Usuario')

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
                <a href="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
                  data-size="710x823">
                  <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
                    class="img-fluid z-depth-1">
                </a>
              </figure>

            </div>

          </div>

        </div>
  
      </div>
      <div class="col-md-6">
  
        <h5>Nombre del producto</h5>
        <p class="mb-2 text-muted text-uppercase small">Categoria</p>
            <p><span class="mr-1"><strong>$12.99</strong></span></p>
        <p class="pt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sapiente illo. Sit
          error voluptas repellat rerum quidem, soluta enim perferendis voluptates laboriosam. Distinctio,
          officia quis dolore quos sapiente tempore alias.</p>
        <div class="table-responsive">
          <table class="table table-sm table-borderless mb-0">
            <tbody>
              <tr>
                <th class="pl-0 w-25" scope="row"><strong>Model</strong></th>
                <td>Shirt 5407X</td>
              </tr>
              <tr>
                <th class="pl-0 w-25" scope="row"><strong>Color</strong></th>
                <td>Black</td>
              </tr>
              <tr>
                <th class="pl-0 w-25" scope="row"><strong>Delivery</strong></th>
                <td>USA, Europe</td>
              </tr>
            </tbody>
          </table>
        </div>
        <hr>
        <div class="table-responsive mb-2">
          <table class="table table-sm table-borderless">
            <tbody>
              <tr>
                <td class="pl-0 pb-0 w-25">Quantity</td>
                <td class="pb-0">Select size</td>
              </tr>
              <tr>
                <td class="pl-0">
                  <div class="def-number-input number-input safari_only mb-0 mx-10">
                    <p class="form-control col-md-10">&nbsp;10 UND</p>
                  </div>
                </td>
                <td>
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
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <button type="button" class="btn btn-primary btn-md mr-1 mb-2"><i class="fas fa-long-arrow-alt-left pr-2"></i>Regresar</button>
        <button type="button" class="btn btn-light btn-md mr-1 mb-2"><i
            class="fas fa-long-arrow-alt-left pr-2"></i>Regresar</button>
      </div>
    </div>
  

  <!--Section: Block Content-->
@stop

@section('css')

@stop

@section('js')

@stop
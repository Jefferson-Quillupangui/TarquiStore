@if(session('status'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Éxito!</strong> {{session('status')}}
    <button type="button"
            class="close"
            data-dismiss="alert"
            arial-label="close">
        <span aria-hidden="true">&times; </span>
    </button>
</div>
@endif
 
@if(session('errorc'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{session('errorc')}}
    <button type="button"
            class="close"
            data-dismiss="alert"
            arial-label="close">
        <span aria-hidden="true">&times; </span>
    </button>
</div>
@endif
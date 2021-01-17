@if(session('status'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Éxito!</strong> {{session('status')}}
    <button type="button"
            class="close"
            data-dismiss="alert"
            arial-label="close">
        <span aria-hidden="true">&times; </span>
    </button>
</div>
@endif
<div class="col-lg-12">
    <!---msj de registrado correctamente -->
@if(Session::has('mSucces'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('mSucces') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!--msj de registro eliminado fallido --->
@if(Session::has('mDanger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('mDanger') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!--msj de warning --->
@if(Session::has('mWarning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('mWarning') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


</div>

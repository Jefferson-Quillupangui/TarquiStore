$('.op-eliminar').submit(function(e){
    e.preventDefault();

    Swal.fire({
        title: '¿Está seguro de eliminar el registro?',
        text: "Esta acción no se puede revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText:   'Cancelar'
        }).then((result) => {
            if (result.value) {
                    this.submit();
            }
    })
})
<script type="text/javascript">
    // Funcion para enviar un toast de notificacion y no redireccionar hasta que se cierre el toast
    function sendToast() {
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "3000",
            "timeOut": "5000",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success("Bienvenido a tu nuevo Club de Lectura!", "Clubes de Lectura");
    }
</script>
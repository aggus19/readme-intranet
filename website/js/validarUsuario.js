// script para validar campo de usuario con ajax, si existe o no en la base de datos.

$(document).ready(function(){
    $("#usuario").keyup(function(){
        var usuario = $("#usuario").val();
        $.post("validarUsuario.php", {usuario: usuario}, function(data){
            $("#resultado").html(data);
        });
    });
});





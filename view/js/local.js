$(document).ready(function(){
    habilitarBotones();
});

function habilitarBotones(){
    $("#editarLocal").click(function(){
        $("#altaLocal").prop("hidden",true);
        habilitarEdicion();
    });
    $("#altaLocal").click(function(){
        $("#eliminarLocal").prop("hidden",true);
        $("#altaLocal").prop("hidden",true);
        $("#altaEvento").prop("hidden",true);
        $("#editarLocal").prop("hidden",true);
        habilitarEdicion();
        $("#idLocal").prop("action", "/index.php?controller=local&action=createLocal");
        $("#nombre").prop("value", "");
        $("#direccion").prop("value", "");
        $("#telefono").prop("value", "");
        $("#email").prop("value", "");
    });
    $("#cancelarLocal").click(function(){
        location.reload(true);
    });
}

function habilitarEdicion(){
    $("#nombre").prop("disabled", false);
    $("#direccion").prop("disabled", false);
    $("#telefono").prop("disabled", false);
    $("#email").prop("disabled", false);
    $("#categoria").prop("disabled", false);
    $("#modificarLocal").prop("hidden", false);
    $("#cancelarLocal").prop("hidden",false);
}

$(document).ready(function(){
    habilitarBotones();
});

//Para variar un poco, unos con ajax y otros con el submit del form

function habilitarBotones(){
    $("#editarLocal").click(function(){
        $("#altaLocal").prop("hidden",true);
        habilitarEdicionLocal();
    });
    $("#altaLocal").click(function(){
        $("#eliminarLocal").prop("hidden",true);
        $("#altaLocal").prop("hidden",true);
        $("#altaEvento").prop("hidden",true);
        $("#editarLocal").prop("hidden",true);
        habilitarEdicionLocal();
        $("#idLocal").prop("action", "/index.php?controller=local&action=createLocal");
        $("#nombre").prop("value", "");
        $("#direccion").prop("value", "");
        $("#telefono").prop("value", "");
        $("#email").prop("value", "");
    });
    $("#cancelarLocal").click(function(){
        //reload para no tener que volver a deshabilitar los botones ni recargar los valores.
        location.reload(true);
    });
    $("#altaEvento").click(function () {
        $("#modalEvento").modal();
    });

    $(".botonEditar").click(function(){
        try{
            let id = $(this).parent().prop("id");
            $.post( "index.php?controller=evento&action=getEventData", {"id":id}, null, "json" )
                .done(function( data ) {
                    $("#modalEvento").modal();
                    $("#nombreEvento").val(data.nombre);
                    $("#descripcionEvento").val(data.descripcion);
                    $("#fechaEvento").val(data.fecha);
                    $("#lugarEvento").val(data.lugar);
                    $("#tipoEvento").val(data.tipo);
                    $("#idEvento").val(id);
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    throw textStatus + ". " + errorThrown;
                });
        }catch(er){
            alert(er.toString());
        }
    });
    $(".botonEliminar").click(function(){
        try{
            $.post("index.php?controller=evento&action=deleteEvento", {"id":$(this).parent().prop("id")}, (r)=>{
                if(r==1){
                    location.reload(true);
                }else{
                    throw "Error al borrar el Evento.";
                }
            });
        }catch(er){
            alert(er.toString());
        }
    });

    $("#guardarEvento").click(function(e){
        let accion = ($("#idEvento").val()==""? "insert":"update&idEvento=" + $("#idEvento").val()) ;
        $("#idEventoModal").prop("action","index.php?controller=evento&action=" + accion);
    });

    (function() {
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
}

function habilitarEdicionLocal(){
    $("#nombre").prop("disabled", false);
    $("#direccion").prop("disabled", false);
    $("#telefono").prop("disabled", false);
    $("#email").prop("disabled", false);
    $("#categoria").prop("disabled", false);
    $("#modificarLocal").prop("hidden", false);
    $("#cancelarLocal").prop("hidden",false);
}

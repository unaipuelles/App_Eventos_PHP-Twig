$(document).ready(function () {
    $(".eventoModal").on('click', function () {
       showModal(this);
    });
    $("#closeModal").on('click', function () {
        hideModal(this);
    });

    $("#busquedaTipo").on("click", busquedaTipo);
    $("#busquedaLocal").on("click", busquedaLocal);
    $("#busquedaFecha").on("click", busquedaFecha);
});

function showModal(clickedLink) {
    let id = $(clickedLink).attr('idEvento');
    $.ajax({
        type: "GET",
        url: "./api/evento/"+id
    }).done(function (data) {
        $("#nombreEvento").val(data['nombre']);
        $("#descripcionEvento").val(data['descripcion']);
        $("#fechaEvento").val(data['fecha']);
        $("#lugarEvento").val(data['lugar']);
        $("#tipoEvento").val(data['tipo']);
        $("#idEventoModal").attr("action", "./index.php?controller=evento&action=update&idEvento="+id);
    });
    $("#modalEvento").modal();
}

function hideModal() {
    $("#modalEvento").modal('hide');
}

function busquedaTipo() {
    let input = $("#busquedaInput");
    if(!verify(/^[A-z]{1,15}[ ]{0,1}[[A-z]{0,15}]{0,2}$/, input))
    {
        $.ajax({
            type: "GET",
            url: "./index.php?controller=evento&action=busqueda&type=tipo&query="+input.val().toLowerCase(),
        }).done(function (html) {
            $("#divTable").html(html);
        });
    }
}

function busquedaLocal() {
    let input = $("#busquedaInput");
    if(!verify(/^[A-z0-9]{1,15}[ ]{0,1}[[A-z0-9]{0,15}]{0,2}$/, input))
    {
        $.ajax({
            type: "GET",
            url: "./index.php?controller=evento&action=busqueda&type=local&query="+input.val().toLowerCase(),
        }).done(function (html) {
            $("#divTable").html(html);
        });
    }
}

function busquedaFecha() {
    let input = $("#busquedaInput");
    if(!verify(/^[12]\d{3}(?:(?:-(?:0[1-9]|1[0-2]))(?:-(?:0[1-9]|[12]\d|3[01]))?)?$/, input))
    {
        $.ajax({
            type: "GET",
            url: "./index.php?controller=evento&action=busqueda&type=fecha&query="+input.val(),
        }).done(function (html) {
            $("#divTable").html(html);
        });
    }
}

function verify(regExp, input) {
    let errores = true;
    if(verificar(regExp, input.val())){
        input.removeClass("is-invalid");
        input.addClass("is-valid");
        errores = false;
    }
    else
        input.addClass("is-invalid");
    return errores;
}

function verificar(regExp, string) {
    let rexp = new RegExp(regExp);
    return rexp.test(string);
}
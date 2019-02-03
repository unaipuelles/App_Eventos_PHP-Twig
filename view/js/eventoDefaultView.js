$(document).ready(function () {
    $(".eventoModal").on('click', function () {
       showModal(this);
    });
    $("#closeModal").on('click', function () {
        hideModal(this);
    });
});

function showModal(clickedLink) {
    alert($(clickedLink).attr('idEvento'))
    $.ajax({
        type: "GET",
        url: "./api/evento/"+$(clickedLink).attr('idEvento')
    }).done(function (data) {
        data = JSON.parse(data);
        $("#nombre").val(data['nombre']);
        $("#descripcion").val(data['descripcion']);
        $("#fecha").val(data['fecha']);
        $("#lugar").val(data['lugar']);
        $("#"+data['tipo']).attr("selected", "selected");
    });
    $("#modalEvento").modal();
}

function hideModal() {
    $("#modalEvento").modal('hide');
}
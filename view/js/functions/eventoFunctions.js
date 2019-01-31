$.ready(function(){
    eventoButtons();
});

function eventoButtons(){
    $(".edit").click(function(){
        constructEvento($(this).attr("id"),$(this).attr("id"), $(this).parent().parent().attr("nombre"),$(this).parent().parent().attr("tipo"),
            $(this).parent().parent().attr("fecha"), $(this).parent().parent().attr("descripcion"), $(this).parent().parent().attr("lugar"));
    });

    $(".delete").click(function(){

    });
}

function constructEvento(id, nombre, tipo, fecha, descripcion, lugar){
    let ev = new Evento(id, nombre, tipo, fecha, descripcion, lugar);
    eventoSendAjax("edit",ev)
}

function eventoSendAjax(comand, data){
    let url;
    switch(command){
        case "add":
            url = "/controller/api/evento.php?comando=add";
            break;
        case "edit":
            url = "/controller/api/evento.php?comando=edit";
            break;
        case "delete":
            url = "/controller/api/evento.php?comando=delete";
            break;
    }
    $.ajax({
        type: "post",
        url: url,
        data: data,
        success: function(resultado){
            (resultado!=null)? $("#votoPregunta").text(data) : campo.text(data);
        }

    });
}
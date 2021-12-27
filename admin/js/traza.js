$(document).ready(function() {
    load(1);
});
//funcion para mostrar el ajax llamado ticket.php donde se muestra la tabla de tickets
function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/trazabilidad.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}

//funcion para eliminar los tickets creados

function eliminar(traza_id) {
    var q = $("#q").val();
    if (confirm("Realmente deseas eliminar la trazabilidad?")) {
        $.ajax({
            type: "GET",
            url: "./ajax/trazabilidad.php",
            data: "traza_id=" + traza_id,
            "q": q,
            beforeSend: function(objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados").html(datos);
                load(1);
            }
        });
    }
}
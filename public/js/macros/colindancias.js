/**
 * Created by Marcela on 24/06/2015.
 */

if (typeof JsonColindancias != 'undefined' && JsonColindancias.length > 0) {

    i = 0;
    $(JsonColindancias).each(function () {
        var $div = $('div[id^="colindanciaDiv"]:last');
        var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;

        var clon = $div.clone(true, true).prop('id', 'colindanciaDiv' + num);

        var orientacion = clon.find('select')[0];
        var superficie = clon.find('input')[0];
        var colindancia = clon.find('input')[1];

        orientacion.name = 'colindancia[' + num + '][orientacion]';
        superficie.name = 'colindancia[' + num + '][superficie]';
        clon.find('input')[1].name = 'colindancia[' + num + '][colindancia]';

        $(orientacion).val(JsonColindancias[i].orientacion);
        $(superficie).val(JsonColindancias[i].superficie);
        $(colindancia).val(JsonColindancias[i].colindancia);

        $($div).after(clon);
        i++;

    });

    //borar primer div
    $('#colindanciaDiv1').remove();

}


$(".agregarColindancia").click(function () {

    var $div = $('div[id^="colindanciaDiv"]:last');
    var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;

    var clon = $div.clone(true, true).prop('id', 'colindanciaDiv' + num);
    var orientacion = clon.find('select')[0];
    var superficie = clon.find('input')[0];
    var colindancia = clon.find('input')[1];

    //modificamos el nombre
    orientacion.name = orientacion.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
    superficie.name = superficie.name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
    clon.find('input')[1].name = clon.find('input')[1].name.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");

    //los creamos en blanco
    $(orientacion).val('');
    $(superficie).val('');
    $(colindancia).val('');

    $($div).after(clon);

});

$(".quitarColindancia").click(function () {
    var confirma = confirm('¿Está seguro que desea borrar la colindancia?');
    if (confirma == true) {
        var kids = $("#divsColindancias").children();
        var len = kids.length;
        if (len > 1) {
            var divBorrar = ($(this).parent().parent().attr('id'));
            $('#' + divBorrar).remove();
        }
        else {
            $(this).parent().parent().find('input').val(null);
            $(this).parent().parent().find('select').val(null);
        }
    }
});




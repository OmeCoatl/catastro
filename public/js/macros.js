$(document).ready(function()
{
    $("input[type='radio']").click(function() {



           if ($(this).data('tipo') == "enajenante")
        {
            //alert( $(this).attr('id'));
            var tipo = $(this).val();
            //alert(tipo);
            if ($(this).val() == 2) {
            $("#id_tipo").val(2);
            var id = $(this).attr('id');
            //oculta label de apellido_paterno
            $('.'+id).hide();
            //oculta input de apellido_paterno
            var curp = id+"[rfc]";

            $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).removeAttr('required');
            $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

             //Habilitamos el autocomplete del curp
                    $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");
                    //Deshabilitamos el autocomplete del rfc
                    $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
        }



                  else if ($(this).val() ==1) {
                $("#id_tipo").val(1);
              var id = $(this).attr('id');
          //oculta label de apellido_paterno
          $('.'+id).show();
          //oculta input de apellido_paterno
          var curp = id+"[rfc]";
          //$( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).removeAttr('required');
          $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');

           //Habilitamos el autocomplete del curp
                    $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");


        }

}

       if ($(this).data('tipo') == "adquiriente")
        {
          //alert( $(this).attr('id'));
          var tipo = $(this).val();
          //alert(tipo);
              if ($(this).val() == 2) {
                $("#id_tipo").val(2);
              var id = $(this).attr('id');
          //oculta label de apellido_paterno
          $('.'+id).hide();
          //oculta input de apellido_paterno
          var curp = id+"[rfc]";
          //$( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).removeAttr('required');
           $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

            //Habilitamos el autocomplete del curp
                    $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");
                    //Deshabilitamos el autocomplete del rfc
                    $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
        }



                  else if ($(this).val() ==1) {
                $("#id_tipo").val(1);
              var id = $(this).attr('id');
          //oculta label de apellido_paterno
          $('.'+id).show();
          //oculta input de apellido_paterno
          var curp = id+"[rfc]";
         //$( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr("required", "true");
         $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');

         //Habilitamos el autocomplete del curp
                    $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("enable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");

        }

}

});
    });


 //autocompletar enajenante
/*  $(function () {
      var curpe = "enajenante[curp]";
        $('#' + curpe.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete({
            source: "/registro/autocomplete",
            minLength: 18,
            select: function (event, ui) {
                var res = "enajenante[response]";
                $('#' + res.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.id);
                var nombres = "enajenante[nombres]";
                $('#' + nombres.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.nombres);
                var apellido_paterno = "enajenante[apellido_paterno]";
                $('#' + apellido_paterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.apellido_paterno);
                var apellido_materno = "enajenante[apellido_materno]";
                $('#' + apellido_materno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.apellido_materno);
                var rfc = "enajenante[rfc]";
                $('#' + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.rfc);
            }
        });
    });


  //autocompletar adquiriente
  $(function () {
         var curpa = "adquiriente[curp]";
        $('#' + curpa.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete({
            source: "/registro/autocomplete",
            minLength: 18,
            select: function (event, ui) {
                var res = "adquiriente[response]";
                $('#' + res.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.id);
                var nombres = "adquiriente[nombres]";
                $('#' + nombres.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.nombres);
                var apellido_paterno = "adquiriente[apellido_paterno]";
                $('#' + apellido_paterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.apellido_paterno);
                var apellido_materno = "adquiriente[apellido_materno]";
                $('#' + apellido_materno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.apellido_materno);
                var rfc = "adquiriente[rfc]";
                $('#' + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.rfc);
            }
        });
    });*/


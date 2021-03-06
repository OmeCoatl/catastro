{{ HTML::style('js/jquery/jquery-ui.css') }}

{{ HTML::script('js/jquery/jquery-ui.js') }}
<script>
   //Calendario
$(function() {
    $( "#datepicker" ).datepicker();
  });
//Cambiar a español el calendario
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: '',
 beforeShowDay: $.datepicker.noWeekends 
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>
<script>

            // Al presionar cualquier tecla en cualquier campo de texto, ejectuamos la siguiente función
            $('input').on('keydown', function (e) {

                if (e.keyCode === 13)
                {
                    // Obtenemos el número del tabindex del campo actual
                    var currentTabIndex = $(this).attr('tabindex');
                    // Le sumamos 1 :P
                    var nextTabIndex = parseInt(currentTabIndex) + 1;
                    // Obtenemos (si existe) el siguiente elemento usando la variable nextTabIndex
                    var nextField = $('[tabindex=' + nextTabIndex + ']');
                    // Si se encontró un elemento:
                    if (nextField.length > 0)
                    {
                        // Hacerle focus / seleccionarlo
                        nextField.focus();
                        // Ignorar el funcionamiento predeterminado (enviar el formulario)
                        e.preventDefault();
                    }
                    // Si no se encontro ningún elemento, no hacemos nada (se envia el formulario)
                }
            });


</script>

<script >
    $(document).ready(function(){
  $("#datepicker").on('change', function () {
    //fecha actual en el calendario
    var fecha_e = $('#datepicker').val();
    //fecha actual del sistema
    var fecha_traida =$('#fecha_r').val();
    //fecha de validacion traida de la base de datos
    var validacion = $('#validacion').val();
    var myArray = validacion.split('-');
    //var concatenado = myArray[2]+'/'+myArray[1]+'/'+myArray[0];
   


    if(fecha_e < validacion)
   {
        alert('La fecha debe de ser mayor a la fecha de emisón requerimiento'+ validacion);
        $('#datepicker').val(validacion);
    }

     });
  });
</script>

<?php $fecha= date("Y-m-d"); ?>
<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Datos Entrega</h4>
</div>

{{ Form::open(array('url'=>'ejecucion/guardar')) }}

<div style="margin-left: 20px">
    <div style="margin-right: 20px">
        <div class="form-group">
            {{Form::text('id',$idrequerimiento,['id' => 'id', 'hidden'] )}}
             {{Form::text('validacion',$fechas,['id' => 'validacion', 'hidden'] )}}
            {{Form::text('fecha_r',$fecha,['id' => 'fecha_r', 'hidden'] )}}
            {{$errors->first('id', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('date','Fecha Notificacion')}}
            {{Form::text('date', $fecha, ['id'=>'datepicker', 'class'=>'btn btn-default btn-sm dropdown-toggle'] )}}
            {{$errors->first('date', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('nombre_ejecutor','Notificador')}}
             <select name="ejecutores" class="form-control">
            @foreach($catalogo as $row)
            <option value="{{$row->id}}">{{$row->nombre}}</option>
            @endforeach
    </select>
            {{$errors->first('nombre_ejecutor', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('notificacion','Via Notificación')}}
            {{Form::text('notificacion', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.nombres'] )}}
            {{$errors->first('notificacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('nombre','Nombre Persona')}}
            {{Form::text('nombre', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.rfc'] )}}
            {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('identificacion','Tipo Identificacion')}}
            {{Form::text('identificacion', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('identificacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('clave','Clave Identificacion')}}
            {{Form::text('clave', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('observaciones','Observaciones')}}
            {{Form::text('observaciones', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('observaciones', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-actions form-group">
            {{ Form::submit('Guardar Datos', array('class' => 'btn btn-primary')) }} 
            {{ Form::reset('Limpiar ', ['class' => 'btn btn-warning']) }}
            <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Cancelar Registro</button>
            {{Form::close()}}
        </div>
    </div>
</div>


{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
{{ HTML::script('js/jquery/jquery.validate.min.js') }}
@stop

<div class="form-group">
    {{Form::label('zona','Zona')}}
    {{Form::text('zona', null, ['Placeholder'=>'Zona','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'1'] )}}
    {{$errors->first('zona', '<span class=text-danger>:message</span>')}}

    <p class="help-block">Zona geografica en la que aplica el salario minimo.</p>
</div>
<div class="form-group">
    {{Form::label('anio','Año')}}
    <!--{{Form::select('anio',$anio, null,['Under 18', 'tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.anio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}-->
    {{Form::text('anio', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.anio','readonly'=>'readonly','tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('anio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
<span id="temp_date_start"></span>

<div class="form-group">
    {{Form::label('salario_minimo','Salario minimo')}}
    {{Form::text('salario_minimo', null, ['Placeholder'=>'Salario Minimo','tabindex'=>'2','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.salario_minimo', 'onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('salario_minimo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Valor del salario minimo.</p>
</div>

<div class="form-group">
    {{Form::label('fecha_inicio_periodo','Fecha inicio')}}
    {{Form::input('date2','fecha_inicio_periodo', null, ['Placeholder'=>'Fecha Inicio','tabindex'=>'3','class'=>'fecha form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_inicio_periodo'] )}}
    {{$errors->first('fecha_inicio_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('fecha_termino_periodo','Fecha termino')}}
    {{Form::input('date2','fecha_termino_periodo', null, ['Placeholder'=>'Fecha Termino','tabindex'=>'4','class'=>'fecha form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_termino_periodo'] )}}
    {{$errors->first('fecha_termino_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
@section('styles')

.my-error-class
{
color:red;
font: bold 85% monospace;
}
#result
{
color:red;
font: bold 85% monospace;
}

@stop
@section('javascript')

<script>

    function aMayusculas(obj, id) {
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }
//Numero
    function justNumbers(e)
    {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;

        return /\d/.test(String.fromCharCode(keynum));
    }
//Calendario
    $(function () {
        $("#fecha_inicio_periodo").datepicker({
            changeMonth: true,
            numberOfMonths: 2,
            onClose: function (selectedDate) {
                $("#fecha_termino_periodo").datepicker("option", "minDate", selectedDate);
            },
            onSelect: function (selectedDate) {
                //dateFormat: 'DD, MM d, yy'
                var theDate = selectedDate;
                var arr = theDate.split('-');
                var anio = arr[0];
                $("#anio").val(anio);
//                console.log(theDate);
            }
        });
        $("#fecha_termino_periodo").datepicker({
            changeMonth: true,
            numberOfMonths: 2,
            onClose: function (selectedDate) {
                $("#fecha_inicio_periodo").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
//Cambiar a español el calendario
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
        $("#fecha").datepicker();
    });
//Mensaje para eliminar
    $("body").delegate('.eliminar', 'click', function () {
        if (!confirm("¿Seguro que quiere eliminar el salario minimo?")) {
            return false;
        }

    });
//Validador
    $.validator.addMethod(
            "date",
            function (value, element) {
                var bits = value.match(/([0-9]+)/gi), str;
                if (!bits)
                    return this.optional(element) || false;
                str = bits[ 1 ] + '-' + bits[ 0 ] + '-' + bits[ 2 ];
                return this.optional(element) || !/Invalid|NaN/.test(new Date(str));
            },
            "Please enter a date in the format yy-mm-dd"
            );
</script>
<script>
    $(document).ready(function () {

//        $('#form').on('submit', function () {
        $("#form").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules:
                    {
                        zona:
                                {
                                    required: true,
                                },
                        salario_minimo:
                                {
                                    required: true,
                                },
                        anio:
                                {
                                    required: true,
                                },
                        fecha_inicio_periodo:
                                {
                                    required: true,
                                  
                                },
                        fecha_termino_periodo:
                                {
                                    required: true,
                                
                                }
                    },
            messages: {
                zona: {
                    required: "Campo requerido: Zona",
                },
                salario_minimo:
                        {
                            required: "Campo requerido: Salario Minimo",
                        },
                anio:
                        {
                            required: "Campo requerido: Año",
                        },
                fecha_inicio_periodo:
                        {
                            required: "Campo requerido:Fecha Inicio",
                           
                        },
                fecha_termino_periodo:
                        {
                            required: "Campo requerido: Fecha Termino",
                           
                        }
            }
        });
    });
</script>
<script>
    // Al presionar cualquier tecla en cualquier campo de texto, ejectuamos la siguiente función
    $('input').on('keydown', function (e) {
        // Solo nos importa si la tecla presionada fue ENTER... (Para ver el código de otras teclas: http://www.webonweboff.com/tips/js/event_key_codes.aspx)
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
<script>
    $(document).ready(function () {
        $('#form').submit(function () {
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (data) {
//                    $('#result').text("Datos Creado Correctamente");
//                    alert(data.id);
                    if (data.id === "Traslape de rango de fecha") {
//                        console.log("Traslape");
                        alert("Traslape de rango de fecha");
                    }
                    if (data.id != "Traslape de rango de fecha") {
                        // if (data.id === data.id) {
                        location.reload();
                        $('#reset').click();
//                        console.log("Guardando  y hay que refrescar");
//                        alert("Guardando");
//                        alert(data.id);
                    }
                }}) 
            return false;
        });
    })
</script>
@append
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script language="javascript">
            $(document).ready(function () {
                $().ajaxStart(function () {
                    $('#loading').show();
                    $('#result').hide();
                }).ajaxStop(function () {
                    $('#loading').hide();
                    $('#result').fadeIn('slow');
                });
                $('#form, #fat, #fo3').submit(function () {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function (data) {
                            $('#result').text("Datos Creado Correctamente");
                            $('#reset').click();
                            $('#cerrar').click();
                            $('#response').val(data.id_p);
                        }
                    })

                    return false;
                });
            })
        </script>
        <script>
            $('#fo3').on('submit',function(){
            var Value = $( "#nombres" ).val();
            var appa = $( "#apellido_paterno" ).val();
            var apma = $( "#apellido_materno" ).val();
            $('#nombrec').val(Value+" "+appa+" "+ apma);
            
           
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
    </head>

    <body>
        <div class="modal-header">
            <h4 class="modal-titulo" id="condominio-titulo">Personas</h4>
        </div>
        {{ Form::open(array('id'=>'fo3','name'=>'fo3')) }}
        <div style="margin-left: 14px;margin-right: 14px;">
            
            <div class="form-group">
                {{Form::label('apellido_paterno','Apellido Paterno')}}
                {{Form::text('apellido_paterno', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.apellido_paterno','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                {{Form::label('apellido_materno','Apellido Materno')}}
                {{Form::text('apellido_materno', null, ['tabindex'=>'1','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.apellido_materno','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                {{Form::label('nombres','Nombres')}}
                {{Form::text('nombres', null, ['tabindex'=>'2','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.nombres','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                {{Form::label('rfc','RFC')}}
                {{Form::text('rfc', null, ['tabindex'=>'3','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.rfc','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                {{Form::label('curp','CURP')}}
                {{Form::text('curp', null, ['tabindex'=>'4','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp','onblur'=>'aMayusculas(this.value,this.id)'] )}}
                {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
                <p class="help-block"></p>
            </div>

            <div class="form-actions form-group">
                {{ Form::submit('Guardar nombre', array('class' => 'btn btn-primary','id'=>'guardar')) }} 
                {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning','id'=>'reset']) }}
                <button class="btn btn-danger" type="button" id="cerrar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                {{Form::close()}}
            </div>
        </div>
        <!--<div id="result"></div>-->
    </body>
</html>


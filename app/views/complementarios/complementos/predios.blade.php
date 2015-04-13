



{{Form::open(array('url' => 'guardar-predios', 'method' => 'POST', 'name' => 'formPredios', 'id' => 'formPredios'))}}
	<div class="panel-body">
		{{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
		<div class="row">
			<div class="col-md-6">
        <div class="form-group">
          {{Form::label('Ltipo_predio','Tipo Predio')}}   
          {{Form::select('tipo_predio', ['U' => 'U','R' => 'R'], null, ['id'=>'tipo_predio', 'class' => 'form-control'])}}
        </div>
      </div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Lniveles','Niveles')}}
					{{Form::number('niveles','',['class'=>'form-control bfh-number','required', 'id'=>'niveles', 'min' => '1' ])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Lfolio','Folio')}}
					{{Form::text('folio','',['class'=>'form-control','required', 'id'=>'folio'])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Lsuperficie_terreno','Superficie Terreno')}}
					{{Form::text('superficie_terreno','',['class'=>'form-control','required', 'id'=>'superficie_terreno'])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Luso_construccion','Uso Connstrucción')}}
					{{Form::select('uso_construccion',  $tuc, null, ['id'=>'uso_construccion', 'class' => 'form-control'])}}

				</div>
			</div>
		</div>
	</div>
<button type="submit" class="btn btn-primary next">
	Siguiente
	<i class="glyphicon glyphicon-chevron-right"></i>
</button>

{{Form::close()}}

@section('javascript')


<script type="text/javascript">

$('#formPredios').bind('submit',function () 
    {
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/guardar-predios',

            success: function (data) 
            {


            }
        });
        return false;
    });


$(document).ready(function(){
  $("#niveles").keydown(function(event) {
     if(event.shiftKey)
     {
          event.preventDefault();
     }

     if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 189 || event.keyCode == 109 )    {
     }
     else {
          if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                  event.preventDefault();
            }
          }
          else {
                if (event.keyCode < 96 || event.keyCode > 105) {
                    event.preventDefault();
                }
          }
        }
     });
  });
</script>

@append

	

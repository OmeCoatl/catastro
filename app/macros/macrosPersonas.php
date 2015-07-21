<?php
Form::macro('personas', function($llave)
{




$personas = '<div class="form-group col-md-6">
            <h3> Adquiriente </h3>

            <div class="">'.
           
                Form::label('tipo_persona','Tipo de persona', ['class'=>'']).
                '<br>'.
                Form::label('tipo_persona','Física', ['class'=>'']).
                 Form::radio($llave.'[id_tipo]', '1', null, ['class'=>$llave.'-radio-persona ', 'data-tipo' => $llave ]).
                Form::label('tipo_persona','Moral', ['class'=>'']).
                 Form::radio($llave.'[id_tipo]', '2', null, ['class'=>$llave.'-radio-persona ','data-tipo' => $llave]).

            '</div>'.

            Form::label($llave.'[nombres]','Nombre', ['class'=>'']).
            Form::text($llave.'[nombres]', null, ['class' => 'form-control', 'required'=>true] ).

            '<span class="$llave-campos-fisica">'.

            Form::label($llave.'[apellido_paterno]','Apellido Paterno', ['class'=>'']).
                Form::text($llave.'[apellido_paterno]', null, ['class' => 'form-control'] ).
                Form::label($llave.'[apellido_materno]','Apellido Materno', ['class'=>'']).
                Form::text($llave.'[apellido_materno]', null, ['class' => 'form-control'] ).

                Form::label($llave.'[curp]','CURP', ['class'=>'']).
                Form::text($llave.'[curp]', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado']).

        '</span>'.

            Form::label($llave.'[rfc]','RFC', ['class'=>'']).
            Form::text($llave.'[rfc]', null, ['class' => 'form-control', 'id'=>$llave.'-rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] ).

        '</div>';




    return $personas;
});
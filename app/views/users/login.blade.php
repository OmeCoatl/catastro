@extends('layouts.default')

@section('content')

<div class="container">
<br>
<br>
<br>
<br>
<br>
<br>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Sistema de Gestión Catastral</h3>
                </div>
                <div class="panel-body">
                    {{ Form::open(array('url' => 'users/login', 'method' => 'POST')) }}

                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            {{ Form::text('username', null, array('class' => 'form-control focus', 'placeholder'=>'Nombre de usuario', 'autofocus'=> 'autofocus')) }}
                        </div>

                        <br/>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Contraseña')) }}
                        </div>

                        <br/>

                        {{ Form::submit('Entrar al sistema', array('class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@stop
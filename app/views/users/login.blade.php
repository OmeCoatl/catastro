@extends('layouts.nosession')

@section('styles')
<style>
    .login {
        position: inherit;
        width: 350px;
        margin: 0 auto;
        padding: 40px 0;
    }
    .panel-title {
        font-size: 24px;
    }
    .panel-heading{
        width: 200px;
    }
    .panel-heading img{
        width: 100%
    }
</style>
@stop

@section('content')

<div class="row">
    <div class="login">
        <div class="panel">
            <div class="panel-heading">
                <img src="http://104.236.22.240/css/images/main/logo-header.png">
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
@stop
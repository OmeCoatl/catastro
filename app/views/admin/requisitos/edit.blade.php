@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

    <div class="row">
    <a href="{{URL::route('admin.requisitos.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-md-4">

            {{ Form::model($requisito, ['route' => array('admin.requisitos.update', $requisito->id ), 'method'=>'put' ]) }}

                @include('admin.requisitos._form', compact('requisito'))

                <div class="form-actions form-group">
                  {{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
                </div>
            {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.requisitos._list', compact('requisitos'))

        </div>
    </div>

@stop


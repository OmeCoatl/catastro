@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{ HTML::style('css/select2.min.css') }}
    <style type="text/css">
        .select2-selection__choice span{
            padding-top: 0;
        }
        .select2-container{
            width: 100% !important;
        }
    </style>

    <div class="row">
        <a href="{{URL::route('admin.tipotramites.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-md-4">

            {{ Form::model($tipotramite, ['route' => array('admin.tipotramites.update', $tipotramite->id ), 'method'=>'put' ]) }}

            @include('admin.tipotramites._form', compact('tipotramite'))

            <div class="form-actions form-group">
                {{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
                {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
            </div>
            {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.tipotramites._list', compact('tipotramites'))

        </div>
    </div>

@stop

@extends('layouts.default')
@section('title')
{{{ $title }}} :: @parent
@stop
@section('content')
<div class="row">
	<a href="{{URL::route('corevat.CatClaseGeneralInmueble.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i>Regresar</a>
	<div class="col-md-4">
        {{ Form::open(array('id'=>'form','url' => 'corevat/CatClaseGeneralInmueble/', 'method' => 'POST')) }}
		@include('CorevatCatalogos.CatClaseGeneralInmueble._form')
		<div class="form-actions form-group">
			{{ Form::submit('Crear una nuevo registro', array('class' => 'btn btn-primary')) }} 
			{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
		</div>
		{{Form::close()}}
	</div>
	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.CatClaseGeneralInmueble._list', compact('CatClaseGeneralInmueble'))<!--_list -->
	</div>
</div>
@stop

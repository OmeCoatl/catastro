@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatFactoresForma')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatFactoresFormaController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatFactoresForma._list', compact('CatFactoresForma'))
</div>
@stop

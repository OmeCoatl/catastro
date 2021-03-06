<div id="lista-tramites">
{{DiffFormatter::alias('es_mx', 'es');}}
<div class="panel">
    <div class="panel-heading">
    </div>
    @if($tramites->count() == 0)
        <div class="panel-body">
            <p>No hay trámites actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
        <table class="table" >
            <thead>
            <tr>
                <th>Trámite</th>
                <th>Folio</th>
                <th style="text-align: center;">Solicitante</th>
                <th style="text-align: center;">Notaría</th>
                <th style="text-align: center;">Inicio</th>
                <th style="text-align: center;">Departamento</th>
                <th style="text-align: center;">Estatus</th>
                <th style="text-align: center;">Acción</th>
            </tr>
            </thead>
            <tbody>


            @foreach($tramites as $key=>$tramite)
                <tr class="<?php if($key % 2){
                    echo "bg-gray01";
                } ?>">
                    <td >
                        {{$tramite->tipotramite->nombre}}
                    </td>
                    <td nowrap>
                        {{$tramite->anio}}/{{$tramite->municipio}}/{{sprintf("%06d",$tramite->folio)}}
                    </td>
                    <td>
                        {{$tramite->solicitante->nombrec}}
                    </td>
                    <td>
                        @if($tramite->notaria)
                            {{$tramite->notaria->nombre}}
                        @endif
                    </td>
                    <td nowrap>
                        {{$tramite->created_at->format("Y-m-d")}}
                    </td>
                    <td>
                        {{$tramite->departamento->descripcion}}
                    </td>
                    <td nowrap>
                        @if($tramite->estatus)
                            {{$tramite->estatus->pasado}}
                        @Endif
                    </td>
                    <td style="text-align: right;" nowrap>
                        @if(Auth::user()->hasRoleId($tramite->role_id))

                                @if($tramite->estatus->pasado == 'Finalizado' || $tramite->estatus->pasado == 'Finalizado observado')
                                    <a href="{{ action('TramitesController@proceso', ['id' => $tramite->id]) }}" class="btn btn-info btn-actionForm01" title="Revisar">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    @else
                                    <a href="{{ action('TramitesController@proceso', ['id' => $tramite->id]) }}" class="btn btn-success btn-actionForm01" title="Atender">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                @endif

                        @else
                            <a href="{{ action('TramitesController@proceso', ['id' => $tramite->id]) }}" class="btn btn-info btn-actionForm01" title="Revisar">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>
                        @endif
                            <a href="{{ action('TramitesController@get_pdf', ['id' => $tramite->id]) }}" class="btn btn-warning btn-actionForm01" title="Recibo" target="_blank">
                                <span class="glyphicon glyphicon-print"></span>
                            </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $tramites->links() }}

</div>
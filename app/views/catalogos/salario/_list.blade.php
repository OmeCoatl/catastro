<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Salario Minimo</h3>
    </div>
    @if(count($salarios) == 0)
    <div class="panel-body">
        <p>No hay requisitos dados de alta actualmente en el sistema.</p>
    </div>
    @endif
    <div class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Termino</th>
                    <th>Zona</th>
                    <th>Salario Minimo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salarios as $row)
                <tr>
                    <td>
                        {{$row->anio}}
                    </td>
                    <td>
                        {{$row->fecha_inicio_periodo}}
                    </td>
                    <td>
                        {{$row->fecha_termino_periodo}}
                    </td>
                    <td>
                        {{$row->zona}}
                    </td>
                    <td>
                        {{$row->salario_minimo}}
                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('catalogos.salario.destroy', 'id'=>$row->id_salario_minimo))) }}
                        <a href="{{ action('catalogos_salarioController@edit',['id'=>$row->id_salario_minimo])}}" class="btn btn-warning" title="Editar requisito">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
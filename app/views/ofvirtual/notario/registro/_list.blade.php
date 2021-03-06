<div id="lista-tramites">
    <div class="panel">


        <div class="alert alert-success" id="dominio-eliminado" style="display: none;">
            <h4><span class="glyphicon glyphicon-ok"></span> Se eliminó correctamente el registro de escritura.</h4>
        </div>

        @if(count($registros) == 0)
            <div class="panel-body">
            <div class="alert alert-warning" role="alert">No hay registros de escrituras dados de alta actualmente en el sistema.</div>
            </div>
        @endif

        <div class="list-group">
         <br/>
          <table class="table">
                <thead>
                <tr>
                    <th>Clave</th>
                    <th>Cuenta</th>
                    <th>Adquiriente</th>
                    <th>Enajenante</th>
                    <th>Fecha</th>
                    <th>Folio</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($registros as $registro)
                    <tr id="traslado-{{$registro->id}}">

                        <td nowrap>
                            {{$registro->clave}}
                        </td>
                        <td>
                            {{$registro->cuenta}}
                        </td>
                        <td>{{$registro->adquiriente->nombres}} {{$registro->adquiriente->apellido_paterno}} {{$registro->adquiriente->apellido_materno}}</td>

                        <td> {{$registro->enajenante->nombres}} {{$registro->enajenante->apellido_paterno}} {{$registro->enajenante->apellido_materno}}</td>
                        <td nowrap> {{$registro->created_at->format("d-m-Y")}}</td>
                        <td nowrap> {{$registro->folio}}</td>
                        <td style="text-align: right;" nowrap>

                            @if(!is_null($registro->folio))
                                <a href="{{ action('ofvirtual_RegistroEscrituraController@show', ['id' => $registro->id]) }}"
                                   class="btn btn-info" title="Ver registro">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                </a>


                                <a href="{{ action('ofvirtual_RegistroEscrituraController@imprimir', ['id' => $registro->id]) }}"
                                   class="print btn btn-info" target="_blank">
                                    <span class="glyphicon glyphicon-print"></span>
                                </a>
                            @else

                                <a href="{{ action('ofvirtual_RegistroEscrituraController@edit', ['id' => $registro->id]) }}"
                                   class="btn btn-warning" title="Editar registro">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#confirm-delete"
                                   class="btn-borrar btn btn-danger" data-traslado_id="{{$registro->id}}">
                                    <span class="glyphicon glyphicon-trash danger"></span>
                                </a>
                            @endif


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--60 líneas de código en algo que se pudo hacer con 2 :/ -->


<!-- Modal para confirmar cuando se borra un documento -->
<div class="modal fade modal-borrar" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-delete"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="confirm-logout-title">Confirme la acción:</h4>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center">¿Desea eliminar el registro de escritura de su lista? <br>Esta acción no
                    puede deshacerse.</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger btn-submit-borrar" data-documento_id=""
                        data-dismiss="modal">
                    <span class="glyphicon glyphicon-trash "></span> Eliminar registro de escritura
                </button>
                <input type="hidden" name="documento_id" id="documento_id">
            </div>
        </div>
    </div>
</div>


@section('javascript')
    <script type="text/javascript">

        $(function () {

            //Cuando se activa la modal se pasa el documento_id correspondiente al botón que mostró la modal
            $('.modal-borrar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var traslado_id = button.data('traslado_id');
                $('#documento_id').val(documento_id);
                $('.btn-submit-borrar').data('traslado_id', traslado_id);
            });

            //Cuando se da click en el botón de borrar de la modal:
            $('.btn-submit-borrar').click(function () {
                var traslado_id = $(this).data('traslado_id');
                console.log('se quiere borrar este: ' + traslado_id);
                $.get("{{url('ofvirtual/notario/registro/destroy/')}}" + '/' + traslado_id, function (data) {
                    console.log('Regresa de borrar el traslado:' + traslado_id);
                    $('#traslado-' + traslado_id).hide();
                    $('#dominio-eliminado').show();
                    return false;
                });


            });
        });
    </script>
@append
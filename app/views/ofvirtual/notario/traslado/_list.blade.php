<div id="lista-tramites">
    <div class="panel">


        <div class="alert alert-success" id="dominio-eliminado" style="display: none;">
            <h4><span class="glyphicon glyphicon-ok"></span> Se eliminó correctamente el traslado de dominio.</h4>
        </div>

        @if(count($traslados) == 0)
            <div class="panel-body">
                <p>No hay traslados de dominio dados de alta actualmente en el sistema.</p>
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
                @foreach($traslados as $traslado)
                    <tr id="traslado-{{$traslado->id}}">

                        <td nowrap>
                            {{$traslado->clave}}
                        </td>
                        <td>
                            {{$traslado->cuenta}}
                        </td>
                        <td> {{$traslado->adquiriente->nombres}} {{$traslado->adquiriente->apellido_paterno}} {{$traslado->adquiriente->apellido_materno}}</td>

                        <td>{{$traslado->enajenante->nombres}} {{$traslado->enajenante->apellido_paterno}} {{$traslado->enajenante->apellido_materno}}</td>
                        <td nowrap> {{$traslado->created_at->format("d-m-Y")}}</td>
                        <td nowrap>
                            {{$traslado->folio}}
                        </td>

                        <td style="text-align: right;" nowrap>

                            @if(!is_null($traslado->folio))
                                <a href="{{ action('OficinaVirtualNotarioController@show', ['id' => $traslado->id]) }}"
                                   class="btn btn-info" title="Ver traslado">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                </a>


                                <a href="{{ action('OficinaVirtualNotarioController@imprimir', ['id' => $traslado->id]) }}"
                                   class="print btn btn-info" target="_blank">
                                    <span class="glyphicon glyphicon-print"></span>
                                </a>
                            @else

                                <a href="{{ action('OficinaVirtualNotarioController@edit', ['id' => $traslado->id]) }}"
                                   class="btn btn-warning" title="Editar traslado">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#confirm-delete"
                                   class="btn-borrar btn btn-danger" data-traslado_id="{{$traslado->id}}">
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
                <h4 style="text-align: center">¿Desea eliminar el traslado de dominio de su lista? <br>Esta acción no
                    puede deshacerse.</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger btn-submit-borrar" data-documento_id=""
                        data-dismiss="modal">
                    <span class="glyphicon glyphicon-trash "></span> Eliminar traslado de dominio
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
                $.get("{{url('ofvirtual/notario/traslado/destroy/')}}" + '/' + traslado_id, function (data) {
                    console.log('Regresa de borrar el traslado:' + traslado_id);
                    $('#traslado-' + traslado_id).hide();
                    $('#dominio-eliminado').show();
                    return false;
                });


            });
        });
    </script>
@append
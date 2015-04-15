
<link href="../css/complementarios_cargar/fileinput.css" media="all" rel="stylesheet" type="text/css" />

      
<input id="file" name="file[]" type="file" multiple class="file-loading">

<div class="input-group" id="carga-hide">
            {{ Form::hidden('clave_catas',$clave_catas, ['id' => 'clave_catasC'])}}
            {{ Form::hidden('gid_predio',$gid, ['id' => 'gid_predioC'])}}
            {{ Form::hidden('entidad',$estado, ['id' => 'entidadC'])}}
            {{ Form::hidden('municipio',$municipio, ['id' => 'municipioC'])}}
</div>






<div id="div-array" data-array="{{$file}}"></div>



@section('javascript')   

<script src="../js/jquery/fileinput.js" type="text/javascript"></script>

<script>




var footerTemplate = '<select name="select-instalaciones" class="form-control" id="instalaciones"> '+
                        '<option selected="selected" value="">--Seleccione una opción--</option>'+
                        '<option value="1">Frontal</option>'+
                        '<option value="2">Lateral</option>'+
                     '</select>'+
                     '<button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" data-url="/eliminar-anexo.com" data-key="1">'+
                        '<i class="glyphicon glyphicon-trash text-danger"></i>'+
                     '</button>';
var imagen = [];


@foreach($file as $fil)
    
    
    imagen.push("{{$fil}}");

    

@endforeach



$('#file').on('fileloaded', function(event, file, previewId, index, reader) 
{
        

});


/*!
 * FileInput <_LANG_> Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
(function ($) {
    "use strict";

    $.fn.fileinput.locales._LANG_ = {
        fileSingle: 'Archivo',
        filePlural: 'Archivos',
        browseLabel: 'Examinar &hellip;',
        removeLabel: 'Eliminar',
        removeTitle: 'Eliminar archivos seleccionados',
        cancelLabel: 'Cancelar',
        cancelTitle: 'Abort ongoing upload',
        uploadLabel: 'Subir',
        uploadTitle: 'Subir archivos seleccionados',
        msgSizeTooLarge: 'El archivo "{name}" (<b>{size} KB</b>) excede el peso permitido de carga <b>{maxSize} KB</b>. Vuelva a intentarlo!',
        msgFilesTooLess: 'You must select at least <b>{n}</b> {files} to upload. Please retry your upload!',
        msgFilesTooMany: 'Numero de archivos seleccionados <b>({n})</b> excede el limite de carga permitido de <b>{m}</b>. Vuelva a intentarlo!',
        msgFileNotFound: 'El archivo "{name}" no se encuentra!',
        msgFileSecured: 'Security restrictions prevent reading the file "{name}".',
        msgFileNotReadable: 'File "{name}" is not readable.',
        msgFilePreviewAborted: 'File preview aborted for "{name}".',
        msgFilePreviewError: 'An error occurred while reading the file "{name}".',
        msgInvalidFileType: 'Archivo invalido "{name}". Solo "{types}" se aceptan.',
        msgInvalidFileExtension: 'Extension invalida "{name}". Solo "{extensions}" se aceptan.',
        msgValidationError: 'Error al subir archivo',
        msgLoading: 'Loading file {index} of {files} &hellip;',
        msgProgress: 'Cargando archivo {index} de {files} - {name} - {percent}% completado.',
        msgSelected: '{n} files selected',
        msgFoldersNotAllowed: 'No se permite arrastrar carpetas {n} carpetas ignoradas(s).',
        dropZoneTitle: 'Suelta tus archivos aqui &hellip;'
    };

    $.extend($.fn.fileinput.defaults, $.fn.fileinput.locales._LANG_);
})(window.jQuery);



	$("#file").fileinput(
	{
		uploadUrl: "/guardar-anexo",
		uploadAsync: false,
		maxFileCount: 5,
		layoutTemplates: {footer: footerTemplate},
        initialPreview: imagen,
		uploadExtraData: function()
		{
			

        	var gid_predio = document.getElementById('gid_predioC').value;
        	var entidad = document.getElementById('entidadC').value;
        	var municipio = document.getElementById('municipioC').value;
        	var clave_catas = document.getElementById('clave_catasC').value;
        	var toma = document.getElementsByName('select-instalaciones');
        	var tomas = [];
        	for (var x = 0; x<toma.length; x++) 
        	{
        		tomas[x]= toma[x].value;
        	};

        	return {gid_predio:gid_predio, entidad:entidad, municipio:municipio, clave_catas:clave_catas, tomas:tomas};
    	}
	});
</script>
@append
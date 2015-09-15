/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var aiMedidasColindancias;

$(document).ready(function () {
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btn3Inmueble').removeClass("btn-info").addClass("btn-primary");

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 *  
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	aiMedidasColindancias = $('#aiMedidasColindanciasDataTable').DataTable({
		 ordering: false
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	aiMedidasColindancias.ajax.url('/corevat/AiMedidasColindanciasGetAjax/' + $("#idavaluoinmueble").val()).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNew').click(function () {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('ins');
		$('#idaimedidacolindancia, #medidas').val('0');
		$('#colindancia').val('');
		$("#idorientacion option[value=1]").attr("selected", true);
		$('#modalFormAiMedidasColindanciasTitle').empty().append('[COREVAT] Capturar un nuevo registro');
		$('#modalFormAiMedidasColindancias').modal('show');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * PENDIENTE CACHAR ERRORES EN AJAX
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAiMedidasColindancias = function (id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('upd');
		$('#idaimedidacolindancia').val(id);
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AiMedidasColindanciasGet/' + $('#idaimedidacolindancia').val(),
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$("#idorientacion option[value=" + datos.idorientacion + "]").attr("selected", true);
				$('#medida').val(datos.medida);
				$('#medidas').val(datos.medidas);
				$('#unidad_medida').val(datos.unidad_medida);
				$('#colindancia').val(datos.colindancia);
				$('#modalFormAiMedidasColindanciasTitle').empty().append('[COREVAT] Modificar registro');
				$('#modalFormAiMedidasColindancias').modal('show');
			}
		});
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAiMedidasColindancias = function (id) {
		$('#corevatConfirmButton').attr('ctrl', 'delAiMedidasColindancias').attr('idTable', id);
		$('#corevatConfirmContainer').empty().append('<h2>¿Realmente dese eliminar el registro?<h2>');
		$('#corevatConfirm').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAiMedidasColindancias").submit(function () {
		$('#messagesDialogForm').empty().removeClass();
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: $(this).attr("action"),
			type: $(this).attr("method"),
			data: $(this).serialize(),
			success: function (data) {
				datos = eval(data);
				if (datos.success) {
					$('#messagesDialogForm').removeClass().addClass('alert').addClass('alert-success').append(datos.message);
					$('#idTable').val(datos.idTable);
					if ($('#ctrl').val() == 'ins') {
						$('#idaimedidacolindancia, #medidas').val('0');
						$('#colindancia').val('');
						$("#idorientacion option[value=1]").attr("selected", true);
					}
					aiMedidasColindancias.ajax.reload();
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesDialogForm').removeClass().addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#fachada, #croquis').fileinput({
		maxFileSize: 2000,
		maxFileCount: 1,
		allowedFileExtensions: ["gif", "jpg", "JPG", "png"]
	});

});

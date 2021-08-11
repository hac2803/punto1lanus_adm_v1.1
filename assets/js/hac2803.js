////////////////////////////////////////////////////////////////////////////////////////////
// Commom - BEGIN
////////////////////////////////////////////////////////////////////////////////////////////

// function base_url() {
//   var base = window.location.href.split('/');
//   return base[0]+'//'+base[2]+'/'+base[3]+'/'+base[4]+'/';
// }

function alert2(str) {
	// hac2803
	$.alert({
		title: "Atención",
		content: str,
		type: "orange",
		icon: "fa fa-warning",
		buttons: {
			ok: {
				text: "Aceptar",
				btnClass: "btn-warning",
				action: function () { },
			},
		},
	});
}

function FormatDate(str) {
	return str.substr(8, 2) + "/" + str.substr(5, 2) + "/" + str.substr(0, 4);
}

//////////////////////////////////////////////////////////////////////////////////////////
// Valida JSON
//////////////////////////////////////////////////////////////////////////////////////////
function IsJsonString(str) {
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}

////////////////////////////////////////////////////////////////////////////////////////////
// Commom - END
////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function () {
	////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	// Confirmación antes de borrar un registro (HAC2803)
	//////////////////////////////////////////////////////////////////////////////////////////
	$(".btn-remove").on("click", function (e) {
		e.preventDefault();
		var ruta = $(this).attr("href");

		// Confirmación (jquery-confirm)
		$.confirm({
			icon: "fa fa-warning",
			type: "red",
			title: "Atención",
			content: "¿Confirma la eliminación de este registro?",
			buttons: {
				confirm: {
					text: "Si",
					btnClass: "btn-blue",
					action: function () {
						// Borra el registro y refresca la pantalla - BEGIN
						$.ajax({
							url: ruta,
							type: "POST",
							success: function (resp) {
								// Refresh view
								window.location.href = base_url_js + resp;
							},
						});
						// Borra el registro y refresca la pantalla - END
					},
				},
				cancel: {
					text: "No",
					btnClass: "btn-red",
					action: function () {
						// $.alert('Canceled!');
					},
				},
			}, // buttons
		}); // $.confirm
	});

	//////////////////////////////////////////////////////////////////////////////////////////
	// Eventos AJAX
	//////////////////////////////////////////////////////////////////////////////////////////
	$(document).ajaxStart(function () {
		$("#ajax_loader").show();
	});

	$(document).ajaxStop(function () {
		$("#ajax_loader").hide();
	});

	//////////////////////////////////////////////////////////////////////////////////////////
	// Inicializa DataTable
	//////////////////////////////////////////////////////////////////////////////////////////
	$("#example1").DataTable({
		language: {
			lengthMenu: "Mostrar _MENU_ registros por página",
			zeroRecords: "No se encontraron resultados en su búsqueda",
			searchPlaceholder: "Buscar registros",
			info: "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
			infoEmpty: "No existen registros",
			infoFiltered: "(filtrado de un total de _MAX_ registros)",
			search: "Buscar:",
			paginate: {
				first: "Primero",
				last: "Último",
				next: "Siguiente",
				previous: "Anterior",
			},
		},
	});
	$(".sidebar-menu").tree();

	////////////////////////////////////////////////////////////////////////////////////////////
}); // $(document).ready(function () {
////////////////////////////////////////////////////////////////////////////////////////////

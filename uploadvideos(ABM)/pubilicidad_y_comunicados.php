<?php
// conectamos a la base de datos
require '../class/database.php';
$objData = new Database();

$sth11 = $objData->prepare('SELECT * FROM videos_publicidad where delet = 0 ORDER BY fecha ASC');
$sth11->execute();
$videos_publicidad = $sth11->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Publicidad y comunicados - </title>
	<link rel="shortcut icon" href="assets/images/favicon.ico" />
	<link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

	<style>
		.modal-custom {
			max-width: 1200px;
		}

		.modal-custom2 {
			max-width: 800px;
		}

		.container-input {
			text-align: center;
			background: #282828;
			border-top: 5px solid #c39f77;
			padding: 50px 0;
			border-radius: 6px;
			width: 50%;
			margin: 0 auto;
			margin-bottom: 20px;
		}

		.inputfile {
			width: 0.1px;
			height: 0.1px;
			opacity: 0;
			overflow: hidden;
			position: absolute;
			z-index: -1;
		}

		.fancy-title {
			font-size: 24px;
			color: #333;
			text-align: center;
			text-transform: uppercase;
			letter-spacing: 2px;
			margin-bottom: 20px;
			border-bottom: 2px solid #ccc;
			padding-bottom: 5px;
		}

		.inputfile {
			width: 0.1px;
			height: 0.1px;
			opacity: 0;
			overflow: hidden;
			position: absolute;
			z-index: -1;
		}

		.inputfile+label {
			max-width: 80%;
			font-size: 1.25rem;
			font-weight: 700;
			text-overflow: ellipsis;
			white-space: nowrap;
			cursor: pointer;
			display: inline-block;
			overflow: hidden;
			padding: 0.625rem 1.25rem;
			color: red;
		}

		.inputfile+label svg {
			width: 1.5em;
			height: 1.5em;
			vertical-align: middle;
			fill: red;
			margin-top: -0.25em;
			margin-right: 0.25em;
		}

		.iborrainputfile {
			font-size: 14px;
			font-weight: normal;
			font-family: "Poppins", sans-serif;
		}

		.inputfile-2+label {
			border: 2px solid currentColor;
			height: 42px;
			background: #fafbfe;
			border: 1px solid #f1f1f1;
			font-size: 14px;
			color: #535f6b;
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;
			-ms-border-radius: 8px;
			-o-border-radius: 8px;
			border-radius: 8px;
			box-shadow: none;
		}

		.fancy-title {
			font-size: 24px;
			color: #333;
			text-align: center;
			text-transform: uppercase;
			letter-spacing: 2px;
			margin-bottom: 20px;
			border-bottom: 2px solid #ccc;
			padding-bottom: 5px;
		}

		.icono-grande {
			font-size: 25px;
		}

		.inputfile-2:focus+label,
		.inputfile-2.has-focus+label,
		.inputfile-2+label:hover {
			color: green;
		}
	</style>
</head>

<body class="fix-header card-no-border">
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
		</svg>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<?php include("header/subheader.php"); ?>
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<aside class="left-sidebar">
			<!-- Sidebar scroll-->
			<div class="scroll-sidebar">
				<!-- User profile -->
				<?php include("header/user-profile.php"); ?>
				<!-- End User profile text-->
				<!-- Sidebar navigation-->
				<?php include("header/menu.php"); ?>
				<!-- End Sidebar navigation -->
			</div>
			<!-- End Sidebar scroll-->
			<!-- Bottom points-->
			<?php include("header/sidebar-footer.php"); ?>
			<!-- End Bottom points-->
		</aside>
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- Page wrapper  -->
		<div class="page-wrapper">
			<!-- Container fluid  -->
			<div class="container-fluid">
				<!-- Bread crumb and right sidebar toggle -->
				<div class="row page-titles">
					<div class="col-md-6 col-8 align-self-center">
						<h3 class="text-themecolor m-b-0 m-t-0">Publicidad y comunicados </h3>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
							<li class="breadcrumb-item active">Publicidad</li>
						</ol>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- End Bread crumb and right sidebar toggle -->
				<!-- ============================================================== -->
				<!-- Start Page Content -->
				<!-- ============================================================== -->
				<!-- Row -->
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title fancy-title">Lista de videos</h4>
								<hr>
								<div class="table-responsive m-t-40">
									<table id="example" class="display nowrap table table-hover  table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr style="font-size: 13px;">
												<th>Opciones</th>
												<th>Titulo</th>
												<th>Fecha de publicación:</th>
												<th>Hasta la fecha</th>
												<th>Video</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($videos_publicidad as $index => $row) { ?>
												<tr style="font-size: 13px;">
													<td class="text-nowrap">
														<div class="d-flex align-items-center">
															<a id="btn-editar" class="btn-edit" data-titulo_edit="<?php echo $row['titulo']; ?>" data-id="<?php echo $row['id']; ?>" data-inicio_edit="<?php echo $row['inicio']; ?>" data-fin_edit="<?php echo $row['fin']; ?>" data-toggle="tooltip" href="javascript:void(0)" data-original-title="Editar fecha" style="margin-right: 5px;">
																<i class="fa fa-pencil text-inverse icono-grande"></i>
															</a>
															<a id="btn-delete" data-iduse_delet="<?php echo $iduse; ?>" data-id="<?php echo $row['id']; ?>" data-toggle="tooltip" href="javascript:void(0)" data-original-title="Eliminar video">
																<i class="fa fa-close text-danger icono-grande"></i>
															</a>
														</div>
													</td>
													<td><?php echo $row['titulo']; ?></td>
													<td><span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d/m/Y - H:i', strtotime($row['inicio'])); ?></span></td>
													<td><span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d/m/Y - H:i', strtotime($row['fin'])); ?></span></td>
													<td>
														<div class="d-flex align-items-center">
															<div title="Ver video" data-load-file="file" data-load-target="#video-viewer" data-url="<?php echo "../../publicidad/" . $row['ruta']; ?>" data-toggle="modal" data-target="#exampleModal" data-title="Antecedente Academico" style="cursor: pointer; color: #8f93f6; text-decoration: none; background-color: transparent; margin-right: 10px;">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-play-btn-fill" viewBox="0 0 16 16">
																	<path d="M0 12V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2m6.79-6.907A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z" />
																</svg>
															</div>
															<div title="Descargar video" data-load-file="file2" data-filename="<?php echo $row['titulo']; ?>">
																<a href="<?php echo "../../publicidad/" . $row['ruta']; ?>" style="margin-right: 25px;" download>
																	<svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill="red" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 329.79">
																		<path fill-rule="nonzero" d="M63.64 303.3h256.87c10.26 0 19.61-4.25 26.37-11.01 6.8-6.8 11.04-16.16 11.04-26.26V63.77c0-10.06-4.26-19.35-11.04-26.12-6.85-6.86-16.23-11.16-26.37-11.16H63.64c-10.19 0-19.61 4.25-26.42 11.06-6.78 6.77-11 16.04-11 26.22v202.26c0 10.24 4.2 19.56 10.95 26.31a37.36 37.36 0 0 0 26.47 10.96zm112.88-111.16-2.9-91.9 31.69-1 2.85 90.52 36.72-37.86 22.73 22.11-76.44 78.84-74.65-77.06 22.74-22.11 37.26 38.46zm208.55-94.63v137.05l100.44 44.48V51.08L385.07 97.51zm-.93-28.7 108.31-50.06c1.88-1.02 4.02-1.59 6.3-1.59 7.31 0 13.25 5.93 13.25 13.24v268.98c-.01 1.79-.38 3.6-1.14 5.33-2.94 6.69-10.75 9.72-17.44 6.78l-109.28-48.4v2.94c0 17.37-7.22 33.39-18.82 44.99-11.53 11.54-27.4 18.77-44.81 18.77H63.64c-17.46 0-33.36-7.17-44.91-18.72C7.18 299.52 0 283.56 0 266.03V63.77c0-17.46 7.23-33.38 18.76-44.93C30.43 7.2 46.36 0 63.64 0h256.87c17.21 0 33.12 7.26 44.67 18.78l.08.09c11.6 11.61 18.88 27.56 18.88 44.9v5.04z" />
																	</svg>
																</a>
															</div>
														</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<h4 class="card-title fancy-title">Subir video</h4>
								<form id="formRegistro" action="" role="form">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group has-info">
												<label class="form-control-feedback" for="titulo">Título del video:</label>
												<input type="text" class="form-control" id="titulo" name="titulo" required><span class="bar"></span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-control-feedback" for="inicio">Fecha de publicación:</label>
												<input type="datetime-local" class="form-control" id="inicio" name="inicio" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-control-feedback" for="fin">Hasta la fecha:</label>
												<input type="datetime-local" class="form-control" id="fin" name="fin" required>
											</div>
										</div>
										<div class="form-group col-md-12" style="text-align: center;">
											<input type="file" id="userF" name="userF" required class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados" />
											<label for="userF">
												<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-camera-reels-fill" viewBox="0 0 16 16">
													<path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
													<path d="M9 6a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
													<path d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z" />
												</svg>
												<span class="iborrainputfile">Adjuntar video</span>
											</label>
										</div>
									</div>
									<input type="hidden" id="action" name="action" value="insert_video" required>
									<input type="hidden" id="idUser" name="idUser" value="<?php echo $iduse; ?>" />
									<input type="hidden" id="creador" name="creador" value="<?php echo $result[0]['nom_alumno'] . " " . $result[0]['ape_alumno']; ?>" />
									<div class="col-12">
										<div class="text-end">
											<input type="submit" name="submit" class="btn btn-primary submit-form me-2 submitBtn" value="Subir video" required />
										</div>
									</div>
								</form>
							</div>
							<div class="col-12">
								<hr>
							</div>
							<hr>
						</div>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- End PAge Content -->
				<!-- ============================================================== -->
				<!-- Right sidebar -->
				<!-- ============================================================== -->
				<!-- .right-sidebar -->
				<div class="right-sidebar">
					<div class="slimscrollright">
						<div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
						<div class="r-panel-body">
							<ul id="themecolors" class="m-t-20">
								<li><b>With Light sidebar</b></li>
								<li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
								<li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
								<li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
								<li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a>
								</li>
								<li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
								<li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
								<li class="d-block m-t-30"><b>With Dark sidebar</b></li>
								<li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
								<li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a>
								</li>
								<li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a>
								</li>
								<li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a>
								</li>
								<li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
								<li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- End Right sidebar -->
				<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- End Container fluid  -->
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			<?php include("footer/copy.php"); ?>
			<!-- ============================================================== -->
			<!-- End footer -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Page wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<?php include("footer/footer.php"); ?>
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../assets/js/sweetalert2@11.js"></script>
	<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
	<script>
		//para obligar a que solo se pueda introducr videos
		(function(document, window, index) {
			var inputs = document.querySelectorAll('.inputfile');
			Array.prototype.forEach.call(inputs, function(input) {
				var label = input.nextElementSibling,
					labelVal = label.innerHTML;
				input.addEventListener('change', function(e) {
					var fileName = '';
					if (this.files && this.files.length > 1)
						fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
					else
						fileName = e.target.value.split('\\').pop();

					var fileExt = fileName.split('.').pop().toLowerCase();
					if (fileExt !== 'mp4' && fileExt !== 'webm') {
						this.value = '';
						label.querySelector('span').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-mp4" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM.706 15.849v-2.66h.038l.952 2.16h.516l.946-2.16h.038v2.66h.715V11.85h-.8l-1.14 2.596h-.026L.805 11.85H0v3.999zm5.278-3.999h-1.6v3.999h.792v-1.342h.803q.43 0 .732-.173.304-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477 1.4 1.4 0 0 0-.733-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.237.241.8.8 0 0 1-.375.082h-.66V12.48h.66q.329 0 .513.181.184.183.184.522m1.505-.032q.4-.65.791-1.301h1.14v2.62h.49v.638h-.49v.741h-.741v-.741H7.287v-.648q.353-.66.747-1.31Zm-.029 1.298v.02h1.219v-2.021h-.041q-.302.477-.607.984-.3.507-.571 1.017"/> </svg>Seleccione un video formato WebM o MP4';
					} else {
						if (fileName)
							label.querySelector('span').innerHTML = fileName;
						else
							label.innerHTML = labelVal;
					}
				});
			});
		}(document, window, 0));


		$(document).ready(function() {
			// Obtener el ID de corrección al hacer clic en el botón btn-edit
			$('.btn-edit').click(function() {
				var id_video_edit = $(this).data('id');
				var inicio_edit = $(this).data('inicio_edit');
				var fin_edit = $(this).data('fin_edit');
				var titulo_edit = $(this).data('titulo_edit');

				$('#id_video_edit').val(id_video_edit);
				$('#inicio_edit').val(inicio_edit);
				$('#fin_edit').val(fin_edit);
				$('#titulo_edit').val(titulo_edit);

				$('#ModalEditVideo').modal('show');
			});

			// Enviar el formulario para editar las fechas del video
			$('#formVideoedit').submit(function(e) {
				e.preventDefault();
				var id_video_edit = $('#id_video_edit').val();
				var inicio_edit = $('#inicio_edit').val();
				var fin_edit = $('#fin_edit').val();
				var titulo_edit = $('#titulo_edit').val();

				var data = {
					id_video_edit: id_video_edit,
					inicio_edit: inicio_edit,
					fin_edit: fin_edit,
					titulo_edit: titulo_edit,
					action: 'update_fecha'
				};
				$.ajax({
					url: 'modify_publicidad.php',
					type: 'POST',
					data: data
				}).done(function(response) {
					if (response.status === 'success') {
						swal({
							title: '¡Se ha editado!',
							text: response.message,
							buttonsStyling: false,
							confirmButtonClass: 'btn btn-success',
							type: 'success'
						});
						setTimeout(function() {
							location.reload();
						}, 2000);
					} else {
						swal('Oops...', response.message, 'error');
						setTimeout(function() {
							location.reload();
						}, 2000);
					}
				}).fail(function() {
					swal('¡Error! intente nuevamente', 'error');
					setTimeout(function() {
						location.reload();
					}, 2000);
				});
				$(this)[0].reset();
				$('#ModalEditVideo').modal('hide');
			});
		});

		//Boton para eliminar videos
		$(document).on('click', '#btn-delete', function() {
			var id = $(this).data('id');
			var iduse_delet = $(this).data('iduse_delet');

			var data = {
				id: id,
				iduse_delet: iduse_delet,
				action: 'delete_video'
			};

			swal({
				title: "¡Eliminar video!",
				text: "¿Estas seguro? este cambio es irreversible",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#28a745",
				cancelButtonColor: "#d33",
				confirmButtonText: "Si",
				cancelButtonText: 'No',
				closeOnConfirm: false,
			}, function() {
				$.ajax({
					url: 'modify_publicidad.php',
					type: 'POST',
					data: data,
					dataType: 'json'
				}).done(function(response) {
					if (response.status === 'success') {
						swal({
							title: '¡Eliminado!',
							text: response.message,
							buttonsStyling: false,
							confirmButtonClass: 'btn btn-success',
							type: 'success'
						});
						setTimeout(function() {
							location.reload();
						}, 2000);
					} else {
						swal('Oops...', response.message, 'error');
					}
				}).fail(function() {
					swal('Oops...', 'Error inesperado, intente de nuevo', 'error');
				});
			});
		});

		document.addEventListener("DOMContentLoaded", function() {
			var form = document.getElementById("formRegistro");
			form.addEventListener("submit", function(e) {
				e.preventDefault();

				var xhr = new XMLHttpRequest();
				xhr.open("POST", "modify_publicidad.php", true);

				xhr.onload = function() {
					if (xhr.status >= 200 && xhr.status < 300) {
						var response = JSON.parse(xhr.responseText);

						if (response.status === 'success') {
							swal({
								title: '¡Registro exitoso!',
								text: response.message,
								buttonsStyling: false,
								confirmButtonClass: 'btn btn-success',
								type: 'success'
							});
							form.reset();
							setTimeout(function() {
								location.reload();
							}, 2500);
						} else {
							swal('Oops...', response.message, 'error');
						}
					} else {
						swal('¡Error!', 'intente nuevamente');
					}

					form.style.opacity = "";
					var submitBtn = document.querySelector(".submitBtn");
					submitBtn.removeAttribute("disabled");
				};

				xhr.onerror = function() {
					swal('¡Error!', 'intente nuevamente');
				};

				var formData = new FormData(form);
				xhr.send(formData);

				form.style.opacity = ".5";
				var submitBtn = document.querySelector(".submitBtn");
				submitBtn.setAttribute("disabled", "disabled");
			});
		});

		$(document).on('show.bs.modal', '#exampleModal', function(event) {
			var button = $(event.relatedTarget);
			var videoViewer = $('#video-viewer');
			var videoUrl = button.data('url');

			videoViewer.attr('src', videoUrl);
		});
		/*		$(document).on('hidden.bs.modal', '#exampleModal', function(event) {
					var videoViewer = $('#video-viewer');
					// Detener la reproducción del video al cerrar el modal
					videoViewer.attr('src', '');
				});
		*/
		//cambia el nombre del archivo descargado
		$(document).ready(function() {
			$('[data-load-file="file2"]').each(function() {
				var filename = $(this).data('filename');
				$(this).find('a').attr('download', filename);
			});
		});

		//traduccion del datatable asignacion
		$(document).ready(function() {
			$(document).ready(function() {
				var table = $('#example').DataTable({
					language: {
						url: 'es-ar.json'
					},
					"pageLength": 10 // Mostrar 20 elementos por página
				});
			});
		});
	</script>

	<!-- Modal video-->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xg modal-custom" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Video seleccionado</h4>
					<div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
				<div class="modal-body">
					<video id="video-viewer" src="" width="100%" height="600" controls muted></video>
				</div>
			</div>
		</div>
	</div>

	<!--  Modal edit video	-->
	<div class="modal fade" id="ModalEditVideo" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xg modal-custom2" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar datos del video</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formVideoedit">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group has-info">
									<label class="form-control-feedback" for="titulo_edit">Título del video:</label>
									<input type="text" class="form-control" id="titulo_edit" name="titulo_edit" required><span class="bar"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-control-feedback" for="inicio_edit">Fecha de publicación:</label>
									<input type="datetime-local" class="form-control" id="inicio_edit" name="inicio_edit" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-control-feedback" for="fin_edit">Hasta la fecha:</label>
									<input type="datetime-local" class="form-control" id="fin_edit" name="fin_edit" required>
								</div>
							</div>
						</div>
						<input type="hidden" id="id_video_edit" name="id_video_edit">
						<div class="col-12">
							<hr>
						</div>
						<button type="submit" class="btn btn-success">Editar video</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
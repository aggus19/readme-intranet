<?php
include_once 'includes/general.php';


$idMultimedia = $_GET['idMultimedia'];
$idUsuario = $_GET['user'];
$correo = $_SESSION['correo'];
$sesionId = $_SESSION['id'];
$multimediaInfo = Book::GetInfoFromBookId($idMultimedia);
$checkOwner = Resenias::CheckIfReseniaOwner($correo, $idMultimedia);

if (isset($_POST['editarResenia'])) {
	$descripcion = $_POST['descripcion'];
	$calificacion = $_POST['selectCalif'];
	$idMultimedia2 = $_POST['idMultimedia2'];
	$reseniaId = $_POST['reseniaId'];
	if (empty($descripcion) || empty($calificacion)) {
		header("Location: resenia.php?idMultimedia=$idMultimedia2&user=$sesionId&type=1&error=1");
		exit();
	} else {
		Resenias::UpdateReview($descripcion, $calificacion, $reseniaId);
		header("Location: resenia.php?idMultimedia=$idMultimedia2&user=$sesionId&type=1&success=1");
	}
	exit();
}

// Recibir el submit del formulario en resenias.php 
if (isset($_POST['btnMusica'])) {
	$txtNombreCancion = $_POST['txtNombreCancion'];
	$txtResenia = $_POST['txtReseniaCancion'];
	$calificacion = $_POST['califM'];
	$generoMusica = $_POST['generoMusica'];
	Resenias::CreateMusicReview($calificacion, $txtResenia);
	//Resenias::CreateReview($txtNombreCancion, $txtResenia, $idMultimedia, $correo);
	header("Location: resenias?success=true&nombre=$txtNombreCancion&type=1&calif=$calificacion&genero=$generoMusica");
}
// Recibir el submit del formulario en resenias.php 
if (isset($_POST['btnPeli'])) {
	$txtReseniaPeli = $_POST['txtReseniaPeli'];
	$txtNombrePeli = $_POST['txtNombrePeli'];
	$calificacion = $_POST['califP'];
	$generoPeli = $_POST['generoPeli'];
	Resenias::CreateMovieReview($calificacion, $txtReseniaPeli);
	header("Location: resenias?success=true&nombre=$txtNombrePeli&type=2&calif=$calificacion&genero=$generoPeli");
}
// Recibir el submit del formulario en resenias.php 
if (isset($_POST['btnLibro'])) {
	$txtReseniaLibro = $_POST['txtReseniaLibro'];
	$selectLibros = $_POST['selectLibros']; // Id multimedia
	$califL = $_POST['califL'];
	Resenias::CreateBookReview($selectLibros, $txtReseniaLibro, $califL);
	$dataBook = Book::GetInfoFromBookId($selectLibros);
	$titulo = $dataBook['nombre'];
	$genero = $dataBook['genero'];
	header("Location: resenias?success=true&nombre=$titulo&type=3&genero=$genero");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>


<body id="kt_body" class="loader header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:45px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<?php
				include "includes/lateral.php";
				?>
			</div>

			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php
				include "includes/header.php";
				?>
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="toolbar" id="kt_toolbar">
						<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
							<ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-bold">
								<li class="breadcrumb-item pe-3"><a href="#" class="pe-3">Panel</a></li>
								<li class="breadcrumb-item px-3"><a href="index" class=" text-muted pe-3">Inicio</a></li>
							</ol>
						</div>
					</div>

					<?php

					if (isset($_GET['user']) && isset($_GET['idMultimedia']) && isset($_GET['type']) && $_GET['type'] == '1') { // Editar reseña
						if (isset($_GET['success']) && $_GET['success'] == '1') {
							echo '
								<div id="kt_content_container" class="container-fluid">
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>¡Bien!</strong> Editaste tu reseña correctamente.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							</div>';
						}
						if (isset($_GET['deleted']) && $_GET['deleted'] == '1') {
							echo '
								<div id="kt_content_container" class="container-fluid">
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>¡Bien!</strong> Eliminaste tu reseña correctamente.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							</div>';
						}
						if (isset($_GET['error']) && $_GET['error'] == '1') {
							echo '
								<div id="kt_content_container" class="container-fluid">
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>¡Error!</strong> No puedes dejar campos vacíos.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							</div>';
						}
						if (isset($_GET['deletedReview']) && $_GET['deletedReview'] == '1') {
							echo '
								<div id="kt_content_container" class="container-fluid">
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>¡Bien!</strong> Eliminaste la reseña correctamente.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							</div>';
						}
						
						if ($checkOwner == true) {
							$reseniaInfo = Resenias::GetAllDataResenia($checkOwner[0]['id_resenia'])[0];
							echo '
							<div class="post d-flex flex-column-fluid" id="kt_post">
								<div id="kt_content_container" class="container-fluid">
									<div class="card">
										<div class="card-header">
											<div class="card-title text-gray-800 fs-3 fw-bolder">Editando reseña 
											<span class="ms-1 fs-5"> <code>(#' . $reseniaInfo['id_resenia'] . ')</code> </span>
											</div>
											<div class="card-toolbar">
											<a href="deletes?idResenia=' . $reseniaInfo['id_resenia'] . '" class="btn btn-sm btn-danger me-2" data-kt-menu-dismiss="true"><i class="fa-solid fa-trash"></i>Eliminar reseña</a>
											<a href="resenias" class="btn btn-sm btn-light me-2" data-kt-menu-dismiss="true"><i class="fa-solid fa-backward"></i>Regresar</a>
											</div>
										</div>
										
										<div class="col-lg-4">
											<a class="card card-custom wave wave-animate bg-grey-100 mb-8 mb-lg-0">
												<div class="card-body">
													<div class="d-flex align-items-center p-6">
														<div class="mr-6">
															<span class="me-sm-6 svg-icon svg-icon-4x svg-icon-primary">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"></rect>
																		<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"></path>
																		<path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"></path>
																		<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"></path>
																	</g>
																</svg>
															</span>
														</div>
														<div class="d-flex flex-column">
															<h3 class="text-dark h3 mb-3">Datos de la reseña:</h3>
															<div class="text-gray-600">Nombre: ' . $multimediaInfo['nombre'] . ' </div>
															<div class="text-gray-600">Genero: ' . $multimediaInfo['genero'] . ' </div>
														</div>
													</div>
												</div>
											</a>
										</div>
										<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
											<div class="card-body">
													<div class="row mb-8">
													<div class="col-xl-3">
														<div class="fs-6 fw-bold text-gray-700 mt-2 mb-3">Descripción de la reseña</div>
													</div>
													<div class="col-xl-9 fv-row">
														<textarea id="descripcion" id="descripcion" name="descripcion" class="form-control form-control-solid h-100px">' . $reseniaInfo['descripcion'] . '</textarea>
														<input type="hidden" id="idMultimedia2" name="idMultimedia2" value="' . $multimediaInfo['id_multimedia'] . '">
														<input type="hidden" id="reseniaId" name="reseniaId" value="' . $reseniaInfo['id_resenia'] . '">
														</div>
												</div>
													<div class="row mb-8">
														<div class="col-xl-3">
															<div class="fs-6 fw-bold text-gray-700 mt-2 mb-3">Calificación dada</div>
														</div>
														<div class="col-xl-9 fv-row">
															<select name="selectCalif" class="form-select form-select-solid">
																<option value="' . $reseniaInfo['calificacion_dada'] . '" selected>Tu calificación: ' . $reseniaInfo['calificacion_dada'] . '</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
															</select>
														</div>
													</div>
												</div>
												<div class="card-footer d-flex justify-content-end py-6 px-9">
													<a href="resenias" class="btn btn-light btn-sm btn-active-light-secondary me-2" data-kt-menu-dismiss="true"> <i class="fa-solid fa-xmark"></i> Cancelar</a>
													<button type="submit" name="editarResenia" class="btn btn-light-success btn-sm btn-active-light me-2"> <i class="fa-solid fa-paper-plane"></i> Editar </button>
												</div>
											</form>
										</div>';
						} else {
							echo 'No es el duenio de la resenia';
						}
					} else {
						header("Location: resenias");
					}

					if (isset($_GET['idResenia']) && isset($_GET['multimediaId']) && isset($_GET['type']) && $_GET['type'] == 'ver') { // Usuarios en general ven todas las reseñas
						$idResenia = $_GET['idResenia'];
						$multimediaId = $_GET['multimediaId'];
						$reseniaData = Resenias::GetAllDataResenia($idResenia);
						$mediaInfo = Book::GetInfoFromBookId($multimediaId);
						foreach ($reseniaData as $reseniaInfo) {
							echo '
							<div class="post d-flex flex-column-fluid" id="kt_post">
								<div id="kt_content_container" class="container-fluid">
									<div class="card">
										<div class="card-header">
											<div class="card-title text-gray-800 fs-3 fw-bolder">Viendo reseña 
											<span class="ms-1 fs-5"> <code>(#' . $reseniaInfo['id_resenia'] . ')</code> </span>
											</div>
											<div class="card-toolbar">
											<a href="reseniasList" class="btn btn-sm btn-light me-2" data-kt-menu-dismiss="true"><i class="fa-solid fa-backward"></i>Regresar</a>
											</div>
										</div>
										<div class="col-lg-4">
											<a class="card card-custom wave wave-animate bg-grey-100 mb-8 mb-lg-0">
												<div class="card-body">
													<div class="d-flex align-items-center p-6">
														<div class="mr-6">
															<span class="me-sm-6 svg-icon svg-icon-4x svg-icon-primary">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"></rect>
																		<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"></path>
																		<path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"></path>
																		<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"></path>
																	</g>
																</svg>
															</span>
														</div>
														<div class="d-flex flex-column">
															<h3 class="text-dark h3 mb-3">Datos de la reseña:</h3>
															<div class="text-gray-600">Nombre: ' . $mediaInfo['nombre'] . ' </div>
															<div class="text-gray-600">Genero: ' . $mediaInfo['genero'] . ' </div>
															<div class="text-gray-600">Tipo de multimedia: ' . $mediaInfo['tipo_multimedia'] . ' </div>
														</div>
													</div>
												</div>
											</a>
										</div>
											<div class="card-body">
													<div class="row mb-8">
													<div class="col-xl-3">
														<div class="fs-6 fw-bold text-gray-700 mt-2 mb-3">Descripción de la reseña</div>
													</div>
													<div class="col-xl-9 fv-row">
														<textarea id="descripcion" id="descripcion" name="descripcion" class="form-control form-control-solid h-100px" readonly>' . $reseniaInfo['descripcion'] . '</textarea>
														<input type="hidden" id="idMultimedia2" name="idMultimedia2" value="' . $mediaInfo['id_multimedia'] . '">
														<input type="hidden" id="reseniaId" name="reseniaId" value="' . $reseniaData['id_resenia'] . '">
														</div>
												</div>
													<div class="row mb-8">
														<div class="col-xl-3">
															<div class="fs-6 fw-bold text-gray-700 mt-2 mb-3">Calificación dada</div>
														</div>
														<div class="col-xl-9 fv-row">
															<div class="mb-10">
																<input type="text" class="form-control form-control-solid" placeholder="' . $reseniaInfo['calificacion_dada'] . '" readonly/>
															</div>
														</div>
													</div>
												</div>
										</div>';
						}
					}

					if (isset($_GET['user']) && isset($_GET['idMultimedia']) && isset($_GET['type']) && $_GET['type'] == 'ver') { // Un usuario ve una reseña que hizo 
						if ($checkOwner == true) {
							$reseniaInfo = Resenias::GetAllDataResenia($checkOwner[0]['id_resenia'])[0];
							echo '
							<div class="post d-flex flex-column-fluid" id="kt_post">
								<div id="kt_content_container" class="container-fluid">
									<div class="card">
										<div class="card-header">
											<div class="card-title text-gray-800 fs-3 fw-bolder">Viendo reseña 
											<span class="ms-1 fs-5"> <code>(#' . $reseniaInfo['id_resenia'] . ')</code> </span>
											</div>
											<div class="card-toolbar">
											<a href="resenias" class="btn btn-sm btn-light me-2" data-kt-menu-dismiss="true"><i class="fa-solid fa-backward"></i>Regresar</a>
											</div>
										</div>
										
										<div class="col-lg-4">
											<a class="card card-custom wave wave-animate bg-grey-100 mb-8 mb-lg-0">
												<div class="card-body">
													<div class="d-flex align-items-center p-6">
														<div class="mr-6">
															<span class="me-sm-6 svg-icon svg-icon-4x svg-icon-primary">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"></rect>
																		<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"></path>
																		<path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"></path>
																		<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"></path>
																	</g>
																</svg>
															</span>
														</div>
														<div class="d-flex flex-column">
															<h3 class="text-dark h3 mb-3">Datos de la reseña:</h3>
															<div class="text-gray-600">Nombre: ' . $multimediaInfo['nombre'] . ' </div>
															<div class="text-gray-600">Genero: ' . $multimediaInfo['genero'] . ' </div>
														</div>
													</div>
												</div>
											</a>
										</div>
										<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
											<div class="card-body">
													<div class="row mb-8">
													<div class="col-xl-3">
														<div class="fs-6 fw-bold text-gray-700 mt-2 mb-3">Descripción de la reseña</div>
													</div>
													<div class="col-xl-9 fv-row">
														<textarea id="descripcion" id="descripcion" name="descripcion" class="form-control form-control-solid h-100px" readonly>' . $reseniaInfo['descripcion'] . '</textarea>
														<input type="hidden" id="idMultimedia2" name="idMultimedia2" value="' . $multimediaInfo['id_multimedia'] . '">
														<input type="hidden" id="reseniaId" name="reseniaId" value="' . $reseniaInfo['id_resenia'] . '">
														</div>
												</div>
													<div class="row mb-8">
														<div class="col-xl-3">
															<div class="fs-6 fw-bold text-gray-700 mt-2 mb-3">Calificación dada</div>
														</div>
														<div class="col-xl-9 fv-row">
															<div class="mb-10">
																<input type="text" class="form-control form-control-solid" placeholder="' . $reseniaInfo['calificacion_dada'] . '" readonly/>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>';
						} else {
							echo 'No es el duenio de la resenia';
						}
					}

					?>

					<?php
					include_once 'includes/scripts.php';
					?>

					<?php
					include_once 'includes/scripts.php';
					?>
</body>

</html>
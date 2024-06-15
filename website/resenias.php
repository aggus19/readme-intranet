<?php
include_once 'includes/general.php';
$idUsuario = $_SESSION['id'];
$correo = $_SESSION['correo'];
$contador = Resenias::GetCountResenias($correo);
$reseniaData = Resenias::GetReseniaInfoFromUser($correo);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>


<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<?php include "includes/lateral.php"; ?>
			</div>
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php include "includes/header.php"; ?>
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="toolbar" id="kt_toolbar">
						<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
							<ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-bold">
								<li class="breadcrumb-item pe-3"><a href="#" class="pe-3">Panel</a></li>
								<li class="breadcrumb-item px-3 text-muted">Mis reseñas</li>
							</ol>
						</div>
					</div>
					<div class=" post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<?php
							if (isset($_GET['deletedReview']) && $_GET['idResenia']) {
								echo '
								<div class="alert alert-dismissible bg-light-success border border-success border-1 d-flex flex-column flex-sm-row w-100 p-5 mb-10">
								<span class="svg-icon svg-icon-2hx svg-icon-success me-4 mb-5 mb-sm-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
										<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
									</svg>
								</span>
								<div class="d-flex flex-column pe-0 pe-sm-10">
									<h5 class="mb-1">¡Bien!</h5>
									<span>Tu reseña <code>' . $_GET['idResenia'] . ' </code>fue eliminada correctamente.</span>
								</div>
								<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
									<i class="bi bi-x fs-1 text-success"></i>
								</button>
							</div>';
							}
							?>
							<?php
							if (isset($_GET['success']) && $_GET['success'] == 'true' && $_GET['nombre'] && $_GET['type'] == '1') {
								echo '
								<div class="alert alert-dismissible bg-light-success border border-success border-1 d-flex flex-column flex-sm-row w-100 p-5 mb-10">
								<span class="svg-icon svg-icon-2hx svg-icon-success me-4 mb-5 mb-sm-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
										<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
									</svg>
								</span>
								<div class="d-flex flex-column pe-0 pe-sm-10">
									<h5 class="mb-1">¡Bien!</h5>
									<span>Tu reseña sobre el album / música<code>' . $_GET['nombre'] . '</code>se ha publicado correctamente.</span>
								</div>
								<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
									<i class="bi bi-x fs-1 text-success"></i>
								</button>
							</div>
							';
							} else if (isset($_GET['success']) && $_GET['success'] == 'true' && $_GET['nombre'] && $_GET['type'] == '2') {
								echo '
								<div class="alert alert-dismissible bg-light-success border border-success border-1 d-flex flex-column flex-sm-row w-100 p-5 mb-10">
								<span class="svg-icon svg-icon-2hx svg-icon-success me-4 mb-5 mb-sm-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
										<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
									</svg>
								</span>
								<div class="d-flex flex-column pe-0 pe-sm-10">
									<h5 class="mb-1">¡Bien!</h5>
									<span>Tu reseña sobre la pelicula<code>' . $_GET['nombre'] . ' (' . $_GET['genero'] . ')</code>se ha publicado correctamente.</span>
								</div>
								<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
									<i class="bi bi-x fs-1 text-success"></i>
								</button>
							</div> ';
							} else if (isset($_GET['success']) && $_GET['success'] == 'true' && $_GET['nombre'] && $_GET['type'] == '3') {
								echo '
								<div class="alert alert-dismissible bg-light-success border border-success border-1 d-flex flex-column flex-sm-row w-100 p-5 mb-10">
								<span class="svg-icon svg-icon-2hx svg-icon-success me-4 mb-5 mb-sm-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
										<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
									</svg>
								</span>
								<div class="d-flex flex-column pe-0 pe-sm-10">
									<h5 class="mb-1">¡Bien!</h5>
									<span>Tu reseña sobre el Libro<code>' . $_GET['nombre'] . ' (' . $_GET['genero'] . ')</code>se ha publicado correctamente.</span>
								</div>
								<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
									<i class="bi bi-x fs-1 text-success"></i>
								</button>
							</div> ';
							}
							?>
							<div id="cardCrearR" name="cardCrearR" class=" card card-flush">
								<div class="row g-5 g-xxl-8">
									<div class="col-xl-6">
										<div class="card mb-5 mb-xxl-8">
											<div class="card-body pb-0">
												<div class="mb-7">
													<div class="text-gray-800 mb-5">
													</div>
												</div>
												<div class="mb-7">
													<div class="text-gray-800 mb-5">
														<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Elige tu tipo de reseña</p>
														<select id="selectBox" name="selectBox" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true">
															<option></option>
															<option value="1">Musica / Álbum</option>
															<option value="2">Pelicula</option>
															<option value="3">Libro</option>
														</select>
													</div>
												</div>
												<form action="resenia.php" method="post" class="position-relative mb-6">
													<div id="opciones" name="opciones" style="display: none;" class="mb-7">
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Nombre de la canción / álbum</p>
															<textarea id="txtNombreCancion" name="txtNombreCancion" class="form-control form-control-solid" rows="3" placeholder="Nombre del album o cancion"></textarea>
														</div>
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Escribe tu reseña</p>
															<textarea id="txtReseniaCancion" name="txtReseniaCancion" class="form-control form-control-solid" rows="3" placeholder="Contenido de tu reseña"></textarea>
														</div>
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Calificacion</p>
															<select id="califM" name="califM" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true">
																<option></option>
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
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Género</p>
															<select id="generoMusica" name="generoMusica" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true">
																<option></option>
																<option value="Clasica">Clasica</option>
																<option value="Pop">Pop</option>
																<option value="Rock">Rock</option>
																<option value="Reggaeton">Reggaeton</option>
																<option value="Salsa">Salsa</option>
																<option value="Trap">Trap</option>
																<option value="Jazz">Jazz</option>
																<option value="Electronica">Electronica</option>
															</select>
														</div>
													</div>
													<div class="position-absolute top-0 end-0 me-n5">
													</div>
													<input style="display: none;" id="btnMusica" name="btnMusica" type="submit" class="mt-4 btn btn-light-success w-100 text-center" value="Enviar">
													<div id="opciones2" name="opciones2" style="display: none;" class="mb-7">
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Genero de la pelicula</p>
															<select id="generoPeli" name="generoPeli" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true">
																<option></option>
																<option value="Accion">Accion</option>
																<option value="Aventura">Aventura</option>
																<option value="Comedia">Comedia</option>
																<option value="Drama">Drama</option>
																<option value="Fantasia">Fantasia</option>
																<option value="Romance">Romance</option>
																<option value="Terror">Terror</option>
																<option value="Ciencia Ficcion">Ciencia Ficcion</option>
																<option value="Musical">Musical</option>
																<option value="Documental">Documental</option>
																<option value="Otro">Otro</option>
															</select>
														</div>
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Calificacion</p>
															<select id="califP" name="califP" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true">
																<option></option>
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
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Nombre de la pelicula</p>
															<textarea id="txtNombrePeli" name="txtNombrePeli" class="form-control form-control-solid" rows="3" placeholder="Nombre de la pelicula"></textarea>
														</div>
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Escribe tu reseña</p>
															<textarea id="txtReseniaPeli" name="txtReseniaPeli" class="form-control form-control-solid" rows="3" placeholder="Contenido de tu reseña"></textarea>
														</div>
													</div>
													<div class="separator mb-4"></div>
													<div class="position-absolute top-0 end-0 me-n5">
													</div>
													<input style="display: none;" id="btnPeli" name="btnPeli" type="submit" class="mt-4 btn btn-light-success w-100 text-center" value="Enviar">
													<div id="opciones3" name="opciones3" style="display: none;" class="mb-7">
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Escribe tu reseña</p>
															<textarea id="txtReseniaLibro" name="txtReseniaLibro" class="form-control form-control-solid" rows="3" placeholder="Contenido de tu reseña"></textarea>
														</div>
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Libro</p>
															<select id="selectLibros" name="selectLibros" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true">
																<option></option>
																<?php
																$libros = Book::GetAllBooks();
																foreach ($libros as $libro => $value) {
																	echo '<option value="' . $value['id_multimedia'] . '">' . $value['nombre'] . ' </option> ';
																}
																?>
															</select>
														</div>
														<div class="text-gray-800 mb-5">
															<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Calificacion</p>
															<select id="califL" name="califL" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true">
																<option></option>
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
													<div class="position-absolute top-0 end-0 me-n5">
													</div>
													<input style="display: none;" id="btnLibro" name="btnLibro" type="submit" class="mt-4 btn btn-light-success w-100 text-center" value="Enviar">
												</form>
											</div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="card card-flush h-lg-100">
											<div class="card-header mt-6">
												<div class="card-title flex-column">
													<h3 class="fw-bolder mb-1">Todas tus reseñas</h3>
													<?php
													echo '<div class="fs-6 text-gray-400">' . $contador . '</div>';
													?>
												</div>
											</div>
											<div class="card-body d-flex flex-column p-9 pt-3">
												<div class="d-flex align-items-center position-relative mb-7">
													<div class="fw-bold">
														<?php
														foreach ($reseniaData as $info) {
															if (count($reseniaData) > 0) {
																echo '
																<div class="mb-8 fs-4 text-gray-600"> 
																	<div class="mb-8 separator mt-4 mb-4"></div>
																		<span class="badge badge-light-success"></span> <span class="fs-6"> <code>' . $info['tipo_multimedia'] . ' (' . $info['genero'] . ')</code></span> <span class="fs-6"> <code>(ID: #' . $info['id_multimedia'] . ')</code> </span>																		<br>
																			<a class="ms-sm-2 text-gray-600 text-hover-primary"> ' . $info['nombre'] . ' </a>
																				<a  href="resenia?idMultimedia=' . $info['id_multimedia'] . '&user=' . $idUsuario . '&type=ver" class="text-gray-600">
																					<span class="ms-2 badge badge-circle badge-light-success">
																						<i class="text-white fa-solid fa-eye"></i>
																					</span>
																				</a>
																				<a href="resenia?idMultimedia=' . $info['id_multimedia'] . '&user=' . $idUsuario . '&type=1" class="text-gray-600">
																					<span class="ms-2 badge badge-circle badge-light-warning">
																						<i class="text-white fa-solid fa-pencil"></i>
																					</span>
																				</a>
																</div>
																';
															}
														}
														?>
														<div class="mb-8 separator mt-4 mb-4"></div> <!-- Ultimo separator -->
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#btnMusica").hide();
			$("#btnPeli").hide();
			$("#btnLibro").hide();
			$("#selectBox").change(function() {
				var seleccion = $(this).children("option:selected").val();
				if (seleccion == 1) {
					$("#opciones2").hide();
					$("#opciones3").hide();
					$("#btnLibro").hide();
					$("#btnPeli").hide();
					$("#opciones").show();
					$("#btnMusica").show();
					$("#btnMusica").click(function() {
						var txtNombreCancion = $("#txtNombreCancion").val();
						var txtReseniaCancion = $("#txtReseniaCancion").val();
						var selectCalif = $("#califM").children("option:selected").val();
						var generoMusica = $("#generoMusica").children("option:selected").val();

					});
				} else if (seleccion == 2) {
					$("#opciones2").show();
					$("#btnPeli").show();
					$("#btnMusica").hide();
					$("#opciones").hide();
					$("#btnPeli").click(function() {
						var txtNombrePeli = $("#txtNombrePeli").val();
						var txtReseniaPeli = $("#txtReseniaPeli").val();
						var generoPeli = $("#generoPeli").children("option:selected").val();
						var selectCalifP = $("#califP").children("option:selected").val();
						if (txtNombrePeli == "" || txtReseniaPeli == "" || generoPeli == 0 || selectCalifP == 0) {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'No puedes dejar campos vacios',
							})
							return false;
						}
					});
				} else if (seleccion == 3) {
					$("#opciones3").show();
					$("#btnLibro").show();
					$("#califL").show();
					$("#btnMusica").hide();
					$("#btnPeli").hide();
					$("#opciones").hide();
					$("#opciones2").hide();
					$("#btnLibro").click(function() {
						var txtReseniaLibro = $("#txtReseniaLibro").val();
						var selectLibros = $("#selectLibros").children("option:selected").val();
						if (txtReseniaLibro == "" || selectLibros == 0) {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'No puedes dejar campos vacios',
							})
							return false;
						}
					});
				} else {
					$("#opciones").hide();
					$("#btnMusica").hide();
				}
			});
			/* 
						$("#opcionCrearR").click(function() {
							$("#cardCrearR").hide();
							$("#divTodas").hide();
							$("#cardVerR").hide();
							$("#cardEditarR").hide();
						});
						$("#opcionTodasR").click(function() {
							$("#cardCrearR").hide();
							$("#cardVerR").hide();
							$("#cardEditarR").hide();
							$("#divTodas").show();
						});
					*/
		});
	</script>
	<?php
	include_once 'includes/scripts.php';
	?>
</body>

</html>
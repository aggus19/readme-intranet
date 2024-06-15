<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';
$idUsuario = $_SESSION['id'];
$usuario = new User($idUsuario);
Discord::SendWebhook("New click on page (manage-books)",  "**Username:** " . "`" . $usuario->GetUserById($idUsuario)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `🔎` **Clicked on manage-books.**" . "\n\n `🌎` **URL:** $url");

if (isset($_POST['agregarLibro'])) {
	$nomLibro = $_POST['nomLibro'];
	$descLibro = $_POST['descLibro'];
	$genLibro = $_POST['selectGenero'];
	$fechaPublicado = $_POST['fechaPublicado'];
	$ratingLibro = $_POST['selectRating'];
	$costoLibro = $_POST['costoLibro'];
	$pubBy = $_POST['selectAutor'];
	Book::AddNewBook($nomLibro, $descLibro, $genLibro, $fechaPublicado, $ratingLibro, $costoLibro, $pubBy);
	header("Location: manage-books?addedBook");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>


<body id="kt_body" class="loader header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
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
							<ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-bold">
								<li class="breadcrumb-item pe-3"><a href="index" class="pe-3">Panel</a></li>
								<li class="breadcrumb-item pe-3"><a class="pe-3">Gestión</a></li>
								<li class="breadcrumb-item px-3"><a href="manage-books" class=" text-muted pe-3">Libros</a></li>
							</ol>
						</div>
					</div>
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<?php
							//  Mostrar en una variable al usuario que no se encontro.
							if (isset($_GET['invalidBook'])) {
								echo '
								<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
									<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-triangle-exclamation"></i>
									</span>
								<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Libro no encontrado! 😔</h4>
										<span class="text-white">No pudimos encontrar el libro solicitado.</span>
								</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							} // Si recibe success, mostrar mensaje de exito.
							elseif (isset($_GET['successEdit']) && $_GET['successEdit'] == '1') {
								echo '<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
										<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
										</span>
										<div class="d-flex flex-column text-light pe-0 pe-sm-10">
											<h4 class="mb-2 text-white">Libro modificado con exito! 😎</h4>
											<span class="text-white">El libro se modificó correctamente.</span>
										</div>
										<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
											<span class="svg-icon svg-icon-2x svg-icon-light">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
													<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
												</svg>
											</span>
										</button>
									</div>';
							} // Si recibe usuario eliminado, mostrar mensaje de exito.
							elseif (isset($_GET['addedBook'])) {
								echo '
								<div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
									<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
										<i class="fs-xl-2 text-white fa-solid fa-circle-check"></i>
									</span>
									<div class="d-flex flex-column pe-0 pe-sm-10">
										<h5 class="mb-1">Libro agregado con exito! 😎</h5>
										<span> El libro se agregó correctamente.</span>
									</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<i class="bi bi-x fs-1 text-success"></i>
									</button>
							</div>';
							} elseif (isset($_GET['deletedBook']) && $_GET['id']) {
								echo '<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
									<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
									<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
									</span>
									<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Libro eliminado con exito! 😎</h4>
										<span class="text-white">El libro (#' . $_GET['id'] . ') | (' . $_GET['nombre'] . ') se eliminó correctamente.</span>
									</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							} // Si recibe error, mostrar mensaje de error.
							elseif (isset($_GET['error'])) {
								echo '<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
									<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
									<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-exclamation-circle"></i>
									</span>
									<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Error! 😢</h4>
										<span class="text-white">Ocurrió un error al intentar modificar el libro.</span>
									</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							}
							?>
							<div class=" card card-flush">
								<div class="card-header mt-6">
									<div class="card-title">
										<div class="d-flex align-items-center position-relative my-1 me-5">
											<span class="svg-icon svg-icon-1 position-absolute ms-6">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
											<input type="text" data-kt-permissions-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar" />
										</div>
									</div>
									<div class="card-toolbar">
										<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
											<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"> Añadir libro <i class="fs-5 ms-2 bi bi-plus-circle"></i> </button>
										</div>

										<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered mw-650px">
												<div class="modal-content">
													<div class="modal-header" id="kt_modal_add_user_header">
														<h2 class="fw-bolder text-white">Creacion de libro</h2>
														<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
															<span class="svg-icon svg-icon-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
																	<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
																</svg>
															</span>
														</div>
													</div>
													<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
														<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="kt_sign_in_form" method="post">
															<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Nombre</label>
																	<input type="text" name="nomLibro" id="nomLibro" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Las aventuras de Mike" required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Descripcion</label>
																	<input type="text" name="descLibro" id="descLibro" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Descripcion..." required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Fecha de publicacion</label>
																	<input type="date" name="fechaPublicado" id="fechaPublicado" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="XXXX-XX-XX" value="<?php echo date("Y-m-d"); ?>" required>
																</div>
																<div class="fv-row mb-7">
																	<div class="text-gray-800">
																		<p class="text-gray-800 fw-bold fs-6 required">Genero</p>
																		<select id="selectGenero" name="selectGenero" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true" required>
																			<option></option>
																			<option value="Accion">Accion</option>
																			<option value="Aventura">Aventura</option>
																			<option value="Comedia">Comedia</option>
																			<option value="Drama">Drama</option>
																			<option value="Fantasia">Fantasia</option>
																			<option value="Ficcion">Ficcion</option>
																			<option value="Misterio & Thriller">Misterio & Thriller</option>
																			<option value="Ficcion histórica">Ficcion histórica</option>
																			<option value="Ciencia y Ficción">Ciencia y Ficción</option>
																			<option value="Memorias y Autobiografia">Memorias y Autobiografia</option>
																			<option value="Historia y Biografía">Historia y Biografía</option>
																			<option value="Novelas Gráficas y Cómics">Novelas Gráficas y Cómics</option>
																			<option value="Poemas">Poemas</option>
																			<option value="Romance">Romance</option>
																			<option value="Terror">Terror</option>
																		</select>
																	</div>
																</div>
																<div class="fv-row mb-7">
																	<div class="text-gray-800">
																		<p class="text-gray-800 fw-bold fs-6 required">Rating</p>
																		<select id="selectRating" name="selectRating" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true" required>
																			<option></option>
																			<option value="1">1</option>
																			<option value="2">2</option>
																			<option value="3">3</option>
																			<option value="4">4</option>
																			<option value="5">5</option>
																		</select>
																	</div>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Costo</label>
																	<input type="number" name="costoLibro" id="costoLibro" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="$" required>
																</div>
																<div class="fv-row mb-7">
																	<div class="text-gray-800 mb-5">
																		<p class="text-gray-800 fw-bold fs-6 mb-4 required">Autor asociado</p>
																		<select id="selectAutor" name="selectAutor" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true" required>
																			<option></option>
																			<?php
																			$autores = Autores::GetAllAutores();
																			foreach ($autores as $autor) {
																				echo '<option value=' . $autor['id_autor'] . '> ' . $autor['nombre'] . ' ' . $autor['apellido'] .  ' (ID #' . $autor['id_autor'] . ')</option> required';
																			}
																			?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="text-center pt-15">
																<input type="submit" class="btn btn-primary" name="agregarLibro" value="Agregar">
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card-body pt-0">
									<table class="table align-middle table-row-bordered fs-6 gy-5 mb-0" id="kt_permissions_table">
										<thead>
											<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
												<th class="min-w-125px">ID Libro</th>
												<th class="min-w-250px">Detalles (nombre, costo, rating)</th>
												<th class="min-w-125px">Fecha</th>
												<th class="text-center min-w-100px">Accion</th>
											</tr>
										</thead>
										<tbody class="fw-bold text-gray-600">
											<?php
											$a = Book::GetAllBooks();
											foreach ($a as $x => $value) {
												echo '
												<tr>
												 	<td>
														<span class="badge badge-light-dark"><strong><i class="text-dark me-2 fas fa-book"> </i> <span class="fw-bold fs-7">' . $value['id_multimedia'] . ' </strong>  </span>  
												 	</td>
												 	<td>
												  		<div class="d-flex flex-column">
															<a class="text-primary-600 text-hover-primary mb-1">' . $value['nombre'] . ' (<span class="text-success">$' . $value['costo'] . '</span>)</a>
																<div class="d-flex flex-column">
																	<ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-bold">
																		<li class="breadcrumb-item pe-3"><a href="autor?idAutor=' . $value['pubBy'] . '" class="badge badge-light-dark pe-3">Ver autor</a></li>
																		<li class="breadcrumb-item pe-3"><a href="libro?idLibro=' . $value['id_multimedia'] . '" class="badge badge-light-dark pe-3">Ver libro</a></li>
																	</ol>
																</div>
															<span class="fw-bolder text-gray-600 text-hover-warning ">' . $value['rating'] . '</span>
														</div>
												 	</td>
												 	<td>
														<div class="d-flex flex-column">
																<a class="text-primary-600 text-hover-primary mb-1"> Fecha de publicacion: <span class="fw-bolder  text-gray-600 text-hover-warning ">' .  $value['fecha_publicacion'] . '</span>  </a>
														</div>
												 	</td>
													<td class="text-center">
														<a class="btn btn-sm btn-light-danger me-3" href="deletes?idLibro=' . $value['id_multimedia'] . '" > <i class="fa-solid fa-trash-can"></i> Eliminar </a>
														<a class="btn btn-sm btn-light-warning me-3" href="editBook?idLibro=' . $value['id_multimedia'] . '" > <i class="fa-solid fa-pen-to-square"></i> Editar </a>
													</td>
												</tr>';
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		// Limitar el inout con id 'nomLibro' a 10 caracteres, si se pasa de 10 caracteres, se muestra un alert
		$('#nomLibro').on('input', function() {
			if ($(this).val().length > 50) {
				$(this).val($(this).val().slice(0, 50));
				alert("El nombre del libro no puede tener mas de 50 caracteres");
			}
		});
	</script>
	<?php
	include_once 'includes/scripts.php';
	?>
</body>

</html>
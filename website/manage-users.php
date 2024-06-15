<?php

include_once 'includes/general.php';
include_once 'includes/adminPerms.php';

$idUsuario = $_SESSION['id'];
$usuario = new User($idUsuario);
Discord::SendWebhook("New click on page (manage-users)",  "**Username:** " . "`" . $usuario->GetUserById($idUsuario)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `🔎` **Clicked on manage-users.**" . "\n\n `🌎` **URL:** $url");

$CheckUsername = User::CheckDuplicatedUser($_POST['username']);
$CheckEmail = User::CheckDuplicatedEmail($_POST['mailPersona']);

// Si recibe el formulario de registro y no hay errores, registra al usuario.
if (isset($_POST['btnRegister'])) {
	if ($CheckEmail == true) {
		header("Location: manage-users?errorEmailAlreadyExists=true&email=" . $_POST['mailPersona']);
	} else if ($CheckUsername == true) {
		header("Location: manage-users?errorUsernameAlreadyExists=true&username=" . $_POST['username']);
	} else {
		$nomPersona = $_POST['nombrePersona'];
		$apePersona = $_POST['apellidoPersona'];
		$celPersona = $_POST['celPersona'];
		$mailPersona = $_POST['mailPersona'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$creditos = $_POST['creditos'];
		$createdAcc = $_POST['fechaCreacion'];
		$rangoPersona = $_POST['rango'];
		$verified = "1";
		$query = User::AddNewUser($nomPersona, $apePersona, $celPersona, $createdAcc, $username, $password, $creditos, $mailPersona, $rangoPersona, $verified);
		header("Location: manage-users?successCreate");
	}
}
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
							<ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-bold">
								<li class="breadcrumb-item pe-3"><a href="index" class="pe-3">Panel</a></li>
								<li class="breadcrumb-item pe-3"><a class="pe-3">Gestión</a></li>
								<li class="breadcrumb-item px-3"><a href="manage-users" class=" text-muted pe-3">Cuentas</a></li>
							</ol>
						</div>
					</div>
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<?php
							//  Mostrar en una variable al usuario que no se encontro.
							if (isset($_GET['invalidusername'])) {
								echo '<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
								<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-triangle-exclamation"></i>
								</span>
								<div class="d-flex flex-column text-light pe-0 pe-sm-10">
									<h4 class="mb-2 text-white">Usuario no encontrado! 😔</h4>
									<span class="text-white">No pudimos encontrar el usuario solicitado.</span>
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
									<h4 class="mb-2 text-white">Usuario ' . $_GET['idUser'] . ' modificado con exito! 😎</h4>
									<span class="text-white">El usuario se modificó correctamente.</span>
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
							elseif (isset($_GET['deletedUser']) && $_GET['id']) {
								echo '<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
								<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
								</span>
								<div class="d-flex flex-column text-light pe-0 pe-sm-10">
									<h4 class="mb-2 text-white">Usuario eliminado con exito! 😎</h4>
									<span class="text-white">El usuario (#' . $_GET['id'] . ') | (' . $_GET['username'] . ') se eliminó correctamente.</span>
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
									<h4 class="mb-2 text-white">Error al crear el usuario! 😢</h4>
									<span class="text-white">El usuario no se creó correctamente. El correo o nombre de usuario ya está en uso.</span>
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
							} elseif (isset($_GET['errorEmailAlreadyExists']) && $_GET['errorEmailAlreadyExists'] == 'true' && $_GET['email']) {
								echo '<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
								<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-exclamation-circle"></i>
								</span>
								<div class="d-flex flex-column text-light pe-0 pe-sm-10">
									<h4 class="mb-2 text-white">Error al crear el usuario! 😢</h4>
									<span class="text-white">El usuario no se creó correctamente. El correo <code>' . $_GET['email'] . '</code> ya está en uso.</span>
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
							} elseif (isset($_GET['errorUsernameAlreadyExists']) && $_GET['errorUsernameAlreadyExists'] == 'true' && $_GET['username']) {
								echo '<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
							<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
							<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-exclamation-circle"></i>
							</span>
							<div class="d-flex flex-column text-light pe-0 pe-sm-10">
								<h4 class="mb-2 text-white">Error al crear el usuario! 😢</h4>
								<span class="text-white">El usuario no se creó correctamente. El nombre de usuario <code>' . $_GET['username'] . '</code> ya está en uso.</span>
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
							elseif (isset($_GET['successCreate'])) {
								echo '<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
								<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-exclamation-circle"></i>
								</span>
								<div class="d-flex flex-column text-light pe-0 pe-sm-10">
									<h4 class="mb-2 text-white"> Usuario creado con exito! 😎</h4>
									<span class="text-white">El usuario se creó correctamente.</span>
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
							elseif (isset($_GET['alreadyExists'])) {
								echo '<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
										<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
										</span>
										<div class="d-flex flex-column text-light pe-0 pe-sm-10">
											<h4 class="mb-2 text-white">Error, el usuario ya existe! 😢</h4>
											<span class="text-white">El usuario no se pudo crear correctamente.</span>
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
											<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"> Añadir Cuenta <i class="fs-5 ms-2 bi bi-plus-circle"></i> </button>
										</div>
										<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered mw-650px">
												<div class="modal-content">
													<div class="modal-header" id="kt_modal_add_user_header">
														<h2 class="fw-bolder text-white">Creacion de Cuenta</h2>
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
																	<input type="text" name="nombrePersona" id="nombrePersona" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nombre" required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Apellido</label>
																	<input type="text" name="apellidoPersona" id="apellidoPersona" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Apellido" required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Celular</label>
																	<input type="number" name="celPersona" id="celPersona" class="form-control form-control-solid mb-3 mb-lg-0" min placeholder="Numero" required>
																</div>

																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Correo electronico</label>
																	<input type="email" name="mailPersona" id="mailPersona" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="admin@agrasystems.us" required>
																</div>
																<div class="fv-row mb-7">
																	<div class="text-gray-800">
																		<p class="text-gray-800 fw-bold fs-6 required">Rango</p>
																		<select id="rango" name="rango" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true" required>
																			<option></option>
																			<option value="0">Visitante</option>
																			<option value="1">Usuario</option>
																			<option value="2">Administrador</option>
																			<option value="3">Bibliotecologo</option>
																		</select>
																	</div>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Usuario</label>
																	<input type="username" name="username" id="username" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Usuario" required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2">Contraseña</label>
																	<input type="password" name="password" id="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="xxxxxxx" required>
																</div>

																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2">Creditos</label>
																	<input type="number" name="creditos" id="creditos" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Cantidad (si es necesario)" required>
																</div>
																<input type="hidden" name="fechaCreacion" id="fechaCreacion" class="form-control form-control-solid mb-3 mb-lg-0" value="<?php echo Time::GetTimeYMD() ?>" required readonly>
															</div>
															<div class="text-center pt-15">
																<input type="submit" class="btn btn-primary" name="btnRegister" value="Agregar">
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
												<th class="min-w-125px">ID Cuenta</th>
												<th class="min-w-250px">Detalles (nombre & email)</th>
												<th class="min-w-125px">Fecha (creacion & ult. sesion)</th>
												<th class="text-center min-w-100px">Accion</th>
											</tr>
										</thead>
										<tbody class="fw-bold text-gray-600">
											<?php

											$a = User::GetAllUsers();
											foreach ($a as $x => $value) {
												echo '
												<tr>
												 	<td>
														<span class="badge badge-light-dark">
														<strong>
														<i class="text-dark fas fa-user"> </i> 
														<span class="fw-bold fs-7"> ' . $value['id'] . ' </strong>  <span class="fw-bold ms-2 fs-7"> (' . $value['username'] . ') </strong>  </span>   </span>  
														<a class="ms-2 text-gray-userTable fw-bolder text-hover-primary mb-1 fs-6"> </a>
												 	</td>
												 	<td>
												 		<div class="d-flex flex-column">
															<a class="text-primary-600 text-hover-primary mb-1">' . $value['nombre'] . ' ' . $value['apellido'] . '</a>
															<span class="fw-bolder text-gray-600 text-hover-warning ">' . $value['correo'] . '</span>
														</div>
												 	</td>
												 	<td>
														<div class="d-flex flex-column">
															<a class="text-primary-600 text-hover-primary mb-1"> Ultimo inicio de sesion: <span class="fw-bolder  text-gray-600 text-hover-warning ">' .  $value['lastLogin'] . '</span>  </a>
															<a class="text-primary-600 text-hover-primary mb-1"> Cuenta creada el: <span class="fw-bolder text-gray-600 text-hover-warning ">' . $value['createdAt'] . '</span> </a>
														</div>
												 	</td>
													<td class="text-center">
														<a class="btn btn-sm btn-light-danger me-3" href="deletes?idUsuario=' . $value['id'] . '" > <i class="fa-solid fa-trash-can"></i> Eliminar </a>
														<a class="btn btn-sm btn-light-warning me-3" href="editUser?idUsuario=' . $value['id'] . '" > <i class="fa-solid fa-pen-to-square"></i> Editar </a>
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
		$('#nombrePersona').on('input', function() {
			if ($(this).val().length > 30) {
				$(this).val($(this).val().slice(0, 30));
				alert("El nombre de la persona supera el limite de 30 caracteres");
			}
		});
		$('#apellidoPersona').on('input', function() {
			if ($(this).val().length > 30) {
				$(this).val($(this).val().slice(0, 30));
				alert("El apellido de la persona supera el limite de 30 caracteres");
			}
		});
		$("#celPersona").keyup(function() {
			var celular = $("#celPersona").val();
			if (celular.length > 9) {
				$("#celPersona").val(celular.substring(0, 9));
			}
		});
		$('#mailPersona').on('input', function() {
			if ($(this).val().length > 50) {
				$(this).val($(this).val().slice(0, 50));
				alert("Los creditos de la persona supera el limite de 50 caracteres");
			}
		});
		$('#username').on('input', function() {
			if ($(this).val().length > 30) {
				$(this).val($(this).val().slice(0, 30));
				alert("El usuario de la persona supera el limite de 30 caracteres");
			}
		});
		$('#password').on('input', function() {
			if ($(this).val().length > 30) {
				$(this).val($(this).val().slice(0, 30));
				alert("La contraseña de la persona supera el limite de 30 caracteres");
			}
		});
		$('#creditos').on('input', function() {
			if ($(this).val().length > 9) {
				$(this).val($(this).val().slice(0, 9));
				alert("Los creditos de la persona supera el limite de 9 caracteres");
			}
		});
	</script>
	<?php
	include_once 'includes/scripts.php';
	?>


</body>

</html>
<?php

include_once 'includes/general.php';
$sesionId = $_SESSION['id'];
$permisos = User::GetRankFromUser($sesionId);
$logsData = AuditLogs::ShowUserLogs($_GET['id']);
$userLogs = AuditLogs::GetLogsFromUser($_SESSION['id']);

if (isset($_GET['id'])) {
	$idUsuario = $_GET['id'];
	$userData = User::GetUserById($idUsuario);
	if (count($userData) == 0) {
		die("[Agras]: Usuario no encontrado. 1");
	}
} else {
	die('[Agras]: Usuario no encontrado. 2');
}

foreach ($userData as $Usuario => $value) {
}

if ($_POST) {
	$idUsuario = $_POST['id'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:1px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class=" d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<?php include "includes/lateral.php"; ?>
			</div>
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_content">
				<?php include "includes/header.php"; ?>
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-fluid">
							<div class="content flex-row-fluid" id="kt_content">
								<?php
								if (isset($_GET['emailRepeat'])) {
									echo '<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
														<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
														<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-triangle-exclamation"></i>
														</span>
														<div class="d-flex flex-column text-light pe-0 pe-sm-10">
															<h4 class="mb-2 text-white"> Error al actualizar tu perfil! </h4>
															<span class="text-white">El email se encuentra en uso por otra persona. Intenta con otro.</span>
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
								} else if (isset($_GET['success'])) {
									echo '<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
														<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
														<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
														</span>
														<div class="d-flex flex-column text-light pe-0 pe-sm-10">
															<h4 class="mb-2 text-white"> Perfil actualizado! </h4>
															<span class="text-white">Tu perfil ha sido actualizado correctamente.</span>
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

								<div class="card shadow-sm mb-5">
									<div class="card-header">
										<h3 class="card-title">Información de tu perfil</h3>
										</button>
										<div class="card-toolbar">
											<div class="me-0">
												<?php
												if ($_SESSION['username'] == 'visitante') {
													echo '';
												} else {
													echo
													'
													<button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="left" title="Realizar cambios en tu cuenta" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
														<i class="bi bi-three-dots fs-3"></i>
													</button>
													<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
														<div class="menu-item px-3">
															<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">ACCIONES</div>
														</div>
														<div class="ms-2 menu-item px-3">
															<a href="#" class=" btn btn-sm btn-light me-2 px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">Actualizar tus datos</a>
														</div>
														<div class="ms-2 menu-item px-3 my-1">
															<form action="changePhoto.php" method="post" enctype="multipart/form-data">
																<input type="file" name="fileToUpload" id="fileToUpload" id="fileToUpload" style="display:none;" />
																	<label class="mt-2 btn btn-sm btn-light me-2 px-3" name="fileToUpload" id="fileToUpload" for="fileToUpload">Elegir nueva foto</label>
																	<input type="submit" class="mt-3 btn btn-sm btn-light-success me-2" value="Actualizar foto" name="subir">
															</form>
														</div>
													</div>
													';
												}
												?>
											</div>
										</div>
									</div>

									<?php
									echo '
									<div class="row d-flex justify-content-flex">
										<div class="col-lg-6 mb-4">
											<div class="card card-custom card-stretch">
												<div class="card-body pt-6 pb-6">
													<div class="d-flex align-items-center">
														<div class="symbol symbol-100px symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
															<div data-bs-toggle="tooltip" data-bs-dismiss="click" title="Tu foto de perfil" class="symbol-label me-5" style="background-image:url(' . $value['profile_pic'] . ')"></div>
														</div>
														<div>
															<div class="d-flex flex-column flex-grow-1 pr-8">
																<div  class="d-flex flex-wrap mb-1 mt-sm-1">
																	<a class="text-muted">
																		<code><i class="text-white fa-solid fa-user"></i></code>
																		<code data-bs-toggle="tooltip" data-bs-dismiss="click"  data-bs-placement="right" title="Tu nombre y apellido" class="ms-sm-2">' . $value['nombre'] . ' ' . $value['apellido'] . ' (#' . $value['id'] . ')</code>
																	</a>
																</div>
																<div class="d-flex flex-wrap mb-1 mt-sm-1">
																	<a class="text-muted">
																		<code><i class="text-white fa-solid fa-envelope"></i></code>
																		<code data-bs-toggle="tooltip" data-bs-placement="right" data-bs-dismiss="click" title="Tu correo" >' . $value['correo'] . ' </code>
																	</a>
																</div>
																<div class="d-flex flex-wrap mb-1 mt-sm-1">
																	<a class="text-muted">
																		<code><i class="text-white fa-brands fa-bitcoin"></i></code>
																		<code data-bs-toggle="tooltip" data-bs-dismiss="click"  data-bs-placement="right" title="Tus creditos" >' . $value['creditos'] . ' </code>
																	</a>
																</div>
																<div class="d-flex flex-wrap mb-1 mt-sm-1">
																	<a class="text-muted">
																		<code><i class="text-white fa-solid fa-phone"></i></code>
																		<code  data-bs-toggle="tooltip" data-bs-dismiss="click"  data-bs-placement="right" title="Tu numero de celular">' . $value['celular'] . ' </code>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>';
									?>
									<div class="m-0">
										<div class="modal fade" id="kt_modal_invite_friends" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog mw-650px">
												<div class="modal-content">
													<div class="modal-header" id="kt_modal_add_user_header">
														<h2 class="fw-bolder text-white">Editar mi cuenta</h2>
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
														<form action="editProfileDetails.php" id="kt_modal_invite_friends" method="post" enctype="multipart/form-data">
															<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
																<div class="fv-row mb-7">
																	<label class="text-white  fw-bold fs-6 mb-2"> Nombre</label>
																	<input type="text" name="nombreUser" id="nombreUser" class="form-control form-control-solid mb-3 mb-lg-0" <?php echo 'placeholder="' . $value['nombre'] . '"'; ?>>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white  fw-bold fs-6 mb-2"> Apellido</label>
																	<input type="text" name="apeUser" id="apeUser" class="form-control form-control-solid mb-3 mb-lg-0" <?php echo 'placeholder="' . $value['apellido'] . '"'; ?>>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white  fw-bold fs-6 mb-2"> Correo electronico</label>
																	<input type="email" name="correoEle" id="correoEle" class="form-control form-control-solid mb-3 mb-lg-0" <?php echo 'value="' . $value['correo'] . '"'; ?> required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white  fw-bold fs-6 mb-2"> Celular</label>
																	<input type="text" pattern="[0-9]+" name="celular" id="celular" class="form-control form-control-solid mb-3 mb-lg-0" <?php echo 'placeholder="' . $value['celular'] . '"'; ?>>
																</div>
																<div class="fv-row mb-7 fv-plugins-icon-container" data-kt-password-meter="true">
																	<div class="mb-1">
																		<label class="form-label fw-bolder text-dark fs-6">Contraseña</label>
																		<div class="position-relative mb-3">
																			<input class="form-control form-control-lg form-control-solid" type="password" placeholder="**********" id="contrasenia" name="contrasenia" autocomplete="off">
																			<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
																				<i class="bi bi-eye-slash fs-2"></i>
																				<i class="bi bi-eye fs-2 d-none"></i>
																			</span>
																		</div>
																		<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
																			<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																			<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																			<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
																			<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
																		</div>
																	</div>
																	<div class="text-muted">Usa al menos 8 caracteres con una combinación de letras, números y símbolos.</div>
																	<div class="fv-plugins-message-container invalid-feedback"></div>
																</div>
																<div class="fv-row mb-7">
																	<input type="hidden" name="idUsuario" id="idUsuario" class="form-control form-control-solid mb-3 mb-lg-0" <?php echo 'value="' . $value['id'] . '"'; ?> readonly>
																</div>
															</div>
															<div class="text-center pt-15">
																<input type="submit" name="submit" class="btn btn-sm btn-success" value="Guardar">
																<input type="reset" data-bs-dismiss="modal" class="btn btn-sm btn-danger" value="Cancelar">
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>


									<?php
									// Si el usuario es visitante, no mostrar la tabla
									if ($_SESSION['username'] != 'visitante') {
										echo '
												<div class="card mb-5 mt-15 mb-lg-10">
													<div class="card-header">
														<div class="card-title">
															<h3>Tus últimos movimientos</h3>
														</div>
													</div>
													
												<div class="card-body p-0">
													<div class="table-responsive">
													<table class="table table-flush align-middle table-row-bordered table-row-solid gy-4" id="kt_permissions_table">
													<thead class="border-gray-200 fs-5 fw-bold bg-lighten">
														<tr>
															<th class="w-350px ps-9">Usuario</th>
															<th class="px-0 min-w-150px">Acción</th>
															<th class="min-w-150px">Dirección IP</th>
															<th class="min-w-100px">Fecha realizado</th>
														</tr>
													</thead>
												';

										if (($logsData == true)) {
											foreach ($userLogs as $query => $value) {
												echo '
												<tr>
												<td class="ps-9">
													<span class="me-sm-2 text-white badge badge-light-primary">
													<strong>
														<i class="text-white fa-solid fa-user"> </i>  
													</strong> 
													</span> ' . $value['username'] . '
												</td>
												<td class="ps-0">
													<a class="text-white">' . $value['type'] . ' ' . $value['info'] . ' </a>
												</td>
												<td>
													<span class="me-sm-2 text-hover-primary badge badge-light-primary">
														<strong>
															<i class="text-white fa-solid fa-wifi"> </i>  
														</strong> 
													</span> ' . $value['ip'] . '
												</td>
												<td>
												<span class="me-sm-2 text-hover-primary badge badge-light-primary">
													<strong>
														<i class="text-white fa-regular fa-calendar"> </i>  
													</strong> 
												</span> ' . $value['date'] . '
												</td>
											</tr>';
											}
										} else {
											echo '
												<td>
												<div class="d-flex align-items-center">
													<code> No hay registros </code>
												</div>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<code> No hay registros </code>
													</div>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<code> No hay registros </code>
													</div>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<code> No hay registros </code>
													</div>
												</td>
												';
										}
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
		<script type="text/javascript">
			$('#nombreUser').on('input', function() {
				if ($(this).val().length > 30) {
					$(this).val($(this).val().slice(0, 30));
					alert("Tu numbre no puede superar el limite de 30 caracteres");
				}
			});
			$('#apeUser').on('input', function() {
				if ($(this).val().length > 30) {
					$(this).val($(this).val().slice(0, 30));
					alert("Tu apellido no puede superar el limite de 30 caracteres");
				}
			});
			$('#celular').on('input', function() {
				if ($(this).val().length > 9) {
					$(this).val($(this).val().slice(0, 9));
					alert("Tu celular no puede superar el limite de 9 caracteres");
				}
			});
			$('#contrasenia').on('input', function() {
				if ($(this).val().length > 50) {
					$(this).val($(this).val().slice(0, 50));
					alert("Tu celular no puede superar el limite de 50 caracteres");
				}
			});
			$("#correoEle").keyup(function() {
				var correoEle = $("#correoEle").val();
				if (correoEle.length > 50) {
					$("#correoEle").val(correoEle.substring(0, 50));
				}
			});
		</script>
		<?php
		include_once 'includes/scripts.php';
		?>
</body>

</html>
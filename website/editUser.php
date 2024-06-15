<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';

if (isset($_GET['idUsuario'])) {
	$id = $_GET['idUsuario'];
	$userData = User::GetUserById($id);
	if ($userData == null) {
		header("location: manage-users?invalidusername");
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

<body id="kt_body" class="loader header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
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
							<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
								<h1 class="d-flex text-white align-items-center fw-bolder fs-3 my-1">Inicio</h1>
								<span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
								<small class="text-white fs-md-6 fw-bold my-1 ms-1">Menu Principal</small>
							</div>
						</div>
					</div>


					<?php echo '
					<div id="kt_content_container" class="container-fluid">
						<div class="card mb-5 mb-xl-10">
							<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
								<div class="card-title m-0">
									<h3 class="fw-bolder m-0">
									<span class="text-gray-600"> Editando al Usuario: </span> ' . $userData[0]['nombre'] . ' (<span class="text-warning">ID: #' . $userData[0]['id'] . '</span>)
									</h3>
								</div>
							</div>
							<div id="kt_account_profile_details" class="collapse show">
							<form action="updateUserAccount.php" method="post" id="kt_account_profile_details_form" class="form">
									<div class="card-body border-top p-9">
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label required fw-bold fs-6">Nombre y Apellido</label>
											<div class="col-lg-8">
												<div class="row">
													<div class="col-lg-6 fv-row">
													<input id="uId" name="uId" type="hidden" value="' . $userData[0]['id'] . '">
													<input id="uUsername" name="uUsername" type="hidden" value="' . $userData[0]['username'] . '">
													<input id="uName" name="uName"  type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nombre" value="' . $userData[0]['nombre'] . '">
													</div>
													<div class="col-lg-6 fv-row">
													<input id="uApe" name="uApe"  type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Apellido" value="' . $userData[0]['apellido'] . '">
													</div>
												</div>
											</div>
										</div>
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label required fw-bold fs-6">Password</label>
											<div class="col-lg-8 fv-row">
											<input id="uPass" name="uPass"  type="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Password" value="' . $userData[0]['password'] . '">
											</div>
										</div>
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label fw-bold fs-6">
												<span class="required">Celular</span>
												<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Especifique el numero de telefono"></i>
											</label>
											<div class="col-lg-8 fv-row">
											<input id="uCel" name="uCel"  type="number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Celular" pattern="[0-9]+" value="' . $userData[0]['celular'] . '">
											</div>
										</div>
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label fw-bold fs-6">
												<span class="required">Creditos</span>
												<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Especifique la cantidad de creditos"></i>
											</label>
											<div class="col-lg-8 fv-row">
											<input id="uCredits" name="uCredits"  type="number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Creditos" value="' . $userData[0]['creditos'] . '">
											</div>
										</div>
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label fw-bold fs-6">Correo electronico</label>
											<div class="col-lg-8 fv-row">
											<input id="uEmail" name="uEmail"  type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="' . $userData[0]['correo'] . '">
											</div>
										</div>
									</div>
									<div class="card-footer d-flex justify-content-end py-6 px-9">
											<a href="manage-users" class="btn btn-light btn-active-light-primary me-2">Regresar</a>
										<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Guardar cambios</button>
									</div>
								</form>
							</div>
						</div>
					</div>';
					?>

					<script type="text/javascript">
						$("#uName").keyup(function() {
							var uName = $("#uName").val();
							if (uName.length > 30) {
								$("#uName").val(uName.substring(0, 30));
							}
						});
						$("#uApe").keyup(function() {
							var uApe = $("#uApe").val();
							if (uApe.length > 30) {
								$("#uApe").val(uApe.substring(0, 30));
							}
						});
						$("#uCel").keyup(function() {
							var uCel = $("#uCel").val();
							if (uCel.length > 9) {
								$("#uCel").val(uCel.substring(0, 9));
							}
						});
						$("#uPass").keyup(function() {
							var uPass = $("#uPass").val();
							if (uPass.length > 50) {
								$("#uPass").val(uPass.substring(0, 50));
							}
						});
						$("#uEmail").keyup(function() {
							var uEmail = $("#uEmail").val();
							if (uEmail.length > 50) {
								$("#uEmail").val(uEmail.substring(0, 50));
							}
						});
					</script>

					<?php
					include_once 'includes/scripts.php';
					?>
</body>

</html>
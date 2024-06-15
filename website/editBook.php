<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';

if (isset($_GET['idLibro'])) {
	$id = $_GET['idLibro'];
	$libroData = Book::GetInfoFromBookId($id);
	if ($libroData == null) {
		header("location: manage-books?invalidBook");
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
									<span class="text-gray-600"> Editando el Libro: </span> ' . $libroData['nombre'] . ' (<span class="text-warning">ID: #' . $libroData['id_multimedia'] . '</span>)
									</h3>
								</div>
							</div>
							<div id="kt_account_profile_details" class="collapse show">
							<form action="updateBookDetails.php" method="post" id="kt_account_profile_details_form" class="form">
									<div class="card-body border-top p-9">
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label required fw-bold fs-6">Nombre</label>
											<div class="col-lg-8">
												<div class="row">
													<div class="col-lg-6 fv-row">
													<input id="idLibro" name="idLibro" type="hidden" value="' . $libroData['id_multimedia'] . '">
													<input id="lname" name="lname"  type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nombre" value="' . $libroData['nombre'] . '">
													</div>
												</div>
											</div>
										</div>
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label required fw-bold fs-6">Descripcion</label>
											<div class="col-lg-8 fv-row">
											<input id="ldesc" name="ldesc"  type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Descripcion" value="' . $libroData['descripcion'] . '">
											</div>
										</div>
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label fw-bold fs-6">
												<span class="required">Genero</span>
												<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Especifique el genero del libro"></i>
											</label>
											<div class="col-lg-8 fv-row">
												<select id="lgen" name="lgen" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Seleccionar..." data-allow-clear="true" required>
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
										<div class="row mb-6">
											<label class="col-lg-4 col-form-label fw-bold fs-6">
												<span class="required">Costo del libro</span>
												<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Especifique lo que cuesta el libro"></i>
											</label>
											<div class="col-lg-8 fv-row">
											<input id="lcosto" name="lcosto"  type="number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Costo" value="' . $libroData['costo'] . '">
											</div>
										</div>
									</div>
									<div class="card-footer d-flex justify-content-end py-6 px-9">
											<a href="manage-books" class="btn btn-light btn-active-light-primary me-2">Regresar</a>
										<button type="submit" name="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Guardar cambios</button>
									</div>
								</form>
							</div>
						</div>
					</div>';
					?>
					<script type="text/javascript">
						$("#lname").keyup(function() {
							var lname = $("#lname").val();
							if (lname.length > 30) {
								$("#lname").val(lname.substring(0, 30));
							}
						});
						$("#ldesc").keyup(function() {
							var ldesc = $("#ldesc").val();
							if (ldesc.length > 255) {
								$("#ldesc").val(ldesc.substring(0, 255));
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
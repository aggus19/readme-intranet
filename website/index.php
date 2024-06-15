<?php
include_once 'includes/general.php';
$idUsuario = $_SESSION['id'];
$correo = $_SESSION['correo'];
$userData = User::GetUserById($idUsuario)[0];
$rank = User::GetRankFromUser($idUsuario);
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
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<div class="mb-5 notice d-flex rounded border-secondary border mt-6 p-6">
								<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.8" x="2" y="2" width="20" height="20" rx="10" fill="#071e26" />
										<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="#ff0000" />
										<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="#ff0000" />
									</svg>
								</span>
								<div class="d-flex flex-stack flex-grow-1">
									<div class="fw-bold">
										<h4 class="text-white fw-bolder">bienvenido <?php echo ' ' . $rank . ' ' ?> <span class="text-hover-primary"><?php echo  '' . $userData['nombre'] . ' ' ?></span>
											al panel de administración desarrollado por <span class="text-hover-danger">agras systems</span>!</h4>
										<div class="fs-6 text-gray-400">recuerda que el panel se encuentra en fase <code><i class="text-warning fa-solid fa-meteor"></i> <span class="fw-bolder fs-6">BETA</code></span>, ante cualquier error enviarlo a
											<i class="ms-1 text-white fa-regular fa-paper-plane"></i> <a class="text-warning fw-bolder" href="https://mail.google.com/mail/?view=cm&fs=1&to=admin@agrasystems.us&su=Escriba el asunto del Mail&body=Desarrolle el cuerpo del correo" target="_blank"><code>admin@agrasystems.us</code></a>
										</div>
									</div>
								</div>
							</div>
							<?php
							if ($userData['perms_level'] <= 1 || $userData['perms_level'] == 3) { // Si es Visitante (0) o Usuario (1)
								$books = Book::GetLatest5Books();
								$dataBook1 = $books[0];
								$dataBook2 = $books[1];
								$dataBook3 = $books[2];
								$dataBook4 = $books[3];
								$dataBook4 = $books[4];
								echo '
								<div class="row g-6 mb-6 g-xl-9 mb-xl-9">
									<div class="text-center mb-5 mt-20">
										<h3 class="fs-2hx text-dark mb-5">Nuestras recomendaciones</h3>
										<div class="fs-5 text-muted fw-bold">Debajo podrás encontrar los libros más vistos hasta el momento
											<br />
										</div>
									</div>
									<div class="col-md-6 col-xxl-4">
										<div class="card">
											<div class="card-body d-flex flex-center flex-column p-9">
												<div class="symbol symbol-65px symbol-circle mb-5">
													<img src="' . $dataBook1['photo'] . '" alt="image" data-stories_space_upload_el_handled="1">
													<div
														class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-white h-15px w-15px ms-n3 mt-n3">
													</div>
												</div>
												<a class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">' . $dataBook1['nombre'] . '</a>
												<div class="fw-bold text-gray-400 mb-6">' . $dataBook1['genero'] . '</div>
												<div class="d-flex flex-center flex-wrap mb-5">
													<div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3">
														<div class="fs-6 fw-bolder text-gray-700">$' . $dataBook1['costo'] . '</div>
														<div class="fw-bold text-gray-400">Costo del Libro</div>
													</div>
													<div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3">
														<div class="fs-6 fw-bolder text-gray-700">' . $dataBook1['rating'] . '</div>
														<div class="fw-bold text-gray-400">Rating</div>
													</div>
												</div>
												<div class="card-footer d-flex justify-content-end py-6 px-9">
													<a href="libro?idLibro=' . $dataBook1['id_multimedia'] . '" target="_blank" class="btn btn-sm btn-secondary">
														<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver libro
													</a>
													<a href="autor?idAutor=' . $dataBook1['pubBy'] . '" target="_blank"  class="ms-5 btn btn-sm btn-secondary">
														<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver autor
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-xxl-4">
										<div class="card">
											<div class="card-body d-flex flex-center flex-column p-9">
												<div class="symbol symbol-65px symbol-circle mb-5">
													<img src="' . $dataBook2['photo'] . '" alt="image" data-stories_space_upload_el_handled="1">
													<div
														class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-white h-15px w-15px ms-n3 mt-n3">
													</div>
												</div>
												<a class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">' . $dataBook2['nombre'] . '</a>
												<div class="fw-bold text-gray-400 mb-6">' . $dataBook2['genero'] . '</div>
												<div class="d-flex flex-center flex-wrap mb-5">
													<div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3">
														<div class="fs-6 fw-bolder text-gray-700">$' . $dataBook2['costo'] . '</div>
														<div class="fw-bold text-gray-400">Costo del Libro</div>
													</div>
													<div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3">
														<div class="fs-6 fw-bolder text-gray-700">' . $dataBook2['rating'] . '</div>
														<div class="fw-bold text-gray-400">Rating</div>
													</div>
												</div>
												<div class="card-footer d-flex justify-content-end py-6 px-9">
													<a href="libro?idLibro=' . $dataBook2['id_multimedia'] . '" target="_blank"  class="btn btn-sm btn-secondary">
														<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver libro
													</a>
													<a href="autor?idAutor=' . $dataBook2['pubBy'] . '" target="_blank"  class="ms-5 btn btn-sm btn-secondary">
														<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver autor
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-xxl-4">
										<div class="card">
											<div class="card-body d-flex flex-center flex-column p-9">
												<div class="symbol symbol-65px symbol-circle mb-5">
													<img src="' . $dataBook3['photo'] . '" alt="image" data-stories_space_upload_el_handled="1">
													<div
														class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-white h-15px w-15px ms-n3 mt-n3">
													</div>
												</div>
												<a class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">' . $dataBook3['nombre'] . '</a>
												<div class="fw-bold text-gray-400 mb-6">' . $dataBook3['genero'] . '</div>
												<div class="d-flex flex-center flex-wrap mb-5">
													<div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3">
														<div class="fs-6 fw-bolder text-gray-700">$' . $dataBook3['costo'] . '</div>
														<div class="fw-bold text-gray-400">Costo del Libro</div>
													</div>
													<div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3">
														<div class="fs-6 fw-bolder text-gray-700">' . $dataBook3['rating'] . '</div>
														<div class="fw-bold text-gray-400">Rating</div>
													</div>
												</div>
												<div class="card-footer d-flex justify-content-end py-6 px-9">
													<a href="libro?idLibro=' . $dataBook3['id_multimedia'] . '" target="_blank"  class="btn btn-sm btn-secondary">
														<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver libro
													</a>
													<a href="autor?idAutor=' . $dataBook3['pubBy'] . '" target="_blank"  class="ms-5 btn btn-sm btn-secondary">
														<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver autor
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="text-center mb-10 mt-20">
										<h3 class="fs-2hx text-dark mb-5">Reseñas más vistas</h3>
									</div>

							<div class="row g-6 g-xl-9 mb-6 mb-xl-9">
								<div class="col-md-6 col-lg-4 col-xl-3">
									<div class="card h-100">
										<div
											class="card-body d-flex justify-content-center text-center flex-column p-8">
											<a href="#" class="text-gray-800 text-hover-primary d-flex flex-column">
												<div class="symbol symbol-60px mb-5">
													<img src="assets/media/albums/Album1.jpg" alt="" />
												</div>
												<div class="fs-5 fw-bolder mb-2"> IV by Led Zeppelin </div>
											</a>
										</div>
										<!--end::Card body-->
										<div class="card-footer d-flex justify-content-center py-6 px-9">
													<a href="resenia?idResenia=70&multimediaId=2071&type=ver" target="_blank"  class="btn btn-sm btn-secondary">
														<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver reseña
													</a>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-lg-4 col-xl-3">
									<div class="card h-100">
										<div
											class="card-body d-flex justify-content-center text-center flex-column p-8">
											<a href="#" class="text-gray-800 text-hover-primary d-flex flex-column">
												<div class="symbol symbol-60px mb-5">
													<img src="assets/media/albums/Album2.jpg" alt="" />
												</div>
												<div class="fs-5 fw-bolder mb-2">Abbey Road by The Beatles</div>
											</a>
										</div>
										<div class="card-footer d-flex justify-content-center py-6 px-9">
											<a href="resenia?idResenia=71&multimediaId=2072&type=ver" target="_blank"  class="btn btn-sm btn-secondary">
												<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver reseña
											</a>	
										</div>
									</div>
								</div>

								<div class="col-md-6 col-lg-4 col-xl-3">
									<div class="card h-100">
										<div
											class="card-body d-flex justify-content-center text-center flex-column p-8">
											<a href="#" class="text-gray-800 text-hover-primary d-flex flex-column">
												<div class="symbol symbol-60px mb-5">
													<img src="assets/media/albums/Album3.jpg" alt="" />
												</div>
												<div class="fs-5 fw-bolder mb-2">Dark Side Of The Moon by Pink Floyd</div>
											</a>
										</div>
										<div class="card-footer d-flex justify-content-center py-6 px-9">
											<a href="resenia?idResenia=72&multimediaId=2073&type=ver" target="_blank"  class="btn btn-sm btn-secondary">
												<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver reseña
											</a>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-lg-6 col-xl-3">
									<div class="card h-100">
										<div
											class="card-body d-flex justify-content-center text-center flex-column p-8">
											<a href="#" class="text-gray-800 text-hover-primary d-flex flex-column">
												<div class="symbol symbol-60px mb-5">
													<img src="assets/media/albums/Album4.jpg" alt="" />
												</div>
												<div class="fs-5 fw-bolder mb-2">OK Computer by Radiohead</div>
											</a>
										</div>
										<div class="card-footer d-flex justify-content-center py-6 px-9">
											<a href="resenia?idResenia=73&multimediaId=2074&type=ver" target="_blank"  class="btn btn-sm btn-secondary">
												<i class="fs-5 fa-solid fa-arrow-pointer"></i> Ver reseña
											</a>
										</div>
									</div>
								</div>
							</div>
								';
							}
							?>
							<?php
							if ($userData['perms_level'] >= 4 || $userData['perms_level'] == 2) { // Si es Administrador (2) o Developer (4)
								echo '
									<div class="mt-5 row g-6 g-xl-9">
										<div class="col-md-6 col-xl-4">
											<a class="card border border-2 border-gray-300 border-hover">
												<div class="card-header border-0 pt-9">
													<div class="card-title m-0">
														<div class="symbol symbol-50px w-50px bg-light">
															<i class="text-white fs-xl-1 p-3 fa-solid fa-server"></i>
														</div>
													</div>
													<div class="card-toolbar">
														<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">Servidor #1</span>
													</div>
												</div>
												<div class="card-body p-9">
													<div class="fs-3 fw-bolder text-dark">Servidor #1</div>
													<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Información del servidor</p>
													<div class="d-flex flex-wrap mb-5">
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
															<div id="infoCpu" name="infoCpu" class="fs-6 text-gray-800 fw-bolder"></div>
															<div class="fw-bold text-gray-400">CPU</div>
														</div>
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
															<div id="infoDisk" name="infoDisk" class="fs-6 text-gray-800 fw-bolder"></div>
															<div class="fw-bold text-gray-400">Disco Duro</div>
														</div>
													</div>
													<div class="h-4px w-100 bg-light mb-5">
														<div class="bg-primary rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</a>
										</div>
										<div class="col-md-6 col-xl-4">
											<a class="card border border-2 border-gray-300 border-hover">
												<div class="card-header border-0 pt-9">
													<div class="card-title m-0">
														<div class="symbol symbol-50px w-50px bg-light">
															<i class="text-white fs-xl-1 p-3 fa-solid fa-people-group"></i>
														</div>
													</div>
													<div class="card-toolbar">
														<span class="badge badge-light-danger fw-bolder me-auto px-4 py-3">Usuarios</span>
													</div>
												</div>
												<div class="card-body p-9">
													<div class="fs-3 fw-bolder text-dark">Usuarios de la Plataforma</div>
													<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Información sobre los usuarios registrados</p>
													<div class="d-flex flex-wrap mb-5">
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
															<div id="contadorUsers" name="contadorUsers" class="fs-6 text-gray-800 fw-bolder"></div>
															<div class="fw-bold text-gray-400">Usuarios</div>
														</div>
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
															<div id="contadorAdmins" name="contadorAdmins" class="fs-6 text-gray-800 fw-bolder"></div>
															<div class="fw-bold text-gray-400">Admins</div>
														</div>
													</div>
													<div class="h-4px w-100 bg-light mb-5">
														<div class="bg-danger rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</a>
										</div>
										
										';
							}
							?>
							<?php
							if ( $userData['perms_level'] >= 4 || $userData['perms_level'] == 2) { // Si es Administrador (2), o Developer (4)
								echo '
								<div class="col-md-6 col-xl-4">
									<a class="card border border-2 border-gray-300 border-hover">
										<div class="card-header border-0 pt-9">
											<div class="card-title m-0">
												<div class="symbol symbol-50px w-50px bg-light">
													<i class="text-white fs-xl-1 p-3 fa-solid fa-book"></i>
												</div>
											</div>
											<div class="card-toolbar">
												<span class="badge badge-light-success fw-bolder me-auto px-4 py-3">Libros</span>
											</div>
										</div>
										<div class="card-body p-9">
											<div class="fs-3 fw-bolder text-dark">Libros de la Plataforma</div>
											<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">Información sobre los libros registrados</p>
											<div class="d-flex flex-wrap mb-5">
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
													<div id="contadorLibros" name="contadorLibros" class="fs-6 text-gray-800 fw-bolder"></div>
													<div class="fw-bold text-gray-400">Libros</div>
												</div>
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
													<div id="ultimoLibro" name="ultimoLibro" class="fs-6 text-gray-800 fw-bolder"></div>
													<div class="fw-bold text-gray-400">Ultimo libro</div>
												</div>
											</div>
											<div class="h-4px w-100 bg-light mb-5">
												<div class="bg-success rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</a>
								</div>
								';
							}
							?>
						</div>
					</div>
				</div>

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
				<script src="assets/plugins/global/plugins.bundle.js"></script>
				<script src="assets/js/scripts.bundle.js"></script>
				<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
				<script src="assets/js/custom/apps/user-management/permissions/list.js"></script>
				<script src="assets/js/custom/apps/user-management/permissions/add-permission.js"></script>
				<script src="assets/js/custom/apps/user-management/permissions/update-permission.js"></script>
				<script src="assets/js/custom/widgets.js"></script>
				<script src="assets/js/custom/apps/chat/chat.js"></script>
				<script src="assets/js/custom/utilities/modals/create-app.js"></script>
				<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
				<script src="assets/js/custom/apps/calendar/calendar.js"></script>
				<script src="assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
				<script type="text/javascript">
					$(document).ready(function() {
						setInterval(function() {
							$("#contadorUsers").load("ajax/info/users.php");
						}, 2000);
					});
					$(document).ready(function() {
						setInterval(function() {
							$("#contadorAdmins").load("ajax/info/admins.php");
						}, 2000);
					});
					$(document).ready(function() {
						setInterval(function() {
							$("#contadorLibros").load("ajax/info/bookCount.php");
						}, 2000);
					});
					$(document).ready(function() {
						setInterval(function() {
							$("#ultimoLibro").load("ajax/info/lastBook.php");
						}, 2000);
					});
					$(document).ready(function() {
						setInterval(function() {
							$("#infoDisk").load("ajax/dedicated/disk.php");
						}, 2000);
					});
					$(document).ready(function() {
						setInterval(function() {
							$("#infoCpu").load("ajax/dedicated/cpu.php");
						}, 2000);
					});
				</script>
</body>

</html>
<?php
include_once 'includes/general.php';

if (isset($_GET['idAutor'])) {
	$id = $_GET['idAutor'];
	$autor = Autores::GetAuthorById($id);
	$librosAutor = Book::GetBooksFromAutor($id);
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
	<div class=" d-flex flex-column flex-root">
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
								<h1 class="d-flex text-white align-items-center fw-bolder fs-3 my-1">Autor</h1>

								<span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
								<small class="text-white fs-md-6 fw-bold my-1 ms-1">Menu Principal</small>
							</div>
						</div>
					</div>

					<?php
					echo '
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-fluid">
								<div class="content flex-row-fluid" id="kt_content">
									<div class="card mb-5 mb-xl-10">
										<div class="card-body bg-login pt-9 pb-0">
											<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
												<div class="me-7 mb-4">
													<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
														<img src="' . $autor[0]['profilePic'] . '"/>
														<div class="position-absolute translate-middle bottom-0 start-100 mb-6"></div>
													</div>
												</div>
												<div class="flex-grow-1">
													<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
														<div class="d-flex flex-column">
															<div class="d-flex align-items-center mb-2">
																<a href="#" class="text-white text-hover-primary fs-2 fw-bolder me-1">
																	<span class="text-white fw-bold">' . $autor[0]['nombre'] . ' ' . $autor[0]['apellido'] . '</span>
																	<a href="#">
																		<span class="svg-icon svg-icon-1 svg-icon-primary">
																			<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																				<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
																				<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
																		</svg>
																	</span>
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card-header card-header-stretch">
											<div class="card-title d-flex align-items-center">
												<span class="svg-icon svg-icon-1 svg-icon-primary me-3 lh-0">
												<i class="bi bi-chat-right-text text-primary fs-2"></i>
												</span>
												<h3 class="fw-bolder m-0 text-white">Información del Autor </h3>
											</div>
										</div>
											<div class="card-body agus">
												<div class="tab-content">
													<div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="kt_activity_today_tab">
														<div class="timeline">
															<div class="timeline-item">
																<div class="timeline-icon symbol symbol-circle symbol-40px me-4">
																</div>
															</div>
																	<div class="timeline-content mb-10 mt-n2">
																		<div class="overflow-auto pe-3">
																			<div class="fs-5 fw-bold mb-2 text-primary">Nombre y Apellido:</div>
																			<div class="d-flex align-items-center mt-1 fs-6">
																			<div class="text-white me-10 fs-6"> <i style="color: white; font-size: 15px;" class="me-2 bi bi-pencil"></i> ' . $autor[0]['nombre'] . '  ' . $autor[0]['apellido'] . ' </div>
																			
																		</div>
																	</div>
																</div>
																
																<div class="timeline-content mb-10 mt-n2">
																	<div class="overflow-auto pe-3">
																		<div class="fs-5 fw-bold mb-2 text-primary">Nacionalidad:</div>
																			<div class="d-flex align-items-center mt-1 fs-6">
																			<div class="text-white me-10 fs-6"> <i class="text-white me-2 fa-solid fa-earth-americas"></i> ' . $autor[0]['nacionalidad'] . '</div>
																			
																		</div>
																	</div>
																</div>

																<div class="timeline-content mb-10 mt-n2">
																	<div class="overflow-auto pe-3">
																		<div class="fs-5 fw-bold mb-2 text-primary">Fecha de nacimiento:</div>
																			<div class="d-flex align-items-center mt-1 fs-6">
																			<div class="text-white me-10 fs-6"> <i class="text-white me-2 fa-solid fa-cake-candles"></i> ' . $autor[0]['fechaNacimiento'] . '</div>
																			</div>
																		</div>
																	</div>

																	<div class="timeline-content mb-10 mt-n2">
																	<div class="overflow-auto pe-3">
																		<div class="fs-5 fw-bold mb-2 text-primary">Libros del autor:</div>
																			<div class="d-flex align-items-center mt-1 fs-6">
																			<div class="text-white me-10 fs-6">'; ?>
																		<?php
																		if (count($librosAutor) > 0) {
																			foreach ($librosAutor as $x) {
																				echo '<a class="text-primary text-hover-warning" href="libro?idLibro=' . $x['id_multimedia'] . '"> <i style="color: white; font-size: 16px;" class="me-2 bi bi-people"> </i>' . $x['nombre'] . '</a> </br>';
																			}
																		} else {
																			echo '<i style="color: white; font-size: 16px;" class="me-2 bi bi-exclamation-circle"></i> No se encontraron libros asociados a este autor </br>';
																		}
																		?>
																		<?php
																		echo '
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
											<div class="separator separator-content border-light-info my-15">
											<a href="listado" class="btn btn-light-danger btn-icon-sm btn-hover-primary btn-shadow"> Regresar</a>
										</div>
								</div>
							</div>
						</div>

					'
					?>

					<?php
					include_once 'includes/scripts.php';
					?>
</body>

</html>
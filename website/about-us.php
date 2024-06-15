<?php
include_once 'includes/general.php';
$idUsuario = $_SESSION['id'];
$usuario = new User($idUsuario);
$developersData = Panel::GetDevelopersInfo();
Discord::SendWebhook("New click on page (about-us)",  "**Username:** " . "`" . $usuario->GetUserById($idUsuario)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `🔎` **Clicked on about-us.php.**" . "\n\n `🌎` **URL:** $url");
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
								<li class="breadcrumb-item pe-3"><a class="pe-3">Sobre Nosotros</a></li>
								<li class="breadcrumb-item px-3"><a href="about-us" class=" text-muted pe-3">Información</a></li>
							</ol>
						</div>
					</div>
					<div class=" post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<div class="card">
								<div class="card-body p-lg-17">
									<div class="mb-18">
										<div class="mb-10">
											<div class="text-center mb-15">
												<div class="fs-5 text-muted fw-bold">
													<code class="text-primary fs-1">AGRAS SYSTEMS</code>
												</div>
											</div>
											<div class="overlay">
												<img class="w-100 card-rounded" src="https://i.imgur.com/ULMG4SB.jpg" alt="" />
											</div>
										</div>
										<div class="mb-5 pb-lg-3">
											<div class="fs-5 fw-bold text-gray-600">
												<h2 class="fw-bolder text-dark mb-8">Valores con los que nos representamos:</h2>
												<div class="d-flex flex-column flex-md-row rounded border p-10">
													<ul class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6">
														<li class="nav-item me-0 mb-md-2">
															<a class="nav-link active text-gray-800 btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#kt_vtab_pane_1">
																<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																	<i class="fs-2qx text-white fa-solid fa-code-commit"></i>
																</span>
																<span class="d-flex flex-column align-items-start">
																	<span class="fs-5 fw-bolder">Valor #1</span>
																</span>
															</a>
														</li>
														<li class="nav-item me-0 mb-md-2">
															<a class="nav-link btn btn-flex text-gray-800 btn-active-light-primary" data-bs-toggle="tab" href="#kt_vtab_pane_2">
																<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																	<i class="fs-2qx text-white fa-solid fa-code-commit"></i>
																</span>
																<span class="d-flex flex-column align-items-start">
																	<span class="fs-5 fw-bolder">Valor #2</span>
																</span>
															</a>
														</li>
														<li class="nav-item me-0 mb-md-2">
															<a class="nav-link btn btn-flex text-gray-800 btn-active-light-primary" data-bs-toggle="tab" href="#kt_vtab_pane_3">
																<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																	<i class="fs-2qx text-white fa-solid fa-code-commit"></i>
																</span>
																<span class="d-flex flex-column align-items-start">
																	<span class="fs-5 fw-bolder">Valor #3</span>
																</span>
															</a>
														</li>
														<li class="nav-item me-0 mb-md-2">
															<a class="nav-link btn btn-flex text-gray-800 btn-active-light-primary" data-bs-toggle="tab" href="#kt_vtab_pane_4">
																<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																	<i class="fs-2qx text-white fa-solid fa-code-commit"></i>
																</span>
																<span class="d-flex flex-column align-items-start">
																	<span class="fw-bolder">Valor #4</span>
																</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link btn btn-flex text-gray-800 btn-active-light-primary" data-bs-toggle="tab" href="#kt_vtab_pane_5">
																<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																	<i class="fs-2qx text-white fa-solid fa-code-commit"></i>
																</span>
																<span class="d-flex flex-column align-items-start">
																	<span class="fs-5 fw-bolder">Valor #5</span>
																</span>
															</a>
														</li>
													</ul>
													<div class="tab-content" id="myTabContent">
														<div class="tab-pane fade show active" id="kt_vtab_pane_1" role="tabpanel">
															<div class="alert alert-info bg-light-secondary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
																<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																	<i class="fs-2x text-grey-200 fa-solid fa-feather"></i>
																</span>
																<div class="d-flex text-gray flex-column pe-0 pe-sm-10">
																	<span class="fs-5 fw-bolder text-uppercase">Respeto</span>
																	Es la base de todo relacionamiento entre seres humanos, en este caso, en el equipo del proyecto. <br /> Nos respetamos porque creemos en el valor de cada uno de los miembros y <br /> por ello estamos enfocados en que cada uno entregue todo su potencial.
																	<br /> Entendemos las situaciones y los problemas personales de nuestros compañeros e intentamos empatizar <br /> con ellos para así poder entregar un mejor servicio creado en un ambiente productivo y relajado.
																</div>
															</div>
														</div>
														<div class="tab-pane fade" id="kt_vtab_pane_2" role="tabpanel">
															<div class="tab-pane fade show active" id="kt_vtab_pane_2" role="tabpanel">
																<div class="alert alert-info bg-light-secondary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
																	<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																		<i class="fs-2x text-grey-200 fa-solid fa-feather"></i>
																	</span>
																	<div class="d-flex text-gray flex-column pe-0 pe-sm-10">
																		<span class="fs-5 fw-bolder text-uppercase">Confianza</span>
																		Confiamos el uno en el otro para entregar un proyecto de calidad,
																		<br /> porque de esta manera la velocidad del trabajo será mayor. Intentar controlar la labor de cada compañero nos ralentizará.
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane fade" id="kt_vtab_pane_3" role="tabpanel">
															<div class="tab-pane fade show active" id="kt_vtab_pane_3" role="tabpanel">
																<div class="alert alert-info bg-light-secondary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
																	<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																		<i class="fs-2x text-grey-200 fa-solid fa-feather"></i>
																	</span>
																	<div class="d-flex text-gray flex-column pe-0 pe-sm-10">
																		<span class="fs-5 fw-bolder text-uppercase">Responsabilidad y Compromiso</span>
																		Tenemos una responsabilidad con cada cliente que paga por nuestro servicio. La biblioteca virtual le cobra a los liceos una cuota mensual.
																		<br /> Estos liceos son organismos educativos que a su vez buscan educar a miles de personas, por lo cual <br /> debemos comprometernos a mejorar el producto mes tras mes, en forma de actualizaciones periódicas.
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane fade" id="kt_vtab_pane_4" role="tabpanel">
															<div class="tab-pane fade show active" id="kt_vtab_pane_4" role="tabpanel">
																<div class="alert alert-info bg-light-secondary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
																	<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																		<i class="fs-2x text-grey-200 fa-solid fa-feather"></i>
																	</span>
																	<div class="d-flex text-gray flex-column pe-0 pe-sm-10">
																		<span class="fs-5 fw-bolder text-uppercase">Honestidad</span>
																		La misma es otro pilar en lo que respecta a la comunicación grupal, debido a que sin ella. <br /> Entre los valores éticos, la honestidad es la que más relacionado está con el resto. <br /> La honestidad es vivir de acuerdo a como pensamos y sentimos, ser coherentes con nuestro pensamiento y modo de vida,
																		<br /> y relacionarnos de este modo con el mundo que nos rodea, las cosas que nos suceden y el resto de los seres humanos. <br /> Algunos buenos ejemplos son aceptar una equivocación propia
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane fade" id="kt_vtab_pane_5" role="tabpanel">
															<div class="tab-pane fade show active" id="kt_vtab_pane_5" role="tabpanel">
																<div class="alert alert-info bg-light-secondary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
																	<span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
																		<i class="fs-2x text-grey-200 fa-solid fa-feather"></i>
																	</span>
																	<div class="d-flex text-gray flex-column pe-0 pe-sm-10">
																		<span class="fs-5 fw-bolder text-uppercase">Calidad</span>
																		“Cómo haces una cosa es cómo haces todas las cosas”, <br /> dijo el escritor canadiense T. Harv Eker, autor del libro Los Secretos de la Mente Millonaria.
																		<br /> Inspirados por tal frase, creemos que la mejora debería ser constante, y no solo demostrarse en facetas del proyecto <br /> con las cuales los usuarios interactúan directamente, sino también en aquello que es invisible a los usuarios.
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="mb-5 pb-lg-20">
											<h2 class="fw-bolder text-dark mb-8">Nuestra misión:</h2>
											<ul class="fs-4 fw-bold mb-6">
												<li>
													<span class="fw-bolder"><code class="text-primary">Misión de la empresa:</code></span> <br />
													<span class="text-gray-700">Desarrollar herramientas amigables al usuario escuchando a la comunidad <br /> y asegurando un servicio confiable y de alta calidad para nuestros clientes.</span>
												</li>
											</ul>
											<h2 class="fw-bolder text-dark mt-10 mb-7">Nuestra visión:</h2>
											<ul class="fs-4 fw-bold">
												<li>
													<span class="fw-bolder"><code class="text-primary">Visión de la empresa:</code></span> <br />
													<span class="fs-4 fw-bold text-gray-700">Consagrarnos como una de las mejores compañías de desarrollo de software a nivel <br /> global ofreciendo un servicio inigualable y con una excelente calidad de atención.</span>
												</li>
											</ul>
										</div>
										<div class="mb-18">
											<div class="text-center mb-12">
												<h3 class="fs-2hx text-dark mb-5">Nuestro equipo de Desarrollo</h3>
												<div class="fs-5 text-muted fw-bold">Conoce a nuestro equipo de desarrollo de la plataforma
													<br /> gracias a ellos puedes disfrutar de esta gran experiencia.
												</div>
											</div>
											<div class="card-body py-3">
												<div class="table-responsive">
													<table class="table table-hover table-rounded table-striped border gy-7 gs-7">
														<thead>
															<tr class="fw-bolder text-muted">
																<th class="min-w-150px">Nombre</th>
																<th class="min-w-140px">Rol</th>
																<th class="	min-w-120px">Informacion básica</th>
															</tr>
														</thead>
														<?php
														foreach ($developersData as $key => $value) {
															echo '
																<tbody>
																	<tr>
																		<td>
																			<div class="d-flex align-items-center">
																				<div class="symbol symbol-45px me-5">
																					<img src="' . $value['foto'] . '" alt="" />
																				</div>
																				<div class="d-flex justify-content-start flex-column">
																					<a class="text-dark fw-bolder text-hover-primary fs-6">' . $value['nombre'] . '</a>
																				</div>
																			</div>
																		</td>
																		<td>
																			<span class="' . $value['colorBadge'] . '">' . $value['rol'] . '</span>
																			<span class="text-muted fw-bold text-muted d-block fs-7">' . $value['descripcion'] . '</span>
																		</td>
																		<td>
																			<a class="text-dark fw-bolder text-hover-primary d-block fs-6">Edad:</a>
																			<span class="text-muted fw-bold text-muted d-block fs-7">' . $value['edad'] . '</span>
																		</td>
																	</tr>
																</tbody>';
														}
														?>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body p-lg-17">
										<div class="row g-5 mb-5 mb-lg-15">
											<div class="col-sm-6 pe-lg-10">
												<div class="text-center bg-light card-rounded d-flex flex-column justify-content-center p-10 h-lg-100">
													<span class="svg-icon svg-icon-3tx svg-icon-primary">
														<i class="fs-2tx fa-solid fa-phone text-gray-700"></i>
													</span>
													<h1 class="text-dark fw-bolder my-5">Contacto</h1>
													<div class="text-gray-700 fw-bold fs-2">(598) 93-798-098</div>
												</div>
											</div>
											<div class="col-sm-6 ps-lg-10">
												<a href="https://goo.gl/maps/wiRufvMkhGhdqKff6" target="_blank">
													<div class="text-center bg-light card-rounded d-flex flex-column justify-content-center p-10 h-lg-100">
														<span class="svg-icon svg-icon-3tx svg-icon-primary">
															<i class="fs-2tx fa-solid fa-solid fa-location-dot text-gray-700"></i>
														</span>
														<h1 class="text-dark fw-bolder my-5">Nuestra oficina</h1>
														<div class="text-gray-700 fs-3 fw-bold">Avenida Italia 2420, Montevideo, Uruguay.</div>
													</div>
												</a>
											</div>
										</div>
										<div class="card mb-4 bg-light text-center">
											<div class="card-body py-12">
												<a href="https://github.com/AgusUruguayo/panel-readme2" class="mx-4">
													<img src="assets/media/svg/brand-logos/github-1.svg" class="h-30px my-2" alt="" />
												</a>
												<a href="http://96510a3bc581.sn.mynetname.net:9001/about-us" class="mx-4">
													<img src="assets/media/svg/brand-logos/dribbble-icon-1.svg" class="h-30px my-2" alt="" />
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
							<span class="svg-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"></rect>
									<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"></path>
								</svg>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once 'includes/scripts.php';
	?>
</body>

</html>
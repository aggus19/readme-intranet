<?php
include_once 'includes/general.php';
$idUsuario = $_SESSION['id'];
$reseniaData = Resenias::GetReseniaInfo();

if ($_SESSION['username'] == 'visitante') {
    header('Location: index');
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
                            <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-bold">
                                <li class="breadcrumb-item pe-3"><a href="#" class="pe-3">Panel</a></li>
                                <li class="breadcrumb-item px-3 text-muted">Mi biblioteca</li>
                            </ol>
                        </div>
                    </div>
                    <div class=" post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-fluid">
                            <div class="card card-flush">
                                <div class="card-body pt-0">
                                    <table class="table align-middle table-row-bordered fs-6 gy-5 mb-0" id="kt_permissions_table">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Informacion (ID & Nombre)</th>
                                                <th class="min-w-250px">Detalles de la reseña</th>
                                                <th class="text-center min-w-100px">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-bold text-gray-600">
                                            <?php
                                            foreach ($reseniaData as $resenia) {
                                                echo '
												<tr>
												 	<td>
														<span class="badge badge-light-dark"><strong><i class="text-dark me-2 fas fa-book"> </i> <span class="fw-bold fs-7">#' . $resenia['id_multimedia'] . ' </strong>  </span>  
															<div class="d-flex flex-column">
																<ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-bold">
																	<li class="breadcrumb-item pe-3"> <span class="mt-2 badge badge-light-dark"><strong><i class="me-2 text-dark fa-solid fa-book-bookmark"> </i> ' . $resenia['nombre'] . ' </span> </strong> </li>
																</ol>
															</div>
												 	</td>
												 	<td>
												  		<div class="d-flex flex-column">
															<a class="text-primary-600 text-hover-primary mb-1">Tipo de multimedia: <span class="text-gray-800">' . $resenia['tipo_multimedia'] . ' </span></a>
																<div class="d-flex flex-column">
																	<a class="text-primary-600 text-hover-primary mb-1">Genero: <span class="text-success">' . $resenia['genero'] . ' </span></a>
																</div>
														</div>
												 	</td>
													<td class="text-center">
                                                      <a class="btn btn-sm btn-light-primary me-3" href="resenia?idResenia=' . $resenia['id_resenia'] . '&multimediaId=' . $resenia['id_multimedia'] . '&type=ver"> <i class="fa-solid fa-circle-question"></i> Ver reseña </a>
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
    <?php
    include_once 'includes/scripts.php';
    ?>
</body>

</html>
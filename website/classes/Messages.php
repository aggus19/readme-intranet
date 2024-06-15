<?php

class Messages
{
    public static function CredentialErrors()
    {
        $divError =
            '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-triangle-exclamation"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1 text-center">Error al intentar iniciar sesión</h5>
                    <span>El usuario o la contraseña son incorrectos por favor verifique e intente de nuevo.</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs-1 text-danger"></i>
                </button>
            </div>
        </div>
        ';
        return $divError;
    }

    // Toast message
    public static function ToastMessage($message)
    {
        $divToast = '
        <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="toast-header">
                <i class="fa-solid fa-bell fs-2 me-2"></i>
                <strong class="me-auto">Notificación</strong>
                <small class="text-muted">Hace 5 segundos</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ' . $message . '
            </div>
        </div>';
        return $divToast;
    }

    public static function AccountNotVerified()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-triangle-exclamation"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1 text-center">Su cuenta está pendiente a verificación.</h5>
                    <span class="text-center">Por favor verifique su cuenta para poder iniciar sesión. </br> Si no ha recibido el correo de verificación, por favor verifique su bandeja de spam.</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs-1 text-danger"></i>
                </button>
            </div>
        </div>
       ';
        return $divError;
    }
    public static function EmailAlreadyInUse()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-triangle-exclamation"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1 text-center">El correo electrónico <code>(' . $_GET['email'] . ')</code> ya está en uso.</h5>
                    <span class="text-center">Por favor verifique su correo electrónico o intente con otro.</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs-1 text-danger"></i>
                </button>
            </div>
        </div>
       ';
        return $divError;
    }
    public static function AlreadyInClub()
    {
        $divError = '
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <div class="alert alert-dismissible bg-light-warning border border-warning d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                        <i class="fs-xl-2 text-white fa-solid fa-triangle-exclamation"></i>
                    </span>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h5 class="mb-1">Ya eres miembro de este club de lectura<code>(ID: #' . $_GET['clubId'] . ')</code></h5>
                        <span class="text-center">Has intentado unirte a un club de lectura al que ya perteneces.</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="bi bi-x fs-1 text-warning"></i>
                    </button>
                </div>
            </div>
        ';
        return $divError;
    }
    public static function SuccessfullCreate()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-circle-check"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1 text-center">Tu cuenta fue creada correctamente! 😎.</h5>
                    <span class="text-center">Ahora podrás iniciar sesión y disfrutar de todos los beneficios de nuestra plataforma!</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs-1 text-success"></i>
                </button>
            </div>
        </div>
       ';
        return $divError;
    }
    public static function ErrorProcess()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-triangle-exclamation"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1 text-center">Ocurrió un error al procesar su solicitud.</h5>
                    <span class="text-center">Por favor intente nuevamente. Si el problema persiste, por favor contacte a soporte.</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs-1 text-danger"></i>
                </button>
            </div>
        </div>
       ';
        return $divError;
    }

    public static function JoinedClub()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-circle-check"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1">Te has unido al club de lectura <code>(ID: #' . $_GET['clubId'] . ')</code> correctamente! 😎.</h5>
                    <span>Ahora podrás disfrutar de todos los beneficios de nuestra plataforma!</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs-1 text-success"></i>
                </button>
            </div>
        </div>

       ';
        return $divError;
    }

    public static function PasswordUpdated()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-circle-check"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1">Tu contraseña fue actualizada correctamente! 😎.</h5>
                    <span>Ya puedes iniciar sesión con tu nueva contraseña (<code>' . $_GET['newPass'] . '</code>).</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fss-1 text-success"></i> 
                </button>
            </div>
        </div>
        ';
        return $divError;
    }

    public static function PasswordNotUpdated()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-triangle-exclamation"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1 text-center">Ocurrío un error al actualizar tu contraseña.</h5>
                    <span>Por favor intente nuevamente. Si el problema persiste, por favor contacte a soporte.</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs 1 text-danger"></i>
                </button>
            </div>
        </div>
        ';
        return $divError;
    }

    public static function LeftClub()
    {
        $divError = '
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <i class="fs-xl-2 text-white fa-solid fa-circle-check"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1">Has abandonado el club de lectura<code>(ID: #' . $_GET['clubId'] . ')</code> correctamente! 😎.</h5>
                    <span>Esperamos verte pronto de vuelta!</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="bi bi-x fs-1 text-success"></i>
                </button>
            </div>
        </div>
       ';
        return $divError;
    }
}

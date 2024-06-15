<?php
session_start();

if (!(isset($_SESSION['loggedin']))) {
	session_unset();
	session_destroy();
	header("Location: sign-in");
}

include_once 'classes/Database.php';
include_once 'classes/User.php';
include_once 'classes/AuditLogs.php';
include_once 'classes/Book.php';
include_once 'classes/Clubes.php';
include_once 'classes/Time.php';
include_once 'classes/IP.php';
include_once 'classes/Autores.php';
include_once 'classes/Discord.php';
include_once 'classes/VPS.php';
include_once 'classes/Messages.php';
include_once 'classes/Resenias.php';
include_once 'classes/Panel.php';

const PRINCIPAL_INDEX = "index";
const PAGES_GESTION_LIBROS = "manage-books";
const PAGES_GESTION_AUTORES = "manage-autores";
const PAGES_USER_BIBLIOTECA = "biblioteca";
const PAGES_ADMIN_CUENTAS = "manage-users";
const PAGES_ADMIN_USER = "user";
const PAGES_ADMIN_USER_PERFIL = "user?id=";
const PAGES_ADMIN_USERS = "users-list";
const PAGES_ADMIN_LOGIN = "sign-in";
const PAGES_LIBROS = "listado";
const PAGES_LOGOUT = "logout";
const PAGES_REGISTER_USER = "sign-up";
const PAGES_AUDIT_LOGS = "auditLogs";
const PAGES_CLUBES_LECTURA = "clubes";
const PAGES_MI_BIBLIOTECA = "biblioteca";
const PAGES_ABOUT_US = "about-us";
const PAGES_WELCOME = "welcome";
const PAGES_RESENIAS = "resenias";
const PAGES_ALL_RESENIAS = "reseniasList";

$url = "http://$_SERVER[HTTP_HOST]/";

<?php
session_start();

include "classes/Database.php";
include "classes/User.php";
include "classes/AuditLogs.php";
include "classes/Time.php";
include "classes/Discord.php";
include "classes/Messages.php";
include "classes/Panel.php";
$mailExists = User::CheckEmail($_POST['email']);

if ($mailExists == false) {
    header("Location: forgot-password?emailInfo=2");
} else {
    if (isset($_POST['submit_email']) && $_POST['email'] && $mailExists == true) {
        $email = $_POST['email'];
        $newPass = Panel::GenerateString();
        $encriptada = md5($newPass);
        $updatePass = User::UpdatePassword($encriptada, $email);
        $newLogRecovery = User::InsertNewRecovery($email, $newPass, $encriptada);
        $getUserPwd = User::GetUserRecoveryPassword($email)['newPass'];
        if ($updatePass == true) {
            header("Location: forgot-password?emailInfo=1&newPass=$getUserPwd");
        } else {
            echo "Ha ocurrido un error";
        }
    }
}

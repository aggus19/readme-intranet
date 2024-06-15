<?php
include_once 'includes/general.php';
$usuario = $_SESSION['username'];
Discord::SendWebhook("Account log out", "**__Credentials:__** \n" . "**Username:** " . "`" . $usuario . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `👋` The account has **log out successfully.**" . "\n\n `🌎` **URL:** $url");
unset($_SESSION['username']);
session_destroy();
header("location: sign-in");

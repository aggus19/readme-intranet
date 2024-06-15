<?php
include_once "classes/Database.php";
include_once "classes/Panel.php";
$tabName = Panel::GetTabName();
$logo = Panel::GetLogo();
$url = Panel::GetURL();
$owner = Panel::GetOwner();

echo '
<base href="">
<title>' . $tabName . '</title>
<meta charset="UTF-8">
<meta name="title" content="' . $tabName . '">
<meta name="description" content="Welcome to the library administration panel developed by ' . $owner . ' designed for any educational institution.">
<meta name="author" content=' . $tabName . '>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="' . $url . '">
<meta property="og:title" content="' . $tabName . '">
<meta property="og:description" content="Welcome to the library administration panel developed by ' . $owner . ' designed for any educational institution.">
<meta property="og:image" content="../assets/media/MetaBg.jpg">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="' . $url . '">
<meta property="twitter:title" content="' . $tabName . '">
<meta property="twitter:description" content="Welcome to the library administration panel developed by ' . $owner . ' designed for any educational institution.">
<meta property="twitter:image" content="../assets/media/MetaBg.jpg">

<link rel="icon" href="' . $logo . '" type="image/png">
<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/global/plugins.dark.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/css/style.dark.css" rel="stylesheet" type="text/css" />
<link href="https://css.gg/css" rel="stylesheet">
<link href="https://unpkg.com/css.gg/icons/all.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/css.gg/icons/all.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/ca462b61ba.js" crossorigin="anonymous"></script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
';

 
<!DOCTYPE html>
<html lang="th" class="light">
<head>
	<meta charset="utf-8" />
	<title><?= $appTitle ?><?php if(!empty($pageName))echo ' | '.$pageName; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="<?= $appUrl ?>/public/favicon.png" />
	<meta name="description" content="Latest updates and statistic charts" />
	<meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
	<link rel="stylesheet" href="<?= $appUrl ?>public/css/app.css" />
	<link rel="stylesheet" href="<?= $appUrl ?>public/css/custom.css" />
</head>
<body class="<?php if(!empty($bodyClass))echo $bodyClass; ?>">
	<?php include_once('sidenav-mobile.php') ?>
	<div class="flex">
		<?php include_once('sidenav.php') ?>
		<div class="content">
			<?php include_once('topnav.php') ?>
	
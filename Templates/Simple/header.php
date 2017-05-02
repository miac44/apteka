<!DOCTYPE html>
<html lang="ru">
<head>
<title><?php echo $site->title; ?></title>
<?php foreach ($site->meta as $attr=>$value) : ?>
<?php foreach ($value as $k=>$v) : ?>
	<meta <?php echo $attr;?>="<?php echo $k;?>" content="<?php echo $v;?>">
<?php endforeach; ?>
<?php endforeach; ?>
</head>
<body>
<header>
<h1><?php echo $site->name;?></h1>
</header>
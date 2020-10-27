<!DOCTYPE html>
<html lang="de-DE" class="no-js">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/style.css">

	<?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
<?php
get_template_part('template-parts/template-part', 'topnav');
?>
	<header class="site-header container">
		<div class="image">
			<img src="<?php bloginfo('template_url'); ?>/img/header.jpg" alt="PSV Herford Abteilung Badminton"/>
		</div>
	</header>
<div class="container">
	<nav aria-label="breadcrumb"><?php get_breadcrumb(); ?></nav>
</div>

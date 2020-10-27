<?php get_header(); ?>
<?php get_template_part('template-parts/homepage', 'widgets'); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<header class="index-page">
				<?php do_action('head_theme_before_title'); ?>
				<h1 class="single-title">Willkommen beim <?php bloginfo('name'); ?></h1>
				<?php do_action('head_theme_after_title'); ?>
			</header>
			<div class="alert alert-warning mt-3 mb-4" role="alert">
				<h4 class="alert-heading">Informationen zur aktuellen Lage</h4>
				<p>Das Training findet weiterhin statt. Es gelten nach wie vor die <a href="https://www.herford.de/index.php?NavID=2593.1168" class="alert-link">Verordnungen der Stadt Herford</a> in Kombination mit den <a href="https://www.badminton-nrw.de/index.php?id=1758" class="alert-link">Vorgaben des Badminton Landesverbands NRW (BLV NRW)</a>.</p>
				<hr>
				<p class="mb-0">Aufgrund der raschen Änderungen ist es uns leider nicht möglich, den aktuellen Stand auf unserer Seite darzustellen. Wir bitten um Verständnis.</p>
			</div>
			<?php
			if (have_posts()) :
				?>
				<masonry-layout cols="auto" gap="20">
				<?php
				while (have_posts()) : the_post();
					get_template_part('content', get_post_format());
				endwhile;
				?></masonry-layout><?php
				bootstrap_pagination();
			else :
				get_template_part('content', 'none');
			endif;
			?>
		</div>
		<div class="col-lg-4">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>

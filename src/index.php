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
				<h2 class="h4 alert-heading">Informationen zur aktuellen Lage</h2>
				<p class="mb-0">Das Training findet vorerst bis einschließlich den 31.11.2020 <strong>nicht</strong> statt.</p>
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

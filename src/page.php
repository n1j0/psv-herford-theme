<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-8 mb-5">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div <?php post_class(); ?>>
					<?php psv_herford_thumb_img('psv-herford-single'); ?>
					<div class="main-content-page">
						<?php the_title('<h1 class="single-title">', '</h1>'); ?>
						<div class="entry-content">
							<?php do_action('head_theme_before_content'); ?>
							<?php the_content(); ?>
							<?php do_action('head_theme_after_content'); ?>
						</div>
						<?php wp_link_pages(); ?>
					</div>
				</div>
			<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part('content', 'none'); ?>
			<?php endif; ?>
		</div>
		<div class="col-lg-4">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>

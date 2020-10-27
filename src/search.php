<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<?php
			if (is_search()) :
				echo "<h1 class='text-center'>" . sprintf(esc_html__('Suchergebnisse für: %s', 'psv-herford'), get_search_query()) . "</h1>";
			endif;
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

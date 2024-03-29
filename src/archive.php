<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<header>
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				?>
			</header>
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


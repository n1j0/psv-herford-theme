<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div <?php post_class(); ?>>
					<div class="card mb-5">
						<div class="card-header d-flex justify-content-between">
							<small class="text-muted"><?php echo esc_html(get_the_date()); ?></small>
							<small class="text-muted"><?php the_author(); ?></small>
						</div>
						<?php if (has_post_thumbnail()) { ?>
							<div class="card-body">
								<div class="w-75 h-50 my-0 mx-auto">
									<?php psv_herford_thumb_img('psv-herford-single', false, 'rounded'); ?>
								</div>
							</div>
						<?php } ?>
						<div class="card-body">
							<div class="card-subtitle">
								<?php the_title('<h1 class="card-title text-center">', '</h1>'); ?>
							</div>
						</div>
						<div class="card-body">
								<?php do_action('head_theme_before_content'); ?>
								<?php the_content(); ?>
								<?php do_action('head_theme_after_content'); ?>
						</div>
						<div class="card-footer">
							<?php the_post_navigation( array(
								'prev_text' => '<span class="nav-previous">' . __( '&larr;', 'psv-herford' ) . ' Vorheriger</span>',
								'next_text' => '<span class="nav-next">Nächster ' . __( '&rarr;', 'psv-herford' ) . '</span>',
							) ); ?>
						</div>
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

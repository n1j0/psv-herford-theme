<div class="card grid-item">
	<?php psv_herford_thumb_img('psv-herford-archive', true, 'card-img-top'); ?>
	<div class="card-body">
		<p class="card-text"><small class="text-muted"><?php echo esc_html(get_the_date()); ?></small></p>
		<h2 class="h5 card-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<div class="card-text">
			<?php the_excerpt(); ?>
		</div>
		<a href="<?php the_permalink(); ?>"
		   class="btn btn-sm btn-outline-primary stretched-link float-right post-read-more">
			Weiterlesen
		</a>
	</div>
	<div class="card-footer">
		<small class="text-muted">Zuletzt geändert von <?php the_author(); ?></small>
	</div>
</div>

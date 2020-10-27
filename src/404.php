<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div class="main-content-page">
				<main class="text-center bg-success pb-4 mb-5" id="content">
					<img class="image-404" loading="lazy" src="<?php bloginfo('template_url'); ?>/img/404.svg" alt="404 error page" width="637" height="255">
					<h1 class="px-2 error-not-found">
						Nicht jeder Ball landet im Feld. Diese Seite gibt es nicht.
					</h1>
					<p class="error-details text-white">
						<?php esc_html_e('Probier doch mal die Suche aus.', 'psv-herford'); ?>
					</p>
				</main>
			</div>
		</div>
		<div class="col-lg-4">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>

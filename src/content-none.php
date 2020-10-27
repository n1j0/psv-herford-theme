<div class="empty-page text-center">
	<h1><?php esc_html_e('Nichts gefunden', 'psv-herford'); ?></h1>
	<?php if (is_search()) : ?>
		<p><?php esc_html_e('Die Suche hat leider keine Ergebnisse gefunden. Versuch es mit einem anderen Begriff.', 'psv-herford'); ?></p>
		<?php bootstrap_search_form(); ?>
	<?php else : ?>
		<p><?php esc_html_e('Das konnten wir leider nicht finden. Probier doch mal die Suche aus.', 'psv-herford'); ?></p>
		<?php bootstrap_search_form(); ?>
	<?php endif; ?>
</div>

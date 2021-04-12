<?php
if (!function_exists('psv_herford_setup')) :

	/**
	 * Global functions
	 */
	function psv_herford_setup()
	{

		// Theme lang.
		load_theme_textdomain('psv-herford', get_template_directory() . '/languages');

		// Add Title Tag Support.
		add_theme_support('title-tag');

		// Register Menus.
		register_nav_menus(
			array(
				'main_menu' => esc_html__('Hauptmenü', 'psv-herford'),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(300, 300, true);
		add_image_size('psv-herford-archive', 540, 304, true);
		add_image_size('psv-herford-single', 1140, 641, true);
		add_image_size('psv-herford-thumbnail', 120, 90, true);

		// Add Custom Background Support.
		add_theme_support(
			'custom-background',
			apply_filters(
				'psv-herford_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support(
			'custom-header',
			array(
				'width' => 2000,
				'height' => 450,
				'flex-width' => true,
				'flex-height' => true,
				'default-image' => esc_url(get_template_directory_uri()) . '/img/header.jpg',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'height' => 250,
				'width' => 250,
				'flex-width' => true,
				'flex-height' => true,
			)
		);

		require_once 'corona.php';
	}
endif;

add_action('after_setup_theme', 'psv_herford_setup');

function psv_herford_content_width()
{
	$GLOBALS['content_width'] = apply_filters('psv_herford_content_width', 640);
}

add_action('after_setup_theme', 'psv_herford_content_width', 0);

function psv_herford_dequeue_scripts()
{
	wp_dequeue_script('wp-embed');
	wp_dequeue_script('jquery');
	wp_dequeue_script('jquery-migrate');
}

add_action('init', 'psv_herford_dequeue_scripts', 9998);

function disable_embeds_code_init()
{
	// Remove the REST API endpoint.
	remove_action('rest_api_init', 'wp_oembed_register_route');

	// Turn off oEmbed auto discovery.
	add_filter('embed_oembed_discover', '__return_false');

	// Don't filter oEmbed results.
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

	// Remove oEmbed discovery links.
	remove_action('wp_head', 'wp_oembed_add_discovery_links');

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action('wp_head', 'wp_oembed_add_host_js');
	add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');

	// Remove all embeds rewrite rules.
	add_filter('rewrite_rules_array', 'disable_embeds_rewrites');

	// Remove filter of the oEmbed result before any HTTP requests are made.
	remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
}

add_action('init', 'disable_embeds_code_init', 9999);

function disable_embeds_tiny_mce_plugin($plugins)
{
	return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules)
{
	foreach ($rules as $rule => $rewrite) {
		if (false !== strpos($rewrite, 'embed=true')) {
			unset($rules[$rule]);
		}
	}

	return $rules;
}

function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}

add_action('init', 'disable_emojis');

function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	if ('dns-prefetch' == $relation_type) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
		$urls = array_diff($urls, array($emoji_svg_url));
	}

	return $urls;
}

remove_action('wp_head', 'wp_generator');

remove_action( 'wp_head', 'wlwmanifest_link' );

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

require_once(trailingslashit(get_template_directory()) . 'lib/wp_bootstrap_navwalker.php');

add_action('widgets_init', 'psv_herford_widgets_init');

function psv_herford_widgets_init()
{
	register_sidebar(
		array(
			'name' => __('Bereich vor Content', 'psv-herford'),
			'id' => 'psv-herford-homepage-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__('Rechte Seitenleiste', 'psv-herford'),
			'id' => 'psv-herford-right-sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
}

if (!function_exists('psv_herford_generate_construct_footer')) :
	function psv_herford_generate_construct_footer()
	{
		?>
		<div class="d-flex flex-column justify-content-center align-items-center">
			<a href="/impressum">Impressum</a>
			<a href="/datenschutz">Datenschutz</a>

			<p><?php
			printf(esc_html__('© 2020 PSV Herford', 'psv-herford'));
			?></p>
		</div>
		<?php
	}
endif;

add_action('head_theme_generate_footer', 'psv_herford_generate_construct_footer');

if (!function_exists('psv_herford_excerpt_length')) :
	function psv_herford_excerpt_length()
	{
		return 20;
	}

	add_filter('excerpt_length', 'psv_herford_excerpt_length');

endif;

if (!function_exists('psv_herford_thumb_img')) :
	function psv_herford_thumb_img($img = 'full', $link = false, $class = '')
	{
		if (has_post_thumbnail() && $link) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<img loading="lazy" src="<?php the_post_thumbnail_url($img); ?>" class="<?php echo $class; ?>"
					 alt="<?php the_title_attribute(); ?>" width="427" height="230"/>
			</a>

		<?php } elseif (has_post_thumbnail()) { ?>
			<img loading="lazy" src="<?php the_post_thumbnail_url($img); ?>" class="<?php echo $class; ?>" alt="<?php the_title_attribute(); ?>" width="595" height="334"/>
			<?php
		}
	}

endif;

function get_breadcrumb()
{
	global $post;

	$home = '<span class="visually-hidden visually-hidden-focusable">Zur Startseite</span><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
    <path d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
    <path d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
</svg>';

	$html = '<ol class="breadcrumb bg-light py-2 px-3 rounded-bottom">';

	if ((is_front_page()) || (is_home())) {
		$html .= '<li class="breadcrumb-item active" aria-current="page">' . $home . 'Startseite</li>';
	} else {
		$html .= '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">' . $home . '</a></li>';

		if (is_attachment()) {
			$parent = get_post($post->post_parent);

			$html .= '<li class="breadcrumb-item"><a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a></li>';
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
		} elseif (is_page() && !is_front_page()) {
			$parent_id = $post->post_parent;
			$parent_pages = array();

			while ($parent_id) {
				$page = get_page($parent_id);
				$parent_pages[] = $page;
				$parent_id = $page->post_parent;
			}

			$parent_pages = array_reverse($parent_pages);

			if (!empty($parent_pages)) {
				foreach ($parent_pages as $parent) {
					$html .= '<li class="breadcrumb-item"><a href="' . esc_url(get_permalink($parent->ID)) . '">' . get_the_title($parent->ID) . '</a></li>';
				}
			}

			$html .= '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
		} elseif (is_singular('post')) {
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
		} elseif (is_tag()) {
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . single_tag_title('', false) . '</li>';
		} elseif (is_day()) {
			$html .= '<li class="breadcrumb-item"><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></li>';
			$html .= '<li class="breadcrumb-item"><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('m') . '</a></li>';
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . get_the_time('d') . '</li>';
		} elseif (is_month()) {
			$html .= '<li class="breadcrumb-item"><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></li>';
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . get_the_time('F') . '</li>';
		} elseif (is_year()) {
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . get_the_time('Y') . '</li>';
		} elseif (is_author()) {
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . get_the_author() . '</li>';
		} elseif (is_search()) {
			$html .= '<li class="breadcrumb-item active" aria-current="page">' . sprintf(esc_html__('Suchergebnisse für: %s', 'psv-herford'), get_search_query()) . '</li>';
		} elseif (is_404()) {
			$html .= '';
		}

	}
	$html .= '</ol>';
	echo $html;
}

function bootstrap_pagination($wp_query = null, $params = [])
{
	if (null === $wp_query) {
		global $wp_query;
	}

	$add_args = [];

	$pages = paginate_links(array_merge([
			'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'type' => 'array',
			'show_all' => false,
			'end_size' => 2,
			'mid_size' => 1,
			'prev_next' => true,
			'prev_text' => __('«'),
			'next_text' => __('»'),
			'add_args' => $add_args,
			'add_fragment' => ''
		], $params)
	);

	if (is_array($pages)) {
		$pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

		foreach ($pages as $page) {
			$pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
		}

		$pagination .= '</ul></nav>';

		echo $pagination;
	}
}

function bootstrap_search_form($args = array())
{
	do_action('pre_get_search_form');
	if (!is_array($args)) {
		$args = array();
	}

	$defaults = array(
		'aria_label' => '',
	);

	$args = wp_parse_args($args, $defaults);

	$args = apply_filters('search_form_args', $args);

	$search_form_template = locate_template('searchform.php');
	if ('' != $search_form_template) {
		ob_start();
		require $search_form_template;
		$form = ob_get_clean();
	} else {
		if (isset($args['aria_label']) && $args['aria_label']) {
			$aria_label = 'aria-label="' . esc_attr($args['aria_label']) . '" ';
		} else {
			$aria_label = '';
		}
		$form = '<form role="search" ' . $aria_label . 'method="get" class="form-inline d-inline-flex mb-5 mb-md-0" action="' . esc_url(home_url('/')) . '">
			<label class="me-2 mb-0">
				<span class="visually-hidden visually-hidden-focusable">' . _x('Suche nach:', 'label') . '</span>
				<input type="search" class="form-control" placeholder="' . esc_attr_x('Suchbgeriff', 'placeholder') . '" value="' . get_search_query() . '" name="s" required/>
			</label>
			<button class="btn btn-primary" type="submit" aria-label="suchen">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 0 136 136.21852" class="search-icon">
					<path d="M 93.148438 80.832031 C 109.5 57.742188 104.03125 25.769531 80.941406 9.421875 C 57.851562 -6.925781 25.878906 -1.460938 9.53125 21.632812 C -6.816406 44.722656 -1.351562 76.691406 21.742188 93.039062 C 38.222656 104.707031 60.011719 105.605469 77.394531 95.339844 L 115.164062 132.882812 C 119.242188 137.175781 126.027344 137.347656 130.320312 133.269531 C 134.613281 129.195312 134.785156 122.410156 130.710938 118.117188 C 130.582031 117.980469 130.457031 117.855469 130.320312 117.726562 Z M 51.308594 84.332031 C 33.0625 84.335938 18.269531 69.554688 18.257812 51.308594 C 18.253906 33.0625 33.035156 18.269531 51.285156 18.261719 C 69.507812 18.253906 84.292969 33.011719 84.328125 51.234375 C 84.359375 69.484375 69.585938 84.300781 51.332031 84.332031 C 51.324219 84.332031 51.320312 84.332031 51.308594 84.332031 Z M 51.308594 84.332031"/>
				</svg>
			</button>
		</form>';
	}

	$result = apply_filters('get_search_form', $form);
	if (null === $result) {
		$result = $form;
	}
	echo $result;
}

function meta_description() {
	global $post;
	if ( is_singular() ) {
		$des_post = strip_tags( $post->post_content );
		$des_post = strip_shortcodes( $des_post );
		$des_post = str_replace( array("\n", "\r", "\t"), ' ', $des_post );
		$des_post = mb_substr( $des_post, 0, 175, 'utf8' );
		$des_post = trim($des_post);
		echo '<meta name="description" content="' . $des_post . '" />';
	}
	if ( is_home() ) {
		echo '<meta name="description" content="PSV Herford Badminton: Für Schüler*innen, Jugendliche und Erwachsene/ Senioren in Herford. Alles rund um Training, die Mannschaften, die Saison und den Verein." />';
	}
	if ( is_category() ) {
		$des_cat = strip_tags(category_description());
		echo '<meta name="description" content="' . $des_cat . '" />';
	}
}
add_action( 'wp_head', 'meta_description');

<nav id="site-navigation" class="navbar sticky-top navbar-expand-lg navbar-dark">
	<div class="container">
		<a class="navbar-brand" href="/">PSV Badminton</a>
		<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php
		wp_nav_menu(array(
			'theme_location' => 'main_menu',
			'depth' => 3,
			'container' => 'div',
			'container_class' => 'collapse navbar-collapse',
			'container_id' => 'navbarToggle',
			'menu_class' => 'navbar-nav me-auto mt-lg-0',
			'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
			'items_wrap' => '<div class="nav-container px-0"><div class="container px-sm-0"><form role="search" method="get" class="form-inline my-2 my-lg-0 d-flex d-lg-none" action="' . esc_url(home_url('/')) . '">
			<label class="me-2 mb-0">
				<span class="visually-hidden visually-hidden-focusable">' . esc_attr_x('Suche nach:', 'label') . '</span>
				<input type="search" class="form-control" placeholder="' . esc_attr_x('Suche', 'placeholder') . '" value="' . get_search_query() . '" name="s" required/>
			</label>
			<button class="btn btn-primary" type="submit" aria-label="suchen">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 0 136 136.21852" class="search-icon">
					<path d="M 93.148438 80.832031 C 109.5 57.742188 104.03125 25.769531 80.941406 9.421875 C 57.851562 -6.925781 25.878906 -1.460938 9.53125 21.632812 C -6.816406 44.722656 -1.351562 76.691406 21.742188 93.039062 C 38.222656 104.707031 60.011719 105.605469 77.394531 95.339844 L 115.164062 132.882812 C 119.242188 137.175781 126.027344 137.347656 130.320312 133.269531 C 134.613281 129.195312 134.785156 122.410156 130.710938 118.117188 C 130.582031 117.980469 130.457031 117.855469 130.320312 117.726562 Z M 51.308594 84.332031 C 33.0625 84.335938 18.269531 69.554688 18.257812 51.308594 C 18.253906 33.0625 33.035156 18.269531 51.285156 18.261719 C 69.507812 18.253906 84.292969 33.011719 84.328125 51.234375 C 84.359375 69.484375 69.585938 84.300781 51.332031 84.332031 C 51.324219 84.332031 51.320312 84.332031 51.308594 84.332031 Z M 51.308594 84.332031"/>
				</svg>
			</button>
		</form><ul id="%1$s" class="%2$s">%3$s</ul></div></div>',
			'walker' => new WP_Bootstrap_Navwalker(),
		));
		?>
		<form role="search" method="get" class="form-inline my-2 my-lg-0 d-none d-lg-inline-flex" action="<?php esc_url(home_url('/')) ?>">
			<label class="me-sm-2">
				<span class="visually-hidden visually-hidden-focusable"><?php echo esc_attr_x('Suche nach:', 'label') ?></span>
				<input type="search" class="form-control" placeholder="<?php echo esc_attr_x('Suche', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" required/>
			</label>
			<button class="btn btn-primary my-2 my-sm-0" type="submit" aria-label="suchen">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 0 136 136.21852" class="search-icon">
					<path d="M 93.148438 80.832031 C 109.5 57.742188 104.03125 25.769531 80.941406 9.421875 C 57.851562 -6.925781 25.878906 -1.460938 9.53125 21.632812 C -6.816406 44.722656 -1.351562 76.691406 21.742188 93.039062 C 38.222656 104.707031 60.011719 105.605469 77.394531 95.339844 L 115.164062 132.882812 C 119.242188 137.175781 126.027344 137.347656 130.320312 133.269531 C 134.613281 129.195312 134.785156 122.410156 130.710938 118.117188 C 130.582031 117.980469 130.457031 117.855469 130.320312 117.726562 Z M 51.308594 84.332031 C 33.0625 84.335938 18.269531 69.554688 18.257812 51.308594 C 18.253906 33.0625 33.035156 18.269531 51.285156 18.261719 C 69.507812 18.253906 84.292969 33.011719 84.328125 51.234375 C 84.359375 69.484375 69.585938 84.300781 51.332031 84.332031 C 51.324219 84.332031 51.320312 84.332031 51.308594 84.332031 Z M 51.308594 84.332031"/>
				</svg>
			</button>
		</form>
	</div>
</nav>

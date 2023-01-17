<?php

namespace OOP_PHP\ADMIN_PAGES;

class Admin_Options extends Abstract_Admin_Page {

	public function configure() {
		// Register settings
		register_setting( $this->get_menu_slug(), 'myplugin_color' );

		// Section
		add_settings_section(
			'myplugin_options_section',
			__( 'Options', 'myplugin' ),
			array( $this, 'render_section' ),
			$this->get_menu_slug()
		);

		add_settings_field(
			'myplugin_options_color',
			__( 'Custom color', 'myplugin' ),
			array( $this, 'render_color_field' ),
			'myplugin_options',
			'myplugin_options_section'
		);
	}

	public function render_section() {
		?>
		<p><?php esc_html_e( 'Customize MyPlugin with these options', 'myplugin' ); ?></p>
		<?php
	}

	public function render_color_field() {
		$color = '';

		if ( $this->options->has( 'myplugin_color' ) ) {
			$color = $this->options->get( 'myplugin_color' );
		}

		$this->render_form_field( 'myplugin_color', 'myplugin_color', $color, 'color' );
	}

	protected function get_menu_slug() {
		return 'myplugin_options';
	}

	protected function get_page_title() {
		return __( 'My Plugin Options', 'myplugin' );
	}

	protected function get_parent_slug() {
		return 'options-general.php';
	}

}

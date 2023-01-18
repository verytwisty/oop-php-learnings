<?php

namespace OOP_PHP\ADMIN_PAGES;

class Admin_Options extends Abstract_Admin_Page {

	public function configure() {
		// Register settings
		register_setting( $this->get_menu_slug(), 'myplugin_color' );

		register_setting( $this->get_menu_slug(), 'myplugin_text' );

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
			array( $this, 'render_form_input' ),
			'myplugin_options',
			'myplugin_options_section',
			array(
				'option' => 'myplugin_color',
				'type'   => 'color',
			)
		);

		add_settings_field(
			'myplugin_options_text',
			__( 'Custom text', 'myplugin' ),
			array( $this, 'render_form_input' ),
			'myplugin_options',
			'myplugin_options_section',
			array(
				'option' => 'myplugin_text',
			)
		);
	}

	public function render_section() {
		?>
		<p><?php esc_html_e( 'Customize MyPlugin with these options', 'myplugin' ); ?></p>
		<?php
	}

	public function render_form_input( $args ) {
		$color  = '';
		$option = $args['option'];
		$type   = $args['type'] ?? 'text';

		if ( $this->options->has( $option ) ) {
			$color = $this->options->get( $option );
		}

		$this->render_form_field( $option, $option, $color, $type );
	}

	public function render_text_field() {
		$text = '';

		if ( $this->options->has( 'myplugin_text' ) ) {
			$text = $this->options->get( 'myplugin_text' );
		}

		$this->render_form_field( 'myplugin_text', 'myplugin_text', $text );
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

<?php

namespace OOP_PHP\ADMIN_PAGES;

abstract class Abstract_Admin_Page {

	protected $options;

	public function __construct( Options_Interface $options ) {
		$this->options = $options;
	}

	public static function register( Options_Interface $options ) {
		$page = new static( $options );
		add_action( 'admin_init', array( $page, 'configure' ) );
		add_action( 'admin_menu', array( $page, 'add_admin_page' ) );
	}

	abstract public function configure();

	public function add_admin_page() {
		add_submenu_page(
			$this->get_parent_slug(),
			$this->get_page_title(),
			$this->get_menu_title(),
			$this->get_capability(),
			$this->get_menu_slug(),
			array( $this, 'render' )
		);
	}

	public function render() {
		?>
	<div class="wrap" id="<?php echo esc_attr( $this->get_menu_slug() ); ?>">
	<h1><?php echo esc_html( $this->get_page_title() ); ?></h1>
	<form action="options.php" method="POST">
		<?php settings_fields( $this->get_menu_slug() ); // creates nonce, action, and option_page fields ?>
		<?php do_settings_sections( $this->get_menu_slug() ); ?>
		<?php submit_button(); ?>
		</form>
	</div>

		<?php
	}

	protected function render_form_field( $id, $name, $value = '', $type = 'text' ) {
		?>
		<input
			id="<?php echo esc_attr( $id ); ?>"
			name="<?php echo esc_attr( $name ); ?>"
			type="<?php echo esc_attr( $type ); ?>"
			value="<?php echo esc_html( $value ); ?>"
		/>
		<?php
	}

	protected function get_capability() {
		return 'install_plugins';
	}

	protected function get_menu_title() {
		return $this->get_page_title();
	}

	abstract protected function get_parent_slug();

	abstract protected function get_page_title();

	abstract protected function get_menu_slug();

}

<?php

namespace OOP_PHP\ADMIN_PAGES;

class Options_Interface {

	public function get( $name, $default = null ) {
		return get_option( $name, $default );
	}

	public function has( $name ) {
		return null !== $this->get( $name );
	}

	public function remove( $name ) {
		delete_option( $name );
	}

	public function set( $name, $value ) {
		update_option( $name, $value );
	}

}

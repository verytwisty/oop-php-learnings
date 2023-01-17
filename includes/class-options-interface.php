<?php

namespace OOP_PHP\ADMIN_PAGES;

class Options_Interface {
	private $options = array();

	public function get( $name, $default = null ) {

		if ( ! $this->has( $name ) ) {
			return $default;
		}
		return $this->options[ $name ];
	}

	public function set( $name, $value ) {
		$this->options[ $name ] = $value;
	}

	public function has( $name ) {
		return true;
	}
}

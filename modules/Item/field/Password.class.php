<?php

class Password extends _String{
	
	/**
	 * Label
	 */
	public $label = 'Password';

	/**
	 * Print the value in the input
	 */
	public $printInputValue = false;

	/**
	 * Min length value
	 */
	public $minLength = 1;

	/**
	 * Initialize print
	 */
	public function iniPrint(){
		$this -> print = (object)[
			'list' => null,
			'view' => null,
			'form' => $this -> label,
		];
	}

	/**
	 * Prepare value field to query
	 *
	 * @param mixed $v value of field
	 * @param mixed value prepared
	 */
	public function dbValue($v){
		return Auth::getHashPass($v);
	}
}
?>
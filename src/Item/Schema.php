<?php

namespace Item;

class Schema{

	/**
	 * Entity
	 */
	public $__entity;

	/**
	 * Name of table
	 */
	public $table;

	/**
	 * Fields
	 */
	public $fields;

	/**
	 * Add a field
	 */
	public function field($class,$name){
		if(is_subclass_of($class,Field\Schema::class)){

			$field = new $class($name);
			$this -> fields[$name] = $field;
			return $field;
		}else{
			throw new \Exception('Error during creation of field');
		}
	}

	/**
	 * Construct
	 */
	public function __construct(){
		$this -> fields();
	}

	/**
	 * Set fields
	 */
	public function fields(){}

	/**
	 * Get fields
	 */
	public function getFields(){
		return $this -> fields;
	}

	/**
	 * Get fields
	 */
	public function getField($name){
		return $this -> fields[$name];
	}

	/**
	 * Get table
	 */
	public function getTable(){
		return $this -> table;
	}

	public function parseResult($result){
		if($this -> hasEntity())
			return $this -> newEntity() -> setFieldsByArray($result);
		else
			return $result;
	}

	public function hasEntity(){
		return $this -> __entity !== null;
	}

	public function newEntity(){
		return new $this -> __entity($this);
	}
}
?>
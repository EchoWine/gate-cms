<?php

namespace CoreWine\Item\Field;

class Entity{
	
	/**
	 * Schema
	 */
	public $schema;

	/**
	 * Value
	 */
	public $value;

	/**
	 * Value raw
	 */
	public $value_raw;

	/**
	 * Persist
	 */
	public $persist;

	/**
	 * Construct
	 */
	public function __construct($schema,$value){
		$this -> schema = $schema;
		$this -> value = $value;
		$this -> persist = $schema -> persist;
	}

	/**
	 * Is primary
	 *
	 * @return bool
	 */
	public function isPrimary(){
		return $this -> getSchema() -> getPrimary();
	}

	/**
	 * Is Autoincrement
	 *
	 * @return bool
	 */
	public function isAutoIncrement(){
		return $this -> getSchema() -> getAutoIncrement();
	}

	/**
	 * Get the schema
	 *
	 * @return Item\Field\Schema
	 */
	public function getSchema(){
		return $this -> schema;
	}

	/**
	 * Set persist
	 *
	 * @return bool
	 */
	public function setPersist($persist = false){
		$this -> persist = $persist;
	}

	/**
	 * Get persist
	 *
	 * @return bool
	 */
	public function getPersist(){
		return $this -> persist;
	}

	/**
	 * Set the value raw
	 *
	 * @return mixed
	 */
	public function setValueRaw($value_raw,$persist = false){
		$this -> value_raw = $value_raw;

		if(!$persist){
			$this -> setValue($this -> parseRawToValue($value_raw),false);
			$this -> persist = $persist;
		}
	}

	/**
	 * Get the value raw
	 *
	 * @return mixed
	 */
	public function getValueRaw(){
		return $this -> value_raw;
	}

	/**
	 * Set the value
	 *
	 * @param mixed $value
	 */
	public function setValue($value = null,$persist = true){
		$this -> value = $value;

		if($persist){
			$this -> setValueRaw($this -> parseValueToRaw($value),true);
			$this -> persist = $persist;
		}
	}

	/**
	 * Get the value
	 *
	 * @return mixed
	 */
	public function getValue(){
		return $this -> value;
	}

	
	/**
	 * Parse the value from raw to value
	 *
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	public function parseRawToValue($value){
		return $value;
	}

	/**
	 * Parse the value from value to raw
	 *
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	public function parseValueToRaw($value){
		return $value;
	}

	/**
	 * To string
	 */
	public function __tostring(){
		return $this -> getValue();
	}

	/**
	 * Add the field to query to add an entity
	 *
	 * @param Repository $repository
	 *
	 * @return Repository
	 */
	public function add($repository){
		return $repository -> addInsert($this -> getSchema() -> getColumn(),$this -> getValueRaw());
	}

	/**
	 * Add the field to query to edit an entity
	 *
	 * @param Repository $repository
	 *
	 * @return Repository
	 */
	public function edit($repository){
		return $repository -> addUpdate($this -> getSchema() -> getColumn(),$this -> getValueRaw());
	}

	/**
	 * Add the field to query to find the entity
	 *
	 * @param Repository $repository
	 *
	 * @return Repository
	 */
	public function where($repository){
		return $repository -> where($this -> getSchema() -> getColumn(),$this -> getValueRaw());
	}

}
?>
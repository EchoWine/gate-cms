<?php

namespace Admin;

use CoreWine\DataBase\DB;

class Repository extends \Item\Repository{


	/**
	 * Get the QueryBuilder object
	 *
	 * @return CoreWine\DataBase\QueryBuilder
	 */
	public function table($type = 1){

		$table = DB::table($this -> getSchema() -> getTable());

		foreach($this -> getSchema() -> getFields() as $field){
			if($field -> isViewGet()){
				$table = $table -> select($field -> getColumn());
			}
		}

		switch($type){
			case null:
				return $table;
			break;
			case 0:

				return $table -> setParserResult(function($results){
					
					return $results;
				});
			break;

			case 1:

				return $table -> setParserResult(function($results){
					
					foreach($results as $n => $result){
						$results[$n] = $this -> schema -> parseResult($result);
					}

					return $results;
				});
			break;

		}

	}



}

?>
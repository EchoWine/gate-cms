<?php

namespace CoreWine\TemplateEngine;

use CoreWine\Components\App;

class TemplateEngineApp extends App{

	public function __construct(){

		# Load template
		Engine::ini(PATH."/".PATH_STORAGE);

	}

	public function app(){

	}

}

?>
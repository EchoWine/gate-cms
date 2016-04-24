<?php
	
	use CoreWine\Route as Route;
	use CoreWine\Request as Request;
	use CoreWine\TemplateEngine\Engine;
	
	function isJson($s){
		json_decode($s);
		return (json_last_error() == JSON_ERROR_NONE);
	}

	function is_closure($t) {
		return is_object($t) && ($t instanceof Closure);
	}
	
	function dirname_r($f,$i) {
    	for(;$i>0;$i--)
    		$f = dirname($f);

    	return $f;
	}

	function view($file,$data = []){
		Route::view($data);
		return Engine::html($file);
	}

	function assets($url,$module = ''){

		$base = !empty($module) ? Request::getDirUrl().'../src/'.$module.'/Resources/public/' : Request::getDirUrl();
		return $base.$url;
	}

	function post($name){
		$post = Request::post($name);
		return $post != null ? $post : '';
	}

	
  	function loadClass($class){
  		$file = PATH_SRC.'/'.__NAMESPACE__.$class.".php";
  		if(file_exists($file))
  			require $file;

  		$file = PATH_LIB.'/'.__NAMESPACE__.$class.".php";
  		if(file_exists($file))
  			require $file;
	}
	spl_autoload_register(__NAMESPACE__ . "\\loadClass");

?>
<?php
	
	use CoreWine\Router;
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

	function route($route = null){
		return $route == null ? Router::active() : Router::url($route);
	}

	function assets($url){
		return Request::getDirUrl().$url;
	}

	function post($name){
		$post = Request::post($name);
		return $post != null ? $post : '';
	}

	function tmpl_js_var($name){
		return '{'.$name.'}';
	}
	

?>
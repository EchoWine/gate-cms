<?php

namespace Serie\Api;

class TheTVDB extends Basic{

	/**
	 * Name of api
	 *
	 * @param string
	 */
	protected $name = 'thetvdb';

	/**
	 * Token api
	 *
	 * @param string
	 */
	protected $token = '2216193F17A3C7A4';

	/**
	 * List of all resources that this api can retrieve
	 * 
	 * @var Array (series|anime|manga)
	 */
	protected $resources = ['anime','series'];

	/**
	 * Basic api url
	 *
	 * @param string
	 */
	protected $url_api = "http://www.thetvdb.com/api/";

	/**
	 * Basic api url
	 *
	 * @param string
	 */
	protected $url_public = "http://www.thetvdb.com/";


	public function requestDiscovery($params){

		$url = $this -> url_api."GetSeries.php?".http_build_query($params);
			
		$return = [];

		# @temp

		try{

			$resources = simplexml_load_string(file_get_contents($url));

		}catch(Exception $e){

			return ['error' => $e -> getMessage()];

		}


		foreach($resources -> Series as $resource){

			try{
				$url = $this -> url_api.$this -> token."/series/".((int)$resource -> seriesid)."/banners.xml";

				if(!($banners = @simplexml_load_string(file_get_contents($url))))
					return $return;


				foreach($banners as $banner){
					if($banner -> BannerType == 'poster'){
						$banner = $this -> url_public."banners/".((string)$banner -> BannerPath);

						if(file_get_contents($banner)){

							break;
						}else{
							$banner = '';
						}
					}
				}
			}catch(\Exception $e){

			}

			$return[(int)$resource -> seriesid] = [
				'api' => $this -> getName(),
				'type' => 'series',
				'id' => (int)$resource -> seriesid,
				'language' => (string)$resource -> language,
				'name' => (string)$resource -> SeriesName,
				'banner' => $banner,
				'overview' => (string)$resource -> Overview,
				'first_aired' => (string)$resource -> FirstAired,
				'network' => (string)$resource -> Network,
			];
		}


		return $return;
	}
	
	/**
	 * Discovery a resource
	 *
	 * @param string $keys
	 */
	public function discovery($key){

		return $this -> requestDiscovery(['seriesname' => str_replace("%20","_",$key)]);
	}




}
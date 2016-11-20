<?php

namespace App\Models;

use App\Model;


class MedicalOrganization extends Model
{

    public $id;
    public $name;
    public $article_url;

	public function url()
	{
	 	return \App\Config::instance()->medical_organization_url . $this->id;
	}

	public function http_code()
	{
		$user_agent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0)';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url());
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$page = curl_exec($ch);

		$err = curl_error($ch);
		if (!empty($err))
			return $err;
  
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $httpcode;
	}
	
	public function data()
	{
		return json_decode(file_get_contents($this->url()));
	}

	
	
}
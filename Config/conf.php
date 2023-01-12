<?php
class conf{
	static private $databases = array(
		'hostname' => 'mysql-globostofo.alwaysdata.net',
		'database' => 'globostofo_site_patisseries',
		'login' => '295869',
		'password' => 'password123drowssap321'
	);

	static public function getLogin(){
		return self::$databases['login'];
	}

	static public function getHostname(){
		return self::$databases['hostname'];
	}

	static public function getDatabase(){
		return self::$databases['database'];
	}

	static public function getPassword(){
		return self::$databases['password'];
	}

	static private $debug = true;

	static public function getDebug(){
		return self::$debug;
	}
}
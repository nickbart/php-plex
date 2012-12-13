php-plex
========

A simple PHP library for interacting with the Plex (http://plexapp.com) HTTP API.

Requirements
============

php-curl
simpleXML

Examples
========

	$servers = array(
		'shepherd' => array(
			'host' => '192.168.11.9'
		)
	);
	
	
	$plex = new Plex();
	$plex->registerServers($servers);
	
	$server = $plex->getServer('shepherd');
	$client = $plex->getClient('zoe');



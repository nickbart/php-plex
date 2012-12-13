<?php

class Plex_Library extends PlexAbstract
{
	private $url;
	
	const LIBRARY_DIRECTORY = '/library';
	const SECTION_DIRECTORY = '/sections';
	
	const SECTION_TYPE_MOVIE = 'movie';
	const SECTION_TYPE_SHOW = 'show';
	
	public function __construct($server, $port = 32400)
	{
		
		$this->setUrl(
			sprintf(
				'%s%s',
				$this->getBaseUrl(),
				self::LIBRARY_DIRECTORY
			)
		);
		
	}
	
	public function getSections()
	{
		$url = sprintf(
			'%s/%s',
			$this->getUrl(),
			self::SECTION_DIRECTORY
		);
		return $this->makeCall($url);
	}
	
	public function getSectionByKey($key)
	{
		$url = sprintf(
			'%s%s/%s',
			$this->getUrl(),
			self::SECTION_DIRECTORY,
			$key
		);
		
		return $this->makeCall($url);
	}
	
	private function setUrl($url)
	{
		$this->url = $url;
	}
	
	public function getUrl()
	{
		return $this->url;
	}
}

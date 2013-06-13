<?php

/**
 * Plex Library Item Media
 * 
 * @category php-plex
 * @package Plex_Server_Library
 * @subpackage Plex_Server_Library_Item
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 *
 * This file is part of php-plex.
 * 
 * php-plex is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-plex is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Class that represents the media info a Plex Server Library Item.
 * 
 * @category php-plex
 * @package Plex_Server_Library
 * @subpackage Plex_Server_Library_Item
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
class Plex_Server_Library_Item_Media 
	implements Plex_Server_Library_Item_MediaInterface
{
	/**
	 * ID of the media info.
	 * @var integer
	 */
	private $id;
	
	/**
	 * Length of the file in milliseconds.
	 * @var integer
	 */
	private $duration;
	
	/**
	 * Bitrate of the file in kilobytes per second.
	 * @var integer
	 */
	private $bitrate;
	
	/**
	 * Width of the file's video in pixels.
	 * @var integer
	 */
	private $width;
	
	/**
	 * Height of the file's video in pixels.
	 * @var integer
	 */
	private $height;
	
	/**
	 * Aspect ration of the file's video.
	 * @var float
	 */
	private $aspectRatio;
	
	/**
	 * Resolution of the file's video.
	 * @var integer
	 */
	private $videoResolution;
	
	/**
	 * Container of the file.
	 * @var string
	 */
	private $container;
	
	/**
	 * Frame rate of the file's video.
	 * @var string
	 */
	private $videoFrameRate;
	
	/**
	 * The files associated with the item.
	 * @var Plex_Server_Library_Item_Media_File[]
	 */
	private $files;
	
	/**
	 * Sets an array of media info to their corresponding class members.
	 * 
	 * @param array $rawMedia An array of the raw media info returned from the
	 * Plex HTTP API.
	 *
	 * @uses Plex_Server_Library_Item_Media::setId()
	 * @uses Plex_Server_Library_Item_Media::setDuration()
	 * @uses Plex_Server_Library_Item_Media::setBitrate()
	 * @uses Plex_Server_Library_Item_Media::setWidth()
	 * @uses Plex_Server_Library_Item_Media::setHeight()
	 * @uses Plex_Server_Library_Item_Media::setAspectRatio()
	 * @uses Plex_Server_Library_Item_Media::setVideoResolution()
	 * @uses Plex_Server_Library_Item_Media::setContainer()
	 * @uses Plex_Server_Library_Item_Media::setVideoFrameRate()
	 * @uses Plex_Server_Library_Item_Media::setFiles()
	 * @uses Plex_Server_Library_Item_Media_File()
	 *
	 * @return void
	 */
	public function __construct($rawMedia)
	{
		if (isset($rawMedia['id'])) {
			$this->setId($rawMedia['id']);
		}
		if (isset($rawMedia['duration'])) {
			$this->setDuration($rawMedia['duration']);
		}
		if (isset($rawMedia['bitrate'])) {
			$this->setBitrate($rawMedia['bitrate']);
		}
		if (isset($rawMedia['width'])) {
			$this->setWidth($rawMedia['width']);
		}
		if (isset($rawMedia['height'])) {
			$this->setHeight($rawMedia['height']);
		}
		if (isset($rawMedia['aspectRatio'])) {
			$this->setAspectRatio($rawMedia['aspectRatio']);
		}
		if (isset($rawMedia['videoResolution'])) {
			$this->setVideoResolution($rawMedia['videoResolution']);
		}
		if (isset($rawMedia['container'])) {
			$this->setContainer($rawMedia['container']);
		}
		if (isset($rawMedia['videoFrameRate'])) {
			$this->setVideoFrameRate($rawMedia['videoFrameRate']);
		}
		
		$files = array();
		foreach ($rawMedia['Part'] as $file) {
			$files[] = new Plex_Server_Library_Item_Media_File($file);
		}
		
		if (!empty($files)) {
			$this->setFiles($files);
		}
	}
	
	/**
	 * Returns the ID of the media info.
	 *
	 * @uses Plex_Server_Library_Item_Media::$id
	 *
	 * @return integer The ID of the media info.
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Sets the ID of the media info.
	 *
	 * @param integer $id The ID of the media info.
	 *
	 * @uses Plex_Server_Library_Item_Media::$id
	 *
	 * @return void
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Returns the length of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media::$duration
	 *
	 * @return integer The length of the file.
	 */
	public function getDuration()
	{
		return $this->duration;
	}
	
	/**
	 * Sets the length of the file.
	 *
	 * @param integer $duration The length of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media::$duration
	 *
	 * @return void
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}

	/**
	 * Returns the bitrate of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media::$bitrate
	 *
	 * @return integer The bitrate of the file.
	 */
	public function getBitrate()
	{
		return $this->bitrate;
	}
	
	/**
	 * Sets the bitrate of the file.
	 *
	 * @param integer $bitrate The bitrate of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media::$bitrate
	 *
	 * @return void
	 */
	public function setBitrate($bitrate)
	{
		$this->bitrate = $bitrate;
	}
	
	/**
	 * Returns the width of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$width
	 *
	 * @return integer The width of the file's video.
	 */
	public function getWidth()
	{
		return $this->width;
	}
	
	/**
	 * Sets the width of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$width
	 *
	 * @param integer $width The width of the file's video.
	 *
	 * @return void
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}
	
	/**
	 * Returns the height of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$height
	 *
	 * @return integer The height of the file's video.
	 */
	public function getHeight()
	{
		return $this->height;
	}
	
	/**
	 * Sets the height of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$height
	 *
	 * @param integer $height The height of the file's video.
	 *
	 * @return void
	 */
	public function setHeight($height)
	{
		$this->height = $height;
	}

	/**
	 * Returns the aspect ratio of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$aspectRatio
	 *
	 * @return float The aspect ratio of the file's video.
	 */
	public function getAspectRatio()
	{
		return $this->aspectRatio;
	}
	
	/**
	 * Sets the aspect ratio of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$aspectRatio
	 *
	 * @param float $aspectRatio The aspect ratio of the file's video.
	 *
	 * @return void
	 */
	public function setAspectRatio($aspectRatio)
	{
		$this->aspectRatio = $aspectRatio;
	}
	
	/**
	 * Returns the video resolution of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$videoResolution
	 *
	 * @return integer The video resolution of the file's video.
	 */
	public function getVideoResolution()
	{
		return $this->videoResolution;
	}
	
	/**
	 * Sets the video resolution of the file's video.
	 *
	 * @uses Plex_Server_Library_Item_Media::$videoResolution
	 *
	 * @param integer $videoResolution The video resolution of the file's video.
	 *
	 * @return void
	 */
	public function setVideoResolution($videoResolution)
	{
		$this->videoResolution = $videoResolution;
	}

	/**
	 * Returns the container of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media::$container
	 *
	 * @return string The container of the file.
	 */
	public function getContainer()
	{
		return $this->container;
	}
	
	/**
	 * Sets the container of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media::$container
	 *
	 * @param string $container The container of the file.
	 *
	 * @return void
	 */
	public function setContainer($container)
	{
		$this->container = $container;
	}
	
	/**
	 * Returns the frame rate of the file's video
	 *
	 * @uses Plex_Server_Library_Item_Media::$videoFrameRate
	 *
	 * @return string The frame rate of the file's video.
	 */
	public function getVideoFrameRate()
	{
		return $this->videoFrameRate;
	}
	
	/**
	 * Sets the frame rate of the file's video
	 *
	 * @uses Plex_Server_Library_Item_Media::$videoFrameRate
	 *
	 * @param string $videoFrameRate The frame rate of the file's video.
	 *
	 * @return void
	 */
	public function setVideoFrameRate($videoFrameRate)
	{
		$this->videoFrameRate = $videoFrameRate;
	}

	/**
	 * Returns the files associated with the item.
	 *
	 * @uses Plex_Server_Library_Item_Media::$files
	 *
	 * @return Plex_Server_Library_Item_Media_File[] Array of media files.
	 */
	public function getFiles()
	{
		return $this->files;
	}
	
	/**
	 * Sets the files associated with the item.
	 *
	 * @uses Plex_Server_Library_Item_Media::$files
	 *
	 * @param Plex_Server_Library_Item_Media_File[] $files Array of media files.
	 *
	 * @return void
	 */
	public function setFiles($files)
	{
		$this->files = $files;
	}
}

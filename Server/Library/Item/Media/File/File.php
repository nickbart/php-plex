<?php

/**
 * Plex Library Item Media File
 * 
 * @category php-plex
 * @package Plex_Server_Library_Item
 * @subpackage Plex_Server_Library_Item_Media
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
 * Class that represents a file associated with a media item.
 * 
 * @category php-plex
 * @package Plex_Server_Library_Item
 * @subpackage Plex_Server_Library_Item_Media
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
class Plex_Server_Library_Item_Media_File
	implements Plex_Server_Library_Item_Media_FileInterface
{
	/**
	 * The ID of the file.
	 * @var integer
	 */
	private $id;
	
	/**
	 * The key of the file.
	 * @var string
	 */
	private $key;
	
	/**
	 * The duration of the file in milliseconds.
	 * @var integer
	 */
	private $duration;
	
	/**
	 * Full path to the file.
	 * @var string
	 */
	private $file;
	
	/**
	 * Size of the file in bytes.
	 * @var integer
	 */
	private $size;
	
	/**
	 * Container of the file.
	 * @var string
	 */
	private $container;

	/**
	 * Sets an array of file info to their corresponding class members.
	 * 
	 * @param array $rawFile An array of the raw file info returned from the
	 * Plex HTTP API.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::setId()
	 * @uses Plex_Server_Library_Item_Media_File::setKey()
	 * @uses Plex_Server_Library_Item_Media_File::setDuration()
	 * @uses Plex_Server_Library_Item_Media_File::setFile()
	 * @uses Plex_Server_Library_Item_Media_File::setSize()
	 * @uses Plex_Server_Library_Item_Media_File::setContainer()
	 *
	 * @return void
	 */	
	public function __construct($rawFile)
	{
		if (isset($rawFile['id'])) {
			$this->setId($rawFile['id']);
		}
		if (isset($rawFile['key'])) {
			$this->setKey($rawFile['key']);
		}
		if (isset($rawFile['duration'])) {
			$this->setDuration($rawFile['duration']);
		}
		if (isset($rawFile['file'])) {
			$this->setFile($rawFile['file']);
		}
		if (isset($rawFile['size'])) {
			$this->setSize($rawFile['size']);
		}
		if (isset($rawFile['container'])) {
			$this->setContainer($rawFile['container']);
		}
	}
	
	/**
	 * Returns the ID of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$id
	 *
	 * @return integer The ID of the file.
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Sets the ID of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$id
	 *
	 * @param integer $id The ID of the file.
	 * 
	 * @return void
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * Returns the key of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$key
	 *
	 * @return string The key of the file.
	 */
	public function getKey()
	{
		return $this->key;
	}
	
	/**
	 * Sets the key of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$key
	 *
	 * @param string $key The key of the file.
	 *
	 * @return void
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}
	
	/**
	 * Returns the duration of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$duration
	 *
	 * @return integer The duration of the file.
	 */
	public function getDuration()
	{
		return $this->duration;
	}
	
	/**
	 * Sets the duration of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$duration
	 *
	 * @param integer $duration The duration of the file.
	 *
	 * @return void
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}

	/**
	 * Returns the path of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$file
	 *
	 * @return string The path of the file.
	 */
	public function getFile()
	{
		return $this->file;
	}
	
	/**
	 * Sets the path of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$file
	 *
	 * @param string $file The path of the file.
	 *
	 * @return void
	 */
	public function setFile($file)
	{
		$this->file = $file;
	}

	/**
	 * Returns the size of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$size
	 *
	 * @return integer The size of the file.
	 */
	public function getSize()
	{
		return $this->size;
	}
	
	/**
	 * Sets the size of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$size
	 *
	 * @param integer $size The size of the file.
	 *
	 * @retur void
	 */
	public function setSize($size)
	{
		$this->size = $size;
	}
	
	/**
	 * Returns the container of the file.
	 *
	 * @uses Plex_Server_Library_Item_Media_File::$container
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
	 * @uses Plex_Server_Library_Item_Media_File::$container
	 *
	 * @param string $container The container of the file.
	 *
	 * @return void
	 */
	public function setContainer($container)
	{
		$this->container = $container;
	}
}

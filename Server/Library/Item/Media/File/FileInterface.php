<?php

/**
 * Plex Library Item Media File
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
 * Interface that defines the structure of the file associated with an item.
 * 
 * @category php-plex
 * @package Plex_Server_Library
 * @subpackage Plex_Server_Library_Item
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
interface Plex_Server_Library_Item_Media_FileInterface
{
	/**
	 * Returns the ID of the file.
	 *
	 * @return integer The ID of the file.
	 */
	public function getId();
	
	/**
	 * Sets the ID of the file.
	 *
	 * @param integer $id The ID of the file.
	 * 
	 * @return void
	 */
	public function setId($id);
	
	/**
	 * Returns the key of the file.
	 *
	 * @return string The key of the file.
	 */
	public function getKey();
	
	/**
	 * Sets the key of the file.
	 *
	 * @param string $key The key of the file.
	 *
	 * @return void
	 */
	public function setKey($key);
	
	/**
	 * Returns the duration of the file.
	 *
	 * @return integer The duration of the file.
	 */
	public function getDuration();
	
	/**
	 * Sets the duration of the file.
	 *
	 * @param integer $duration The duration of the file.
	 *
	 * @return void
	 */
	public function setDuration($duration);

	/**
	 * Returns the path of the file.
	 *
	 * @return string The path of the file.
	 */
	public function getFile();
	
	/**
	 * Sets the path of the file.
	 *
	 * @param string $file The path of the file.
	 *
	 * @return void
	 */
	public function setFile($file);

	/**
	 * Returns the size of the file.
	 *
	 * @return integer The size of the file.
	 */
	public function getSize();
	
	/**
	 * Sets the size of the file.
	 *
	 * @param integer $size The size of the file.
	 *
	 * @retur void
	 */
	public function setSize($size);
	
	/**
	 * Returns the container of the file.
	 *
	 * @return string The container of the file.
	 */
	public function getContainer();
	
	/**
	 * Sets the container of the file.
	 *
	 * @param string $container The container of the file.
	 *
	 * @return void
	 */
	public function setContainer($container);
}

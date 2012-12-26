<?php

/**
 * Plex Library Album
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
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
 * Represents a Plex album.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Server_Library_Item_Album 
	extends Plex_Server_Library_ItemParentAbstract 
{
	/**
	 * Sets an array of attributes, if they exist, to the corresponding class
	 * member.
	 * 
	 * @param array $attribute An array of item attributes as passed back by the
	 * Plex HTTP API.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::setAttributes()
	 *
	 * @return void
	 */
	public function setAttributes($attribute)
	{
		parent::setAttributes($attribute);
	}
	
	/**
	 * Returns an array of all the track objects for the intstantiated album.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_ItemAbstract::buildChildrenEndpoint()
	 *
	 * @return Plex_Server_Library_Item_Track[] An array of Plex library track
	 * objects.
	 */
	public function getTracks()
	{
		return $this->getItems(
			$this->buildChildrenEndpoint()
		);
	}
	
	/**
	 * Returns a single track by index, key, or exact title match.
	 *
 	 * @param integer|string $polymorphicData Either an index, a key, or a title
	 * for an exact title match that will be used to retrieve a single track.
	 * 
	 * @uses Plex_Server_Library_ItemAbstract::getPolymorphicItem()
	 *
	 * @return Plex_Server_Library_Item_Track A single track.
	 */
	public function getTrack($polymorphicData)
	{
		return $this->getPolymorphicItem($polymorphicData);
	}
}

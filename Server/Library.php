<?php

/**
 * Plex Server Library
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
 * Class that represents a Plex library and allows interaction with its sections
 * and items.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Server_Library extends Plex_Server
{
	/**
	 * URL endpoint for Plex server library.
	 */
	const ENDPOINT_LIBRARY = 'library';
	
	/**
	 * URL endpoint for library sections.
	 */
	const ENDPOINT_SECTION = 'sections';
	
	/**
	 * URL endpoint for a library's recently added items.
	 */
	const ENDPOINT_RECENTLY_ADDED = 'recentlyAdded';
	
	/**
	 * URLl endpoint for a library's on deck items.
	 */
	const ENDPOINT_ON_DECK = 'onDeck';
	
	/**
	 * String that identifies a Plex library movie item type.
	 */
	const TYPE_MOVIE = 'movie';

	/**
	 * String that identifies a Plex library artist item type.
	 */
	const TYPE_ARTIST = 'artist';
	
	/**
	 * String that identifies a Plex library photo item type.
	 */
	const TYPE_PHOTO = 'photo';

	/**
	 * String that identifies a Plex library TV show item type.
	 */
	const TYPE_SHOW = 'show';

	/**
	 * String that identifies a Plex library episode item type.
	 */
	const TYPE_EPISODE = 'episode';
	
	/**
	 * Generic way of building a url agains the Plex library.
	 *
	 * @uses Plex_MachineAbstract::getBaseUrl()
	 * @uses Plex_Server_Library::ENDPOINT_LIBRARY
	 *
	 * @return string A Plex library URL based on the given endpoint.
	 */
	protected function buildUrl($endpoint)
	{
		$url = sprintf(
			'%s/%s/%s',
			$this->getBaseUrl(),
			self::ENDPOINT_LIBRARY,
			$endpoint
		);
		return $url;
	}
	
	/**
	 * Generic way of requestion Plex library items.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_ItemAbstract::factory()
	 * @uses Plex_Server_Library_ItemInterface::setAttributes()
	 *
	 * return Plex_Server_Library_Item[] An array of plex library items.
	 */
	protected function getItems($endpoint)
	{
		$items = array();
		$itemArray = $this->makeCall($this->buildUrl($endpoint));
		
		foreach ($itemArray as $attribute) {
			$item = Plex_Server_Library_ItemAbstract::factory(
				$attribute['type']
			);
			$item->setAttributes($attribute);
			$items[] = $item;
		}
		return $items;
	}
	
	/**
	 * Returns an array of user defined Plex library sections that can be used
	 * to interact with th eitems contained within.
	 *
	 * @uses Plex_MachineAbstract::$name
	 * @uses Plex_MachineAbstract::$address
	 * @uses Plex_MachineAbstract::$port
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::ENDPOINT_SECTION
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::factory()
	 * @uses Plex_Server_Library_SectionAbstract::setAttributes()
	 *
	 * @return Plex_Server_Library_Section[] An array of user defined Plex
	 * library sections.
	 */
	public function getSections()
	{
		$sections = array();
		$sectionArray = $this->makeCall(
			$this->buildUrl(self::ENDPOINT_SECTION)
		);
		
		foreach ($sectionArray as $attribute) {
			$section = Plex_Server_Library_SectionAbstract::factory(
				$attribute['type'],
				$this->name,
				$this->address,
				$this->port
			);
			$section->setAttributes($attribute);

			$sections[] = $section;
		}
		
		return $sections;
	}
	
	/**
	 * Returns a Plex library section by its given key. Here we simpoly run
	 * self::getSections() because the endpoint /library/sections/ID does not
	 * return full section data, it returns the categories below the section.
	 *
	 * @param integer $key The key of the requested section.
	 *
	 * @uses Plex_Server_Library::getSections()
	 * @uses Plex_Server_Library_Section::getKey()
	 *
	 * @return Plex_Server_Library_Section The request library section.
	 */
	public function getSectionByKey($key)
	{
		foreach ($this->getSections() as $section) {
			if ($section->getKey() === $key) {
				return $section;
			}
		}
	}
	
	/**
	 * Returns the recently added items at the library level.
	 *
	 * @uses Plex_Server_Library::getItem()
	 * @uses Plex_Server_Library::ENPOINT_RECENTLY_ADDED
	 * 
	 * return Plex_Server_Library_Item[] An array of plex library items.
	 */
	public function getRecentlyAddedItems()
	{
		return $this->getItems(self::ENDPOINT_RECENTLY_ADDED);
	}
	
	/**
	 * Returns the on deck items at the library level.
	 *
	 * @uses Plex_Server_Library::getItem()
	 * @uses Plex_Server_Library::ENPOINT_RECENTLY_ADDED
	 * 
	 * return Plex_Server_Library_Item[] An array of plex library items.
	 */
	public function getOnDeckItems()
	{
		return $this->getItems(self::ENDPOINT_ON_DECK);
	}
}

<?php

/**
 * Plex Server Library Section
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
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
 * Class that represents a Plex library section and allows interaction with
 * items. This abstract class helps define how individual sections will behave
 * and gives them some general constants and methods that all or most can share.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
 */
abstract class Plex_Server_Library_SectionAbstract extends Plex_Server_Library
{
	/**
	 * Reference to the art section's art.
	 * @var string
	 */
	protected $art;
	
	/**
	 * Boolean saying whether or not the section is currently refreshing.
	 * @var boolean
	 */
	protected $refreshing;
	
	/**
	 * The section's key.
	 * @var integer
	 */
	protected $key;
	
	/**
	 * The section's type.
	 * @var string
	 */
	protected $type;
	
	/**
	 * The section's title.
	 * @var string
	 */
	protected $title;
	
	/**
	 * The metadata agent for the sectiion.
	 * @var string
	 */
	protected $agent;
	
	/**
	 * The type of scanner for the section.
	 * @var string
	 */
	protected $scanner;
	
	/**
	 * The section's language.
	 * @var string
	 */
	protected $language;
	
	/**
	 * Universally unique identifier for the section.
	 * @var string
	 */
	protected $uuid;
	
	/**
	 * Date the section was last updated.
	 * @var DateTime
	 */
	protected $updatedAt;

	/**
	 * Date the section was created.
	 * @var DateTime
	 */
	protected $createdAt;
	
	/**
	 * Endpoint for retrieving all items for a section.
	 */
	const ENDPOINT_CATEGORY_ALL = 'all';
	
	/**
	 * Endpoint for retrieving all unwatched items for a section.
	 */
	const ENDPOINT_CATEGORY_UNWATCHED = 'unwatched';
	
	/**
	 * Endpoint for retrieving the newest items for a section.
	 */
	const ENDPOINT_CATEGORY_NEWEST = 'newest';
	
	/**
	 * Endpoint for retrieving recently added items for a section.
	 */
	const ENDPOINT_CATEGORY_RECENTLY_ADDED = 'recentlyAdded';
	
	/**
	 * Endpoint for retrieving recently viewed items for a section.
	 */
	const ENDPOINT_CATEGORY_RECENTLY_VIEWED = 'recentlyViewed';
	
	/**
	 * Endpoint for retrieving on deck items for a section.
	 */
	const ENDPOINT_CATEGORY_ON_DECK = 'onDeck';
	
	/**
	 * Endpoint for retrieving items for a section by collection.
	 */
	const ENDPOINT_CATEGORY_COLLECTION = 'collection';
	
	/**
	 * Endpoint for retrieving items for a section by first character.
	 */
	const ENDPOINT_CATEGORY_FIRST_CHARACTER = 'firstCharacter';
	
	/**
	 * Endpoint for retrieving items for a section by genre.
	 */
	const ENDPOINT_CATEGORY_GENRE = 'genre';
	
	/**
	 * Endpoint for retrieiving items for a section by year.
	 */
	const ENDPOINT_CATEGORY_YEAR = 'year';
	
	/**
	 * Endpoint for searching a section for items.
	 */
	const ENDPOINT_SEARCH = 'search';
	
	/**
	 * Parameter for searching movies.
	 */
	const SEARCH_TYPE_MOVIE = 1;

	/**
	 * Parameter for searching television shows.
	 */
	const SEARCH_TYPE_SHOW = 2;
	
	/**
	 * Parameter for searching teleivision episodes.
	 */
	const SEARCH_TYPE_EPISODE = 4;

	/**
	 * Parameter for searching artists.
	 */
	const SEARCH_TYPE_ARTIST = 8;

	/**
	 * Parameter for searching tracks.
	 */
	const SEARCH_TYPE_TRACK = 10;
	
	/**
	 * Adds the attributes to the object if they exist.
	 *
	 * @param array Array of attributes to be added to the object.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::setArt()
	 * @uses Plex_Server_Library_SectionAbstract::setRefreshing()
	 * @uses Plex_Server_Library_SectionAbstract::setKey()
	 * @uses Plex_Server_Library_SectionAbstract::setType()
	 * @uses Plex_Server_Library_SectionAbstract::setTitle()
	 * @uses Plex_Server_Library_SectionAbstract::setAgent()
	 * @uses Plex_Server_Library_SectionAbstract::setScanner()
	 * @uses Plex_Server_Library_SectionAbstract::setLanguage()
	 * @uses Plex_Server_Library_SectionAbstract::setUuid()
	 * @uses Plex_Server_Library_SectionAbstract::setUpdatedAt()
	 * @uses Plex_Server_Library_SectionAbstract::setCreatedAt()
	 * 
	 * @return void
	 */
	public function setAttributes($attribute)
	{
		if (isset($attribute['art'])) {
			 $this->setArt($attribute['art']);
		}
		if (isset($attribute['refreshing'])) {
			$this->setRefreshing($attribute['refreshing']);
		}
		if (isset($attribute['key'])) {
			$this->setKey($attribute['key']);
		}
		if (isset($attribute['type'])) {
			$this->setType($attribute['type']);
		}
		if (isset($attribute['title'])) {
			$this->setTitle($attribute['title']);
		}
		if (isset($attribute['agent'])) {
			$this->setAgent($attribute['agent']);
		}
		if (isset($attribute['scanner'])) {
			$this->setScanner($attribute['scanner']);
		}
		if (isset($attribute['language'])) {
			$this->setLanguage($attribute['language']);
		}
		if (isset($attribute['uuid'])) {
			$this->setUuid($attribute['uuid']);
		}
		if (isset($attribute['updatedAt'])) {
			$this->setUpdatedAt($attribute['updatedAt']);
		}
		if (isset($attribute['createdAt'])) {
			$this->setCreatedAt($attribute['createdAt']);
		}
	}
	
	/**
	 * Generic method for building a Plex library section endpoint.
	 *
	 * @param string $endpoint The specific section endpoint to be added
	 * to the generic Plex library section endpoint.
	 *
	 * @uses Plex_Server_Library::ENDPOINT_SECTION
	 * @uses Plex_Server_Library_SectionAbstract::getKey()
	 *
	 * @return string The requested endpoint.
	 */
	protected function buildEndpoint($endpoint)
	{
		return sprintf(
			'%s/%d/%s',
			Plex_Server_Library::ENDPOINT_SECTION,
			$this->getKey(),
			$endpoint
		);
	}
	
	/**
	 * Builds an endpoint to search a Plex library section.
	 *
	 * @param integer $type The type of item to be searched.
	 * @param string $query The string of text against which the search will be
	 * run.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_SEARCH
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 *
	 * @return string The requested search endpoint.
	 */
	protected function buildSearchEndpoint($type, $query)
	{
		$parameters = array(
			'type' => $type,
			'query' => trim($query)
		);
		
		$endpoint = sprintf(
			'%s?%s',
			self::ENDPOINT_SEARCH,
			http_build_query($parameters)
		);
		
		return $this->buildEndpoint($endpoint);
	}
	
	/**
	 * Generic method allowing a child class to retrieve all items for its
	 * section.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_ALL
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getAllItems()
	{
		return $this->getItems(
			$this->buildEndpoint(self::ENDPOINT_CATEGORY_ALL)
		);
	}

	/**
	 * Generic method allowing a child class to retrieve all unwatched items for
	 * its section.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_UNWATCHED
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getUnwatchedItems()
	{
		return $this->getItems(
			$this->buildEndpoint(self::ENDPOINT_CATEGORY_UNWATCHED)
		);
	}

	/**
	 * Generic method allowing a child class to retrieve the newest items for
	 * its section.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_NEWEST
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getNewestItems()
	{
		return $this->getItems(
			$this->buildEndpoint(self::ENDPOINT_CATEGORY_NEWEST)
		);
	}
	
	/**
	 * Generic method allowing a child class to retrieve recently added items
	 * for its section. It is named slightly differently as it collided with the
	 * library method of the same name.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_RECENTLY_ADDED
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getRecentlyAddedSectionItems()
	{
		return $this->getItems(
			$this->buildEndpoint(self::ENDPOINT_CATEGORY_RECENTLY_ADDED)
		);
	}

	/**
	 * Generic method allowing a child class to retrieve the on deck items for
	 * its section. It is named slightly differently as it collided with the
	 * library method of the same name.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_ON_DECK
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getOnDeckSectionItems()
	{
		return $this->getItems(
			$this->buildEndpoint(self::ENDPOINT_CATEGORY_ON_DECK)
		);
	}

	/**
	 * Generic method allowing a child class to retrieve recently viewed items
	 * for its section.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_RECENTLY_VIEWED
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getRecentlyViewedItems()
	{
		return $this->getItems(
			$this->buildEndpoint(self::ENDPOINT_CATEGORY_RECENTLY_VIEWED)
		);
	}
	
	/**
	 * Generic method allowing a child class to retrieve recently viewed items
	 * for its section.
	 *
	 * @param integer $collectionKey Key that represents the collection by which
	 * the items will be retrieved. The collection key can be discovered by using 
	 * the getCollections() method in this same class.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_COLLECTION
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getItemsByCollection($collectionKey)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%d',
					self::ENDPOINT_CATEGORY_COLLECTION,
					$collectionKey
				)
			)
		);
	}
	
	/**
	 * Generic method allowing a child class to retrieve items by first
	 * character from its section.
	 *
	 * @param string $character The first character by which the items will be
	 * retrieved.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_FIRST_CHARACTER
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */
	protected function getItemsByFirstCharacter($character)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%s',
					self::ENDPOINT_CATEGORY_FIRST_CHARACTER,
					$character
				)
			)
		);
	}

	/**
	 * Generic method allowing a child class to retrieve items by genre from its
	 * section.
	 *
	 * @param integer $genreKey Key that represents the genre by which the items
	 * will be retrieved. The genre key can be discovered by using the getGenres()
	 * method in this same class.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_GENRE
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */	
	protected function getItemsByGenre($genreKey)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%d',
					self::ENDPOINT_CATEGORY_GENRE,
					$genreKey
				)
			)
		);
	}
	
	/**
	 * Generic method allowing a child class to retrieve items by four digit 
	 * year from its section
	 *
	 * @param integer $year Four digit year by which the items will be 
	 * retrieved.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_YEAR
	 *
	 * return Plex_Server_Library_ItemAbstract[] An array of Plex library items.
	 */	
	protected function getItemsByYear($year)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%d',
					self::ENDPOINT_CATEGORY_YEAR,
					$year
				)
			)
		);
	}
	
	/**
	 * A generic method to allow polymorphic retrieval of a single library item.
	 * This will take a rating key, a key, or a string that it will use to
	 * attempt an exact title match.
	 *
	 * @param integer|string $polymorphicData Either a rating key, a key, or a
	 * title for an exact title match that will be used to retrieve a single
	 * library item.
	 * @param boolean scopedToItem Tells the method whether or not we are
	 * scoped to an item. If we are scoped to an item then we are use get
	 * methods instead of search methods.
	 *
	 * @uses Plex_MachineAbstract::getCallingFunction()
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library::functionToType()
	 * @uses Plex_Server_Library::ENDPOINT_METADATA
	 * @uses Plex_Server_Library::ENDPOINT_LIBRARY
	 * @uses Plex_Server_Library_ItemAbstract::getTitle()
	 * @uses Plex_Server_Library_ItemAbstract::getRatingKey()
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 *
	 * @return Plex_Server_Library_ItemAbstract The request Plex library item.
	 *
	 * @throws Plex_Exception_Server_Library()
	 */
	protected function getPolymorphicItem($polymorphicData, $scopedToItem = FALSE)
	{
		if (is_int($polymorphicData)) {
			// If we have an integer then we can assume we have a rating key.
			if ($item = reset(
				$this->getItems(
					sprintf(
						'%s/%d',
						Plex_Server_Library::ENDPOINT_METADATA,
						$polymorphicData
					)
				)
			)) {
				return $item;
			}

			throw new Plex_Exception_Server_Library(
				'RESOURCE_NOT_FOUND',
				array('item', $polymorphicData)
			);

		} else if (strpos($polymorphicData, Plex_Server_Library::ENDPOINT_METADATA)
			!== FALSE) {
			// If the single item endpoint appears in the polymorphic data then
			// is assumed we are dealing with a key, which is already a valid
			// endpoint.
			
			// A key will contain the library endpoint, which will be added back
			// by our getItems method, so we strip it out here. The buildUrl
			// method will handle stripping out and double slashes caused by
			// this.
			$endpoint = str_replace(
				Plex_Server_Library::ENDPOINT_LIBRARY, 
				'',
				$polymorphicData
			);
			
			if ($item = reset($this->getItems($endpoint))) {
				return $item;
			}

			throw new Plex_Exception_Server_Library(
				'RESOURCE_NOT_FOUND',
				array('item', $polymorphicData)
			);

		} else {
			// If we don't have a rating key or a key then we just assume we're
			// doing an exact title match.
			
			// If we are scoped to item it means an item is trying to retrieve
			// children or grandchildren. This has two implications. We can't
			// search at this level, so we have to "get" then loop/match/return.
			// It also means that to get the calling function we have to change
			// the depth as there is an extra function inbetween.
			$depth = 2;
			$functionType = 'search';
			
			if ($scopedToItem) {
				$depth = 3;
				$functionType = 'get';
			}
			
			// Find the item type.
			$itemType =  $this->functionToType(
				$this->getCallingFunction($depth)
			);
			
			// Find the search method and make sure it exists in the search
			// class.
			$searchMethod = sprintf('%s%ss', $functionType, ucfirst($itemType));
			
			if (method_exists($this, $searchMethod)) {
				foreach ($this->{$searchMethod}($polymorphicData) as $item) {
					if ($item->getTitle() === $polymorphicData) {
						if ($scopedToItem) {
							// So, this might seem a bit recursive, but there's
							// method to this madness. If we are scoped to an 
							// item and we have identified the item by its 
							// title, we have to refetch the item singularly by 
							// its rating key. We do this because we have used a
							// "get" method to find this item instead of a 
							// "search" method and Plex limits the amount of 
							// data that comes back with an item when you ask
							// for more than one at a time. By asking for it 
							// singularly here, we guarantee we get the most 
							// data back, like grandparent and parent keys and 
							// titles.
							return self::getPolymorphicItem(
								$item->getRatingKey()
							);
						} else {
							return $item;
						}
					}
				}
			}
			
			// Tried to do an exact title match and came up empty.
			throw new Plex_Exception_Server_Library(
				'RESOURCE_NOT_FOUND',
				array('item', $polymorphicData)
			);
		}
	}
		
	/**
	 * Returns a list of collections for the child class's section. We use
	 * makeCall directly here, because we want to return just the raw array of
	 * collections and not do any post processing on it.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_COLLECTION
	 *
	 * @return array An array of collections with their names and keys. 
	 */
	public function getCollections()
	{
		return $this->makeCall(
			$this->buildUrl(
				$this->buildEndpoint(self::ENDPOINT_CATEGORY_COLLECTION)
			)
		);
	}
	
	/**
	 * Returns a list of genres for the child class's section. We use makeCall
	 * directly here, because we want to return just the raw array of genres and
	 * not do any post processing on it.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_GENRE
	 *
	 * @return array An array of genres with their names and keys.
	 */
	public function getGenres()
	{
		return $this->makeCall(
			$this->buildUrl(
				$this->buildEndpoint(self::ENDPOINT_CATEGORY_GENRE)
			)
		);
	}
	
	/**
	 * Static factory method used to instantiate child section classes by their
	 * type.
	 *
	 * @param string $type The type of child section class being instantiated.
	 * @param string $name The name of the Plex server.
	 * @param string $address The IP address of the Plex server.
	 * @param integer $port The port on which the Plex server is listening.
	 *
	 * @return Plex_Server_Library_SectionAbstract An instantiated section child
	 * class.
	 */
	public static function factory($type, $name, $address, $port)
	{
		$class = sprintf(
			'Plex_Server_Library_Section_%s',
			ucfirst($type)
		);
		
		return new $class($name, $address, $port);
	}
	
	/**
	 * Returns a reference to the section's art.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$art
	 *
	 * @return string A reference to the section's art.
	 */
	public function getArt()
	{
		return $this->art;
	}
	
	/**
	 * Sets a reference to the section's art.
	 *
	 * @param string $art A reference to the section's art.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$art
	 *
	 * @return void
	 */
	public function setArt($art)
	{
		$this->art = $art;
	}
	
	/**
	 * Tells whether the section is currently in the process of refreshing.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$refreshing
	 *
	 * @return boolean Whether or not the section is refreshing.
	 */
	public function isRefreshing()
	{
		return (boolean) $this->refreshing;
	}
	
	/**
	 * Sets whether the section is currently in the process of refreshing.
	 *
	 * @param boolean $refreshing Whether or not the section is refreshing.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$refreshing
	 *
	 * @return void
	 */
	public function setRefreshing($refreshing)
	{
		$this->refreshing = (boolean) $refreshing;
	}
	
	/**
	 * Returns the section's key.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$key
	 *
	 * @return integer The section's key.
	 */
	public function getKey()
	{
		return (int) $this->key;
	}
	
	/**
	 * Sets the section's key.
	 *
	 * @param integer $key The section's key. 
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$key
	 *
	 * @return void
	 */
	public function setKey($key)
	{
		$this->key = (int) $key;
	}
	
	/**
	 * Returns the section's type.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$type
	 *
	 * @return string The section's type.
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * Sets the section's type.
	 *
	 * @param string $type The section's type.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$type
	 *
	 * @return void
	 */
	public function setType($type)
	{
		$this->type = $type;
	}
	
	/**
	 * Returns the section's title.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$title
	 *
	 * @return string The section's title.
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * sets the section's title.
	 *
	 * @param string $title The section's title.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$title
	 *
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Returns the section's agent.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$agent
	 *
	 * @return string The section's agent.
	 */
	public function getAgent()
	{
		return $this->agent;
	}
	
	/**
	 * Sets the section's agent.
	 *
	 * @param string $agent The section's agent.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$agent
	 *
	 * @return void
	 */
	public function setAgent($agent)
	{
		$this->agent = $agent;
	}
	
	/**
	 * Returns the section's scanner
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$scanner
	 *
	 * @return string The section's scanner.
	 */
	public function getScanner()
	{
		return $this->scanner;
	}
	
	/**
	 * Sets the section's scanner
	 *
	 * @param string $scanner The section's scanner.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$scanner
	 *
	 * @return void
	 */
	public function setScanner($scanner)
	{
		$this->scanner = $scanner;
	}
	
	/**
	 * Returns the section's language.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$language
	 *
	 * @return string The section's language.
	 */
	public function getLanguage()
	{
		return $this->language;
	}
	
	/**
	 * Sets the section's language.
	 *
	 * @param string $language The section's language.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$language
	 *
	 * @return void
	 */
	public function setLanguage($language)
	{
		$this->language = $language;
	}
	
	/**
	 * Returns the section's universally unique identifier.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$uuid
	 *
	 * @return string The section's universally unique identifier.
	 */
	public function getUuid()
	{
		return $this->uuid;
	}
	
	/**
	 * Sets the section's universally unique identifier.
	 *
	 * @param string $uuid The section's universally unique identifier.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$uuid
	 *
	 * @return void
	 */
	public function setUuid($uuid)
	{
		$this->uuid = $uuid;
	}
	
	/**
	 * Returns the time at which the section was last updated.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$updatedAt
	 *
	 * @return DateTime The time at which the section was last updated.
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
	
	/**
	 * Sets the time at which the section was last updated.
	 *
	 * @param integer $updatedAtTs The unix timestamp representing the time the
	 * section was last updated. This will be turned into a DateTime object.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::$updatedAt
	 *
	 * @return void
	 */
	public function setUpdatedAt($updatedAtTs)
	{
		$updatedAt = new DateTime(sprintf('@%s', $updatedAtTs));
		$this->updatedAt = $updatedAt;
	}

	/**
	 * Returns the time at which the section was created.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::$createdAt
	 *
	 * @return DateTime The time at which the section was created.
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Sets the time at which the section was last created.
	 *
	 * @param integer $createdAtTs The unix timestamp representing the time the
	 * section was created. This will be turned into a DateTime object.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::$createdAt
	 *
	 * @return void
	 */	
	public function setCreatedAt($createdAtTs)
	{
		$createdAt = new DateTime(sprintf('@%s', $createdAtTs));
		$this->createdAt = $createdAt;
	}
}

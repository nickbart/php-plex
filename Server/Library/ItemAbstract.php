<?php

/**
 * Plex Library Item
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
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
 * Base class that helps define a Plex library item with all the generic methods
 * and membes shared by all Plex library items.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
abstract class Plex_Server_Library_ItemAbstract 
	extends Plex_Server_Library_SectionAbstract
	implements Plex_Server_Library_ItemInterface
{
	/**
	 * Whether or not the item is available for sync.
	 * @var boolean
	 */
	protected $allowSync;
	
	/**
	 * The ID of the library section to which the item belongs.
	 * @var integer
	 */
	protected $librarySectionId;
	
	/**
	 * Unique integer that represents an item and helps build its key string.
	 * @var integer
	 */
	protected $ratingKey;
	
	/**
	 * Key/path to specifically identify the the single item.
	 * @var string
	 */
	protected $key;
	
	/**
	 * Type of the item.
	 * @var string
	 */
	protected $type;
	
	/**
	 * Title of the item.
	 * @var string
	 */
	protected $title;
	
	/**
	 * Sorting title of the item. This is used if the item's title starts with
	 * "The," "An," or "A."
	 * @var string
	 */
	protected $titleSort;
	
	/**
	 * Summary of the item.
	 * @var string
	 */
	protected $summary;
	
	/**
	 * Index of the item.
	 * @var integer
	 */
	protected $index;
	
	/**
	 * Reference to the thumb of the item.
	 * @var string
	 */
	protected $thumb;
	
	/**
	 * Date the item was added to the library.
	 * @var DateTime
	 */
   	protected $addedAt;
	
	/**
	 * Date the item was last updated.
	 * @var DateTime
	 */
	protected $updatedAt;
	
	/**
	 * The media info associated with a Plex item.
	 * @var Plex_Server_Library_Item_Media
	 */
	protected $media;
	
	/**
	 * Endpoint for listing the child items of a parent or grandparent item.
	 */
	const ENDPOINT_CHILDREN = 'children';
	
	/**
	 * Endpoint for listing all the grandchild items of an item.
	 */
	const ENDPOINT_ALL_LEAVES = 'allLeaves';
	
	/**
	 * Sets an array of attribues, if they exist, to the corresponding class
	 * member.
	 * 
	 * @param array $attribute An array of item attributes as passed back by the
	 * Plex HTTP API.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::setAllowSync()
	 * @uses Plex_Server_Library_ItemAbstract::setLibrarySectionId()
	 * @uses Plex_Server_Library_ItemAbstract::setRatingKey()
	 * @uses Plex_Server_Library_ItemAbstract::setKey()
	 * @uses Plex_Server_Library_ItemAbstract::setType()
	 * @uses Plex_Server_Library_ItemAbstract::setTitle()
	 * @uses Plex_Server_Library_ItemAbstract::setTitleSort()
	 * @uses Plex_Server_Library_ItemAbstract::setSummary()
	 * @uses Plex_Server_Library_ItemAbstract::setIndex()
	 * @uses Plex_Server_Library_ItemAbstract::setThumb()
	 * @uses Plex_Server_Library_ItemAbstract::setAddedAt()
	 * @uses Plex_Server_Library_ItemAbstract::setUpdatedAt()
	 * @uses Plex_Server_Library_ItemAbstract::setMedia()
	 *
	 * @return void
	 */
	public function setAttributes($attribute)
	{
		if (isset($attribute['allowSync'])) {
			$this->setAllowSync($attribute['allowSync']);
		}
		if (isset($attribute['librarySectionID'])) {
			$this->setLibrarySectionId($attribute['librarySectionID']);
		}
		if (isset($attribute['ratingKey'])) {
			$this->setRatingKey($attribute['ratingKey']);
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
		if (isset($attribute['titleSort'])) {
			$this->setTitleSort($attribute['titleSort']);
		}
		if (isset($attribute['summary'])) {
			$this->setSummary($attribute['summary']);
		}
		if (isset($attribute['index'])) {
			$this->setIndex($attribute['index']);
		}
		if (isset($attribute['thumb'])) {
			$this->setThumb($attribute['thumb']);
		}
		if (isset($attribute['addedAt'])) {
			$this->setAddedAt($attribute['addedAt']);
		}
		if (isset($attribute['updatedAt'])) {
			$this->setUpdatedAt($attribute['updatedAt']);
		}
		if (isset($attribute['Media'])) {
			$this->setMedia($attribute['Media']);
		}
	}
	
	/**
	 * Returns a single item by its index.
	 *
	 * @param integer $index The index by which the item will be matched and
	 * returned.
	 *
	 * @uses Plex_MachineAbstract::getCallingFunction()
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 * @uses Plex_Server_Library::functionToType()
	 * @uses Plex_Server_Library_ItemAbstract::getIndex()
	 * @uses Plex_Server_Library_ItemAbstract::getRatingKey()
	 *
	 * @return Plex_Server_Library_ItemAbstract A single Plex library item.
	 */
	public function getItemByIndex($index)
	{
		// Since we 'hop' from the overridden 'getPolymorphicItem' method, we
		// have to extend the depth by one here to properly identify the calling
		// function.
		$itemType = $this->functionToType(
			$this->getCallingFunction(3)
		);
		
		// Find the get method and make sure it exists in the calling class.
		$getMethod = sprintf('get%ss', ucfirst($itemType));
		
		if (method_exists($this, $getMethod)) {
			foreach ($this->{$getMethod}() as $item) {
				if ($item->getIndex() === $index) {
					// So, this might seem a bit recursive, but there's method
					// to this madness. Once we have identified the correct item
					// by its key, we use the parent item retrieval system to
					// get the item by its rating key. We do this because Plex
					// limits the amount of data that comes back with an item
					// when you ask for more than one at a time. By asking for
					// for it singularly here, we guarantee we get the most data
					// back, like grandparent and parent keys and titles.
					return parent::getPolymorphicItem($item->getRatingKey());
				}
			}
		}
	}
	
	/**
	 * Override of the setion version of this method so we can apply slightly
	 * different rules when retrieving single children and grandchildren at the
	 * item level.
	 *
	 * @param integer|string $polymorphicData Either an index, a key, or a title
	 * for an exact title match that will be used to retrieve a single library
	 * item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::getItemByIndex()
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 *
	 * @return Plex_Server_Library_ItemAbstract A single Plex library item.
	 */
	public function getPolymorphicItem($polymorphicData)
	{
		// At the item level, instead of assuming an integer is a rating key, we
		// assume an integer is an index. This allows us to retrieve seasons,
		// episodes, and tracks by their number in sequence, which is a more
		// common way than by its Plex assigned rating key.
		if (is_int($polymorphicData)) {
			return $this->getItemByIndex($polymorphicData);
		} else {
			// If we're not retrieving by index, then we simply default to the
			// parent function, however, we scope it to 'item' so the calling
			// function is identified by the right depth and we use a 'get'
			// function to find the items instead of search.
			return parent::getPolymorphicItem($polymorphicData, TRUE);
		}
	}
	
	/**
	 * Builds an endpoint for an item to retrieve its children and grandchildren
	 * items.
	 *
	 * @uses Plex_Server_Library::ENDPOINT_METADATA
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CHILDREN
	 * @uses Plex_Server_Library_ItemAbstract::getRatingKey()
	 *
	 * @return string The requested children endpoint.
	 */
	protected function buildChildrenEndpoint()
	{
		return sprintf(
			'%s/%d/%s',
			Plex_Server_Library::ENDPOINT_METADATA,
			$this->getRatingKey(),
			self::ENDPOINT_CHILDREN
		);
	}
	
	/**
	 * Builds an endpoint for an item to retrieve all of its grandchildren.
	 *
	 * @uses Plex_Server_Library::ENDPOINT_METADATA
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_ALL_LEAVES
	 * @uses Plex_Server_Library_ItemAbstract::getRatingKey()
	 *
	 * @return string The requested grandchildren endpoint.
	 */
	protected function buildAllLeavesEndpoint()
	{
		return sprintf(
			'%s/%d/%s',
			Plex_Server_Library::ENDPOINT_METADATA,
			$this->getRatingKey(),
			self::ENDPOINT_ALL_LEAVES
		);
	}
	
	/**
	 * Static factory method used to instantiate child item classes by their
	 * type.
	 *
	 * @param string $type The type of child section class being instantiated.
	 * @param string $name The name of the Plex server.
	 * @param string $address The IP address of the Plex server.
	 * @param integer $port The port on which the Plex server is listening.
	 *
	 * @return Plex_Server_Library_ItemAbstract An instantiated item child
	 * class.
	 */
	public static function factory($type, $name, $address, $port)
	{
		$class = sprintf(
			'Plex_Server_Library_Item_%s',
			ucfirst($type)
		);
		
		return new $class($name, $address, $port);
	}
	
	/**
	 * Says whether or not the item is available for sync.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$allowSync
	 *
	 * @return boolean Whether or not the item is available for sync.
	 */
	public function doesAllowSync()
	{
		return (boolean) $this->allowSync;
	}
	
	/**
	 * Sets whether or not the item is available for sync.
	 *
	 * @param boolean $allowSync Whether or not the item is available for sync.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$allowSync
	 *
	 * @return void
	 */
	public function setAllowSync($allowSync)
	{
		$this->allowSync = (boolean) $allowSync;
	}
	
	/**
	 * Return library section ID to which the item belongs.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$librarySectionId
	 *
	 * @return int The library ID to which the item belongs.
	 */
	public function getLibrarySectionId()
	{
		return (int) $this->librarySectionId;
	}
	
	/**
	 * Sets the library section ID to which the item belongs.
	 *
	 * @param int $librarySectionId The library ID to which the item belongs.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$librarySectionId
	 *
	 * @return void
	 */
	public function setLibrarySectionId($librarySectionId)
	{
		$this->librarySectionId = (int) $librarySectionId;
	}
	
	/**
	 * Returns the rating key of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$ratingKey
	 *
	 * @return int The rating key of the item.
	 */
	public function getRatingKey()
	{
		return (int) $this->ratingKey;
	}
	
	/**
	 * Sets the rating key of the item.
	 *
	 * @param int $ratingKey The rating key of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$ratingKey
	 *
	 * @return void
	 */
	public function setRatingKey($ratingKey)
	{
		$this->ratingKey = (int) $ratingKey;
	}
	
	/**
	 * Returns the key of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$key
	 *
	 * @return string The key of the item.
	 */
	public function getKey()
	{
		return $this->key;
	}
	
	/**
	 * Sets the key of the item.
	 *
	 * @param string $key The key of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$key
	 *
	 * @return void
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}

	/**
	 * Returns the type of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$type
	 *
	 * @return string The type of the item.
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * Sets the type of the item.
	 *
	 * @param string $type The type of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$type
	 *
	 * @return void
	 */
	public function setType($type)
	{
		$this->type = $type;
	}
	
	/**
	 * Returns the title of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$title
	 *
	 * @return string The title of the item.
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Sets the title of the item.
	 *
	 * @param string $title The title of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$title
	 *
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Returns the sort title of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$titleSort
	 *
	 * @return string The sort title of the item.
	 */
	public function getTitleSort()
	{
		return $this->titleSort;
	}
	
	/**
	 * Sets the sort title of the item.
	 *
	 * @param string $titleSort The sort title of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$titleSort
	 *
	 * @return void
	 */
	public function setTitleSort($titleSort)
	{
		$this->titleSort = $titleSort;
	}
	
	/**
	 * Returns the summary of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$summary
	 *
	 * @return string The summary of the item.
	 */
	public function getSummary()
	{
		return $this->summary;
	}
	
	/**
	 * Sets the summary of the item.
	 *
	 * @param string $summary The summary of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$summary
	 *
	 * @return void
	 */
	public function setSummary($summary)
	{
		$this->summary = $summary;
	}

	/**
	 * Returns the index of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$index
	 *
	 * @return int The index of the item.
	 */
	public function getIndex()
	{
		return (int) $this->index;
	}
	
	/**
	 * Sets the index of the item.
	 *
	 * @param int $index The index of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$index
	 *
	 * @return void
	 */
	public function setIndex($index)
	{
		$this->index = (int) $index;
	}
	
	/**
	 * Returns the thumb reference of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$thumb
	 *
	 * @return string The thumb reference of the item.
	 */
	public function getThumb()
	{
		return $this->thumb;
	}
	
	/**
	 * Sets the thumb reference of the item.
	 *
	 * @param string $thumb The thumb reference of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$thumb
	 *
	 * @return void
	 */
	public function setThumb($thumb)
	{
		$this->thumb = $thumb;
	}

	/**
	 * Returns the time at which the item was added.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$addedAt
	 *
	 * @return DateTime The time at which the item was added.
	 */
	public function getAddedAt()
	{
		return $this->addedAt;
	}
	
	/**
	 * Sets the time at which the item was added.
	 *
	 * @param integer $addedAtTs The unix timestamp representing the time the
	 * item was last added. This will be turned into a DateTime object.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$addedAt
	 *
	 * @return void
	 */
	public function setAddedAt($addedAtTs)
	{
		$addedAt = new DateTime(sprintf('@%s', $addedAtTs));
		$this->addedAt = $addedAt;
	}

	/**
	 * Returns the time at which the item was last updated.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$updatedAt
	 *
	 * @return DateTime The time at which the item was last updated.
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
	
	/**
	 * Sets the time at which the item was last updated.
	 *
	 * @param integer $updatedAtTs The unix timestamp representing the time the
	 * item was last updated. This will be turned into a DateTime object.
	 * 
	 * @uses Plex_Server_Library_ItemAbstract::$updatedAt
	 *
	 * @return void
	 */
	public function setUpdatedAt($updatedAtTs)
	{
		$updatedAt = new DateTime(sprintf('@%s', $updatedAtTs));
		$this->updatedAt = $updatedAt;
	}
	
	/**
	 * Returns the media info of the item.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::$media
	 *
	 * @return Plex_Server_Library_Item_Media THe media info of the item.
	 */
	public function getMedia()
	{
		return $this->media;
	}
	
	/**
	 * Sets the media info of the item.
	 *
	 * @uses Plex_Server_Library_Item_Media()
	 * @uses Plex_Server_Library_ItemAbstract::$media
	 *
	 * @param string $media Raw media info that is to be converted into a media
	 * info object.
	 *
	 * @return void
	 */
	public function setMedia($media)
	{
		$mediaObject = new Plex_Server_Library_Item_Media(reset($media));
		$this->media = $mediaObject;
	}
}

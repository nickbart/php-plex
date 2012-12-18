<?php

/**
 * Plex Library Child Item
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
 * Base class that represents a Plex library item at the bottom of the 
 * Thierarchy. This includes items such as episodes and movies.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
abstract class Plex_Server_Library_ItemChildAbstract
	extends Plex_Server_Library_ItemParentAbstract {
	
	/**
	 * Unique integer that represents a grandparent item and helps build its 
	 * key string.
	 * @var integer
	 */
	protected $grandparentRatingKey;
	
	/**
	 * Grandparent item's key.
	 * @var string
	 */
	protected $grandparentKey;
	
	/**
	 * Grandparent item's title.
	 * @var string
	 */
	protected $grandparentTitle;
	
	/**
	 * Reference to the grandparent item's thumb.
	 * @var string
	 */
	protected $grandparentThumb;
	
	/**
	 * Duration of the item in seconds.
	 * @var integer
	 */
	protected $duration;
	
	/**
	 * How many seconds into the item of the last unfinished view.
	 * @var integer
	 */
	protected $viewOffset;
	
	/**
	 * Sets an array of attribues, if they exist, to the corresponding class
	 * member.
	 * 
	 * @param array $attribute An array of item attributes as passed back by the
	 * Plex HTTP API.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::setGrandparentRatingKey()
	 * @uses Plex_Server_Library_ItemChildAbstract::setGrandparentKey()
	 * @uses Plex_Server_Library_ItemChildAbstract::setGrandparentTitle()
	 * @uses Plex_Server_Library_ItemChildAbstract::setGrandparentThumb()
	 * @uses Plex_Server_Library_ItemChildAbstract::setDuration()
	 * @uses Plex_Server_Library_ItemChildAbstract::setViewOffset()
	 *
	 * @return void 
	 */
	public function setAttributes($attribute)
	{
		parent::setAttributes($attribute);
		
		if (isset($attribute['grandparentRatingKey'])) {
			$this->setGrandparentRatingKey($attribute['grandparentRatingKey']);
		}
		if (isset($attribute['grandparentKey'])) {
			$this->setGrandparentKey($attribute['grandparentKey']);
		}
		if (isset($attribute['grandparentTitle'])) {
			$this->setGrandparentTitle($attribute['grandparentTitle']);
		}
		if (isset($attribute['grandparentThumb'])) {
			$this->setGrandparentThumb($attribute['grandparentThumb']);
		}
		if (isset($attribute['duration'])) {
			$this->setDuration($attribute['duration']);
		}
		if (isset($attribute['viewOffset'])) {
			$this->setViewOffset($attribute['viewOffset']);
		}
	}

	/**
	 * Returns the grandparent item's rating key.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentRatingKey
	 *
	 * @return integer The grandparent item's rating key.
	 */
	public function getGrandparentRatingKey()
	{
		return (int) $this->grandparentRatingKey;
	}
	
	/**
	 * Sets the grandparent item's rating key.
	 *
	 * @param integer $grandparentRatingKey The grandparent item's rating key.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentRatingKey
	 *
	 * @return void
	 */
	public function setGrandparentRatingKey($grandparentRatingKey)
	{
		$this->grandparentRatingKey = (int) $grandparentRatingKey;
	}
	
	/**
	 * Returns the grandparent item's key.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentKey
	 *
	 * @return string The grandparent item's key.
	 */
	public function getGrandparentKey()
	{
		return $this->getGrandparentKey;
	}
	
	/**
	 * Sets the grandparent item's key.
	 *
	 * @param string $grandparentKey The grandparent item's key.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentKey
	 *
	 * @return void
	 */
	public function setGrandparentKey($grandparentKey)
	{
		$this->grandparentKey = $grandparentKey;
	}
	
	/**
	 * Returns the grandparent item's title.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentTitle
	 *
	 * @return string The grandparent item's title.
	 */
	public function getGrandparentTitle()
	{
		return $this->grandparentTitle;
	}
	
	/**
	 * Sets the grandparent item's title.
	 *
	 * @param string $grandparentTitle string The grandparent item's title.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentTitle
	 *
	 * @return void
	 */
	public function setGrandparentTitle($grandparentTitle)
	{
		$this->grandparentTitle = $grandparentTitle;
	}

	/**
	 * Returns the grandparent item's thumb.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentThumb
	 *
	 * @return string The grandparent item's thumb.
	 */
	public function getGrandparentThumb()
	{
		return $this->grandparentThumb;
	}
	
	/**
	 * Sets the grandparent item's thumb.
	 *
	 * @param string $parentTitle string The grandparent item's thumb.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$grandparentThumb
	 *
	 * @return void
	 */
	public function setGrandparentThumb($grandparentThumb)
	{
		$this->grandparentThumb = $grandparentThumb;
	}

	/**
	 * Returns the item's duration.
	 * 
	 * @uses Plex_Server_Library_ItemChildAbstract::$duration
	 * 
	 * @return integer The item's duration.
	 */
	public function getDuration()
	{
		return (int) $this->duration;
	}
	
	/**
	 * Sets the item's duration.
	 * 
	 * @param integer $duration The item's duration.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$duration
	 * 
	 * @return void
	 */
	public function setDuration($duration)
	{
		$this->duration = (int) $duration;
	}

	/**
	 * Returns the item's view offset.
	 * 
	 * @uses Plex_Server_Library_ItemChildAbstract::$viewOffset
	 * 
	 * @return integer The item's view offset.
	 */
	public function getViewOffset()
	{
		return (int) $this->viewOffset;
	}
	
	/**
	 * Sets the item's view offset.
	 * 
	 * @param integer $viewOffset The item's view offset.
	 *
	 * @uses Plex_Server_Library_ItemChildAbstract::$viewOffset
	 * 
	 * @return void
	 */
	public function setViewOffset($viewOffset)
	{
		$this->viewOffset = (int) $viewOffset;
	}
}

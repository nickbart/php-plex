<?php

/**
 * Plex Server Library Show Section
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
 * Class that represents a Plex library show section and allows retrieval of
 * Plex library shows and their seasons and episodes.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Server_Library_Section_Show
	extends Plex_Server_Library_SectionAbstract
{
	/**
	 * Endpoint for retrieving recently viewed shows.
	 */
	const ENDPOINT_CATEGORY_RECENTLY_VIEWED_SHOWS = 'recentlyViewedShows';
	
	/**
	 * Endpoint for retrieving shows by content rating.
	 */
	const ENDPOINT_CATEGORY_CONTENT_RATING = 'contentRating';
	
	/**
	 * Returns all the shows for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getAllItems()
	 *
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */
	public function getAllShows()
	{
		return $this->getAllItems();
	}
	
	/**
	 * Returns all the unwatched shows for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getUnwatchedItems()
	 *
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */
	public function getUnwatchedShows()
	{
		return $this->getUnwatchedItems();
	}
	
	/**
	 * Returns the recently aired episodes for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getNewestItems()
	 *
	 * @return Plex_Server_Library_Item_Episode[] An array of episodes.
	 */
	public function getRecentlyAiredEpisodes()
	{
		return $this->getNewestItems();
	}
	
	/**
	 * Returns the recently added episodes for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getRecentlyAddedSectionItems()
	 *
	 * @return Plex_Server_Library_Item_Episode[] An array of episodes.
	 */
	public function getRecentlyAddedEpisodes()
	{
		return $this->getRecentlyAddedSectionItems();
	}
	
	/**
	 * Returns the recently viewed episodes for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getRecentlyViewedItems()
	 *
	 * @return Plex_Server_Library_Item_Episode[] An array of episodes.
	 */
	public function getRecentlyViewedEpisodes()
	{
		return $this->getRecentlyViewedItems();
	}
	
	/**
	 * Returns the recently viewed shows for the given section.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Show::ENDPOINT_CATEGORY_RECENTLY_VIEWED_SHOWS
	 * 
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */
	public function getRecentlyViewedShows()
	{
		return $this->getItems(
			$this->buildEndpoint(self::ENDPOINT_CATEGORY_RECENTLY_VIEWED_SHOWS)
		);
	}
	
	/**
	 * Returns the on deck episodes for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getOnDeckItems()
	 *
	 * @return Plex_Server_Library_Item_Episode[] An array of episodes.
	 */
	public function getOnDeckEpisodes()
	{
		return $this->getOnDeckSectionItems();
	}
	
	/**
	 * Returns all the shows contained in a given collection.
	 *
	 * @param integer $collectionKey Key that represents the collection by which
	 * the shows will be retrieved. The genre key can be discovered by using
	 * the getGenres() method from the parent class.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByCollection()
	 *
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */
	public function getShowsByCollection($collectionKey)
	{
		return $this->getItemsByCollection($collectionKey);
	}
	
	/**
	 * Returns all shows in the section whose titles start with the given
	 * character.
	 *
	 * @param string $character The first character by which the movies will be
	 * retrieved.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByFirstCharacter()
	 *
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */
	public function getShowsByFirstCharacter($character)
	{
		return $this->getItemsByFirstCharacter($character);
	}
	
	/**
	 * Returns all the shows categorized under a given genre.
	 *
	 * @param integer $genreKey Key that represents the genre by which the 
	 * shows will be retrieved. The genre key can be discovered by using the 
	 * getGenres() method from the parent class.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByGenre()
	 * 
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */
	public function getShowsByGenre($genreKey)
	{
		return $this->getItemsByGenre($genreKey);
	}
	
	/**
	 * Returns all the shows from a given four digit year.
	 *
	 * @param integer $year Four digit year by which the shows will be 
	 * retrieved.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByYear()
	 * 
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */	
	public function getShowsByYear($year)
	{
		return $this->getItemsByYear($year);
	}

	/**
	 * Returns all the shows categorized under a given content rating.
	 *
	 * @param string $contentRating The content rating under which requested
	 * shows are categorized. Valid content ratings can be discovered by using
	 * the getContentRatings() method from this class.
	 * 
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_CONTENT_RATING
	 * 
	 * @return Plex_Server_Library_Item_Show[] An array of shows.
	 */
	public function getShowsByContentRating($contentRating)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%s',
					self::ENDPOINT_CATEGORY_CONTENT_RATING,
					$contentRating
				)
			)
		);
	}

	/**
	 * Returns a list of content ratings for the section. We use makeCall
	 * directly here because we want to return just the raw array of content
	 * ratings and not do any post processing on it.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_CONTENT_RATING
	 *
	 * @return array An array of content ratings with their names and keys.
	 */
	public function getContentRatings()
	{
		return $this->makeCall(
			$this->buildUrl(
				$this->buildEndpoint(self::ENDPOINT_CATEGORY_CONTENT_RATING)
			)
		);
	}
	
	/**
	 * Searches show titles for the passed query and returns the shows that
	 * match.
	 *
	 * @param string $query The search term against which the shows will be
	 * matched.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildSearchEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::SEARCH_TYPE_SHOW
	 *
	 * @return Plex_Server_Library_Item_Show[] An array of show objects.
	 */
	public function searchShows($query)
	{
		return $this->getItems(
			$this->buildSearchEndpoint(
				Plex_Server_Library_SectionAbstract::SEARCH_TYPE_SHOW,
				$query
			)
		);
	}

	/**
	 * Searches episode titles for the passed query and returns the episodes 
	 * that match.
	 *
	 * @param string $query The search term against which the episodes will be
	 * matched.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildSearchEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::SEARCH_TYPE_EPISODE
	 *
	 * @return Plex_Server_Library_Item_Episode[] An array of episode objects.
	 */
	public function searchEpisodes($query)
	{
		return $this->getItems(
			$this->buildSearchEndpoint(
				Plex_Server_Library_SectionAbstract::SEARCH_TYPE_EPISODE,
				$query
			)
		);
	}
	
	/**
	 * Returns a single show by its rating key, key, or exact title match.
	 *
	 * @param integer|string $polymorphicData Either a rating key, a key, or a
	 * title for an exact title match that will be used to retrieve a single
	 * show.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 *
	 * @retrun Plex_Server_Library_Item_Show A Plex library show object.
	 */
	public function getShow($polymorphicData)
	{
		return $this->getPolymorphicItem($polymorphicData);
	}
	
	/**
	 * Returns a single episode by its rating key, key, or exact title match.
	 *
	 * @param integer|string $polymorphicData Either a rating key, a key, or a
	 * title for an exact title match that will be used to retrieve a single
	 * episode.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 *
	 * @retrun Plex_Server_Library_Item_Episode A Plex library episode object.
	 */
	public function getEpisode($polymorphicData)
	{
		return $this->getPolymorphicItem($polymorphicData);	
	}
}

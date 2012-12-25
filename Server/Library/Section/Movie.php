<?php

/**
 * Plex Server Library Movie Section
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
 * Class that represents a Plex library movie section and allows retrieval of
 * Plex library movies.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Server_Library_Section_Movie 
	extends Plex_Server_Library_SectionAbstract
{
	/**
	 * Endpoint for retrieving movies by four digit decade.
	 */
	const ENDPOINT_CATEGORY_DECADE = 'decade';
	
	/**
	 * Endpoint for retrieving movies by director.
	 */
	const ENDPOINT_CATEGORY_DIRECTOR = 'director';
	
	/**
	 * Endpoint for retrieving movies by actor.
	 */
	const ENDPOINT_CATEGORY_ACTOR = 'actor';
	
	/**
	 * Endpoint for retrieving movies by content rating.
	 */
	const ENDPOINT_CATEGORY_CONTENT_RATING = 'contentRating';
	
	/**
	 * Endpoint for retrieving movies by resolution.
	 */
	const ENDPOINT_CATEGORY_RESOLUTION = 'resolution';
	
	/**
	 * Returns all the movies for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getAllItems()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getAllMovies()
	{
		return $this->getAllItems();
	}
	
	/**
	 * Returns all the unwatched movies for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getUnwatchedItems()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getUnwatchedMovies()
	{
		return $this->getUnwatchedItems();
	}
	
	/**
	 * Returns the recently released movies for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getNewestItems()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getRecentlyReleasedMovies()
	{
		return $this->getNewestItems();
	}
	
	/**
	 * Returns the recently added movies for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getRecentlyAddedSectionItems()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getRecentlyAddedMovies()
	{
		return $this->getRecentlyAddedSectionItems();
	}
	
	/**
	 * Returns the recently viewed movies for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getRecentlyViewedItems()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getRecentlyViewedMovies()
	{
		return $this->getRecentlyViewedItems();
	}

	/**
	 * Returns the on deck movies for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getOnDeckItems()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getOnDeckMovies()
	{
		return $this->getOnDeckSectionItems();
	}
	
	/**
	 * Returns all the movies contained in a given collection.
	 *
	 * @param integer $collectionKey Key that represents the collection by which
	 * the movies will be retrieved. The genre key can be discovered by using
	 * the getGenres() method from the parent class.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByCollection()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getMoviesByCollection($collectionKey)
	{
		return $this->getItemsByCollection($collectionKey);
	}
	
	/**
	 * Returns all the movies categorized under a given genre.
	 *
	 * @param integer $genreKey Key that represents the genre by which the 
	 * movies will be retrieved. The genre key can be discovered by using the 
	 * getGenres() method from the parent class.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByGenre()
	 * 
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getMoviesByGenre($genreKey)
	{
		return $this->getItemsByGenre($genreKey);
	}

	/**
	 * Returns all the movies from a given four digit year.
	 *
	 * @param integer $year Four digit year by which the movies will be 
	 * retrieved.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByYear()
	 * 
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */	
	public function getMoviesByYear($year)
	{
		return $this->getItemsByYear($year);
	}
	
	/**
	 * Returns all the movies from a given four digit decade.
	 *
	 * @param integer $decade Four digit decade by which the movies will be 
	 * retrieved.
	 * 
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_DECADE
	 * 
	 * @return Plex_Server_Library_Item_Movies[] An array of movies.
	 */
	public function getMoviesByDecade($decade)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%d',
					self::ENDPOINT_CATEGORY_DECADE,
					$decade
				)
			)
		);
	}

	/**
	 * Returns all the movies categorized under a given director.
	 *
	 * @param integer $directorKey Key that represents the genre by which the 
	 * movies will be retrieved. The director key can be discovered by using the
	 * getDirectors() method from this class.
	 * 
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_DIRECTOR
	 * 
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getMoviesByDirector($directorKey)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%d',
					self::ENDPOINT_CATEGORY_DIRECTOR,
					$directorKey
				)
			)
		);
	}

	/**
	 * Returns all the movies categorized under a given actor.
	 *
	 * @param integer $actorKey Key that represents the genre by which the
	 * movies will be retrieved. The actor key can be discovered by using the
	 * getActors() method from this  class.
	 * 
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_ACTOR
	 * 
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getMoviesByActor($actorKey)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%d',
					self::ENDPOINT_CATEGORY_ACTOR,
					$actorKey
				)
			)
		);
	}
	
	/**
	 * Returns all the movies categorized under a given content rating.
	 *
	 * @param string $contentRating The content rating under which requested
	 * movies are categorized. Valid content ratings can be discovered by using
	 * the getContentRatings() method from this class.
	 * 
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_CONTENT_RATING
	 * 
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getMoviesByContentRating($contentRating)
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
	 * Returns all the movies categorized under a given resolution.
	 *
	 * @param string $resolution The resolution under which requested movies are
	 * categorized. Valid resolutions can be discovered by using the 
	 * getResolutions() method from this class.
	 * 
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_RESOLUTION
	 * 
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getMoviesByResolution($resolution)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%s',
					self::ENDPOINT_CATEGORY_RESOLUTION,
					$resolution
				)
			)
		);
	}
	
	/**
	 * Returns all movies in the section whose titles start with the given
	 * character.
	 *
	 * @param string $character The first character by which the movies will be
	 * retrieved.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByFirstCharacter()
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movies.
	 */
	public function getMoviesByFirstCharacter($character)
	{
		return $this->getItemsByFirstCharacter($character);
	}
	
	/**
	 * Returns a list of directors for the section. We use makeCall directly
	 * here, because we want to return just the raw array of directors and not
	 * do any post processing on it.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_DIRECTOR
	 *
	 * @return array An array of directors with their names and keys.
	 */
	public function getDirectors()
	{
		return $this->makeCall(
			$this->buildUrl(
				$this->buildEndpoint(self::ENDPOINT_CATEGORY_DIRECTOR)
			)
		);
	}
	
	/**
	 * Returns a list of actors for the section. We use makeCall directly here
	 * because we want to return just the raw array of actors and not do any
	 * post processing on it.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_ACTOR
	 *
	 * @return array An array of actors with their names and keys.
	 */
	public function getActors()
	{
		return $this->makeCall(
			$this->buildUrl(
				$this->buildEndpoint(self::ENDPOINT_CATEGORY_ACTOR)
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
	 * Returns a list of resolutions for the section. We use makeCall directly
	 * here because we want to return just the raw array of resolutions and not
	 * do any post processing on it.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::ENDPOINT_CATEGORY_RESOLUTION
	 *
	 * @return array An array of resolutions with their names and keys.
	 */
	public function getResolutions()
	{
		return $this->makeCall(
			$this->buildUrl(
				$this->buildEndpoint(self::ENDPOINT_CATEGORY_RESOLUTION)
			)
		);
	}
	
	/**
	 * Searches moview titles for the passed query and returns the movies that
	 * match.
	 *
	 * @param string $query The search term against which the movies will be
	 * matched.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildSearchEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::SEARCH_TYPE_MOVIE
	 *
	 * @return Plex_Server_Library_Item_Movie[] An array of movie objects.
	 */
	public function searchMovies($query)
	{
		return $this->getItems(
			$this->buildSearchEndpoint(
				Plex_Server_Library_SectionAbstract::SEARCH_TYPE_MOVIE,
				$query
			)
		);
	}

	/**
	 * Returns a single movie by its rating key, key, or exact title match.
	 *
	 * @param integer|string $polymorphicData Either a rating key, a key, or a
	 * title for an exact title match that will be used to retrieve a single
	 * mvoie.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 *
	 * @retrun Plex_Server_Library_Item_Movie A Plex library movie object.
	 */	
	public function getMovie($polymorphicData)
	{
		return $this->getPolymorphicItem($polymorphicData);
	}
}

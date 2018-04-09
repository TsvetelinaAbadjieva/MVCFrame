<?php


class MoviesEntity extends Entity
{
    protected $id;
    protected $title;
    protected $description;
    protected $duration;
    protected $year;
    protected $genres;
    protected $director;
    protected $writers;
    protected $cast;
    protected $rating;
    protected $cover_photo;
    protected $youtube_link;
    protected $language;
    protected $movies_categories_id;
    protected $category_title;

    /**
     * @return mixed
     */
    public function getCategoryTitle()
    {
        return $this->category_title;
    }

    /**
     * @param mixed $category_title
     */
    public function setCategoryTitle($category_title)
    {
        $this->category_title = $category_title;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getWriters()
    {
        return $this->writers;
    }

    /**
     * @param mixed $writers
     */
    public function setWriters($writers)
    {
        $this->writers = $writers;
    }

    /**
     * @return mixed
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @param mixed $cast
     */
    public function setCast($cast)
    {
        $this->cast = $cast;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getCoverPhoto()
    {
        return $this->cover_photo;
    }

    /**
     * @param mixed $cover_photo
     */
    public function setCoverPhoto($cover_photo)
    {
        $this->cover_photo = $cover_photo;
    }

    /**
     * @return mixed
     */
    public function getYoutubeLink()
    {
        return $this->youtube_link;
    }

    /**
     * @param mixed $youtube_link
     */
    public function setYoutubeLink($youtube_link)
    {
        $this->youtube_link = $youtube_link;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getMoviesCategoriesId()
    {
        return $this->movies_categories_id;
    }

    /**
     * @param mixed $movies_categories_id
     */
    public function setMoviesCategoriesId($movies_categories_id)
    {
        $this->movies_categories_id = $movies_categories_id;
    }






}
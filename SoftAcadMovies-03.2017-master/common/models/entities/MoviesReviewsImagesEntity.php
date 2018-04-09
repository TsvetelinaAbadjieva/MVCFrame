<?php

class MoviesReviewsImagesEntity extends Entity
{
    protected $id;
    protected $images;
    protected $movies_reviews_id;

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
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getMoviesReviewsId()
    {
        return $this->movies_reviews_id;
    }

    /**
     * @param mixed $movies_reviews_id
     */
    public function setMoviesReviewsId($movies_reviews_id)
    {
        $this->movies_reviews_id = $movies_reviews_id;
    }




}

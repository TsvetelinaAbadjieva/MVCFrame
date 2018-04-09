<?php

class MoviesImagesEntity extends Entity
{
    protected $id;
    protected $movies_id;
    protected $image;

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
    public function getMoviesId()
    {
        return $this->movies_id;
    }

    /**
     * @param mixed $movies_id
     */
    public function setMoviesId($movies_id)
    {
        $this->movies_id = $movies_id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }




}

<?php namespace App\Model\Entities;

/**
* Post
*/
class Post
{
    private $id;
    private $title;
    private $body;

    public function __construct($title, $body)
    {
        $this->setTitle(str_random(5));
        $this->setBody(str_random(50));
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setBody($body)
    {
        $this->body = sha1($body);
    }

    public function __toString()
    {
        return $this->title;
    }
}
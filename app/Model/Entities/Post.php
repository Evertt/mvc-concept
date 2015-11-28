<?php namespace App\Model\Entities;

/**
* Post
*/
class Post implements \ArrayAccess
{
    use Traits\AccessibleProperties;
    
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

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = sha1($body);
    }
}
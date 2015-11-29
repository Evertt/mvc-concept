<?php namespace App\Model\Repositories;

use Framework\ORM;
use App\Contracts\Listable;
use App\Model\Entities\Post;

/**
* Post repository
*/
class PostRepository implements Listable
{
    private $orm;

    public function __construct(ORM $orm)
    {
        $this->orm = $orm->setEntity(Post::class);
    }

    public function getList()
    {
        $posts = $this->orm->getAll();

        return $posts->lists('body', 'title');
    }
}
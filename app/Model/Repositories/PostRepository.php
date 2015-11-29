<?php namespace App\Model\Repositories;

use Framework\Repository;
use App\Contracts\Listable;

/**
* Post repository
*/
class PostRepository extends Repository implements Listable
{
    public function getList()
    {
        $posts = $this->orm->getAll();

        return $posts->lists('body', 'title');
    }
}
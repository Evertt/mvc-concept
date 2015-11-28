<?php namespace App\Model\Repositories;

use App\Contracts\Listable;
use Illuminate\Support\Collection;

/**
* Post repository
*/
class PostRepository extends Repository implements Listable
{
    public function getList()
    {
        $entities   = $this->orm->getAll();
        $collection = new Collection($entities);

        return $collection;
    }
}
<?php namespace App\Views;

use App\Contracts\Listable;

/**
* A list view
*/
class ListView
{
    private $repository;

    public function __construct(Listable $repository)
    {
        $this->repository = $repository;
    }

    public function getItems()
    {
        return $this->repository->getList();
    }
}
<?php namespace App\Controllers;

use App\Contracts\Paginatable;

/**
* Page Controller
*/
class PageController
{
    private $repository;

    public function __construct(Paginatable $repository)
    {
        $this->repository = $repository;
    }

    public function index($page)
    {
        $this->repository->setPage($page);
    }
}
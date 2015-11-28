<?php namespace App\Controllers;

use App\Contracts\Paginatable;

/**
* Page Controller
*/
class PageController
{
    private $repository;

    function __construct(Paginatable $repository)
    {
        $this->repository = $repository;
    }

    function index($page)
    {
        $this->repository->setPage($page);
    }
}
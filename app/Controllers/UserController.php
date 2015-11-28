<?php namespace App\Controllers;

use App\Model\Repositories\UserRepository;

/**
* User Controller
*/
class UserController
{
    private $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    function index($page)
    {
        $this->repository->setPage($page);
    }
}
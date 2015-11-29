<?php namespace App\Model\Repositories;

use Framework\Repository;
use App\Contracts\Listable;
use App\Contracts\Paginatable;

/**
* User repository
*/
class UserRepository extends Repository implements Listable, Paginatable
{
    private $page = 1;
    private $perPage = 5;

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    public function getList()
    {
        $users  = $this->orm->getAll();
        $emails = $users->lists('email');

        return $emails->forPage($this->page, $this->perPage);
    }
}
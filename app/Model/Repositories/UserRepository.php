<?php namespace App\Model\Repositories;

use App\Contracts\Listable;
use App\Contracts\Paginatable;
use Illuminate\Support\Collection;

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
        $entities = $this->orm->getAll();
        $emails = (new Collection($entities))->lists('email');

        return $emails->forPage($this->page, $this->perPage);
    }
}
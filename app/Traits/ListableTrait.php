<?php namespace App\Traits;

trait ListableTrait
{
    protected $page = 1;
    protected $perPage = 5;

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getList()
    {
        $entities = collect($this->orm->getAll());

        return $entities->forPage($this->page, $this->perPage);
    }
}
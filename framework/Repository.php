<?php namespace Framework;

/**
* Repository
*/
abstract class Repository
{
    protected $orm;

    public function __construct(ORM $orm)
    {
        // initFromRepository is used so
        // that the orm can determine which
        // table and entity-class to use
        $this->orm = $orm->initFromRepository($this);
    }
}
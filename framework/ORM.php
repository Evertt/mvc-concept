<?php namespace Framework;

use Illuminate\Support\Collection;
/**
* This is just here as a mock.
* IRL I would use doctrine or something like that...
*/
class ORM
{
    private $entity;

    public function initFromRepository($repository)
    {
        $repositoryName = class_basename($repository);
        $entityName = substr($repositoryName, 0, -10);

        $this->entity = config('namespaces.entities') . "\\$entityName";

        return $this;
    }

    public function getAll()
    {
        $entities = new Collection;

        foreach(range(1,100) as $i) {
            $entities->push(new $this->entity("mail{$i}@example.com", str_random(8)));
        }

        return $entities;
    }
}
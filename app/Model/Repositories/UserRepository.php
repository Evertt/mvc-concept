<?php namespace App\Model\Repositories;

use App\Contracts\Listable;
use App\Traits\ListableTrait;

/**
* User repository
*/
class UserRepository extends Repository implements Listable
{
    use ListableTrait;
}
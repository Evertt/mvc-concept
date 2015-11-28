<?php namespace App\Contracts;

interface Paginatable {
    public function getPage();
    public function setPage($page);
    
    public function getPerPage();
    public function setPerPage($perPage);
}
<?php namespace App\Model\Entities;

/**
* User
*/
class User implements \ArrayAccess
{
    use Traits\AccessibleProperties;
    
    private $id;
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
}
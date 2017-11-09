<?php

namespace App\Association\Entity;

use App\Pc\Entity\Pc;
use App\Users\Entity\User;

class Association
{
    protected $id;
    protected $User;
    protected $Pc;

    public function __construct($id, User $user, Pc $pc)
    {
        $this->id = $id;
        $this->User = $user;
        $this->Pc = $pc;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUser(User $user)
    {
        $this->User = $user;
    }

    public function setComputer(Pc $pc)
    {
        $this->Pc = $pc;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUser()
    {
        return $this->User;
    }
    public function getPc()
    {
        return $this->Pc;
    }
}

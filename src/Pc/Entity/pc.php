<?php

namespace App\Pc\Entity;

class Pc
{
    protected $id;

    protected $marque;

    public function __construct($id, $marque)
    {
        $this->id = $id;
        $this->marque = $marque;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getMarque()
    {
        return $this->marque;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['marque'] = $this->marque;

        return $array;
    }
}

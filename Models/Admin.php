<?php

namespace Models;

use Models\IUser as IUser;

class Admin implements IUser
{

    private $id;
    private $email;
    private $password;
    private $name;
    private $active;

    public function __construct($id = null, $email = null, $password = null, $name = null, $active=null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->active = $active;
    }

    public static function fromArray($array)
    {
        $id = null;
        $email = null;
        $password = null;
        $name = null;
        $active = null;

        if (isset($array["id"])) {
            $id = $array["id"];
        } else {
            $id = null;
        }
        if (isset($array["Email"])) {
            $email = $array["Email"];
        } else {
            $email = null;
        }
        if (isset($array["Password"])) {
            $password = $array["Password"];
        } else {
            $password = null;
        }
        if (isset($array["Name"])) {
            $name = $array["Name"];
        } else {
            $name = null;
        }
        if (isset($array["Active"])) {
            $active = $array["Active"];
        } else {
            $active = null;
        }


        return new self($id, $email, $password, $name, $active);
    }


    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of active
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }
}

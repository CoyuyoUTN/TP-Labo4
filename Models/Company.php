<?php
namespace Models;

use Models\User as User;


class Company extends User{

private $cuil;
private $name;
private $category;
private $state;
private $description;


public function __construct($email,$password,$cuil,$name,$category,$state,$description){
    parent::__construct($email,$password);

    $this->cuil=$cuil;
    $this->name=$name;
    $this->category=$category;
    $this->state=$state;
    $this->description=$description;
}















/**
 * Get the value of cuil
 */ 
public function getCuil()
{
return $this->cuil;
}

/**
 * Set the value of cuil
 *
 * @return  self
 */ 
public function setCuil($cuil)
{
$this->cuil = $cuil;

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
 * Get the value of category
 */ 
public function getCategory()
{
return $this->category;
}

/**
 * Set the value of category
 *
 * @return  self
 */ 
public function setCategory($category)
{
$this->category = $category;

return $this;
}

/**
 * Get the value of state
 */ 
public function getState()
{
return $this->state;
}

/**
 * Set the value of state
 *
 * @return  self
 */ 
public function setState($state)
{
$this->state = $state;

return $this;
}

/**
 * Get the value of description
 */ 
public function getDescription()
{
return $this->description;
}

/**
 * Set the value of description
 *
 * @return  self
 */ 
public function setDescription($description)
{
$this->description = $description;

return $this;
}
}





















?>
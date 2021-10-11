<?php
namespace Models;

class Company{


private $name;
private $cuil;


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
}

?>
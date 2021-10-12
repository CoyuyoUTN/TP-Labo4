<?php
namespace Models;

class Company{


private $name;
private $cuil;
private $id;


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
}

?>
<?php  

namespace Models;

class Admin{

private $id;
private $email="admin@gmail.com";
private $password="adminadmin";
private $careerId;




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
 * Get the value of careerId
 */ 
public function getCareerId()
{
return $this->careerId;
}

/**
 * Set the value of careerId
 *
 * @return  self
 */ 
public function setCareerId($careerId)
{
$this->careerId = $careerId;

return $this;
}
}
?>
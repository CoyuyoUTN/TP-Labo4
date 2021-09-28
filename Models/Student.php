<?php

namespace Models;

class Student{

 private $name;
 private $lastName;
 private $yearOfBird;
 private $carrear;





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
  * Get the value of lastName
  */ 
 public function getLastName()
 {
  return $this->lastName;
 }

 /**
  * Set the value of lastName
  *
  * @return  self
  */ 
 public function setLastName($lastName)
 {
  $this->lastName = $lastName;

  return $this;
 }

 /**
  * Get the value of yearOfBird
  */ 
 public function getYearOfBird()
 {
  return $this->yearOfBird;
 }

 /**
  * Set the value of yearOfBird
  *
  * @return  self
  */ 
 public function setYearOfBird($yearOfBird)
 {
  $this->yearOfBird = $yearOfBird;

  return $this;
 }

 /**
  * Get the value of carrear
  */ 
 public function getCarrear()
 {
  return $this->carrear;
 }

 /**
  * Set the value of carrear
  *
  * @return  self
  */ 
 public function setCarrear($carrear)
 {
  $this->carrear = $carrear;

  return $this;
 }
}
















?>
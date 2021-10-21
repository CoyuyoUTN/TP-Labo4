<?php
namespace Models;

class Company{


private $name;
private $cuil;
private $id;
private $img;
private $shortDesc;
private $ranking;
private $email;
private $phone;
private $city;
private $address;
private $jobOffers;
private $bio;
private $linkedin;
private $webpage;
private $facebook;

function __construct(
        $name=null,
        $cuil=null,
        $id=null,
        $img=null,
        $shortDesc=null,
        $ranking=null,
        $email=null,
        $phone=null,
        $city=null,
        $address=null,
        $jobOffers=null,
        $bio=null,
        $linkedin=null,
        $webpage=null,
        $facebook=null
    ){

    $this->name = $name;
    $this->cuil = $cuil;
    $this->id = $id;
    $this->img = $img;
    $this->shortDesc = $shortDesc;
    $this->ranking = $ranking;
    $this->email = $email;
    $this->phone = $phone;
    $this->city = $city;
    $this->address = $address;
    $this->jobOffers = $jobOffers;
    $this->bio = $bio;
    $this->linkedin = $linkedin;
    $this->webpage = $webpage;
    $this->facebook = $facebook;
}

public static function fromJson($json): static{
    if(isset($json["Name"])){
        $name = $json["Name"];
    }
    else{
        $name = null;
    }
    if(isset($json["CUIL"])){
        $cuil = $json["CUIL"];
    }
    else{
        $cuil = null;
    }
    if(isset($json["id"])){
        $id = $json["id"];
    }
    else{
        $id = null;
    }
    if(isset($json["img"])){
        $img = $json["img"];
    }
    else{
        $img = null;
    }
    if(isset($json["shortDesc"])){
        $shortDesc = $json["shortDesc"];
    }
    else{
        $shortDesc = null;
    }
    if(isset($json["ranking"])){
        $ranking = $json["ranking"];
    }
    else{
        $ranking = null;
    }
    if(isset($json["email"])){
        $email = $json["email"];
    }
    else{
        $email = null;
    }
    if(isset($json["phone"])){
        $phone = $json["phone"];
    }
    else{
        $phone = null;
    }
    if(isset($json["city"])){
        $city = $json["city"];
    }
    else{
        $city = null;
    }
    if(isset($json["address"])){
        $address = $json["address"];
    }
    else{
        $address = null;
    }
    if(isset($json["jobOffers"])){
        $jobOffers = $json["jobOffers"];
    }
    else{
        $jobOffers = null;
    }
    if(isset($json["bio"])){
        $bio = $json["bio"];
    }
    else{
        $bio = null;
    }
    if(isset($json["linkedin"])){
        $linkedin = $json["linkedin"];
    }
    else{
        $linkedin = null;
    }
    if(isset($json["webpage"])){
        $webpage = $json["webpage"];
    }
    else{
        $webpage = null;
    }
    if(isset($json["facebook"])){
        $facebook = $json["facebook"];
    }
    else{
        $facebook = null;
    }

    return new static($name,$cuil,$id,$img,$shortDesc,$ranking,$email,$phone,$city,$address,$jobOffers,$bio,$linkedin,$webpage,$facebook);
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

/**
 * Get the value of img
 */ 
public function getImg()
{
return $this->img;
}

/**
 * Set the value of img
 *
 * @return  self
 */ 
public function setImg($img)
{
$this->img = $img;

return $this;
}

/**
 * Get the value of shortDesc
 */ 
public function getShortDesc()
{
return $this->shortDesc;
}

/**
 * Set the value of shortDesc
 *
 * @return  self
 */ 
public function setShortDesc($shortDesc)
{
$this->shortDesc = $shortDesc;

return $this;
}

/**
 * Get the value of ranking
 */ 
public function getRanking()
{
return $this->ranking;
}

/**
 * Set the value of ranking
 *
 * @return  self
 */ 
public function setRanking($ranking)
{
$this->ranking = $ranking;

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
 * Get the value of phone
 */ 
public function getPhone()
{
return $this->phone;
}

/**
 * Set the value of phone
 *
 * @return  self
 */ 
public function setPhone($phone)
{
$this->phone = $phone;

return $this;
}

/**
 * Get the value of city
 */ 
public function getCity()
{
return $this->city;
}

/**
 * Set the value of city
 *
 * @return  self
 */ 
public function setCity($city)
{
$this->city = $city;

return $this;
}

/**
 * Get the value of address
 */ 
public function getAddress()
{
return $this->address;
}

/**
 * Set the value of address
 *
 * @return  self
 */ 
public function setAddress($address)
{
$this->address = $address;

return $this;
}

/**
 * Get the value of jobOffers
 */ 
public function getJobOffers()
{
return $this->jobOffers;
}

/**
 * Set the value of jobOffers
 *
 * @return  self
 */ 
public function setJobOffers($jobOffers)
{
$this->jobOffers = $jobOffers;

return $this;
}

/**
 * Get the value of bio
 */ 
public function getBio()
{
return $this->bio;
}

/**
 * Set the value of bio
 *
 * @return  self
 */ 
public function setBio($bio)
{
$this->bio = $bio;

return $this;
}

/**
 * Get the value of linkedin
 */ 
public function getLinkedin()
{
return $this->linkedin;
}

/**
 * Set the value of linkedin
 *
 * @return  self
 */ 
public function setLinkedin($linkedin)
{
$this->linkedin = $linkedin;

return $this;
}

/**
 * Get the value of webpage
 */ 
public function getWebpage()
{
return $this->webpage;
}

/**
 * Set the value of webpage
 *
 * @return  self
 */ 
public function setWebpage($webpage)
{
$this->webpage = $webpage;

return $this;
}

/**
 * Get the value of facebook
 */ 
public function getFacebook()
{
return $this->facebook;
}

/**
 * Set the value of facebook
 *
 * @return  self
 */ 
public function setFacebook($facebook)
{
$this->facebook = $facebook;

return $this;
}
}

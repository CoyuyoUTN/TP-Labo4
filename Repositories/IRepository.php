<?php
  namespace Repositories;
  
  interface IRepository {
    function Add($element);
    function GetAll();
  }
?>
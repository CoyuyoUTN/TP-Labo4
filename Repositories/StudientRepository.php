<?php

namespace Repositories;

require_once "__DIR__/../Config/Autoload.php";

use Repositories\IRepository as IRepository;
use Models\Student as Student;

class StudientRepository implements IRepository
{
    private $fileName;

    function GetAll()
    {
        $opts = array(
            'http' =>
            array(
                'method' => 'GET',
                'header' => 'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            )
        );

        $context = stream_context_create($opts);

        $result = file_get_contents('https://utn-students-api.herokuapp.com/api/Student', false, $context);

        return $result;
    }

    function Add($element)
    {
        return null;
    }

    function GetElementByID($id){
        $array = $this->GetAll();
        $ret = null;

        foreach($array as $element){
            if($element['studentId'] == $id){
                $ret = $element;
            }
        }

        return $element;
    }
}

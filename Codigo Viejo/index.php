<?php

function getStudientDatabase(){
    $opts = array('http' => 
        array(
            'method'=>'GET',
            'header'=>'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        )
    );

    $context = stream_context_create($opts);

    $result = file_get_contents('https://utn-students-api.herokuapp.com/api/Student',false,$context);

    return $result;
}

function getCareerDatabase(){
    $opts = array('http' => 
        array(
            'method'=>'GET',
            'header'=>'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        )
    );

    $context = stream_context_create($opts);

    $result = file_get_contents('https://utn-students-api.herokuapp.com/api/Career',false,$context);

    return $result;
}

function getJobsDatabase(){
    $opts = array('http' => 
        array(
            'method'=>'GET',
            'header'=>'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        )
    );

    $context = stream_context_create($opts);

    $result = file_get_contents('https://utn-students-api.herokuapp.com/api/JobPosition',false,$context);

    return $result;
}

?>
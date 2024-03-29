<?php

namespace DAO;

use Models\JobPosition as JobPosition;

class JobPositionDAO
{
    private $jobPositionList;
    private static $instance;

    /**
     * Constructor de la clase donde ya carga de manera automatica la lista de posiciones con los datos de la api.
     */
    function __construct()
    {
        $this->jobPositionList = array();

        $opt = array(
            "http" => array(
                "method" => "GET",
                "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
            )
        );

        $ctx = stream_context_create($opt);

        $aux = file_get_contents("https://utn-students-api.herokuapp.com/api/JobPosition", false, $ctx);
        $array = ($aux) ? json_decode($aux, true) : array();

        foreach ($array as $value) {
            array_push($this->jobPositionList, new JobPosition($value["jobPositionId"], $value["careerId"], $value["description"]));
        }
    }

    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function getAll()
    {
        return $this->jobPositionList;
    }

    /**
     * Retorna una posicion por id.
     * @param id de la posicion.
     */
    function getById($id)
    {
        $ret = new JobPosition;
        foreach ($this->jobPositionList as $value) {
            if ($value->getJobPositionId() == $id) {
                $ret = $value;
            }
        }
        return $ret;
    }

    /**
     * Busca uns posicion por la descripcion en la lista cargada por la api
     * @param descripcion de la posicion.
     */

    function searchByDescription($description)
    {
        $prueba = $description;
        $ret = array();

        foreach ($this->jobPositionList as $value) {
            if (!is_array($prueba)) {
                if (str_contains($value->getDescription(), $prueba)) {
                    array_push($ret, $value);
                }
            }
        }
        return $ret;
    }

    /**
     * Obtiene una lista cargada con las posiciones donde estas pertenezcan a una misma carrera
     * @param el id de la carrera
     */

    public function getJobsPositionsForCareerId($careerId)
    {

        $listJobsPosition = array();
     
        for ($i = 0; $i < count($this->jobPositionList); $i++) {

            if ($this->jobPositionList[$i]->getCareerId() == $careerId) {

                $jobPosition = new JobPosition();

                $jobPosition->setDescription($this->jobPositionList[$i]->getDescription());
                $jobPosition->setJobPositionId($this->jobPositionList[$i]->getJobPositionId());
                $jobPosition->setCareerId($this->jobPositionList[$i]->getCareerId());

                array_push($listJobsPosition, $jobPosition);  // retorna todas las jobPosition para ese career id
            }
        }

        return $listJobsPosition;
    }
}

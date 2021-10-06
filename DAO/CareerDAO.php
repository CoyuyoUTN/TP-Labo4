<?php
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;


    

    class CareerDao implements ICareerDAO
    {
        private $careerList = array();

        public function Add(Career $career)
        {
            $this->RetrieveData();
            
            array_push($this->careerList, $career);

            //$this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->careerList;
        }

       

        function existeKey($key1,$array){
            $bool=0;
            $valueAux="";
            foreach($array as $key=>$value){
                if($key1==$key){
                    $bool=1;
                    $valueAux=$value;
                }
        }
                if($bool==1){
                    echo "existe key, su valor es  ".$valueAux;
                }
                else{
                    echo "No existe key";
        }
        }

        private function RetrieveData()
        {
            $this->careerList = array();

           
            $opt = array(
                "http" => array(
                  "method" => "GET",
                  "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
                )
              );
              
              $ctx = stream_context_create($opt);
              
              echo file_get_contents("https://utn-students-api.herokuapp.com/api/Career", false, $ctx);
               

                foreach($ctx as $valuesArray)
                {
                    $career = new Career();
                    $career->setCareerId($valuesArray["careerId"]);
                    $career->setDescription($valuesArray["description"]);
                    $career->setActive($valuesArray["active"]);

                    array_push($this->careerList, $career);
                }
            
        }
       

    }
?>
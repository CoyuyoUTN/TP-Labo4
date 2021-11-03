<?php
    namespace DAO;
    
    class NavDAO
    {
        static function getNav(){
            $ret = null;
            switch (get_class($_SESSION["loggedUser"])) {
                case 'Models\Admin':
                    $ret = "navADMIN.php";
                    break;
            
                case ' Models\Admin':
                    $ret = "nav.php";
                    break;
                default:
                    $ret = "nav.php";
                    break;
            }
            require_once(VIEWS_PATH . $ret);
        }
        static function getTableNav($table){
            $ret = null;
         
                switch ($table) {
                case 'Company':
                    $ret = "navCompanyAdmin.php";
                    break;
                    
            }
            require_once(VIEWS_PATH . $ret);
        }
        static function getTableNav1($table1){
            $ret = null;
         
                switch ($table1) {
                case 'Admin':
                    $ret = "navAdmins.php";
                    break;
                    
            }
            require_once(VIEWS_PATH . $ret);
        }
    }
    
?>
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
    }
?>
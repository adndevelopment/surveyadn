<?php
include("adodb5/adobd.inc.php");


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SurveyAd
 *
 * @author Diego
 */
class SurveyAd {
    //put your code here
    
    function connectMySqlDataBase()
    {
        try
        {
            $hostname = "190.7.192.3";
            $username = "root";
            $password = "D4t4L0t3d";
            $dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
            echo "Connected to MySQL<br>";
            
            
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }      
                
    }
    public function write()
    {
        echo "Hola";
    }
    
    
}

?>

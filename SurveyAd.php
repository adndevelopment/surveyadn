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
    public static $con;
    function Conectar()
    {
        try{
        $this->con = NewADOConnection("mssql"); //mssql_connect('190.7.192.3', 'adnSurvey', 'Com54.pas');
        }catch(Exception $ex)
        {
        echo $ex->getMessage();
        }
        
                    
        
    }
    
    
    
}

?>

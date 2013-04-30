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
    public $con;
    private $handle;
    function connectMySqlDataBase()
    {
        try
        {
            $this->con=mysqli_connect("190.7.192.3","root","D4t4L0t3d","survey");
            
            if (mysqli_connect_errno($this->con))
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                echo "It connected";
            }
            
            
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }      
        mysqli_close($this->con);
                
    }
    
    
    
}

?>

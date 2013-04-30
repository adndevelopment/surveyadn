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
    private $dbhandle;
    function connectMySqlDataBase()
    {
        try
        {
            $hostname = "190.7.192.3";
            $username = "root";
            $password = "D4t4L0t3d";
            $this->dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
            mysql_selectdb('survey', $this->dbhandle);
            //echo "Connected to MySQL<br>";
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }      
                
    }
    
    function closeMySqlDataBase()
    {
        try
        {
        mysql_close($this->dbhandle);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    function write()
    {
        echo "Hola";
    }
    
    function surveyS($_surveyName)
    {
        try
        {
            $this->connectMySqlDataBase();
            
            $res = mysql_query("call surveyS('$_surveyName')", $this->dbhandle);
            
            /*while($row = mysql_fetch_array($res))
            {
                echo $row['idSurvey']. ' ' .$row['nombre'];
                //echo '<br />';
            }*/
            $this->closeMySqlDataBase();
            return $res;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    function questionSType($_idSurvey)
    {
        try
        {
            $this->connectMySqlDataBase();
            $res = mysql_query("call questionSType('$_idSurvey')", $this->dbhandle);
            return $res;
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    function surveyI($_nombre)
    {
        try
        {
            $this->connectMysqlDataBase();
            mysql('survey', "call surveyI('$_nombre')", $this->dbhandle);
            //echo 'Se inserto la encuesta!';
            $this->closeMySqlDataBase();
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    function getPosibleAnswer($_idQuestion, $_questionType)
    {
        try
        {
            if(trim($_questionType) == 'boolean')
            {
                $this->connectMysqlDataBase();
                $res = mysql_query("call questionBoolS('$_idQuestion')", $this->dbhandle);
                return $res;
            }
            else if(trim($_questionType) == 'multipleselection')
            {
                $this->connectMysqlDataBase();
                $res = mysql_query("call questionMultipleSelectionS('$_idQuestion')", $this->dbhandle);
                return $res;
            }
            else if(trim($_questionType) == 'range')
            {
                $this->connectMysqlDataBase();
                $res = mysql_query("call questionRangeS('$_idQuestion')", $this->dbhandle);
                return $res;
            }
            
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    
    }
}
?>

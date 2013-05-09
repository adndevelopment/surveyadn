<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        include 'SurveyAd.php';
        $survey = new SurveyAd();
        //$survey->write();
        //$survey->connectMySqlDataBase();
        $Prueba = 'funciona esta bara o no??';
        //$survey->insertSurvey("prueba4");
        $row = $survey->surveyS('pruebaADN');
        $prueba = mysql_fetch_array($row);
        echo $prueba['idSurvey'];
        
        echo 'marica';
        
        ?>
    
    </body>
</html>

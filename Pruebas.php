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
        $survey->write();
        $survey->connectMySqlDataBase();
            
        
        
        ?>
    
    </body>
</html>
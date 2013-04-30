<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/cssSurvey.css" rel="stylesheet" type="text/css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        
        <title>Cuestionario ADN</title>
        <script>
        $(document).ready(function()
        {
            $("div:hidden").fadeIn(3000);
        });
        </script>
    </head>
    <body>
        <?php
        include ("SurveyAd.php");
        
        $surveyAd = new SurveyAd();
        
        $idSurvey  = $surveyAd->surveyS("pruebaADN");
        
        $preg = $surveyAd->questionSType($_idSurvey);
        
        ?>
        <div id="content">
            
            <div id="top">
            </div> 
                <form action="" method="POST">
                    <?php
                    while($row = mysql_fetch_array($preg)){
                        
                    ?>
                    <p>
                        1 - aaa
                    </p>
                    <?php
                    }
                    ?>
                </form>
                
            
            
            
            
        </div>
    </body>
</html>

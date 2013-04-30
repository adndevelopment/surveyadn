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

        $idSurvey = $surveyAd->surveyS("pruebaADN");
        $id = mysql_fetch_array($idSurvey);
        //echo $id['idSurvey'];
        $preg = $surveyAd->questionSType($id['idSurvey']);
        ?>
        <div id="content">

            <div id="top">
            </div> 
            <form action="" method="POST">
                <?php
                while ($row = mysql_fetch_array($preg)) {
                    echo '<p>' . $row['idQuestion'] . '-' . $row['question'] . '?</p>';

                    $opciones = $surveyAd->getPosibleAnswer($row['idQuestion'], $row['type']);

                    if (trim($row['type']) == 'multiple selection') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            echo'<preg><input type="checkbox" id="' . $row['idQuestion'] . '-' . $opc['idquetionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '</preg><br/>';
                        }
                    }

                    if (trim($row['type']) == 'boolean') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            echo'<preg><input type="radio" id="' . $row['idQuestion'] . '-' . $opc['idquetionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '</preg><br/>';
                        }
                    }


                    if (trim($row['type']) == 'range') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            for ($i = 0; i < $opc['value']; $i++) {
                                echo'<preg><input type="radio" id="' . $row['idQuestion'] . '-' . $opc['idquetionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '<preg><br/>';
                            }
                        }
                    }
                }
                ?>
            </form>





        </div>
    </body>
</html>

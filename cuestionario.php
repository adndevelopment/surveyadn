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
        session_start();

        if($_POST['Enviar'])
        {
            $completo=true;
            $preg = $_SESSION['preguntas'];
            foreach($preg as $respuesta)
                {
                    if(empty($respuesta))
                        {
                            $completo = false;
                        }
                }
            if($completo)
                {
                    header( 'Location: finalizar.php' ) ;
                }
        }
        $surveyAd = new SurveyAd();
        $listaResp = array();
        $idSurvey = $surveyAd->surveyS("pruebaADN");
        $id = mysql_fetch_array($idSurvey);
        //echo $id['idSurvey'];
        $preg = $surveyAd->questionSType($id['idSurvey']);
        ?>
        <div id="content">

            <div id="top">
            </div> 
            <form action="finalizar.php" method="POST">
                <?php
                while ($row = mysql_fetch_array($preg)) {
                    echo '<p>' . $row['idQuestion'] . '-' . $row['question'] . '?</p>';

                    $opciones = $surveyAd->getPosibleAnswer($row['idQuestion'], $row['type']);

                    if (trim($row['type']) == 'multiple selection') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            echo'<preg><input type="checkbox" id="' . $row['idQuestion'] . '-' . $opc['idquestionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '</preg><br/>';
                        }
                    }

                    if (trim($row['type']) == 'boolean') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            echo'<preg><input type="radio" id="' . $row['idQuestion'] . '-' . $opc['idquetionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '</preg><br/>';
                        }
                    }

                    $prim = true;
                    if (trim($row['type']) == 'range') {
                        echo '<table>';
                        while ($opc = mysql_fetch_array($opciones)) {
                            if($prim == true)
                                {
                                echo'<tr><th></th>';
                                for ($i = 1; $i <= $opc['value']; $i++) 
                                {
                                    echo'<th>'.$i.'</th>';
                                }
                                echo '</tr>';
                                $prim = false;
                                }
                            echo '<tr><td>';
                            echo  '<preg>'.$opc['description'].'</td>';
                            for ($i = 1; $i <= $opc['value']; $i++) {
                                echo '<td>';
                                echo '<input type="radio" id="' . $row['idQuestion'] . '-' . $opc['value'] . '" name="' . $row['idQuestion'] .'-'.$opc['idquestionRange']. '" value="' . $i . '">';
                                echo '</td>';
                                
                            }
                            echo'</preg>';
                        }
                        echo '</table>';
                    }
                }
                ?>
                
                <center>
                    <br/>
                    <br/>
                <input type="submit" value="Enviar">
                </center>
            </form>





        </div>
    </body>
</html>

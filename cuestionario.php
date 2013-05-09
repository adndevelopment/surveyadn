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
        include ("RespuestaEn.php");
        session_start();
        if(!empty($_SESSION['cliente']))
            {
            echo '<center>
                    <img src="img/acceso-denegado.jpg" alt="Survey under construction"/>
                    </center>';
            }else{
        if($_POST['Enviar'])
        {
            $completo=true;
            $pregL = $_SESSION['preguntas'];
            $pregT = $_SESSION['tipoPreguntas'];
            foreach($pregL as $respuesta)
                {
                echo $respuesta.'-valor:';
                echo $_POST[$respuesta].'<br/>';
                if(empty($_POST[$respuesta]))
                        {
                            $completo = false;
                        }
                }
                
            if($completo)
                {
                    
                    $cont =0;
                    $listaRespuestas = array();
                    foreach($pregL as $idRespuesta)
                        {
                            //$nombre = explode("",$idRespuesta);
                            $respuestaEn = new RespuestaEn();
                            $respuestaEn->setIdQuestion($idRespuesta);
                            $respuestaEn->setValue($_POST[$idRespuesta]);
                            if($_POST['comment']){$respuestaEn->setComment($_POST['comment']);}else{$respuestaEn->setComment($_POST['comment']);}
                            $respuestaEn->setIdTipo($pregT[$cont]);
                            $respuestaEn->setIdClient(4);
                            $cont = $cont +1;
                            array_push($listaRespuestas, $respuestaEn);
                            echo $respuestaEn->idQuestion;
                            
                        
                        }
                        
                    $_SESSION['listaRespuestas']=$listaRespuestas;
                    echo 'entra';
                    header("Location:finalizar.php") ;
                }
                else
                    {
                        print '<script type="text/javascript">'; 
                        print 'alert("Por favor verificar que todas las respuestas esten completas")'; 
                        print '</script>';  
                    }
        }
        $surveyAd = new SurveyAd();
        $listaResp = array();
        $listaTip = array();
        $idSurvey = $surveyAd->surveyS("pruebaADN");
        $id = mysql_fetch_array($idSurvey);
        //echo $id['idSurvey'];
        $preg = $surveyAd->questionSType($id['idSurvey']);
        ?>
        <div id="content">

            <div id="top">
            </div> 
            <form action="cuestionario.php" method="POST">
                <?php
                while ($row = mysql_fetch_array($preg)) {
                    echo  utf8_encode('<p>' . $row['idQuestion'] . '-' . $row['question'] . '?</p>');
                    if(trim($row['type']) != 'range')
                        {
                    array_push($listaResp,$row['idQuestion']);
                    array_push($listaTip, $row['type']);
                    }
                    $opciones = $surveyAd->getPosibleAnswer($row['idQuestion'], $row['type']);

                    if (trim($row['type']) == 'multiple selection') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            echo utf8_encode('<preg><input type="checkbox" id="' . $row['idQuestion'] . '-' . $opc['idquestionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '</preg><br/>');
                        }
                    }
                    
                    if (trim($row['type']) == 'radio') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            echo utf8_encode('<preg><input type="radio" id="' . $row['idQuestion'] . '-' . $opc['idquestionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '</preg><br/>');
                        }
                    }

                    if (trim($row['type']) == 'boolean') {

                        while ($opc = mysql_fetch_array($opciones)) {
                            echo utf8_encode('<preg><input type="radio" id="' . $row['idQuestion'] . '-' . $opc['idquetionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '">' . $opc['value'] . '</preg><br/>');
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
                            $uno = true;
                            for ($i = 1; $i <= $opc['value']; $i++) {
                                echo '<td>';
                                if($uno)
                                    {
                                        array_push($listaResp,$row['idQuestion'].'-'.$opc['idquestionRange']);
                                        array_push($listaTip, $row['type']);
                                        $uno = false;
                                    }
                                echo utf8_encode('<input type="radio" id="' . $row['idQuestion'] . '-' . $opc['value'] . '" name="' . $row['idQuestion'] .'-'.$opc['idquestionRange'].'" value="' . $i . '">');
                                echo '</td>';
                                
                            }
                            echo'</preg>';
                        }
                        echo '</table>';
                    }
                }
                
                $_SESSION['preguntas'] = $listaResp;
                $_SESSION['tipoPreguntas'] = $listaTip;
                ?>
                
                <center>
                    <br/>
                    <br/>
                <input type="submit" name="Enviar" value="Enviar">
                </center>
            </form>
<?php 
        }
?>




        </div>
    </body>
</html>

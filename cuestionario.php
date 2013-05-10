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
                
                $("#frm").submit(function()
                {
                    $("div").fadeOut("slow");
                });
            });
            
        </script>
    </head>
    <body>
        <?php
        include ("SurveyAd.php");
        include ("RespuestaEn.php");
        include ("ClienteEn.php");
        session_start();
        if(!isset($_SESSION['cliente']))
            {
            echo '<center>
                    <img src="img/acceso-denegado.jpg" alt="American Data Networks"/>
                    </center>';
            }else{
        if($_POST['Enviar'])
        {
            $completo=true;
            $pregL = $_SESSION['preguntas'];
            $pregT = $_SESSION['tipoPreguntas'];
            foreach($pregL as $respuesta)
                {
                
                if(empty($_POST[$respuesta]))
                        {
                            $completo = false;
                        }
                }
                
            if($completo)
                {
                    echo'entro a completo';
                    $cont =0;
                    $listaRespuestas = array();
                    $clienteEn = $_SESSION['cliente'];
                    
                    $clienteEn->setName($_POST['nombre']);
                            $clienteEn->setApellidos($_POST['apellidos']);
                            $clienteEn->setPuesto($_POST['puesto']);
                            $clienteEn->setCompania($_POST['empresa']);
                            $clienteEn->setTelephone($_POST['telefono']);
                            $clienteEn->setUbicacion($_POST['ubicacion']);
                            $_SESSION['cliente']= $clienteEn;
                    
                    foreach($pregL as $idRespuesta)
                        {
                        
                            //$nombre = explode("",$idRespuesta);
                                
                        
                            
                                
                        
                            $respuestaEn = new RespuestaEn();
                            
                            $respuestaEn->setValue($_POST[$idRespuesta]);
                            if($pregT[$cont]=='range')
                                {
                                    $idRespuestaLista = explode('-', $idRespuesta);
                                    $idRespuesta = $idRespuestaLista[0];
                                }
                            $respuestaEn->setIdQuestion($idRespuesta);
                            
                            if($pregT[$cont]){$respuestaEn->setComment($_POST['comment']);}else{$respuestaEn->setComment('');}
                          
                            $respuestaEn->setIdTipo($pregT[$cont]);
                            
                            $respuestaEn->setIdClient($clienteEn->getIdClient());
                            $cont = $cont +1;
                            
                            //$listaRespuestas[]= $respuestaEn;
                            array_push($listaRespuestas, $respuestaEn);
                            echo $respuestaEn->getIdClient();
                            
                        
                        }
                        
                    $_SESSION['listaRespuestas']=$listaRespuestas;
                    echo 'entra50';
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
            <form id="frm" action="cuestionario.php" method="POST">
                
                <table>
                <tr>
                    <td>
                        <p>Nombre: </p></td><td><input id="infoPer" type="text" name="nombre"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Apellidos: </p></td><td><input id="infoPer" type="text" name="apellidos"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Puesto: </p></td><td><input id="infoPer" type="text" name="puesto"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Empresa o Entidad: </p></td><td><input id="infoPer" type="text" name="empresa"/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <p>Telefono: </p></td><td><input id="infoPer" type="text" name="telefono"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Ubicacion: </p></td><td><input id="infoPer" type="text" name="ubicacion"/>
                    </td>
                </tr>
                </table>

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
                    
                    if (trim($row['type']) == 'comment') {

                        
                        echo utf8_encode('<preg><textarea cols="50" rows="5" id="' . $row['idQuestion'] . '-' . $opc['idquestionMultipleSelection'] . '" name="' . $row['idQuestion'] . '" value="' . $opc['value'] . '"></textarea></preg><br/>');
                        
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
                        echo '<table id="tabOpc">';
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
                            echo  utf8_encode('<preg>'.$opc['description'].'</td>');
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
                <input type="submit" id="enviar" name="Enviar" value="Enviar">
                </center>
            </form>
<?php 
        }
?>




        </div>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include ("SurveyAd.php");
        include ("ClienteEn.php");
        // put your code here
        //phpinfo();
        session_start();
        if (isset($_GET['id'])) {

            try {
                $surveyAd = new SurveyAd();
                $surveyAnt = $surveyAd->client_has_surveySChecksSurvey($_GET['id'], 5);
                $surAnt = mysql_fetch_array($surveyAnt);
                if ($surAnt['Survey_idSurvey'] == '') {
                    $info = $surveyAd->clientS($_GET['id']);

                    $existe = false;

                    while ($row = mysql_fetch_array($info)) {
                        if ($row['email'] != '') {
                            $clienteEn = new ClienteEn();
                            $clienteEn->setIdClient($_GET['id']);
                            $clienteEn->setName($row['name']);
                            $clienteEn->setApellidos($row['apellidos']);
                            $clienteEn->setEmail($row['email']);
                            $clienteEn->setPuesto($row['puesto']);
                            $clienteEn->setCompania($row['compania']);
                            $clienteEn->setTelephone($row['telephone']);
                            $clienteEn->setUbicacion($row['ubicacion']);
                            $_SESSION['cliente'] = $clienteEn;
                            $existe = true;
                        }
                    }
                    if ($existe == true) {
                        header("Location:cuestionario.php");
                    } else {
                        echo '<center>
                    <img src="img/mensaje.jpg" alt="American Data Networks"/>
                    </center>';
                    }
                } else {
                    echo '<center>
                    <img src="img/completa.jpg" alt="American Data Networks"/>
                    </center>';
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            //exit;
            /*     echo '<center>
              <img src="img/uc.jpg" alt="Survey under construction"/>
              </center>'; */
        } else {
            echo '<center>
                <img src="img/mensaje.jpg" alt="American Data Networks"/>
                </center>';
        }
        ?>

    </body>
</html>

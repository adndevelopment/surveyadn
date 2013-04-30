<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        //phpinfo();
        if(isset($_GET['id']))
            {
            header("Location:cuestionario.php");
            //exit;
                echo '<center>
        <img src="img/uc.jpg" alt="Survey under construction"/>
        </center>';
            }else
                {
                echo '<center>
        <img src="img/mensaje.jpg" alt="Survey under construction"/>
        </center>';
                }
            
        
        
        ?>
    
    </body>
</html>

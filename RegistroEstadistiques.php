<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registros tabla estadistiques</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">

        function windowCredits() {
            //window.open("./credits.txt", "", "width=200,height=100");
            window.open("./credits.txt","","height=200,width=400,scrollbars=no");
        }
        windowCredits();
        /*$(document).ready(function() {
            $.ajax({
                url: './credits.txt',
                type:'GET',
                success: function(m){
                alert(m);
                }                   
            });   
        });*/
        </script>
    </head>
    <body>
        <?php
        session_start();
        include_once 'DB/EstadistiquesRow.php';
        include_once 'DB/DatabaseOOP.php';

        $credits = fopen("credits.txt", "w+") or die("Unable to open file!");
        $txtName = "Nombre: Adrian Quintero Gimenez\n";
        $txtEmail = "Email: adri.bcn.98@gmail.com\n";
        $txtDate = "Fecha de hoy: ".date("F d Y H:i:s", filemtime("credits.txt"));
        fwrite($credits, $txtName);
        fwrite($credits, $txtEmail);
        fwrite($credits, $txtDate);
        //print_r(file_get_contents("credits.txt"));          
        fclose($credits);
        
        $db = null;
        try {
            echo "<h1>MP07 UF3 (Tècniques d'accés a dades)</h1>";
            $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
            $db->connect();
            echo "<h2>Registro de la tabla 'estadístiques'</h2>";
            echo DatabaseOOP::TABLE_START;
            $stmt = $db->selectAll();
            foreach (new EstadistiquesRow(new RecursiveArrayIterator($row = $stmt->fetch_all(MYSQLI_ASSOC))) as $key => $row) {
                echo $row;
            }
        } catch (Exception $error) {
            echo "connection failed: " . $error->getMessage();
        }
        DatabaseOOP::TABLE_END
        ?>

    </body>
</html>

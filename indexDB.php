<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'DB/DatabasePDO.php';
        include_once 'DB/EstadistiquesRow.php';

        //
        session_start();
        include_once 'DB/DatabaseOOP.php';
        include_once 'DB/DatabaseProc.php';
        //

        $db = null;
        try {
            echo "<h1>PHP MySQL</h1>";
            echo "<h2>Inserció</h2>";
            //$db = new DatabasePDO("localhost:3306", "administrador", "admin", "m07uf3");
            $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
            //$db = new DatabaseProc("localhost:3306", "administrador", "admin", "m07uf3");
            $db->connect();
            echo "<p>Connected successfully</p>";
            $_SESSION['intents'] = 4;
            //$last_record = $db->insert(ModalitatEnum::HUMA, 1, 5);
            $last_record = $db->insert(ModalitatEnum::HUMA, 1, $_SESSION['intents']);
            echo "<p>Registre $last_record inserit correctament</p>";
            echo "<h2>Estadístiques</h2>";
            //echo DatabasePDO::TABLE_START;
            echo DatabaseOOP::TABLE_START;
            /*$stmt = $db->selectAll();
            foreach (new EstadistiquesRow(new RecursiveArrayIterator($stmt->fetchAll())) as $key => $row) {
                echo $row;
            }*/
            //
            $stmt = $db->selectAll();
            //$result -> $mysqli -> query($stmt);
            //$result -> query($stmt);
            // Fetch all
            foreach (new EstadistiquesRow(new RecursiveArrayIterator($row = $stmt->fetch_all(MYSQLI_ASSOC))) as $key => $row) {
                echo $row;
            }

            //
        } catch (Exception $error) {
            echo "connection failed: " . $error->getMessage();
        }
        //DatabasePDO::TABLE_END
        DatabaseOOP::TABLE_END
        ?>

    </body>
</html>

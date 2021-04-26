<!DOCTYPE html>
<html>
    <head>
        <style>
            .center {
                margin-left: auto;
                margin-right: auto;
            }
            table {
                width: 75%;
                border-collapse: collapse;
            }

            table, td, th {
                border: 1px solid black;
                padding: 5px;
            }

            th {text-align: left;}
        </style>
    </head>
    <body>

        <?php
        include_once 'DB/DatabaseOOP.php';
        include_once 'EstadistiquesRow.php';

        $modalitat = $_GET['modalitat'];

        $db = null;
        $result = null;
        try {
            $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
            $db->connect();
            switch ($modalitat) {
                case "Totes":
                    $result = $db->selectAll();
                    break;
                case "Huma":
                    $result = $db->selectByModalitat("Huma");
                    break;
                case "Maquina":
                    $result = $db->selectByModalitat("Maquina");
                    break;
                default:
                    $result = $db->selectAll();
                    break;
            }

            echo DatabaseOOP::TABLE_START;
            foreach (new EstadistiquesRow(new RecursiveArrayIterator($row = $result->fetch_all(MYSQLI_ASSOC))) as $key => $row) {
                echo $row;
            }
        } catch (Exception $error) {
            echo "connection failed: " . $error->getMessage();
        }
        echo DatabaseOOP::TABLE_END
        ?>
    </body>
</html>



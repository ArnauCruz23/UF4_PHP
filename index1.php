<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Mòdul 07 UF's 3 i 4</title>
        <link rel="stylesheet" href="css/mystyle.css" >
        <script src="js/my_functions.js"></script>
    </head>
    <body onload="showEstadistiques('Totes')">
        <?php
        include_once 'classes/Config.php';
        include_once 'classes/DatabasePDO.php';
        $config = new Config("xml/config.xml");
        $db = new DatabasePDO("localhost", "root", "admin", "m07uf3");
        $db->connect();
        $result = $db->selectDistinctModalitats();
        echo "<h5 align='right'>Avui és " . date("Y/m/d") . "</h5>";
        echo $config->getTitle();
        echo $config->getSubtitle();
        $cookie_name = "last_time";
        if (isset($_COOKIE[$cookie_name])) {
            echo "<p>Hola, no ens veiem des de: " . $_COOKIE[$cookie_name] . "</p>";
        }
        $cookie_value = date("d/m/Y");
        // expires s'expressa en segons 60 * 60 * 24 = 86400 segons en un dia
        // domain "/" tot el domini
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("author[name]", "Pep", strtotime('+30 days'), "/");
        //setcookie("author[age]", null, -1, "/");
        setcookie("author[phone]", "456453347", strtotime('+30 days'), "/");
        setcookie("author[email]", "email@email.cat", strtotime('+30 days'), "/");
        ?>
        <form>
            <label>Modalitats:</label>
            <select class="dropdown-content" name="modalitats" onchange="showEstadistiques(this.value)">
                <option value="Totes">Totes</option>
                <?php
                while ($row = $result->fetch()) {
                    $modalitat = $row['modalitat'];
                    echo "<option value='$modalitat'>" . $modalitat . "</option>";
                }
                ?>
            </select>
        </form>
        <br>
        <div id="taula_estadistiques_id"></div>
        <?php
        echo "<p>";
        if (isset($_COOKIE['author'])) {
            foreach ($_COOKIE['author'] as $name => $value) {
                $name = htmlspecialchars($name);
                $value = htmlspecialchars($value);
                echo "$value ";
            }
        }
        echo "</p>"
        ?>
    </body>
</html>

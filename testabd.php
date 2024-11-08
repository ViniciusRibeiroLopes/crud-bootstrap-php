<?php include "config.php"; ?>
<?php include DBAPI; ?>

<?php
    try{
        $db = open_database();
        echo "<h1>Banco de Dados conectado!</h1>";
    } catch(Exception $e) {
        echo "<h3>Ocorreu um erro: <br>\n" . $e -> getMessage() . "</h3>\n";
    }
?>
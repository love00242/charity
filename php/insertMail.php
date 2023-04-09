<?php


$errMsg = "";


try{
    require_once("connectDB.php");

    $sql = "insert into `questionnairedb_usermail` (`mail`) values (:mail)";
    $usertdata = $pdo->prepare( $sql );
    $usertdata -> bindValue(":mail", $_POST["mail"]);
    $usertdata -> execute();


} catch (PDOException $e) {
    echo "錯誤行號 : " . $e->getLine() . "<br>";
    echo "錯誤訊息 : " . $e->getMessage() . "<br>";
    echo "系統無法連線<br>";
}
   




?>
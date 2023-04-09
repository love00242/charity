<?php


$errMsg = "";


try{
    require_once("connectDB.php");
    
    $sql = "insert into `questionnairedb_article` (`topAns1`, `bottomAns1`, `topAns2`, `bottomAns2`, `topAns3`, `bottomAns3`, `topAns4`, `bottomAns4`, `topAns5`, `bottomAns5`, `member`, `gender`, `ageRange`) values (:topAns1, :bottomAns1, :topAns2, :bottomAns2, :topAns3, :bottomAns3, :topAns4, :bottomAns4, :topAns5, :bottomAns5, :member, :gender, :ageRange)";
    $usertdata = $pdo->prepare( $sql );
    $usertdata -> bindValue(":topAns1", $_POST["topAns1"]);
    $usertdata -> bindValue(":bottomAns1", $_POST["bottomAns1"]);
    $usertdata -> bindValue(":topAns2", $_POST["topAns2"]);
    $usertdata -> bindValue(":bottomAns2", $_POST["bottomAns2"]);
    $usertdata -> bindValue(":topAns3", $_POST["topAns3"]);
    $usertdata -> bindValue(":bottomAns3", $_POST["bottomAns3"]);
    $usertdata -> bindValue(":topAns4", $_POST["topAns4"]);
    $usertdata -> bindValue(":bottomAns4", $_POST["bottomAns4"]);
    $usertdata -> bindValue(":topAns5", $_POST["topAns5"]);
    $usertdata -> bindValue(":bottomAns5", $_POST["bottomAns5"]);
    
    $usertdata -> bindValue(":member", $_POST["member"]);
    $usertdata -> bindValue(":gender", $_POST["gender"]);
    $usertdata -> bindValue(":ageRange", $_POST["ageRange"]);
    $usertdata -> execute();


} catch (PDOException $e) {
    echo "錯誤行號 : " . $e->getLine() . "<br>";
    echo "錯誤訊息 : " . $e->getMessage() . "<br>";
    echo "系統無法連線<br>";
}
   




?>
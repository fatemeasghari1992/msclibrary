<?php
require_once('main.php');
$session = $_COOKIE['session'];
$studentNumber = $_COOKIE['studentNumber'];
$bookId = $_POST['bookId'];
?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div style="margin-left: 45%;">

<?
if (authenticate($studentNumber,$session)){
    $db = Db::getInstance();
    $record = $db->first("SELECT Status,Title FROM `Books` WHERE ID='$bookId' ");
    if(!isset($record)){
        $message = "کتابی با این شماره وجود ندارد";
        require_once("failed.php");
        br();
        br();
        br();
        echo "<a href='index.php' class='btn btn-danger'>بازگشت </a>";
        exit;
    }else if($record['Status'] == 1){
        $bookName = $record['Title'];
        $book = $db->insert("INSERT INTO `borrowbook`(`stdid`,`bookid`,`bookName`) VALUES ('$studentNumber','$bookId','$bookName')");
        $db-> query("UPDATE Books SET Status='0' WHERE ID='$bookId'");
        $message = "کتاب شما با موفقیت ثبت شد";
        require_once("succeed.php");
        br();
        br();
        br();
        echo "<a href='index.php' class='btn btn-success'>بازگشت </a>";
        exit;
    }else{
        $message = "این کتاب امانت داده شده است";
        require_once("failed.php");
        br();
        br();
        br();
        echo "<a href='index.php' class='btn btn-warning'>بازگشت </a>";
        exit;
    }

}else{
    $message = "شماره دانشجویی شما منقضی شده است. لطفا مجددا وارد شوید";
    require_once("failed.php");
    br();
    br();
    br();
    echo "<a href='http://127.0.0.1:8083/index.php'>بازگشت </a>";
    exit;
}
?>
</div>
</body>
</html>
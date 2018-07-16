<?php
require_once('main.php');
$session = $_COOKIE['session'];
$studentNumber = $_COOKIE['studentNumber'];
$bookId = $_POST['bookId'];
?>
<div class="tac" style="margin-left: 45%;">
<?
if (authenticate($studentNumber,$session)){
    $db = Db::getInstance();
    $record = $db->first("SELECT bookid FROM `borrowbook` WHERE bookid='$bookId' ");
    if(!isset($record)){
        $message = "کتابی با این شماره وجود ندارد";
        require_once("failed.php");
        br();
        br();
        br();
        echo "<a href='reserved.php'>بازگشت </a>";
        exit;
    }
    else {
        $bookName = $record['Title'];
        $book = $db->query("DELETE FROM `borrowbook` WHERE bookid='$bookId'");
        $db-> query("UPDATE Books SET Status='1' WHERE ID='$bookId'");

        $message = "کتاب شما با موفقیت حذف شد";
        require_once("succeed.php");
        br();
        br();
        br();
        echo "<a href='reserved.php'>بازگشت </a>";
        exit;
    }

}else{
    $message = "شماره دانشجویی شما ثبت نشده است.لطفا مجددا وارد شوید";
    require_once("failed.php");
    br();
    br();
    br();
    echo "<a href='http://127.0.0.1:8083/index.php'>بازگشت </a>";
    exit;
}
?>
</div>


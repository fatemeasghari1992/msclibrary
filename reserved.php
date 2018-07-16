<!DOCTYPE html>
<html lang="en">
<head>
    <title>library</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php
require_once('main.php');
$studentNumber = $_COOKIE['studentNumber'];
?>

<div class="container">
    <div class="row">

        <div class="row">

            <div class="col-sm-12 col-md-11">

                <div class="thumbnail shadow-depth">

                    <div class="caption">
                        <table class="table table-striped">
                            <thead class="alert alert-info">
                            <tr>
                                <th>BookID</th>
                                <th>BookName</th>
				<th>expired date</th>


                            </tr>
                            </thead>

                            <?php
                            $db = Db::getInstance();
                            $record = $db->query("SELECT bookid,bookName,date FROM borrowbook WHERE stdid=$studentNumber ");
                            if($record)
                                foreach ($record as $item){
                                    echo "<tr class='table-row'>";
                                    foreach ($item as $key => $value){
                                        echo "<td>";
                                        echo $value;
                                        echo "</td>";
                                    }
                                }
                            ?>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="col-md-3 col-md-offset-1">
        <div class="pad15"><br>
            <div class="md-input">
                <form action="Deletion.php" method="post" >
                    <input class="md-form-control" required="" type="text" name="bookId">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Delete Reserve </label>
            </div>


            <div class="col-md-2">


                <button type="submit"  class="btn btn-info">حذف کتاب</button>
            </div>

            <div class="col-md-2 col-md-offset-5">
                <a href="index.php" class="btn btn-warning">بازگشت به صفحه رزرو کتاب</a>


            </div>
            </form>
        </div>

    </div>


</body>
</html>

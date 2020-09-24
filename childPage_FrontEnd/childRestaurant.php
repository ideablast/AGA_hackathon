<!DOCTYPE html>
<html>
<head>
  <title>음식 주문</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css경로/child.css">

  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  <style>
a {
    text-decoration: none;
}

img {
    height: 200px;
}

button {
    margin: 8px;
    width: 216px;
    display: inline-block;
}

.menuText {
    text-align: center;
}
.restaurantInfo {
    height: 150px;
}
</style>
</head>
<body>
    <div class="container">
        <h1>식당 선택</h1>
        <br>
        <div id='selectRestaurant'>
<?php
$DV = new PDO('mysql:host=localhost;dbname=AGA;charset=utf8', 'root', '');
$SP = $DV->prepare('SELECT SE_INDEX, SE_NAME, SE_ADDRESS, SE_PHONE FROM STORE LIMIT 8');
$SP->execute();
while ($ROW = $SP->fetch())
{
	echo '<a href="/childPage_FrontEnd/childMenu.php?id=' .$ROW[0] .'"><button type="button" class="restaurant"><img src="/childPage_FrontEnd/Empty.jpg" alt="빈 사진"><div class="restaurantInfo">' .$ROW[1] .'<br>' .$ROW[2] .'<br>' .$ROW[3] .'</div></button></a>';
}
$SP->closeCursor();
$SP = null;
$DV = null;
?>
        </div>
    </div>
</body>

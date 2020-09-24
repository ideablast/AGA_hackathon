<!DOCTYPE html>
<html>
<head>
  <title>음식 주문</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css경로/child.css">
  <style>
a {
    text-decoration: none;
}
.menuInfo {
    margin: 8px;
    width: 200px;
    display: inline-block;
}

img {
    height: 200px;
}

button.orderButton {
    width: 100%;
}

.menuText {
    text-align: center;
}
</style>

  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->

  <!-- ##################################### 팝업창 구현을 위한 간단한 자바스크립트 ##################################### -->
  <script language='javascript'>
      var popupX = (document.body.offsetWidth / 2) - (200 / 2);


      var popupY = (window.screen.height / 2) - (300 / 2);
      function checkOrder(StrFood, StrStore) {
          window.open("checkOrder.php?food=" +StrFood +"&store=" +StrStore, "checkOrder", "width=200, height=100, left="+ popupX +",top="+popupY);
      }
  </script>
</head>
<body>
    <div class="container">
        <h1>음식을 골라보자</h1>
        <br>
        <div id='formBox'>
            <form action='' method=''>
<?php
$StrStoreID = isset($_GET['id'])?htmlspecialchars($_GET['id']):NULL;
if(!is_numeric($StrStoreID))
{
	exit('<div class="menuInfo"><img src="/childPage_FrontEnd/Empty.jpg" alt="빈 사진"><div class="menuText">메뉴정보가없습니다.</div></div>');
}
$DV = new PDO('mysql:host=localhost;dbname=AGA;charset=utf8', 'root', '');
$SP = $DV->prepare('SELECT SE_MENU FROM STORE WHERE SE_INDEX = :StrStoreID');
$SP->bindParam(':StrStoreID', $StrStoreID);
$SP->execute();
$JsnData = json_decode($SP->fetch()[0]);
$SP->closeCursor();
$SP = null;
$DV = null;

foreach ($JsnData->food_info as $TmpJsn1)
{
	echo '<div class="menuInfo"><img src="/childPage_FrontEnd/Empty.jpg" alt="빈 사진"><div class="menuText">' .$TmpJsn1->food .'<button type="button" class="orderButton" onclick="checkOrder(\'' .$TmpJsn1->food .'\', \'' .$StrStoreID .'\');">주문</button></div></div>';
}
?>
	    </form>
        </div>
    
    </div>
</body>

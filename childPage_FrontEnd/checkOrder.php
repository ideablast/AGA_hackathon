<?php
$StrStoreID = isset($_GET['store'])?htmlspecialchars($_GET['store']):NULL;
$StrFood = isset($_GET['food'])?htmlspecialchars($_GET['food']):NULL;

if((strlen($StrFood) == 0) || (!is_numeric($StrStoreID)))
{
	exit('ERROR');
}

$DV = new PDO('mysql:host=localhost;dbname=AGA;charset=utf8', 'root', '');
$SP = $DV->prepare('INSERT INTO ORDERS (OR_STUDENT_INDEX, OR_STORE_ID, OR_ORDER_LIST, OR_ORDER_TIME, OR_STATE) VALUES (1, :StrStoreID, :StrFood, NOW(), 0)');
$SP->bindParam(':StrStoreID', $StrStoreID);
$SP->bindParam(':StrFood', $StrFood);
$SP->execute();
$SP = null;
$DV = null;
echo 'HIHI';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>음식 주문</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css경로/child.css">

    <script language='javascript'>
        var popupX = (document.body.offsetWidth / 2) - (200 / 2);
        var popupY = (window.screen.height / 2) - (300 / 2);
        function orderConfirm() {
            window.close();
        }
    </script>
</head>
<body>
    <div class='container'>
        <div class='popupTextBox'>
            주문 완료되었습니다~!
        </div>
        <div class='popupButtonsBox'>
            <button class='popupButton' onclick="orderConfirm();">확인</button>
        </div>
    </div>
</body>
</html>

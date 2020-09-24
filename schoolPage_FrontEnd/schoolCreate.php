<?php
$StrName = isset($_GET['name'])?htmlspecialchars($_GET['name']):NULL;
$StrPhone = isset($_GET['phoneNum'])?htmlspecialchars($_GET['phoneNum']):NULL;
$StrAddress = isset($_GET['Address'])?htmlspecialchars($_GET['Address']):NULL;

if( (mb_strlen($StrName) > 0) && (mb_strlen($StrName) < 12) && (mb_strlen($StrPhone) > 0) && (mb_strlen($StrPhone) < 20) && (mb_strlen($StrName) > 0) && (mb_strlen($StrName) < 255) )
{
	$DV = new PDO('mysql:host=localhost;dbname=AGA;charset=utf8', 'root', '');
	$SP = $DV->prepare('INSERT INTO STUDENT (ST_NAME, ST_ADDRESS, ST_PHONE, ST_ADMIN_INDEX) VALUES (:StrName, :StrAddress, :StrPhone, 1)');
	$SP->bindParam(':StrName', $StrName);
	$SP->bindParam(':StrAddress', $StrAddress);
	$SP->bindParam(':StrPhone', $StrPhone);
	$SP->execute();
	$SP = null;
	$DV = null;
	echo '추가완료!';
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>결식 아동 실시간 정보 확인 시스템</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  <style>
input[type="text"] {
    position: fixed;
    left: 200px;
}

form > div {
    height: 32px;
}

button {
    width: 100px;
    margin: 0 8px;
}
  </style>
</head>
<body>
    <div class="container">
        <h1>결식 아동 실시간 정보 확인 시스템</h1>
        <br>
        <h2>결식 아동 정보 추가</h2>

        <div id='formBox'>
<form action="" method="">
                <div id="nameBox">
                    이름 :
                    <input type="text" name="name" placeholder="이름을 입력하세요">
                </div>
                <div id="phoneNumBox">
                    연락처 :
                    <input type="text" name="phoneNum" placeholder="연락처를 입력하세요">
                </div>
            <div id="Address">
                    주소 :
                    <input type="text" name="Address" placeholder="주소를 입력하세요">
		</div><button type="submit">등록</button><button type="reset">초기화</button></form>
	</div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <title>결식 아동 실시간 정보 확인 시스템</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->
  <!-- css 경로 입력해줘요 ! ########################################################################## -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
</head>
<body>
    <div class="container">
        <h1>결식 아동 실시간 정보 확인 시스템</h1>
        <br>
	<a href="schoolCreate.php"><input type='button' id='create_ST' class='crud_button' value='학생 정보 추가'></a>
        <br>
        <h2>결식 아동 실시간 정보</h2>
            <table class="table table-striped studentTable">
                <thead>
                <tr>
                    <td><B>이름</B></td>
                    <td><B>연락처</B></td>
                    <td><B>음식 주문 시간</B></td>
                    <td><B>음식 배달 완료 시간</B></td>
                    <td><B>음식 주문 메뉴</B></td>
                    <td><B>식사 여부(배달 완료 기준)</B></td>
                </tr>
                </thead>
                <tbody>
                <!-- {% for candidate in candidates %} -->
<?php
$DV = new PDO('mysql:host=localhost;dbname=AGA;charset=utf8', 'root', '');
$SP = $DV->prepare('SELECT (SELECT ST_NAME FROM STUDENT WHERE ST_INDEX = OR_STUDENT_INDEX), (SELECT ST_PHONE FROM STUDENT WHERE ST_INDEX = OR_STUDENT_INDEX), OR_ORDER_LIST, OR_ORDER_TIME, OR_DELIVER_TIME, OR_STATE FROM ORDERS LIMIT 10');
$SP->execute();
while ($ROW = $SP->fetch())
{
	if ($ROW[5] == 0)
	{
		$TmpStr1 = '배달 없음';
		$Color = 'grey';
	} else {
		$TmpStr1 = '배달 완료';
		$Color = 'green';
	}
	if ($ROW[4] == '1990-01-01 00:00:00')
	{
		$ROW[4] = '-';
	}
	echo '<tr><td>' .$ROW[0] .'</td><td>' .$ROW[1] .'</td><td>' .$ROW[3] .'</td><td>' .$ROW[4] .'</td><td>' .$ROW[2] .'</td><td><span class="eatStatus" style="width:30px;height:10px;background-color:' .$Color .';">' .$TmpStr1 .'</span></td></tr>';
}
$SP->closeCursor();
$SP = null;
$DV = null;
?>
                </tbody>
            </table>
    </div>
</body>

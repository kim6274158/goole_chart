<?php
// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "value";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 폼 데이터 수집 및 쿼리 작성
$money = $_POST['money'];
$time = $_POST['time'];
$health = $_POST['health'];
$honor = $_POST['honor'];
$ex = $_POST['ex'];
$sql = "INSERT INTO desire (money, time, health, honor, ex) VALUES ('$money', '$time', '$health', '$honor', '$ex')";

// 쿼리 실행 및 결과 처리
if ($conn->query($sql) === TRUE) {
header("Location: valuepie.php");
  #echo "Login success!.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>
<?php
// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valuetext";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 폼 데이터 수집 및 쿼리 작성
$one = $_POST['one'];
$two = $_POST['two'];
$three = $_POST['three'];
$four = $_POST['four'];
$ex = $_POST['ex'];
$sql = "INSERT INTO desire(one, two, three, four, ex) VALUES ('$one', '$two', '$three', '$four', '$ex')";

// 쿼리 실행 및 결과 처리
if ($conn->query($sql) === TRUE) {
header("Location: valuepietext.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>
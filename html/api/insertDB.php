<?php

include_once("./config/db.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 수정 여부를 확인하기 위해 wno (id) 값 체크
$wno = isset($_GET['wno']) ? intval($_GET['wno']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼 데이터 받기
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $num_people = $_POST['num_people'];
    $class_type = $_POST['class_type'];
    $date = $_POST['date'];

    // wno 값이 있는 경우, 기존 데이터를 수정
    if ($wno > 0) {
        // 데이터 업데이트
        $stmt = $conn->prepare("UPDATE reservations SET name = ?, phone = ?, num_people = ?, class_type = ?, date = ? WHERE id = ?");
        $stmt->bind_param("ssissi", $name, $phone, $num_people, $class_type, $date, $wno);
    } else {
        // 새 데이터 삽입
        $stmt = $conn->prepare("INSERT INTO reservations (name, phone, num_people, class_type, date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $phone, $num_people, $class_type, $date); // class_type을 문자열 타입으로 변경
    }

    // 실행 후 결과 출력
    if ($stmt->execute()) {
        echo "<script>alert('완료되었습니다.');
        window.location.href = 'list.php';
        </script>";
    } else {
        echo "<p>수정 실패: " . $stmt->error . "</p>";
    }

    // 자원 해제
    $stmt->close();
}


?>
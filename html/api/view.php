<?php

include_once("./config/db.php"); // 상대경로로 가져와야 한다.

$conn = new mysqli($servername, $username, $password, $dbname);
$wno = $_GET['wno']; 
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POCO:AR</title>

<style>
    .join {
        margin-top: 30px;
        width: 30vw;
        margin: 0 auto;
        padding: 10px 30px;
        border: 3px solid #333;
        background-color: #ffffff;
        border-radius: 1.25rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

    h2{
        text-align: center;
    }
    strong{
        margin-right: 10px;
        padding: 10px;
        border-radius: 5px;
        background: #333;
        color: #fff;
        font-weight: 500;
    }
    p{
        padding-bottom: 20px;
    }

    a {
        padding: 10px 20px;
        margin: 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        text-decoration: none;
    }

    a:hover {
        background-color: #555;
    }

    a.delete-btn {
        background-color: #aaa;
        transition: background 0.5s ease;

    }
    a.delete-btn:hover {
        background-color: #AD3232;
    }
    </style>

</head>
<body>
    <div class="join">
        <?php
        if ($conn->connect_error) {
            die("연결 실패: " . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM reservations WHERE id = " . intval($wno); 
            // 특정 하나의 글을 검색하기
            $result = $conn->query($sql); // SQL 실행

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h2>정보</h2>";
                echo "<p><strong>이름:</strong> " . htmlspecialchars($row['name']) . "</p>";
                echo "<p><strong>전화번호:</strong> " . htmlspecialchars($row['phone']) . "</p>";
                echo "<p><strong>수강 인원:</strong> " . htmlspecialchars($row['num_people']) . "</p>";
                echo "<p><strong>수강 작품:</strong> " . htmlspecialchars($row['class_type']) . "</p>";
                echo "<p><strong>수강 날짜:</strong> " . htmlspecialchars($row['date']) . "</p>";
                echo "<p><strong>예약 일시:</strong> " . htmlspecialchars($row['created_at']) . "</p>";
            } else {
                echo "데이터가 없습니다.";
            }
        }

        // 연결 종료
        $conn->close();
?>
</div>
<div style="text-align: center; margin-top: 30px;">
    <a href="./list.php">< 목록</a>
    <a href="./write.php?wno=<?php echo $wno; ?>">예약정보 수정</a>
</div>
</body>
</html>

<?php

    include_once("./config/db.php");

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("연결 실패: " . $conn->connect_error);
    } else {
        $sql = "SELECT * FROM reservations";
        $result = $conn->query($sql);
    }
?>


<style>
.reservList {
    max-width: 65vw;
    margin: 0 auto;
    margin-top: 30px;
    padding: 10px;
    background-color: #fff;
    border: 3px solid #333;
    border-radius: 1.25rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2{text-align: center; margin-top: 20px;}

.reservList ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

span{
    align-items: center;
    display: flex;
    justify-content: center;
}


.reservList ul li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 5px;
    background-color: #ffffff;
    transition: background-color 0.3s;
}

.reservList ul li:hover {
    background-color: #d9d9d9;
}

.reservList ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

.reservList ul li a:hover {
    text-decoration: underline;
}

.item-phone, .item-detail-type {
    color: #555;
}

.reservList ul li span {
    flex: 1; /* 각 항목의 기본 너비를 동일하게 */
    padding: 0 10px; /* 각 항목의 좌우 여백 추가 */
    text-align: left; /* 텍스트 왼쪽 정렬 */
}

.reservList ul li .item-id,
.reservList ul li .item-num_people,
.reservList ul li .item-input {
    flex: 0.4; /* 상대적으로 작은 너비 */
}


.reservList ul li .item-phone,
.reservList ul li .item-detail-type {
    flex: 1; /* 전화번호와 기타 항목들은 기본값 */
}
.reservList ul li span:last-child{
    width: 500px;
}

.reservList ul li input[type='checkbox'] {
    flex: 0.3; /* 체크박스의 너비 */
}


button, .add {
    padding: 10px 20px;
    margin: 20px;
    font-size: 16px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
}

button:hover {
    background-color: #555;
}

button.delete-btn {
    background-color: #aaa;
    transition: background 0.5s ease;

}
button.delete-btn:hover {
    background-color: #AD3232;
}

checkbox{
    width: 50px;
    height: 50px;
}

</style>

<form method="post" action="delete.php">
<div class="reservList">
<?php
// 데이터베이스에서 데이터를 가져오는 쿼리
$sql = "SELECT * FROM reservations ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>예약 : " . $result->num_rows . "개📃</h2>";

    echo "<ul>";

    $index = $result->num_rows;

    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<span class='item-input'><input type='checkbox' value='" . htmlspecialchars($row['id']) . "' name='delete_ids[]'></span>";
        echo "<span class='item-id'>" . $index . "</span>";
        echo "<span class='item-name'><a href='./view.php?wno=" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</a></span>"; 
        echo "<span class='item-phone'>" . htmlspecialchars($row['phone']) . "</span>"; 
        echo "<span class='item-num_people'>" . htmlspecialchars($row['num_people']) . "</span>"; 
        echo "<span class='item-class_type'>" . htmlspecialchars($row['class_type']) . "</span>"; 
        echo "<span class='item-date'>" . htmlspecialchars($row['date']) . "</span>"; 
        echo "<span class='item-created_at'>" . htmlspecialchars($row['created_at']) . "</span>"; 
        echo "</li>";
        $index--;
    }

    echo "</ul>";
} else {
    echo "데이터가 없습니다.";
}

$conn->close();
?>
</div>

<div style="text-align: center;">
    <button type="submit" class="delete-btn">삭제</button>
    <a class="add" href='write.php'">예약 추가</a>
</div>

</form>
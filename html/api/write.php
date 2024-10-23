<?php

include_once("./config/db.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 수정 여부를 확인하기 위해 wno (id) 값 체크
$wno = isset($_GET['wno']) ? intval($_GET['wno']) : 0;

// 수정할 게시글이 있는 경우, 해당 게시글 데이터 불러오기
if ($wno > 0) {
    $stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ?");
    $stmt->bind_param("i", $wno);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // 데이터가 있는 경우, 각 필드에 값을 미리 채워둠
    if ($row) {
        $name = $row['name'];
        $phone = $row['phone'];
        $num_people = $row['num_people'];
        $class_type = $row['class_type'];
        $date = $row['date'];
    } else {
        echo "<p>해당 글을 찾을 수 없습니다.</p>";
    }
    $stmt->close();
} else {
    // 새 게시글 작성할 때는 빈 값으로 설정
    $name = "";
    $phone = "";
    $num_people = "";
    $class_type = "";
    $date = "";
}

?>


<style>

.form{
    width: 30vw;
    margin: 0 auto;
    padding: 10px 30px;
    border: 3px solid #333;
    background-color: #ffffff;
    border-radius: 1.25rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2{text-align: center;}

li{
    list-style-type: none;
    margin-bottom: 10px;
}

a, .Btn {
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    margin: 20px;
    font-size: 16px;
}

a:hover,
.Btn:hover {
    background-color: #555;
}

input:not(.Btn), select{
    margin: 10px 0;
    border: 3px solid #333;
    border-radius: 100px;
    padding: 0 15px;
    width: 10vw; 
    height: 40px;
    font-size: 14px;
}

</style>

<div class="form">
    <h2><?php echo $wno > 0 ? "예약 수정" : "새 예약"; ?></h2>
    <form method="post" action="/api/insertDB.php">
    <ul>

    <li>
        <!-- type hidden은 삭제 불가라는 뜻. input을 절대 건들지 않는다. -->
        <input type="hidden" id="wno" name="wno" value="<?php echo isset($wno) ? $wno : ''; ?>">
    </li>


    <li>
        <label for="name">이름:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required placeholder="성함을 입력해 주세요." maxlength="11" pattern="^[가-힣]{1}[가-힣\s]*$" title="이름은 반드시 자모음이 결합된 한글로 시작해야 합니다."><br>
    </li>
    
    <li>
        <label for="phone">전화번호:</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required placeholder="010-0000-0000" maxlength="13" pattern="^010-\d{4}-\d{4}$" title="전화번호는 010-0000-0000 형식으로 입력해 주세요."><br>
    </li>

    
    <li>
        <label for="num_people">수강 인원(명):</label><br>
        <select id="num_people" name="num_people" required>
            <option value="1" <?php if ($num_people == 1) echo 'selected'; ?>>1명</option>
            <option value="2" <?php if ($num_people == 2) echo 'selected'; ?>>2명</option>
            <option value="3" <?php if ($num_people == 3) echo 'selected'; ?>>3명</option>
            <option value="4" <?php if ($num_people == 4) echo 'selected'; ?>>4명</option>
        </select><br>
    </li>
    
    <li>
        <label for="class_type">수강 작품:</label><br>
        <select id="class_type" name="class_type" required>
            <option value="PLATE" <?php if ($class_type == 'PLATE') echo 'selected'; ?>>PLATE</option>
            <option value="MUG" <?php if ($class_type == 'MUG') echo 'selected'; ?>>MUG</option>
            <option value="MINI_MUG" <?php if ($class_type == 'MINI_MUG') echo 'selected'; ?>>MINI-MUG</option>
            <option value="LIFE" <?php if ($class_type == 'LIFE') echo 'selected'; ?>>LIFE</option>
        </select><br>
    </li>
    
    <li>
    <label for="date">수강 날짜:</label><br>
    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required min="<?php echo date('Y-m-d'); ?>"><br>
</li>

    
    
    <li>
    <input class="Btn" type="submit" value="<?php echo $wno > 0 ? '수정하기' : '작성하기'; ?>">
</lil>
</ul>
    </form>
</div>

<div class="list" style="text-align: center; margin-top: 30px;">
    <a href="./list.php">목록</a>
</div>

<?php
$conn->close();
?>

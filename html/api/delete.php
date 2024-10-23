<?php
    include_once("./config/db.php");
    //mysql접속 정보(db. 변수에 값만 저장한 php파일)
    $conn = new mysqli($servername, $username, $password, $dbname);
    //접속하기(리턴)
    // = mysqli에 해당하는 값을 통째로 conn에 새로 저장


    // $_SERVER 함수는 허접.❤서버만 쓸 수 있음. 해킹당함
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // = 이 페이지를 오픈하게 한 폼(list.php내의 action="delete.php"을 가진 form의 method가 post라면?)

    if (isset($_POST['delete_ids']) && !empty($_POST['delete_ids'])) {
        // 삭제할 예약의 ID 배열을 가져옵니다. 체크박스의 name
        // 체크박스 체크 안 하고 삭제 버튼 누르면 아래의 else로 이동
        
        $delete_ids = $_POST['delete_ids'];
        
        // 삭제할 ID들을 하나의 문자열로 만듭니다.
        // 자바스크립트 join(array -> string) / split(string -> array)
        // php에서는 implode / explode
        $placeholders = implode(",", array_fill(0, count($delete_ids), "?"));

        // DELETE 쿼리 준비
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id IN ($placeholders)");

        // 동적으로 파라미터 바인딩
        // 보안상의 문제로 인해 아래의 식으로 진행
        $types = str_repeat("i", count($delete_ids)); // 모든 ID는 정수형
        $stmt->bind_param($types, ...$delete_ids);
        
        // 쿼리 실행 후 결과 확인
        if ($stmt->execute()) {
            echo "<script>alert('선택한 예약이 삭제되었습니다.'); window.location.href = 'list.php';</script>";
        } else {
            echo "<p>삭제 실패: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('삭제할 항목을 선택해 주세요.'); window.location.href = 'list.php';</script>";
    }
}

$conn->close();
?>
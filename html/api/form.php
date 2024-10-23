<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품 업로드</title>
    <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
}

.upload-form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    margin: 0 auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"], input[type="number"], select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="file"] {
    padding: 10px;
    font-size: 16px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    font-size: 18px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}

    </style>
    
</head>

<body>
    <div class="upload-form-container">
        <h1>상품 등록</h1>
        <form id="productUploadForm" method="post" action="/sumbit-product" onsubmit="유효성검사함수만들어줘">
            <!-- postman을 통해서 넘겨온 데이터 확인 -->
            <!-- create -> 테이블생성 -> 데이터생성 글쓰기 -->
            <!-- read -> 목록, 글보기 / update ->  글수정 / delete -> 글삭제 -->

            <div class="form-group">
                <label for="productName">상품 이름</label>
                <input type="text" id="productName" name="productName" required>
                <!-- input의 name은 db의 필드명과 동일하게..하면 사실 안됨 해커 헷갈리게 보통 다르게하지만 우리는 공부중이다 -->
                <!-- 패턴을 넣어서 허수데이터 1차 걸러내도록 했다...같이 말해라 발표할때~ -->
            </div>
            
            <div class="form-group">
                <label for="productDescription">상품 설명</label>
                <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="productPrice">가격 (₩)</label>
                <input type="number" id="productPrice" name="productPrice" min="0" step="100" required>
            </div>
            
            <div class="form-group">
                <label for="productCategory">카테고리</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="e">전자제품</option>
                    <option value="c">의류</option>
                    <option value="f">가구</option>
                    <option value="t">장난감</option>
                    <!-- productCategory 필드의 데이터타입이 char(1)임 -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="productImage">상품 이미지</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>
                <!-- 저장한 위치만 데이터베이스에 넘긴다 -->
            </div>
            
            <div class="form-group">
                <label for="stockQuantity">재고 수량</label>
                <input type="number" id="stockQuantity" name="stockQuantity" min="1" required>
            </div>
            
            <button type="submit">업로드</button>
        </form>
    </div>
</body>
</html>

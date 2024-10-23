$(document).ready(function() {

  
  $(window).scroll(function() {
    const elements = $('.fadeIn');
    const windowHeight = $(window).height();
    
    elements.each(function() {
        const elementPosition = $(this).offset().top;
  
        // 화면의 3분의 2 위치 계산
        if ($(window).scrollTop() + windowHeight * (2/3) > elementPosition) {
            $(this).addClass('visible'); // .visible 클래스 추가
        }
    });
  });


});



// 지도
const mapContainer = document.getElementById('map'); 
const mapOption = { 
    center: new kakao.maps.LatLng(37.54739452517357, 127.04320946510356), // 원하는 위치로 변경
    level: 3 
};

const map = new kakao.maps.Map(mapContainer, mapOption);

const markerPosition  = new kakao.maps.LatLng(37.54739452517357, 127.04320946510356); // 마커 위치
const marker = new kakao.maps.Marker({
    position: markerPosition
});

marker.setMap(map);


// 버튼 누를 시 상태 변경
const categoryButtons = document.querySelectorAll('.category-btn');
categoryButtons.forEach(button => {
    button.addEventListener('click', function() {
        categoryButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
    });
});



//번호 자동 -
const phoneInput = document.getElementById('phone');

phoneInput.addEventListener('input', function() {
    // 숫자만 추출
    let input = this.value.replace(/\D/g, '');

    // 형식화
    if (input.length > 3 && input.length <= 7) {
        input = input.replace(/(\d{3})(\d{0,4})/, '$1-$2');
    } else if (input.length > 7) {
        input = input.replace(/(\d{3})(\d{4})(\d{0,4})/, '$1-$2-$3');
    }

    // 변경된 값 설정
    this.value = input;
});



// review

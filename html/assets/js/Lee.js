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


// 커서 따라다니는 svg
// let mouseX = 0;
// let mouseY = 0;

// document.addEventListener('mousemove', (e) => {
//     mouseX = e.clientX;
//     mouseY = e.clientY;
// });

// const updateCursor = () => {
//     const scrollX = window.scrollX;
//     const scrollY = window.scrollY;
//     customCursor.style.transform = `translate(${mouseX + scrollX}px, ${mouseY + scrollY}px)`;
// };

// // 일정 간격으로 커서 위치를 업데이트
// setInterval(updateCursor, 10);



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



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


// topBtn
let lastScrollTop = 0; // 마지막 스크롤 위치
const topBtn = document.querySelector('.topBtn');

window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (window.innerWidth < 992) { // lg 이하의 사이즈일 때
        if (currentScroll > lastScrollTop && currentScroll > 200) {
        // 아래로 스크롤 중일 때: 버튼 숨기기
        topBtn.classList.remove('visible');
        } else if (currentScroll < lastScrollTop && currentScroll > 200) {
        // 위로 스크롤 중일 때: 버튼 보이기
        topBtn.classList.add('visible');
        }
    }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // 마지막 스크롤 위치 갱신
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




new Swiper('.swiper-container', {
    loop: true,  // 무한 루프 활성화
    slidesPerView: 5,  // 한 번에 5개의 슬라이드 표시
    spaceBetween: 10,  // 슬라이드 사이의 간격
    speed: 5000,  // 슬라이드가 부드럽게 이동하는 속도
    loopAdditionalSlides: 5,  // 복제 슬라이드 추가로 부드러운 루프 구현
    autoplay: {
        delay: 0,  // 지연 없이 슬라이드 계속 이동
        disableOnInteraction: false,  // 사용자 상호작용 후에도 자동 재생 유지
    },
});

new Swiper('.swiper-container', {
    loop: true, 
    loopedSlides: 5,  // 복제할 슬라이드 개수를 명시적으로 지정
    slidesPerView: 5,
    spaceBetween: 10,
    speed: 5000,
    autoplay: {
        delay: 0,
        disableOnInteraction: false,
    },
});

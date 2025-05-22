var swiper1 = new Swiper(".categorySwiper", {
    slidesPerView: 6,
    spaceBetween: 10,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    loop: true,

    // 👇 اینجا تعداد اسلایدها در سایزهای مختلف مشخص می‌شه
    breakpoints: {
        0: {
            slidesPerView: 2, // برای گوشی‌های خیلی کوچک
        },
        576: {
            slidesPerView: 3, // برای گوشی‌های متوسط
        },
        768: {
            slidesPerView: 4, // برای تبلت
        },
        992: {
            slidesPerView: 5, // برای لپ‌تاپ یا دسکتاپ کوچک
        },
        1200: {
            slidesPerView: 6, // برای دسکتاپ‌های بزرگ
        }
    }
});


var swiper2 = new Swiper(".ProductSwiper", {
    slidesPerView: 3,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    loop: true,
    loopAdditionalSlides: 10,

    breakpoints: {
        0: { slidesPerView: 1 },
        768: { slidesPerView: 2 },
        992: { slidesPerView: 3 }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 10,
    loop: true,
    slidesPerGroup: 1,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    loop:true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 2, // برای گوشی‌های خیلی کوچک
        },
        576: {
            slidesPerView: 3, // برای گوشی‌های متوسط
        },
        768: {
            slidesPerView: 4, // برای تبلت
        },
    },
});

// تغییر عکس اصلی وقتی عکس کوچیک کلیک بشه
document.querySelectorAll('.swiper-slide img').forEach(img => {
    img.addEventListener('click', function() {
        var largeImage = this.getAttribute('data-large');
        document.getElementById('product-detail').src = largeImage;
    });
});

// تغییر عکس اصلی وقتی اسلایدر حرکت کنه
swiper.on('slideChange', function () {
    var activeSlide = document.querySelector('.swiper-slide-active img');
    if (activeSlide) {
        var largeImage = activeSlide.getAttribute('data-large');
        document.getElementById('product-detail').src = largeImage;
    }
});



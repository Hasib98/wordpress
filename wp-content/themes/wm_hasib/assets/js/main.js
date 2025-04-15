var swiper = new Swiper(".hero_swiper", {
  slidesPerView: 3,
  centeredSlides: true,
  grabCursor: true,
  freeMode: false,
  loop: true,
  mousewheel: false,
  spaceBetween: 30,
  keyboard: {
    enabled: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  // Responsive breakpoints
  breakpoints: {
    1024: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
      centeredSlides: false,
    },
    300: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
  },
});

var swiper = new Swiper(".test", {
  slidesPerView: 2,
  // centeredSlides: true,
  grabCursor: true,
  freeMode: false,
  loop: true,
  mousewheel: false,
  spaceBetween: 30,
  keyboard: {
    enabled: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  // Responsive breakpoints
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    300: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
  },
});

const counters = document.querySelectorAll(".count_value");
const speed = 50; // adjust for animation speed

// Save original values in data-target
counters.forEach((counter) => {
  counter.dataset.target = counter.innerText;
  counter.innerText = 0;
});

// Animate one counter and return a Promise that resolves when done
const animate = (counter) => {
  return new Promise((resolve) => {
    const target = +counter.dataset.target;
    let count = 0;
    const increment = target / speed;

    const update = () => {
      count += increment;
      if (count < target) {
        counter.innerText = Math.ceil(count);
        requestAnimationFrame(update);
      } else {
        counter.innerText = target;
        resolve(); // animation done
      }
    };

    update();
  });
};

// Animate all counters in sequence
const animateInSequence = async () => {
  for (let counter of counters) {
    counter.innerText = 0; // reset before animation
    await animate(counter);
  }
};

// IntersectionObserver to trigger animation on scroll in
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animateInSequence();
      }
    });
  },
  { threshold: 0.5 }
);

counters.forEach((counter) => observer.observe(counter));

new Swiper(".swiper-slider", {
  // Optional parameters
  centeredSlides: true,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  loop: true,
  mousewheel: false,
  keyboard: {
    enabled: true,
  },
  onInit: function (swiper) {
    updateSlideWidths(swiper);
  },
  onSlideChangeEnd: function (swiper) {
    updateSlideWidths(swiper);
  },

  // Enabled autoplay mode
  /*   autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  }, */

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: false,
    clickable: true,
  },

  // If we need navigation
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  // Responsive breakpoints
  breakpoints: {
    640: {
      slidesPerView: 1.25,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
  },
});

/* var copy = document.querySelector(".logos-slide").cloneNode(true);
document.querySelector(".logos").appendChild(copy); */
function updateSlideWidths(swiper) {
  // Reset all slides to default width
  swiper.slides.forEach(function (slide) {
    slide.classList.remove("active-slide");
  });

  // Set active slide width
  swiper.slides[swiper.activeIndex].classList.add("active-slide");
}

/* const element = document.querySelector(".hero_swiper");
const swiperWidth = element.clientWidth;

const activeSlideWidth = (swiperWidth - 40) * 0.4;
const normalSlideWidth = ((swiperWidth - 40) * 0.6) / 2;
console.log(activeSlideWidth, normalSlideWidth);
document.querySelector(".swiper-slide-active").style.width = "416px";
document.querySelector(".swiper-slide").style.width = "312px"; */

// service card line js CSS

const get_section_height = document.querySelector(
  ".section_our_services"
).clientHeight;

// console.log(get_section_height);

const get_left_line = document.querySelector(".left_line_of_card");
const get_right_line = document.querySelector(".right_line_of_card");

get_left_line.style.height = `${get_section_height}px`;
get_right_line.style.height = `${get_section_height}px`;

const get_sec_left_line = document.querySelector(".sec_left_line_of_card");
const get_sec_right_line = document.querySelector(".sec_right_line_of_card");

get_sec_left_line.style.height = `${get_section_height}px`;
get_sec_right_line.style.height = `${get_section_height}px`;

const hamburger = document.getElementById("hamburger");
const navLinks = document.getElementById("navLinks");

hamburger.addEventListener("click", () => {
  // alert("test");
  navLinks.classList.toggle("active");
});

const get_hero_section_height =
  document.querySelector(".section_hero").clientHeight;

const line_1 = document.querySelector(".line_1");
const line_2 = document.querySelector(".line_2");
const line_3 = document.querySelector(".line_3");
const line_4 = document.querySelector(".line_4");
const line_5 = document.querySelector(".line_5");
const line_6 = document.querySelector(".line_6");

line_1.style.height = `${get_hero_section_height}px`;
line_2.style.height = `${get_hero_section_height}px`;
line_3.style.height = `${get_hero_section_height}px`;
line_4.style.height = `${get_hero_section_height}px`;
line_5.style.height = `${get_hero_section_height}px`;
line_6.style.height = `${get_hero_section_height}px`;

const slide_prev = document
  .querySelector(".swiper-slide-prev")
  .getBoundingClientRect();
const slide_active = document
  .querySelector(".swiper-slide-active")
  .getBoundingClientRect();
const slide_next = document
  .querySelector(".swiper-slide-next")
  .getBoundingClientRect();

/* 
console.log("Top:", slide_prev.top);
console.log("Left:", slide_prev.left);
console.log("Bottom:", slide_prev.bottom);
console.log("Right:", slide_prev.right);
*/

line_1.style.left = `${slide_prev.left}px`;
line_2.style.left = `${slide_prev.right}px`;

line_3.style.left = `${slide_active.left}px`;
line_4.style.left = `${slide_active.right}px`;

line_5.style.left = `${slide_next.left}px`;
line_6.style.left = `${slide_next.right}px`;

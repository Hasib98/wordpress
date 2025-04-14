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

console.log(get_section_height);

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
  navLinks.classList.toggle("active");
});

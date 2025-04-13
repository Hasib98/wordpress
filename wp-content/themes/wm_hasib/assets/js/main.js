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
      slidesPerView: 1.25,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
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

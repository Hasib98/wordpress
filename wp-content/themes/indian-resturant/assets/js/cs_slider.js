// document.addEventListener("DOMContentLoaded", function () {
//     //** Step 1: Get a reference to a Fancybox instance
// const fancybox = Fancybox.getInstance();

// //** Step 2: Get a reference to a Carousel Autoplay plugin
// const autoplay = fancybox.plugins.Slideshow.ref;
// // or
// const autoplay = fancybox.Carousel.plugins.Autoplay;

// //** Step 3: Use any Carousel Autoplay API method, for example:

// // Start autoplay
// autoplay.start();

// // Stop autoplay
// autoplay.stop();

// });

Fancybox.bind('[data-fancybox="gallery"]', {
    //
    // hideScrollbar: false,
    dragToClose: false,
    Toolbar: {
        items: {
            facebook: {
                tpl: `<button class="f-button"><svg><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></button>`,
                click: () => {
                    window.open(
                        `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                            window.location.href
                        )}&t=${encodeURIComponent(document.title)}`,
                        "",
                        "left=0,top=0,width=600,height=300,menubar=no,toolbar=no,resizable=yes,scrollbars=yes"
                    );
                },
            },
        },
        display: {
            left: [],
            middle: [],
            right: ['facebook', 'iterateZoom', 'download', 'fullscreen', 'close'],
        },
    },
});

/*   download: {
    tpl: '<a class="f-button" title="{{DOWNLOAD}}" data-fancybox-download href="javasript:;"><svg><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M7 11l5 5 5-5M12 4v12"/></svg></a>',
    click: (fancybox, slide) => {
        const url = slide.downloadSrc || slide.src;

        if (!url) {
          alert("No image URL found.");
          return;
        }

        // Create a temporary download link
        const a = document.createElement("a");
        a.href = url;
        a.download = url.split('/').pop(); // optional: rename here
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      },
}, */

document.addEventListener("DOMContentLoaded", function () {
    const mainImageSrc = "<?php echo get_template_directory_uri(); ?>/assets/images/test.jpg";
    const watermarkSrc = "<?php echo get_template_directory_uri(); ?>/assets/images/watermark.png";
    const fancyLink = document.getElementById("watermarked-link");

    Promise.all([loadImage(mainImageSrc), loadImage(watermarkSrc)])
        .then(([mainImg, watermarkImg]) => {
            const canvas = document.createElement("canvas");
            canvas.width = mainImg.width;
            canvas.height = mainImg.height;

            const ctx = canvas.getContext("2d");
            ctx.drawImage(mainImg, 0, 0);

            const posX = canvas.width - watermarkImg.width - 10;
            const posY = canvas.height - watermarkImg.height - 10;

            ctx.drawImage(watermarkImg, posX, posY);

            const base64 = canvas.toDataURL("image/jpeg");

            // Set base64 as data-src
            fancyLink.setAttribute("data-src", base64);

            // Optional: Open Fancybox on click after it's ready
            fancyLink.addEventListener("click", function (e) {
                e.preventDefault();
                Fancybox.show([{ src: base64, type: "image" }]);
            });
        })
        .catch((err) => {
            console.error("Image load error:", err);
        });

    function loadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = "anonymous"; // Only needed if image is from another domain and allows CORS
            img.onload = () => resolve(img);
            img.onerror = () => reject(new Error("Image load failed: " + src));
            img.src = src;
        });
    }
});
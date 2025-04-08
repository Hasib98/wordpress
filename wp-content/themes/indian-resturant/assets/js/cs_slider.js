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
    // dragToClose: false,
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


window.onload = function () {
    const anchor = document.getElementById("fancyAnchor");
    const img = document.getElementById("fancyImage");

    const originalSrc = anchor.getAttribute("data-src");
    console.log(anchor,);
    console.log(img);
    console.log(originalSrc);

    const image = new Image();
    image.crossOrigin = "anonymous"; // Required for loading external images into canvas
    image.src = originalSrc;


    image.onload = function () {
        const canvas = document.createElement("canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        console.log(canvas)

        const ctx = canvas.getContext("2d");


        ctx.drawImage(image, 0, 0);

        // Add watermark text
        ctx.font = "80px sans-serif";
        ctx.fillStyle = "#ffffff";
        ctx.textAlign = "right";
        ctx.fillText("Watermark", canvas.width - 20, canvas.height - 20);

        // Get new data URL from canvas
        const watermarkedDataUrl = canvas.toDataURL("image/png");

        // Update both the img src and anchor data-src
        img.src = watermarkedDataUrl;
        anchor.setAttribute("data-src", watermarkedDataUrl);
    };
};
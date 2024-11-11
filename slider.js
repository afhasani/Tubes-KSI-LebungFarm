document.addEventListener("DOMContentLoaded", function () {
  const sliders = [
    { element: document.getElementById("slider-left"), index: 0 },
    { element: document.getElementById("slider-right"), index: 0 },
  ];
  const autoSlideInterval = 3000; // Interval untuk auto-slide dalam milidetik (3 detik)

  sliders.forEach((slider) => {
    const images = slider.element.querySelectorAll(".slider-content img");
    const totalImages = images.length;
    let interval;

    // Fungsi untuk menggeser gambar ke arah kanan
    function slideRight() {
      slider.index = (slider.index + 1) % totalImages;
      updateSlider();
    }

    // Fungsi untuk menggeser gambar ke arah kiri
    function slideLeft() {
      slider.index = (slider.index - 1 + totalImages) % totalImages;
      updateSlider();
    }

    // Fungsi untuk memperbarui tampilan slider
    function updateSlider() {
      slider.element.querySelector(
        ".slider-content"
      ).style.transform = `translateX(-${375 * slider.index}px)`;
    }

    // Fungsi untuk memulai auto-slide
    function startAutoSlide() {
      stopAutoSlide(); // Hentikan interval sebelumnya (jika ada) untuk menghindari duplikasi
      interval = setInterval(slideRight, autoSlideInterval);
    }

    // Fungsi untuk menghentikan auto-slide
    function stopAutoSlide() {
      clearInterval(interval);
    }

    // Mulai auto-slide
    startAutoSlide();

    // Tambahkan event listener untuk tombol kiri dan kanan
    const leftButton = slider.element.querySelector(".left-button");
    const rightButton = slider.element.querySelector(".right-button");

    leftButton.addEventListener("click", () => {
      slideLeft();
      startAutoSlide(); // Reset auto-slide interval setelah klik
    });

    rightButton.addEventListener("click", () => {
      slideRight();
      startAutoSlide(); // Reset auto-slide interval setelah klik
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const scrollContainer = document.querySelector(".scroll-container");
  const boxWidth =
    scrollContainer.querySelector(".orange-box").offsetWidth + 30; // Lebar kotak + margin
  const totalWidth = boxWidth * scrollContainer.children.length;
  const halfWidth = totalWidth / 2; // Setengah dari total lebar konten (asli + duplikat)
  let position = 0;

  function startScroll() {
    // Geser kontainer ke kiri
    position -= 1;
    scrollContainer.style.transform = `translateX(${position}px)`;

    // Jika posisi mencapai setengah total width, reset ke posisi awal untuk seamless loop
    if (Math.abs(position) >= halfWidth) {
      position = 0; // Reset posisi ke awal konten asli
      scrollContainer.style.transition = "none"; // Hapus transisi sementara untuk reset
      scrollContainer.style.transform = `translateX(${position}px)`;

      // Reflow untuk memastikan reset diterapkan tanpa transisi
      void scrollContainer.offsetWidth;

      // Kembalikan transisi untuk animasi berkelanjutan
      scrollContainer.style.transition = "transform 0.5s linear";
    }

    // Lanjutkan animasi
    requestAnimationFrame(startScroll);
  }

  startScroll();
});

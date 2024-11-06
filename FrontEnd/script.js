document.querySelector('.menu-icon').addEventListener('click', function() {
    document.querySelector('.menu').classList.toggle('active');
});

function nextSlide(button) {
    const slider = button.parentElement;
    const slides = slider.querySelectorAll('.slide');
    let currentIndex = Array.from(slides).findIndex(slide => slide.classList.contains('active'));

    slides[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + 1) % slides.length;  // pindah ke slide berikutnya
    slides[currentIndex].classList.add('active');
}

function prevSlide(button) {
    const slider = button.parentElement;
    const slides = slider.querySelectorAll('.slide');
    let currentIndex = Array.from(slides).findIndex(slide => slide.classList.contains('active'));

    slides[currentIndex].classList.remove('active');
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;  // pindah ke slide sebelumnya
    slides[currentIndex].classList.add('active');
}

function createCircularSlider(sliderId, direction = "right") {
    const slider = document.getElementById(sliderId);
    const slides = Array.from(slider.children);
    const totalSlides = slides.length;
    const slideWidth = slides[0].offsetWidth;

    let currentIndex = 0;

    // Clone the slides at the beginning and end for smooth circular effect
    slides.forEach(slide => slider.appendChild(slide.cloneNode(true))); // Duplicate slides to the end
    slides.forEach(slide => slider.insertBefore(slide.cloneNode(true), slides[0])); // Duplicate slides to the beginning

    function slideNext() {
        currentIndex++;

        // Apply different directions based on the slider
        let translateXValue = direction === "left" ? -slideWidth * currentIndex : slideWidth * currentIndex;

        // Smoothly translate the slider
        slider.style.transition = 'transform 0.5s ease';
        slider.style.transform = `translateX(${translateXValue}px)`;

        // When reaching the end of the original slides, reset to start (without transition)
        if (currentIndex >= totalSlides) {
            setTimeout(() => {
                slider.style.transition = 'none';
                slider.style.transform = 'translateX(0px)';
                currentIndex = 0;
            }, 500); // Reset after the transition ends
        }
    }

    setInterval(slideNext, 2000); // Change slides every 2 seconds
}

const sliderContent = document.querySelector('.slider-content');
const cards = document.querySelectorAll('.card');

// Clone the first few cards to create an infinite effect
cards.forEach(card => {
    const clone = card.cloneNode(true);
    sliderContent.appendChild(clone);
});

// Adjust the animation duration based on the number of cards
const totalCards = cards.length;
const animationDuration = 20; // seconds
sliderContent.style.animationDuration = `${animationDuration / totalCards}s`;


function nextSlide(btn) {
    const slides = btn.parentElement.getElementsByClassName("slide");
    let activeIndex = Array.from(slides).findIndex(slide => slide.classList.contains("active"));
    slides[activeIndex].classList.remove("active");
    slides[(activeIndex + 1) % slides.length].classList.add("active");
}

function prevSlide(btn) {
    const slides = btn.parentElement.getElementsByClassName("slide");
    let activeIndex = Array.from(slides).findIndex(slide => slide.classList.contains("active"));
    slides[activeIndex].classList.remove("active");
    slides[(activeIndex - 1 + slides.length) % slides.length].classList.add("active");
}

function toggleMobileMenu() {
    const navbar = document.getElementById('navbar');
    const burgerIcon = document.querySelector('.mobile-nav-toggle');
    const closeIcon = document.querySelector('.mobile-nav-close');

    // Toggle kelas 'navbar-mobile' untuk menampilkan atau menyembunyikan menu
    navbar.classList.toggle('navbar-mobile');

    // Kontrol visibilitas ikon burger dan close
    if (navbar.classList.contains('navbar-mobile')) {
        burgerIcon.style.display = 'none';  // Sembunyikan ikon burger
        closeIcon.style.display = 'block';  // Tampilkan ikon close
    } else {
        burgerIcon.style.display = 'block'; // Tampilkan ikon burger
        closeIcon.style.display = 'none';   // Sembunyikan ikon close
    }
}




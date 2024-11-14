
function setupSlider(id) {
const profiles = document.getElementById(id);
let clone = profiles.innerHTML;
profiles.innerHTML += clone;

let scrollAmount = 0;
const scrollStep = 1;
const scrollInterval = 20;

function autoScroll() {
    scrollAmount += scrollStep;
    profiles.style.transform = `translateX(-${scrollAmount}px)`;

    if (scrollAmount >= profiles.scrollWidth / 2) {
    scrollAmount = 0;
    }
}

setInterval(autoScroll, scrollInterval);
}

setupSlider('profiles1');
setupSlider('profiles2');
setupSlider('profiles3');
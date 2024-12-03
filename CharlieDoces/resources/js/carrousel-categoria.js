let currentIndex = 0;
const totalSlides = 8;
const imagesPerView = 4;
const track = document.querySelector('.carousel-track');
const imageWidth = 110; // 100px width + 10px margin-right

function moveSlides(direction) {
    currentIndex += direction;

    // Prevent sliding out of bounds
    if (currentIndex < 0) {
        currentIndex = 0;
    }
    if (currentIndex > totalSlides - imagesPerView) {
        currentIndex = totalSlides - imagesPerView;
    }

    // Move the track
    track.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
}

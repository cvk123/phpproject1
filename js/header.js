const menuIcon = document.querySelector(".menu-icon")
const navigation = document.querySelector("nav")
const hamburgerIcon = document.querySelector(".fa-solid")


menuIcon.addEventListener("click", () => {
    if (hamburgerIcon.classList[1] === "fa-bars") {
        hamburgerIcon.classList.remove("fa-bars")
        hamburgerIcon.classList.add("fa-xmark")
        navigation.style.display = "block"
    } else {
        hamburgerIcon.classList.remove("fa-xmark")
        hamburgerIcon.classList.add("fa-bars")
        navigation.style.display = "none"
    }
})


var audio = document.getElementById("myAudio");
var playButton = document.getElementById("playButton");
var playIcon = document.getElementById("playIcon");
var volumeSlider = document.getElementById("volumeSlider");
audio.volume = volumeSlider.value= 0.1;

function toggleAudio() {
  if (audio.paused) {
    audio.play();
    playIcon.classList.remove("fa-play");
    playIcon.classList.add("fa-pause");
  } else {
    audio.pause();
    playIcon.classList.remove("fa-pause");
    playIcon.classList.add("fa-play");
  }
}

function changeVolume() {
  audio.volume = volumeSlider.value;
}

  
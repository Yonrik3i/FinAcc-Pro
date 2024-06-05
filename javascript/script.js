var navLinks = document.getElementById("navLinks");

function showMenu() {
  navLinks.style.right = "0";
  localStorage.setItem("menuStatus", "shown");
}

function hideMenu() {
  navLinks.style.right = "-200px";
  localStorage.setItem("menuStatus", "hidden");
}

document.addEventListener("DOMContentLoaded", function () {
  let menuStatus = localStorage.getItem("menuStatus");

  if (menuStatus === "shown") {
    showMenu();
  } else {
    hideMenu();
  }
});

var btn = document.getElementsByClassName("btn");
var slide = document.getElementById("slide");

btn[0].onclick = function () {
  slide.style.transform = "translateX(0)";
  for (var i = 0; i < btn.length; i++) {
    btn[i].classList.remove("active");
  }
  this.classList.add("active");
};
btn[1].onclick = function () {
  slide.style.transform = "translateX(-800px)";
  for (var i = 0; i < btn.length; i++) {
    btn[i].classList.remove("active");
  }
  this.classList.add("active");
};
btn[2].onclick = function () {
  slide.style.transform = "translateX(-1600px)";
  for (var i = 0; i < btn.length; i++) {
    btn[i].classList.remove("active");
  }
  this.classList.add("active");
};
btn[3].onclick = function () {
  slide.style.transform = "translateX(-2400px)";
  for (var i = 0; i < btn.length; i++) {
    btn[i].classList.remove("active");
  }
  this.classList.add("active");
};

// Modal Section
const newSection = document.querySelector(".new-section");
const overlay = newSection.querySelector(".overlay");
const showModalBtn = document.querySelector(".show-modal");
const closeBtn = newSection.querySelector(".close-btn");
const contactUsBtn = document.querySelector(".hero-btn"); // Select the CONTACT US button

showModalBtn.addEventListener("click", () => {
  newSection.classList.add("active");
  overlay.classList.add("active");
  showModalBtn.classList.add("hidden"); // Hide the show modal button
  contactUsBtn.classList.add("hidden"); // Hide the CONTACT US button
  showAlert();
});

overlay.addEventListener("click", () => {
  newSection.classList.remove("active");
  overlay.classList.remove("active");
  showModalBtn.classList.remove("hidden"); // Show the show modal button
  contactUsBtn.classList.remove("hidden"); // Show the CONTACT US button
});

closeBtn.addEventListener("click", () => {
  newSection.classList.remove("active");
  overlay.classList.remove("active");
  showModalBtn.classList.remove("hidden"); // Show the show modal button
  contactUsBtn.classList.remove("hidden"); // Show the CONTACT US button
});

function showAlert() {
  alert("Testing alert");

  let confirmation = confirm("Next?");

  if (confirmation) {
    console.log("Ngoke!");
  } else {
    console.log("Aduhhh!");
  }
}

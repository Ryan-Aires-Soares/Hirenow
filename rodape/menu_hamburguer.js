function toggleMenu() {
  var menu = document.querySelector(".navegation");
  var menuIcon = document.getElementById("menu-icon");
  var closeIcon = document.getElementById("close-icon");

  menu.classList.toggle("active");

  if (menu.classList.contains("active")) {
    menuIcon.style.display = "none";
    closeIcon.style.display = "flex";
  } else {
    menuIcon.style.display = "flex";
    closeIcon.style.display = "none";
  }
}
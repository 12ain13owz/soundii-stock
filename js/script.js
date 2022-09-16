// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

if (window.innerWidth <= 768) {
  sidebar.classList.toggle("hide");
}

const switchMode = document.getElementById("switch-mode");
setTheme();

switchMode.addEventListener("change", function () {
  if (this.checked) {
    document.body.classList.add("dark");
    localStorage.setItem("theme", "dark");
  } else {
    document.body.classList.remove("dark");
    localStorage.setItem("theme", "white");
  }
});

function setTheme() {
  let theme = localStorage.getItem("theme");
  if (!theme) {
    theme = "white";
    localStorage.setItem("theme", "white");
  }

  if (theme == "dark") {
    switchMode.checked = true;
    document.body.classList.add(theme);
  } else {
    switchMode.checked = false;
    document.body.classList.remove("dark");
  }
}

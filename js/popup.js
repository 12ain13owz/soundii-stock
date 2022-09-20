const popupBox = document.querySelector(".popup-box");
const popupName = document.querySelector("#popup-name");
const btnCancel = document.querySelector(".btn-cancel");
const btnOK = document.querySelector(".btn-ok");
let linkDelete = "";

btnCancel.addEventListener("click", function () {
  popupBox.style.opacity = 0;
  popupBox.style.pointerEvents = "none";
});

btnOK.addEventListener("click", function () {
  window.location = linkDelete;
});

document.addEventListener("click", (e) => {
  const isClosest = e.target.closest(".popup-box");
  const opacity = popupBox.style.opacity;

  if (!isClosest && opacity == 1) {
    popupBox.style.opacity = 0;
    popupBox.style.pointerEvents = "none";
  }
});

function onPopup(value, link) {
  setTimeout(() => {
    popupBox.style.opacity = 1;
    popupBox.style.pointerEvents = "auto";
    popupName.textContent = value;
    linkDelete = link;
  }, 20);
}

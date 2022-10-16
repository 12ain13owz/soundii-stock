const uploadWrapper = document.querySelector(".upload-wrapper");
const uploadDefaultBtn = document.querySelector("#upload-default-btn");
const uploadBtn = document.querySelector("#upload-btn");
const uploadImage = document.querySelector("#upload-image");
const uploadCancel = document.querySelector("#upload-cancel-btn");
const regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\).\%\+\~\_]+$/;

uploadDefaultBtn.addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      uploadImage.src = result;
      uploadWrapper.classList.add("active");
    };
    reader.readAsDataURL(file);
  }

  if (this.value) uploadBtn.textContent = this.value.match(regExp);
});

uploadCancel.addEventListener("click", function () {
  uploadImage.src = "";
  uploadWrapper.classList.remove("active");
  uploadBtn.textContent = "เลือกไฟล์";
});

function defaultBtnActive() {
  uploadDefaultBtn.click();
}

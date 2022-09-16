const allForm = document.querySelectorAll(".form input, .form textarea");

for (let form of allForm) {
  form.addEventListener("input", function () {
    if (this.checkValidity()) {
      this.classList.add("valid");
      this.classList.remove("invalid");
    } else {
      this.classList.add("invalid");
      this.classList.remove("valid");
    }

    if (this.value === "") {
      this.classList.remove("valid");
      this.classList.remove("invalid");
    }
  });
}

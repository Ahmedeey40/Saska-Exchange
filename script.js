function showForm(formId) {
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}

function showForgotForm() {
    document.getElementById("forgot-form").style.display = "block";
}
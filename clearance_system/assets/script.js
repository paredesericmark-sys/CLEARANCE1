function showPassword(inputId) {
    const input = document.getElementById(inputId);
    input.type = "text";
}

function hidePassword(inputId) {
    const input = document.getElementById(inputId);
    input.type = "password";
}
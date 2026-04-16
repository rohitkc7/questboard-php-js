document.addEventListener("DOMContentLoaded", () => {
  const button = document.getElementById("testButton");
  const message = document.getElementById("message");
  const clearButton = document.getElementById("clearButton");

  button.addEventListener("click", () => {
    message.style.display = "block";
    message.textContent = "Javascript is connected and working";
    clearButton.style.display = "block";
  });
  clearButton.addEventListener("click", () => {
    message.style.display = "none";
    clearButton.style.display = "none";
  });
});

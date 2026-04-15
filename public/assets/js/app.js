document.addEventListener("DOMContentLoaded", () => {
  const button = document.getElementById("testButton");
  const message = document.getElementById("message");

  button.addEventListener("click", () => {
    message.textContent = "Javascript is connected and working";
  });
});

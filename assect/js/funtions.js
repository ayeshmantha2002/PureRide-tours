// preLoader
var loading = document.getElementById("loading");

window.addEventListener("load", function () {
  loading.style.display = "none";
});

function clickFunction() {
  document.getElementById("loading").style.display = "flex";
}

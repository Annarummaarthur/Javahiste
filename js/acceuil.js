const body = document.querySelector("body");
const quote = document.querySelector(".quote");

fitForContainer();
window.addEventListener("resize", () => {
  fitForContainer();
});

function fitForContainer() {
  	if(body.offsetHeight > 600 && body.offsetWidth > 600) {
		quote.classList.remove('small-container');
	} else {
		quote.classList.add("small-container");
	}
}
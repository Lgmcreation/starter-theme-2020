//button menu
let burger = document.getElementById("burger");
burger.addEventListener("click", () => {
	document.body.classList.toggle("open-menu");
}, false);

//gestion click #footer
var openMenu = document.getElementsByClassName('open-menu');
var link_contact = document.querySelector('a[href^="#footer"]');

if (openMenu) {
	link_contact.addEventListener('click', (e) => {
		document.body.classList.remove("open-menu")
	})
}

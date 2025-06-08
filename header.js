document.addEventListener('DOMContentLoaded', function () {
	const hamburgerButton = document.getElementById('hamburgerButton');
	const dropdownMenu = document.getElementById('dropdownMenu');
	
	//Toggle the dropdown menu on logo click
	hamburgerButton.addEventListener('click', function (event) {
		event.stopPropagation();
		dropdownMenu.classList.toggle('show');
	});
	
	//Close the dropdown if clicking outside of it
	document.addEventListener('click', function (event) {
		if (!hamburgerButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
			dropdownMenu.classList.remove('show');
		}
	});
});
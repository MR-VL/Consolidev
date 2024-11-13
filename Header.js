document.addEventListener('DOMContentLoaded', function () {
	const dropdownToggle = document.getElementById('dropdownToggle');
	const dropdownMenu = document.getElementById('dropdownMenu');
	
	//Toggle the dropdown menu on logo click
	dropdownToggle.addEventListener('click', function (event) {
		event.stopPropagation();
		dropdownMenu.classList.toggle('show');
	});
	
	//Close the dropdown if clicking outside of it
	document.addEventListener('click', function (event) {
		if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
			dropdownMenu.classList.remove('show');
		}
	});
});
const mobileMenu = () => {
	const menu = document.querySelector('.mobile-menu')
	const toggle = document.querySelector('.menutoggle')
	const sideNav = document.querySelector('.navigation')
	const links = document.querySelectorAll('.menu-item a')

	toggle &&
		toggle.addEventListener('click', e => {
			console.log('mobile')
			menu.classList.toggle('crossed')
			sideNav.classList.toggle('expanded')
		})

	links &&
		links.forEach(link => {
			link.addEventListener('click', () => {
				menu.classList.toggle('crossed')
				sideNav.classList.toggle('expanded')
				toggle.checked = false
			})
		})
}

export default mobileMenu

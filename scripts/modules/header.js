const mobileMenu = () => {
	const menu = document.querySelector('.mobile-menu')
	const sideNav = document.querySelector('.navigation')
	const links = document.querySelectorAll('.menu-item a')

	menu &&
		menu.addEventListener('click', e => {
			console.log('mobile')
			menu.classList.toggle('crossed')
			sideNav.classList.toggle('expanded')
		})

	links &&
		links.forEach(link => {
			link.addEventListener('click', () => {
				menu.classList.toggle('crossed')
				sideNav.classList.toggle('expanded')
			})
		})
}

export default mobileMenu

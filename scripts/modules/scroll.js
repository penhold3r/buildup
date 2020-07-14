const onScroll = () => {
	check()
	window.onscroll = () => check()
}

const check = () => {
	const { body } = document
	const homeWidget = document.querySelector('body.home .search-widget .widget')
	const pageWidget = document.querySelector('.page-widget .widget')
	const offsetBody = body.classList.contains('home') ? 325 : 100

	if (body)
		window.scrollY >= offsetBody
			? body.classList.add('scrolled')
			: body.classList.remove('scrolled')

	if (homeWidget)
		window.scrollY >= 325
			? homeWidget.classList.add('sticky')
			: homeWidget.classList.remove('sticky')

	if (pageWidget)
		window.scrollY >= 100
			? pageWidget.classList.add('sticky')
			: pageWidget.classList.remove('sticky')
}

export default onScroll

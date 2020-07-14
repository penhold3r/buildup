const suscribe = () => {
	const form = document.querySelector('.subscribe__form')

	form && initSuscribe(form)
}

const initSuscribe = form => {
	console.log(form)
	form.addEventListener('submit', e => {
		e.preventDefault()
		form.reset()
	})
}

export default suscribe

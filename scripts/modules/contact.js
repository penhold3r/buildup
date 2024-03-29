import submitFormData from '../utils/submit-form'

const contact = () => {
	const form = document.querySelector('.contact-form')

	form && initForm(form)
}

const initForm = form => {
	const settings = {
		dest: theme.adminAjax,
		fields: '.form-field',
		reciever: form.dataset.recip || 'penhold3r@gmail.com',
		urlencoded: true,
		wpAction: 'submit_form',
	}

	form.addEventListener('submit', e => {
		e.preventDefault()

		const msg = form.querySelector('.output-msg')

		msg.querySelector('p').innerHTML = 'Enviando...'
		msg.classList.add('visible')

		submitFormData(form, settings)
			.then(({ data: { success, data } }) => {
				console.log({ ok: { success, data } })
				contactResp(msg, data.name, success)
			})
			.catch(({ ok, data, valid }) => {
				console.warn({ 'not ok': { ok, valid, data } })
				if (!valid) {
					msg.querySelector('p').innerHTML = ''
					msg.classList.remove('visible')
					data.field.classList.add('invalid')
				} else {
					contactResp(msg, data.name, ok)
				}
			})
	})
}

const contactResp = (msg, name, ok) => {
	const msgClose = document.createElement('div')
	const txt = ok
		? `${name}, gracias por comunicarte con nosotros, te responderemos a la brevedad.`
		: `${name ? name + ', a' : 'A'}lgo parece haber salido mal, intenta luego más tarde.`

	msgClose.classList.add('button--outline--light', 'close-form-msg')
	msgClose.innerHTML = 'Enviar otro mensaje'
	msg.appendChild(msgClose)
	msgClose.addEventListener('click', e => msg.classList.remove('visible'))

	msg.querySelector('p').innerHTML = txt
	msg.classList.add('visible')

	msg.querySelector('p').className = ok ? 'msg-ok' : 'msg-error'
}

export default contact

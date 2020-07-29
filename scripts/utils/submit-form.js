/* eslint-disable */
//--------------------------------------------------------
//>>   SUBMIT FORMS
//--------------------------------------------------------
/**
 *
 * @param {HTMLFormElement} form - reference to form elemnt
 * @param {Object.<string, *>} settings - settings before send
 */
const submitFormData = (form, settings) => {
	if (!settings || !form) {
		console.warn('Must configure form settings')
		return false
	} else if (!settings.dest) console.warn('Must set "dest" property: example – "dest":"/contact"')
	else if (!settings.fields)
		console.warn('Must set "fields" property value with input class name.')
	else {
		const fields = form.querySelectorAll(settings.fields)

		form.setAttribute('novalidate', '')

		return send(form, fields, settings)
	}
}
//
const send = (form, fields, settings) => {
	const formData = new FormData(form)
	const opt = { method: 'POST', credentials: 'same-origin' }
	//
	const { valid, field } = validate(fields)
	//
	if (settings.name) formData.append('form-name', settings.name)
	if (settings.reciever) formData.append('dest', settings.reciever)
	if (settings.wpAction) formData.append('action', settings.wpAction)
	//
	opt.headers = {
		'Content-Type': settings.urlencoded
			? 'application/x-www-form-urlencoded'
			: 'application/json',
		'Cache-Control': 'no-cache',
	}
	opt.body = settings.urlencoded ? urlencodeFormData(formData) : formData
	//
	devLog('to send:', opt)
	//
	return new Promise((resolve, reject) => {
		valid
			? fetch(settings.dest, opt)
					.then(result => result.json())
					.then(resp => {
						devLog('RESPONSE: ', resp)

						form.reset()

						resolve({ ok: true, data: resp, valid })
					})
					.catch(error => {
						reject({ ok: false, data: { error }, valid })
						devLog('Error: ', error)
					})
			: reject({ ok: false, data: { field }, valid })
	})
}
//
const validate = fields => {
	const regex = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/

	for (let field of fields) {
		if (field.hasAttribute('required')) {
			if (
				field.value === '' ||
				(field.getAttribute('name') === 'email' && !regex.test(field.value))
			) {
				field.focus()
				devLog('invalid', field)
				return { field, valid: false }
			}
		}
	}
	return { valid: true }
}
//
const devLog = (...args) => {
	process.env.NODE_ENV && process.env.NODE_ENV === 'development' && console.log(...args)
}
/**
 *
 * @param {FormData} fd - FromData Object to encode
 * @returns {String}
 */
const urlencodeFormData = fd => {
	let str = ''
	const encode = str => encodeURIComponent(str).replace(/%20/g, '+')
	for (const pair of fd.entries()) {
		if (typeof pair[1] == 'string') {
			str += (str ? '&' : '') + encode(pair[0]) + '=' + encode(pair[1])
		}
	}
	return str
}
//------------------------------------------------
export default submitFormData

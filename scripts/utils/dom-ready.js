const domReady = callback => {
	document.readyState === 'interactive' || document.readyState === 'complete'
		? callback()
		: document.addEventListener('DOMContentLoaded', callback)
}

export default domReady

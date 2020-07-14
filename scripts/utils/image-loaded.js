const imageLoaded = (img, cb) => {
	if (img.complete) {
		cb()
	} else {
		img.addEventListener('load', cb)
		img.addEventListener('error', err => console.error('IMAGE LOADED ERROR', err))
	}
}

export default imageLoaded

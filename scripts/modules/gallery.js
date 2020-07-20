//--------------------------------------------------------
//>>   GALLERY EVENTS
//--------------------------------------------------------
import imageLoaded from '../utils/image-loaded'
import animationEnded from '../utils/animation-ended'

const Gallery = () => {
	const galleries = document.querySelectorAll('.project-gallery')

	if (galleries) for (let gal of galleries) galleryEvents(gal)
}

const galleryEvents = gallery => {
	const slider = gallery.querySelector('.slider')
	const imgs = slider.querySelectorAll('.image-block')
	const prev = gallery.querySelector('.prev')
	const next = gallery.querySelector('.next')

	let view = slider.parentElement.offsetWidth
	let rest = slider.scrollWidth
	let count = 1
	let percentage = 0

	next.addEventListener('click', () => {
		if (rest < view) return
		percentage = -18 * count
		slider.style.left = percentage + '%'
		count++
		rest = rest - view * 0.18
	})

	prev.addEventListener('click', () => {
		if (percentage >= 0) return
		percentage = percentage + 18
		slider.style.left = percentage + '%'
		count--
		rest = rest + view * 0.18
	})

	for (let img of imgs) img.addEventListener('click', e => galleryModal(e, gallery))
}

const galleryModal = (e, gallery) => {
	const img = e.currentTarget.getAttribute('data-full')
	const template = gallery.querySelector('.gallery-template')
	const imgs = Array.from(gallery.querySelectorAll('.image-block img'))
	const pageContent = document.querySelector('main.site-main')
	const index = imgs.indexOf(e.target)

	template.content.querySelector('img').setAttribute('src', img)
	document.body.insertBefore(template.content.cloneNode(true), pageContent)
	document.body.style.overflow = 'hidden'
	pageContent.classList.add('blurred')

	modalEvents(document.querySelector('.gallery-modal'), imgs, index)
}

const modalEvents = (modal, imgs, index) => {
	const wrapper = modal.querySelector('.inner-modal')
	const modalImg = modal.querySelector('img')
	const close = modal.querySelector('.close-modal')
	const prev = modal.querySelector('.prev-btn')
	const next = modal.querySelector('.next-btn')

	let count = index,
		urls = []

	imageLoaded(modalImg, () => {
		modalImg.style.opacity = 1
		wrapper.classList.remove('with-spinner')
	})

	close.addEventListener('click', () => {
		modal.classList.add('fade')
		document.querySelector('main.site-main').classList.remove('blurred')
		document.body.style.overflow = 'initial'
		animationEnded(modal, () => modal.remove())
	})

	for (let im of imgs) urls.push(im.src)

	if (count >= urls.length - 1) next.style.visibility = 'hidden'
	if (count <= 0) prev.style.visibility = 'hidden'

	next.addEventListener('click', e => {
		count++
		imageChange(wrapper, modalImg, urls[count])
		if (count >= urls.length - 1) e.currentTarget.style.visibility = 'hidden'
		if (count >= 0) prev.style.visibility = 'visible'
	})

	prev.addEventListener('click', e => {
		count--
		imageChange(wrapper, modalImg, urls[count])
		if (count <= 0) e.currentTarget.style.visibility = 'hidden'
		if (count <= urls.length - 1) next.style.visibility = 'visible'
	})
}

const imageChange = (wrapper, img, url) => {
	img.style.opacity = 0
	wrapper.classList.add('with-spinner')

	animationEnded(img, () => {
		img.setAttribute('src', url)
		imageLoaded(img, () => (img.style.opacity = 1))
		wrapper.classList.remove('with-spinner')
	})
}

export default Gallery

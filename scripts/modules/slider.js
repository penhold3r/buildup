import animationEnded from '../utils/animation-ended'

const slider = () => {
	const slider = document.querySelector('#slider')

	slider && initSlider(slider)
}

const initSlider = slider => {
	const wrapper = slider.querySelector('#slides')
	const prev = slider.querySelector('#prev')
	const next = slider.querySelector('#next')

	const slides = wrapper.querySelectorAll('.slide')
	const slidesLength = slides.length

	const lastSlide = slides[slidesLength - 1]
	const firstSlide = slides[0]

	const cloneFirst = firstSlide.cloneNode(true)
	const cloneLast = lastSlide.cloneNode(true)

	const threshold = 100

	let slideSize = wrapper.querySelectorAll('.slide')[0].offsetWidth

	let posInitial
	let posFinal
	let posX1 = 0
	let posX2 = 0
	let index = 0
	let allowShift = true

	// Clone first and last slide
	wrapper.appendChild(cloneFirst)
	wrapper.insertBefore(cloneLast, firstSlide)

	// Mouse events
	wrapper.onmousedown = dragStart

	// Touch events
	wrapper.addEventListener('touchstart', dragStart)
	wrapper.addEventListener('touchend', dragEnd)
	wrapper.addEventListener('touchmove', dragAction)

	// Click events
	prev.addEventListener('click', () => shiftSlide('prev'))
	next.addEventListener('click', () => shiftSlide('next'))

	// auto start
	setInterval(() => shiftSlide('next'), 5000)

	// recalculate on resize
	window.addEventListener('resize', () => {
		slideSize = wrapper.querySelectorAll('.slide')[0].offsetWidth
		wrapper.style.left = '-100%'
		posInitial = 0
		posFinal = 0
		posX1 = 0
		posX2 = 0
		index = 0

		animationEnded(wrapper, checkIndex)
	})

	// Transition events
	animationEnded(wrapper, checkIndex)

	function dragStart(e) {
		e.preventDefault()
		posInitial = wrapper.offsetLeft

		if (e.type == 'touchstart') {
			posX1 = e.touches[0].clientX
		} else {
			posX1 = e.clientX
			document.onmouseup = dragEnd
			document.onmousemove = dragAction
		}
	}

	function dragAction(e) {
		if (e.type == 'touchmove') {
			posX2 = posX1 - e.touches[0].clientX
			posX1 = e.touches[0].clientX
		} else {
			posX2 = posX1 - e.clientX
			posX1 = e.clientX
		}
		wrapper.style.left = wrapper.offsetLeft - posX2 + 'px'
	}

	function dragEnd(e) {
		posFinal = wrapper.offsetLeft
		if (posFinal - posInitial < -threshold) {
			shiftSlide('next', 'drag')
		} else if (posFinal - posInitial > threshold) {
			shiftSlide('prev', 'drag')
		} else {
			wrapper.style.left = posInitial + 'px'
		}

		document.onmouseup = null
		document.onmousemove = null
	}

	function shiftSlide(dir, action) {
		wrapper.classList.add('shifting')

		if (allowShift) {
			if (!action) posInitial = wrapper.offsetLeft

			if (dir === 'next') {
				wrapper.style.left = posInitial - slideSize + 'px'
				index++
			} else if (dir === 'prev') {
				wrapper.style.left = posInitial + slideSize + 'px'
				index--
			}
		}

		allowShift = false
	}

	function checkIndex() {
		wrapper.classList.remove('shifting')

		if (index == -1) {
			wrapper.style.left = -(slidesLength * slideSize) + 'px'
			index = slidesLength - 1
		}

		if (index == slidesLength) {
			wrapper.style.left = -(1 * slideSize) + 'px'
			index = 0
		}

		allowShift = true
	}
}

export default slider

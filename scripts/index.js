/** --------------------------------------------------------
 *
 *  @file index - buildup.com
 *  @copyright 2020
 *  @author penholder designerd
 *  @version 1.0.1
 *
 */
//--------------------------------------------------------
// utils
import domReady from './utils/dom-ready'
//--------------------------------------------------------
// modules
//import onScroll from './modules/scroll'
import imageLoaded from './utils/image-loaded'
//import mobileMenu from './modules/header'
//import contact from './modules/contact'
//import suscribe from './modules/suscribe'

import AOS from 'aos'
import 'aos/dist/aos.css'

// core styles
import '../styles/index.scss'

//--------------------------------------------------------
domReady(() => {
	const landingImages = document.querySelectorAll('.lazy')

	const lazyImages = [...landingImages]

	console.table(theme)

	lazyImages &&
		lazyImages.forEach(image => {
			imageLoaded(image.querySelector('.acf-img-file'), () => {
				image.classList.add('loaded')
			})
		})

	AOS.init({
		offset: 200, // offset (in px) from the original trigger point
		delay: 0, // values from 0 to 3000, with step 50ms
		duration: 1000, // values from 0 to 3000, with step 50ms
		easing: 'ease-in-out', // default easing for AOS animations
		once: false, // whether animation should happen only once - while scrolling down
		mirror: false, // whether elements should animate out while scrolling past them
		anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
	})
})
//--------------------------------------------------------

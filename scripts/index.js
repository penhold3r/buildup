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
import onScroll from './modules/scroll'
import slider from './modules/slider'
import imageLoaded from './utils/image-loaded'
import mobileMenu from './modules/header'
import contact from './modules/contact'
import suscribe from './modules/suscribe'

// core styles
import '../styles/index.scss'

//--------------------------------------------------------
domReady(() => {
	const promoImages = document.querySelectorAll('.promo__grid__card .acf-image')
	const promoRoutesImages = document.querySelectorAll('.promo-routes__grid__card .acf-image')

	const lazyImages = [...promoImages, ...promoRoutesImages]

	console.table(theme)

	mobileMenu()
	onScroll()
	slider()
	contact()
	suscribe()

	lazyImages &&
		lazyImages.forEach(image => {
			imageLoaded(image.querySelector('.acf-img-file'), () => {
				image.classList.add('loaded')
			})
		})
})
//--------------------------------------------------------

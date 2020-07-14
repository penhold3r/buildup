//--------------------------------------------------------
//>>   DETECT CSS TRANSITION & ANIMATION END
//--------------------------------------------------------
/**
 *
 * @param {HTMLElement} element
 * @param {Function} callback
 */
const animationEnded = (element, callback) => {
	const el = document.createElement('dummy')
	const animations = {
		animation: 'animationend',
		OAnimation: 'oAnimationEnd',
		MozAnimation: 'animationend',
		WebkitAnimation: 'webkitAnimationEnd',
		transition: 'transitionend',
		OTransition: 'oTransitionEnd',
		MozTransition: 'transitionend',
		WebkitTransition: 'webkitTransitionEnd',
	}
	let type
	for (let t in animations) if (el.style[t] !== undefined) type = animations[t]
	element.addEventListener(type, callback, false)
}
//
export default animationEnded

/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

;(() => {
	const title = document.querySelector('.site-title a')
	const description = document.querySelector('.site-description')

	wp.customize('blogname', value => value.bind(to => title.text(to)))
	wp.customize('blogdescription', value => value.bind(to => description.text(to)))
})()

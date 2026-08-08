( function () {
	'use strict';

	/**
	 * Fire an event to GA4 (gtag/dataLayer) and Meta Pixel (fbq) when configured.
	 * Safe no-op when neither tracking tool is loaded.
	 */
	function ciTrack( eventName, params ) {
		params = params || {};

		if ( typeof window.gtag === 'function' ) {
			window.gtag( 'event', eventName, params );
		}

		if ( typeof window.fbq === 'function' ) {
			window.fbq( 'trackCustom', eventName, params );
		}
	}

	/** Append current UTM params (if present) to a checkout URL. */
	function ciAppendUtm( url ) {
		try {
			var current = new URLSearchParams( window.location.search );
			var target  = new URL( url, window.location.href );
			var utmKeys = [ 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term' ];

			utmKeys.forEach( function ( key ) {
				if ( current.has( key ) ) {
					target.searchParams.set( key, current.get( key ) );
				}
			} );

			return target.toString();
		} catch ( e ) {
			return url;
		}
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		ciTrack( 'view_landing_page' );

		/* CTA clicks -------------------------------------------------- */
		var ctas = document.querySelectorAll( '.ci-js-cta' );
		ctas.forEach( function ( cta ) {
			if ( cta.hasAttribute( 'href' ) && /^https?:\/\//.test( cta.getAttribute( 'href' ) ) ) {
				cta.setAttribute( 'href', ciAppendUtm( cta.getAttribute( 'href' ) ) );
			}

			cta.addEventListener( 'click', function () {
				var eventName = cta.getAttribute( 'data-event' ) || 'click_checkout';
				var location  = cta.getAttribute( 'data-location' ) || 'unknown';

				ciTrack( eventName, { cta_location: location } );

				if ( 'oferta' === location ) {
					ciTrack( 'begin_checkout', { cta_location: location } );
				}
			} );
		} );

		/* FAQ accordion -------------------------------------------------- */
		var faqButtons = document.querySelectorAll( '.ci-js-faq' );
		faqButtons.forEach( function ( button ) {
			button.addEventListener( 'click', function () {
				var expanded = 'true' === button.getAttribute( 'aria-expanded' );
				var answer   = document.getElementById( button.getAttribute( 'aria-controls' ) );

				button.setAttribute( 'aria-expanded', expanded ? 'false' : 'true' );

				if ( answer ) {
					answer.style.maxHeight = expanded ? null : answer.scrollHeight + 'px';
				}

				if ( ! expanded ) {
					ciTrack( 'faq_open', { question: button.textContent.trim() } );
				}
			} );
		} );

		/* Sticky CTA visibility ------------------------------------------ */
		var stickyCta = document.getElementById( 'ci-sticky-cta' );
		var heroEl    = document.getElementById( 'hero' );

		if ( stickyCta && heroEl && 'IntersectionObserver' in window ) {
			var observer = new IntersectionObserver(
				function ( entries ) {
					entries.forEach( function ( entry ) {
						stickyCta.classList.toggle( 'is-visible', ! entry.isIntersecting );
					} );
				},
				{ rootMargin: '-10% 0px 0px 0px' }
			);
			observer.observe( heroEl );
		}

		/* Reveal on scroll (respects prefers-reduced-motion via CSS) ----- */
		var revealTargets = document.querySelectorAll( '.ci-card, .ci-compare__col, .ci-testimonial' );
		revealTargets.forEach( function ( el ) { el.classList.add( 'ci-reveal' ); } );

		if ( 'IntersectionObserver' in window ) {
			var revealObserver = new IntersectionObserver(
				function ( entries, obs ) {
					entries.forEach( function ( entry ) {
						if ( entry.isIntersecting ) {
							entry.target.classList.add( 'is-visible' );
							obs.unobserve( entry.target );
						}
					} );
				},
				{ threshold: 0.15 }
			);
			revealTargets.forEach( function ( el ) { revealObserver.observe( el ); } );
		} else {
			revealTargets.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
		}

		/* Scroll depth events --------------------------------------------- */
		var fired50 = false;
		var fired90 = false;

		window.addEventListener(
			'scroll',
			function () {
				var scrollTop    = window.scrollY || document.documentElement.scrollTop;
				var docHeight    = document.documentElement.scrollHeight - window.innerHeight;
				var scrollPct    = docHeight > 0 ? ( scrollTop / docHeight ) * 100 : 0;

				if ( ! fired50 && scrollPct >= 50 ) {
					fired50 = true;
					ciTrack( 'scroll_50' );
				}

				if ( ! fired90 && scrollPct >= 90 ) {
					fired90 = true;
					ciTrack( 'scroll_90' );
				}
			},
			{ passive: true }
		);
	} );
} )();

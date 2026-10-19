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
		var product = window.ciData && window.ciData.product;
		function itemParams( p ) {
			return p ? { currency: 'BRL', value: Number( p.price ), items: [ { item_id: p.id, item_name: p.name, price: Number( p.price ), quantity: 1 } ] } : {};
		}
		ciTrack( 'view_landing_page', product ? { product_id: product.id } : {} );
		if ( product ) {
			ciTrack( 'view_item', itemParams( product ) );
			if ( product.promotion ) {
				ciTrack( 'view_promotion', Object.assign( { promotion_id: product.id }, itemParams( product ) ) );
			}
		}

		// Pass attribution through home -> landing -> checkout, without persisting personal data.
		document.querySelectorAll( 'a[href]' ).forEach( function ( link ) {
			var href = link.getAttribute( 'href' );
			if ( href.charAt( 0 ) === '#' ) { return; }
			try {
				var target = new URL( href, window.location.href );
				if ( target.origin === window.location.origin || link.hasAttribute( 'data-checkout' ) ) {
					link.href = ciAppendUtm( href );
				}
			} catch ( e ) { /* Invalid optional links must not interrupt other interactions. */ }
		} );
		document.querySelectorAll( '.ci-js-product' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				ciTrack( 'select_item', Object.assign( { item_list_id: 'home_products' }, itemParams( { id: link.dataset.product, name: link.dataset.name, price: link.dataset.price } ) ) );
			} );
		} );
		document.querySelectorAll( '[data-checkout]' ).forEach( function ( cta ) {
			cta.addEventListener( 'click', function () {
				if ( ! product || cta.dataset.checkout !== product.id ) { return; }
				var params = Object.assign( { cta_location: cta.dataset.location || 'unknown' }, itemParams( product ) );
				ciTrack( 'click_checkout', params );
				if ( product.promotion ) { ciTrack( 'select_promotion', Object.assign( { promotion_id: product.id }, params ) ); }
				ciTrack( 'begin_checkout', params );
			} );
		} );
		// Observe the provider's generated button without replacing its payment handler.
		document.querySelectorAll( '.ci-greenn-native' ).forEach( function ( container ) {
			container.addEventListener( 'click', function ( event ) {
				if ( ! product || ! event.target.closest( '[data-greenn-upsell]' ) ) { return; }
				ciTrack( 'select_promotion', Object.assign( { promotion_id: product.id }, itemParams( product ) ) );
			} );
		} );
		document.querySelectorAll( '.ci-faq__list details' ).forEach( function ( details ) {
			details.addEventListener( 'toggle', function () {
				if ( details.open ) { ciTrack( 'faq_open', { question: details.querySelector( 'summary' ).textContent.trim() } ); }
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
						var visible = ! entry.isIntersecting;
						stickyCta.hidden = ! visible;
						stickyCta.inert = ! visible;
						stickyCta.setAttribute( 'aria-hidden', visible ? 'false' : 'true' );
						stickyCta.classList.toggle( 'is-visible', visible );
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

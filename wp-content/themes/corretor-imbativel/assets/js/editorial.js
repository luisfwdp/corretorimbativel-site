(function () {
 'use strict';
 function start() {
  if (!document.body.classList.contains('ci-editorial')) return;
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  var animations = new Set();
  // Content is never hidden. Animate only a few editorial landmarks, once.
  if ('IntersectionObserver' in window && typeof Element.prototype.animate === 'function') {
   var landmarks = document.querySelectorAll('#solucao h2, #mentalidade h2, #complementaridade h2, #exemplos .ci-section-intro');
   var reveal = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
     if (!entry.isIntersecting) return;
     reveal.unobserve(entry.target);
     if (reduced.matches || entry.target.getBoundingClientRect().top < 0) return;
     var animation = entry.target.animate([
      {opacity: .8, transform: 'translateY(8px)'},
      {opacity: 1, transform: 'translateY(0)'}
     ], {duration: 360, easing: 'cubic-bezier(.22,1,.36,1)'});
     animations.add(animation);
     animation.finished.then(function () { animations.delete(animation); }, function () { animations.delete(animation); });
    });
   }, {threshold: .2});
   landmarks.forEach(function (landmark) { reveal.observe(landmark); });
  }
  function cancelMotion() { if (reduced.matches) animations.forEach(function (animation) { animation.cancel(); }); }
  if (typeof reduced.addEventListener === 'function') reduced.addEventListener('change', cancelMotion);
  else if (typeof reduced.addListener === 'function') reduced.addListener(cancelMotion);

  var decline = document.querySelector('.ci-decline-fallback');
  if (decline) decline.addEventListener('click', function () {
   var guidance = document.getElementById(decline.getAttribute('aria-controls'));
   if (!guidance) return;
   var expanded = decline.getAttribute('aria-expanded') === 'true';
   decline.setAttribute('aria-expanded', String(!expanded));
   guidance.hidden = expanded;
  });

  // The fixed mobile CTA must not cover the offer, closing action or keyboard focus.
  var sticky = document.getElementById('ci-sticky-cta');
  var hero = document.getElementById('hero');
  if (sticky && hero && 'IntersectionObserver' in window) {
   var heroVisible = true;
   var offerVisible = new Set();
   var desktop = window.matchMedia('(min-width: 860px)');
   function updateSticky() {
    var focusedElsewhere = document.activeElement && document.activeElement !== document.body && !sticky.contains(document.activeElement);
    var visible = !!sticky.querySelector('[data-checkout]') && !desktop.matches && !heroVisible && offerVisible.size === 0 && !focusedElsewhere;
    sticky.hidden = !visible; sticky.inert = !visible;
    sticky.setAttribute('aria-hidden', String(!visible));
    sticky.classList.toggle('is-visible', visible);
   }
   var visibility = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
     if (entry.target === hero) heroVisible = entry.isIntersecting;
     else if (entry.isIntersecting) offerVisible.add(entry.target);
     else offerVisible.delete(entry.target);
    });
    updateSticky();
   });
   visibility.observe(hero);
   document.querySelectorAll('#oferta, #cta-final').forEach(function (region) { visibility.observe(region); });
   document.addEventListener('focusin', updateSticky);
   document.addEventListener('focusout', function () { window.setTimeout(updateSticky, 0); });
   if (typeof desktop.addEventListener === 'function') desktop.addEventListener('change', updateSticky);
  }
 }
 if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
 else start();
})();

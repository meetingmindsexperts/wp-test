/* OSHC 2026 — front-end interactions (vanilla JS, no dependencies). */
(function () {
	'use strict';

	var d = document;

	function ready(fn) {
		if (d.readyState !== 'loading') { fn(); }
		else { d.addEventListener('DOMContentLoaded', fn); }
	}

	ready(function () {

		/* ---- Sticky header shadow ---- */
		var header = d.querySelector('.oshc-header');
		if (header) {
			var onScroll = function () {
				header.classList.toggle('is-stuck', window.scrollY > 8);
			};
			window.addEventListener('scroll', onScroll, { passive: true });
			onScroll();
		}

		/* ---- Mobile nav ---- */
		var toggle = d.querySelector('.oshc-navtoggle');
		var nav = d.getElementById('oshc-nav');
		if (toggle && nav) {
			toggle.addEventListener('click', function () {
				var open = nav.classList.toggle('is-open');
				toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			});
			nav.querySelectorAll('a').forEach(function (a) {
				a.addEventListener('click', function () {
					nav.classList.remove('is-open');
					toggle.setAttribute('aria-expanded', 'false');
				});
			});
		}

		/* ---- Tabs ---- */
		d.querySelectorAll('[data-tabs]').forEach(function (group) {
			var tabs = group.querySelectorAll('.oshc-tab');
			var panes = group.querySelectorAll('.oshc-tabs__pane');
			tabs.forEach(function (tab) {
				tab.addEventListener('click', function () {
					var id = tab.getAttribute('data-tab');
					tabs.forEach(function (t) { t.classList.remove('is-active'); });
					panes.forEach(function (p) { p.classList.remove('is-active'); });
					tab.classList.add('is-active');
					var pane = group.querySelector('#' + id);
					if (pane) { pane.classList.add('is-active'); }
				});
			});
		});

		/* ---- Accordion ---- */
		d.querySelectorAll('[data-accordion]').forEach(function (acc) {
			acc.querySelectorAll('.oshc-acc__q').forEach(function (q) {
				q.addEventListener('click', function () {
					var panel = q.nextElementSibling;
					var open = q.getAttribute('aria-expanded') === 'true';
					// Close siblings within the same accordion.
					acc.querySelectorAll('.oshc-acc__q').forEach(function (other) {
						if (other !== q) {
							other.setAttribute('aria-expanded', 'false');
							other.nextElementSibling.style.maxHeight = null;
						}
					});
					q.setAttribute('aria-expanded', open ? 'false' : 'true');
					panel.style.maxHeight = open ? null : panel.scrollHeight + 'px';
				});
			});
		});

		/* ---- Count-up stats ---- */
		var counts = d.querySelectorAll('.oshc-count');
		if (counts.length && 'IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) { return; }
					var el = entry.target;
					io.unobserve(el);
					var target = parseInt(el.getAttribute('data-count'), 10) || 0;
					if (!target) { return; }
					var start = 0, dur = 1400, t0 = null;
					var step = function (ts) {
						if (!t0) { t0 = ts; }
						var p = Math.min((ts - t0) / dur, 1);
						el.textContent = Math.floor(start + (target - start) * (0.5 - Math.cos(p * Math.PI) / 2)).toLocaleString();
						if (p < 1) { requestAnimationFrame(step); }
					};
					requestAnimationFrame(step);
				});
			}, { threshold: 0.4 });
			counts.forEach(function (c) { io.observe(c); });
		}

		/* ---- Shared modal ---- */
		var modal = d.createElement('div');
		modal.className = 'oshc-modal';
		modal.innerHTML = '<div class="oshc-modal__box"><button class="oshc-modal__close" aria-label="Close">&times;</button><div class="oshc-modal__content"></div></div>';
		d.body.appendChild(modal);
		var modalContent = modal.querySelector('.oshc-modal__content');
		var closeModal = function () { modal.classList.remove('is-open', 'oshc-modal--img'); };
		modal.addEventListener('click', function (e) { if (e.target === modal) { closeModal(); } });
		modal.querySelector('.oshc-modal__close').addEventListener('click', closeModal);
		d.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closeModal(); } });

		/* ---- Bio pop-ups ---- */
		var openBio = function (card) {
			var name = card.querySelector('.oshc-person__name');
			var bio = card.querySelector('.oshc-person__biofull');
			if (!bio) { return; }
			var photo = card.querySelector('.oshc-person__photo img');
			var roles = card.querySelectorAll('.oshc-person__role, .oshc-person__org, .oshc-person__country');
			var meta = '';
			roles.forEach(function (r) { meta += '<p class="oshc-person__role">' + r.textContent + '</p>'; });
			modalContent.innerHTML =
				'<div class="oshc-modal__head">' +
				(photo ? '<img src="' + photo.src + '" alt="">' : '') +
				'<div><h3 style="margin:0">' + (name ? name.textContent : '') + '</h3>' + meta + '</div></div>' +
				'<div class="oshc-prose">' + bio.innerHTML + '</div>';
			modal.classList.add('is-open');
		};
		d.querySelectorAll('.oshc-person.has-bio').forEach(function (card) {
			card.addEventListener('click', function () { openBio(card); });
			card.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openBio(card); }
			});
		});

		/* ---- Gallery lightbox ---- */
		d.querySelectorAll('[data-lightbox]').forEach(function (link) {
			link.addEventListener('click', function (e) {
				e.preventDefault();
				modalContent.innerHTML = '<img src="' + link.getAttribute('href') + '" alt="' + (link.getAttribute('title') || '') + '">';
				modal.classList.add('is-open', 'oshc-modal--img');
			});
		});
	});
})();

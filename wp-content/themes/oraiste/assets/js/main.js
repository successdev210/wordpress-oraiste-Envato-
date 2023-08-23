(function ($) {
	'use strict';
	window.qodef = {};

	qodef.body = $('body');
	qodef.html = $('html');
	qodef.window = $(window);
	qodef.windowWidth = $(window).width();
	qodef.windowHeight = $(window).height();
	qodef.scroll = 0;

	$(document).ready(
		function () {
			qodef.scroll = $(window).scrollTop();
			qodefBrowserDetection.init();
			qodefSwiper.init();
			qodefMagnificPopup.init();
			qodefAnchor.init();
			qodefSelect2.init();
			qodefAppearElementsReady.init();
			qodefSvgMorph.init();
			qodefArrowCursor.init();
		}
	);

	$(window).resize(
		function () {
			qodef.windowWidth = $(window).width();
			qodef.windowHeight = $(window).height();
		}
	);

	$(window).scroll(
		function () {
			qodef.scroll = $(window).scrollTop();
		}
	);

	$(document).on(
		'oraiste_trigger_get_new_posts',
		function () {
			qodefSwiper.init();
			qodefMagnificPopup.init();
			qodefAppearElementsReady.init();
		}
	);

	/*
	 * Browser detection functionality
	 */
	var qodefBrowserDetection = {
		init            : function () {
			qodefBrowserDetection.addBodyClassName();
		},
		isBrowser       : function (name) {
			var isBrowser = false;

			switch (name) {
				case 'chrome':
					isBrowser = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
					break;
				case 'safari':
					isBrowser = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
					break;
				case 'firefox':
					isBrowser = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
					break;
				case 'ie':
					isBrowser = window.navigator.userAgent.indexOf('MSIE ') > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./);
					break;
				case 'edge':
					isBrowser = /Edge\/\d./i.test(navigator.userAgent);
					break;
			}

			return isBrowser;
		},
		addBodyClassName: function () {
			var browsers = [
				'chrome',
				'safari',
				'firefox',
				'ie',
				'edge',
			];

			$.each(
				browsers,
				function (key, value) {
					if (qodefBrowserDetection.isBrowser(value) && typeof qodef.body !== 'undefined') {
						if (value === 'ie') {
							value = 'ms-explorer';
						}

						qodef.body.addClass('qodef-browser--' + value);
					}
				}
			);
		}
	};

	/**
	 * Init swiper slider
	 */
	var qodefSwiper = {
		init          : function (settings) {
			this.holder = $('.qodef-swiper-container');

			// Allow overriding the default config
			$.extend(this.holder, settings);

			if (this.holder.length) {
				this.holder.each(
					function () {
						qodefSwiper.createSlider($(this));
					}
				);
			}
		},
		createSlider  : function ($holder) {
			var options = qodefSwiper.getOptions($holder),
				events = qodefSwiper.getEvents($holder, options);

			var $swiper = new Swiper($holder, Object.assign(options, events));
		},
		getOptions    : function ($holder, returnBreakpoints) {
			var sliderOptions = typeof $holder.data('options') !== 'undefined' ? $holder.data('options') : {},
				spaceBetween = sliderOptions.spaceBetween !== undefined && sliderOptions.spaceBetween !== '' ? sliderOptions.spaceBetween : 0,
				slidesPerView = sliderOptions.slidesPerView !== undefined && sliderOptions.slidesPerView !== '' ? sliderOptions.slidesPerView : 1,
				centeredSlides = sliderOptions.centeredSlides !== undefined && sliderOptions.centeredSlides !== '' ? sliderOptions.centeredSlides : false,
				sliderScroll = sliderOptions.sliderScroll !== undefined && sliderOptions.sliderScroll !== '' ? sliderOptions.sliderScroll : false,
				loop = sliderOptions.loop !== undefined && sliderOptions.loop !== '' ? sliderOptions.loop : true,
				autoplay = sliderOptions.autoplay !== undefined && sliderOptions.autoplay !== '' ? sliderOptions.autoplay : true,
				speed = sliderOptions.speed !== undefined && sliderOptions.speed !== '' ? parseInt(sliderOptions.speed, 10) : 5000,
				speedAnimation = sliderOptions.speedAnimation !== undefined && sliderOptions.speedAnimation !== '' ? parseInt(sliderOptions.speedAnimation, 10) : 800,
				customStages = sliderOptions.customStages !== undefined && sliderOptions.customStages !== '' ? sliderOptions.customStages : false,
				outsideNavigation = sliderOptions.outsideNavigation !== undefined && sliderOptions.outsideNavigation === 'yes',
				nextNavigation = outsideNavigation ? '.swiper-button-next-' + sliderOptions.unique : $holder.find('.swiper-button-next'),
				prevNavigation = outsideNavigation ? '.swiper-button-prev-' + sliderOptions.unique : $holder.find('.swiper-button-prev'),
				pagination = $holder.find('.swiper-pagination');

			if ( autoplay !== false && speed !== 5000 ) {
				autoplay = {
					delay: speed,
					disableOnInteraction: false
				};
			} else if ( autoplay !== false ) {
				autoplay = {
					disableOnInteraction: false
				};
			}

			if (slidesPerView === 'auto') {
				var slidesPerView1440 = 'auto',
					slidesPerView1366 = 'auto',
					slidesPerView1024 = 'auto',
					slidesPerView768 = 'auto',
					slidesPerView680 = 'auto',
					slidesPerView480 = 'auto'
			} else {
				var slidesPerView1440 = sliderOptions.slidesPerView1440 !== undefined && sliderOptions.slidesPerView1440 !== '' ? parseInt(sliderOptions.slidesPerView1440, 10) : 5,
					slidesPerView1366 = sliderOptions.slidesPerView1366 !== undefined && sliderOptions.slidesPerView1366 !== '' ? parseInt(sliderOptions.slidesPerView1366, 10) : 4,
					slidesPerView1024 = sliderOptions.slidesPerView1024 !== undefined && sliderOptions.slidesPerView1024 !== '' ? parseInt(sliderOptions.slidesPerView1024, 10) : 3,
					slidesPerView768 = sliderOptions.slidesPerView768 !== undefined && sliderOptions.slidesPerView768 !== '' ? parseInt(sliderOptions.slidesPerView768, 10) : 2,
					slidesPerView680 = sliderOptions.slidesPerView680 !== undefined && sliderOptions.slidesPerView680 !== '' ? parseInt(sliderOptions.slidesPerView680, 10) : 1,
					slidesPerView480 = sliderOptions.slidesPerView480 !== undefined && sliderOptions.slidesPerView480 !== '' ? parseInt(sliderOptions.slidesPerView480, 10) : 1;

				if (!customStages) {
					if (slidesPerView < 2) {
						slidesPerView1440 = slidesPerView;
						slidesPerView1366 = slidesPerView;
						slidesPerView1024 = slidesPerView;
						slidesPerView768 = slidesPerView;
					} else if (slidesPerView < 3) {
						slidesPerView1440 = slidesPerView;
						slidesPerView1366 = slidesPerView;
						slidesPerView1024 = slidesPerView;
					} else if (slidesPerView < 4) {
						slidesPerView1440 = slidesPerView;
						slidesPerView1366 = slidesPerView;
					} else if (slidesPerView < 5) {
						slidesPerView1440 = slidesPerView;
					}
				}
			}

			var options = {
				slidesPerView : slidesPerView,
				centeredSlides: centeredSlides,
				sliderScroll  : sliderScroll,
				spaceBetween  : spaceBetween,
				grabCursor    : true,
				autoplay      : autoplay,
				loop          : loop,
				speed         : speedAnimation,
				navigation    : {
					nextEl: nextNavigation,
					prevEl: prevNavigation
				},
				pagination    : {
					el          : pagination,
					type        : 'bullets',
					clickable   : true,
					renderBullet: function (index, className) {
						return '<span class="' + className + '">' + (index + 1) + '</span>';
					},
				},
				breakpoints   : {
					// when window width is < 481px
					0: {
						slidesPerView: slidesPerView480
					},
					// when window width is >= 481px
					481: {
						slidesPerView: slidesPerView680
					},
					// when window width is >= 681px
					681: {
						slidesPerView: slidesPerView768
					},
					// when window width is >= 769px
					769: {
						slidesPerView: slidesPerView1024
					},
					// when window width is >= 1025px
					1025: {
						slidesPerView: slidesPerView1366
					},
					// when window width is >= 1367px
					1367: {
						slidesPerView: slidesPerView1440
					},
					// when window width is >= 1441px
					1441: {
						slidesPerView: slidesPerView
					}
				},
			};

			return Object.assign(options, qodefSwiper.getSliderDatas($holder));
		},
		getSliderDatas: function ($holder) {
			var dataList = $holder.data(),
				returnValue = {};

			for (var property in dataList) {
				if (dataList.hasOwnProperty(property)) {
					// It's required to be different from data options because da options are all options from shortcode element
					if (property !== 'options' && typeof dataList[property] !== 'undefined' && dataList[property] !== '') {
						returnValue[property] = dataList[property];
					}
				}
			}

			return returnValue;
		},
		getEvents     : function ($holder, options) {
			return {
				on: {
					init: function () {
						$holder.addClass('qodef-swiper--initialized');

						if (options.sliderScroll) {
							var scrollStart = false;

							$holder.on(
								'mousewheel',
								function (e) {
									e.preventDefault();

									if (!scrollStart) {
										scrollStart = true;

										if (e.deltaY < 0) {
											$holder[0].swiper.slideNext();
										} else {
											$holder[0].swiper.slidePrev();
										}

										setTimeout(
											function () {
												scrollStart = false;
											},
											1000
										);
									}
								}
							);
						}
					}
				}
			};
		}
	};

	qodef.qodefSwiper = qodefSwiper;

	/**
	 * Init magnific popup galleries
	 */
	var qodefMagnificPopup = {
		init                : function (settings) {
			this.holder = $('.qodef-magnific-popup');

			// Allow overriding the default config
			$.extend(this.holder, settings);

			if (this.holder.length) {
				this.holder.each(
					function () {
						var $thisPopup = $(this);

						if ($thisPopup.hasClass('qodef-popup-item')) {
							qodefMagnificPopup.initSingleImagePopup($thisPopup);
						} else if ($thisPopup.hasClass('qodef-popup-gallery')) {
							qodefMagnificPopup.initGalleryPopup($thisPopup);
						}
					}
				);
			}
		},
		initSingleImagePopup: function ($popup) {
			var type = $popup.data('type');

			$popup.magnificPopup(
				{
					type       : type,
					titleSrc   : 'title',
					image      : {
						cursor: null
					},
					closeMarkup: '<button title="%title%" type="button" class="mfp-close">' + qodefGlobal.vars.iconClose + '</button>', // markup of an arrow button
				}
			);
		},
		initGalleryPopup    : function ($popup) {
			var $items = $popup.find('.qodef-popup-item'),
				itemsFormatted = qodefMagnificPopup.generateGalleryItems($items);

			$items.each(
				function (index) {
					var $this = $(this);
					$this.magnificPopup(
						{
							items      : itemsFormatted,
							gallery    : {
								enabled    : true,
								arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%">' + qodefGlobal.vars.iconArrowLeft + '</button>', // markup of an arrow button
							},
							index      : index,
							type       : 'image',
							image      : {
								cursor: null
							},
							closeMarkup: '<button title="%title%" type="button" class="mfp-close">' + qodefGlobal.vars.iconClose + '</button>', // markup of an arrow button
						}
					);
				}
			);
		},
		generateGalleryItems: function ($items) {
			var itemsFormatted = [];

			if ($items.length) {
				$items.each(
					function () {
						var $thisItem = $(this);
						var itemFormatted = {
							src  : $thisItem.attr('href'),
							title: $thisItem.attr('title'),
							type : $thisItem.data('type')
						};
						itemsFormatted.push(itemFormatted);
					}
				);
			}

			return itemsFormatted;
		}
	};

	qodef.qodefMagnificPopup = qodefMagnificPopup;

	var qodefAnchor = {
		items              : '',
		init               : function (settings) {
			this.holder = $('.qodef-anchor');

			// Allow overriding the default config
			$.extend(this.holder, settings);

			if (this.holder.length) {
				qodefAnchor.items = this.holder;

				qodefAnchor.clickTrigger();

				$(window).on(
					'load',
					function () {
						qodefAnchor.checkAnchorOnScroll();
						qodefAnchor.checkAnchorOnLoad();
					}
				);
			}
		},
		clickTrigger       : function () {
			qodefAnchor.items.on(
				'click',
				function (e) {
					var $anchorItem = qodefAnchor.getAnchorItem(this),
						anchorURL = $anchorItem.attr('href'),
						hash = $anchorItem.prop('hash').split('#')[1],
						pageURL = window.location.href,
						pageHash = pageURL.indexOf('#') > -1 ? pageURL.split('#')[1] : 0;

					if (
						anchorURL.indexOf('http') < 0
						|| anchorURL === pageURL
						|| (pageHash !== 0 && anchorURL.substring(0, anchorURL.length - hash.length - 1) === pageURL.substring(0, pageURL.length - pageHash.length - 1))
						|| (pageHash === 0 && anchorURL.substring(0, anchorURL.length - hash.length - 1) === pageURL)
					) {
						e.preventDefault();
					}

					qodefAnchor.animateScroll($anchorItem, hash);
				}
			);
		},
		checkAnchorOnLoad  : function () {
			var hash = window.location.hash.split('#')[1];

			if (typeof hash !== 'undefined' && hash !== '' && qodefAnchor.items.length) {
				qodefAnchor.items.each(
					function () {
						var $anchorItem = qodefAnchor.getAnchorItem(this);

						if ($anchorItem.attr('href').indexOf(hash) > -1) {
							qodefAnchor.animateScroll($anchorItem, hash);
						}
					}
				);
			}
		},
		checkAnchorOnScroll: function () {

			if (qodef.windowWidth > 1024) {
				var $target = $('#qodef-page-inner *[id]');

				if ($target.length) {
					$target.each(
						function () {
							var $currentTarget = $(this),
								$anchorItem = $('[href*="#' + $currentTarget.attr('id') + '"]');

							if ($anchorItem.length) {
								if (qodefAnchor.isTargetInView($currentTarget)) {
									qodefAnchor.setActiveState($anchorItem);
								}

								$(window).scroll(
									function () {
										if (qodefAnchor.isTargetInView($currentTarget)) {
											qodefAnchor.setActiveState($anchorItem);
										} else {
											$anchorItem.removeClass(qodefAnchor.getItemClasses($anchorItem));
										}
									}
								);
							}
						}
					);
				}
			}
		},
		isTargetInView     : function ($target) {
			var rect = $target[0].getBoundingClientRect(),
				percentVisible = 20,
				windowHeight = (window.innerHeight || document.documentElement.clientHeight);

			return !(
				Math.floor(100 - (((rect.top >= 0 ? 0 : rect.top) / +-(rect.height / 1)) * 100)) < percentVisible ||
				Math.floor(100 - ((rect.bottom - windowHeight) / rect.height) * 100) < percentVisible
			);
		},
		getAnchorItem      : function (item) {
			var isItemLink = item.tagName === 'A';

			return isItemLink ? $(item) : $(item).children('a');
		},
		animateScroll      : function ($item, hash) {
			var $target = hash !== '' ? $('[id="' + hash + '"]') : '';

			if ($target.length) {
				var targetPosition = $target.offset().top,
					scrollAmount = targetPosition - qodefAnchor.getHeaderHeight() - qodefGlobal.vars.adminBarHeight;

				qodefAnchor.setActiveState($item);

				qodef.html.stop().animate(
					{
						scrollTop: Math.round(scrollAmount)
					},
					1000,
					function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					}
				);

				return false;
			}
		},
		getHeaderHeight    : function () {
			var height = 0;

			if (qodef.windowWidth > 1024 && qodefGlobal.vars.headerHeight !== null && qodefGlobal.vars.headerHeight !== '') {
				height = parseInt(qodefGlobal.vars.headerHeight, 10);
			}

			return height;
		},
		setActiveState     : function ($item) {
			var isItemLink = !$item.parent().hasClass('qodef-anchor'),
				classes = qodefAnchor.getItemClasses($item);

			qodefAnchor.items.removeClass(classes);

			if (isItemLink) {
				$item.addClass(classes);
			} else {
				$item.parent().addClass(classes);
			}
		},
		getItemClasses     : function ($item) {
			// Main anchor item class plus header item classes if item is inside header
			var activeClass = 'qodef-anchor--active',
				menuItemClasses = $item.parents('#qodef-page-header') ? ' current-menu-item current_page_item' : '';

			return activeClass + menuItemClasses;
		}
	};

	qodef.qodefAnchor = qodefAnchor;

	if (typeof Object.assign !== 'function') {
		Object.assign = function (target) {

			if (target === null || typeof target === 'undefined') {
				throw new TypeError('Cannot convert undefined or null to object');
			}

			target = Object(target);
			for (var index = 1; index < arguments.length; index++) {
				var source = arguments[index];

				if (source !== null) {
					for (var key in source) {
						if (Object.prototype.hasOwnProperty.call(source, key)) {
							target[key] = source[key];
						}
					}
				}
			}

			return target;
		};
	}

	var qodefSelect2 = {
		init               : function (settings) {
			this.holder = [];
			this.holder.push(
				{
					holder  : $('.widget.widget_archive select'),
					callback: 'archive',
				}
			);
			this.holder.push(
				{
					holder: $('.widget.widget_categories select'),
				}
			);
			this.holder.push(
				{
					holder: $('.widget.widget_text select'),
				}
			);

			// allow overriding the default config
			$.extend(this.holder, settings);

			if (typeof this.holder === 'object') {
				$.each(
					this.holder,
					function (key, value) {
						qodefSelect2.createSelect2(value.holder, value.options, value.callback);
					}
				);
			}
		},
		createSelect2      : function ($holder, options, callback) {
			if (typeof $holder.select2 === 'function') {
				$holder.select2(options);

				if (callback !== '') {
					qodefSelect2.handleSelect2Change($holder, callback);
				}
			}
		},
		handleSelect2Change: function ($holder, callback) {
			// handle archive dropdown on select
			if (callback === 'archive') {
				$holder.on(
					'change',
					function (event) {
						if (event.target.value !== '') {
							document.location.href = event.target.value;
						}
					}
				);
			}
		},
	};

	qodef.qodefSelect2 = qodefSelect2;

	var qodefAppearElementsReady = {
		init: function () {
			var $elements = $('.qodef--has-appear');

			function getRandomArbitrary( min, max ) {
				return Math.floor( Math.random() * (max - min) + min );
			}

			function getAppearDelay( item , randomNum) {
				if (item.hasClass('qodef--random-appear-delay')){
					return randomNum;
				} else if(item.hasClass('qodef--has-delay-200')) {
					return 200;
				} else {
					return 0;
				}
			}

			if ($elements.length) {
				$elements.each(function () {
					var thisItem = $(this),
						random = getRandomArbitrary(0, 300),
						appearDelay = getAppearDelay(thisItem, random);

					thisItem.appear(function () {
						setTimeout( function () {
							thisItem.addClass( 'qodef--appear' );
						}, appearDelay )
					}, {accX: 0, accY: 0});
				});
			}
		}
	};

	qodef.qodefAppearElementsReady = qodefAppearElementsReady;

	var qodefSvgMorph = {
		init: function () {
			var $elements = $('.qodef-m-morph-circle, .qodef-button.qodef-layout--textual-animated .qodef-m-circle, .qodef-m-scroll-indicator');

			if ($elements.length) {
				$elements.each(function () {
					var thisItem = $(this);
					qodefSvgMorph.initMorph(thisItem);
				});
			}
		},
		initMorph: function (item) {
			var morph = qodefSvgMorph.createMorph(item);
		},
		createMorph: function (item) {
			var thisItem = item,
				points = [
				{
					"x": 72.30,
					"y": 27.41,
				},
				{
					"x": 79.59,
					"y": 36.82,
				},
				{
					"x": 80.52,
					"y": 46.09,
				},
				{
					"x": 82.06,
					"y": 56.58,
				},
				{
					"x": 80.06,
					"y": 65.41,
				},
				{
					"x": 71.68,
					"y": 74.96,
				},
				{
					"x": 63.03,
					"y": 78.23,
				},
				{
					"x": 54.16,
					"y": 82.60,
				},
				{
					"x": 43.80,
					"y": 84.10,
				},
				{
					"x": 35.15,
					"y": 80.36,
				},
				{
					"x": 27.02,
					"y": 73.44,
				},
				{
					"x": 21.46,
					"y": 62.98,
				},
				{
					"x": 19.13,
					"y": 54.21,
				},
				{
					"x": 16.31,
					"y": 44.26,
				},
				{
					"x": 20.72,
					"y": 33.07,
				},
				{
					"x": 27.85,
					"y": 25.40,
				},
				{
					"x": 35.55,
					"y": 21.42,
				},
				{
					"x": 45.90,
					"y": 17.82,
				},
				{
					"x": 56.43,
					"y": 19.16,
				},
				{
					"x": 66.20,
					"y": 21.46,
				}
			],
			 	durations = [
				0.42,
				0.41,
				0.87,
				0.71,
				0.48,
				0.57,
				0.88,
				0.96,
				0.73,
				0.79,
				0.65,
				0.67,
				0.64,
				0.99,
				0.87,
				0.96,
				0.76,
				0.83,
				0.93,
				0.84
			],
			 	path = item.find('path')[0],
				slice = (Math.PI * 2) / points.length,
				startAngle = 5.55,
				tweens = [],
				tweensBack = [],
				initiallyPaused = item.hasClass('q-m-morph-idle') ? false : true,
			 	centerX = 50,
				centerY = 50,
				maxRadius = 37;


			var tl = new gsap.timeline({
				onUpdate: update,
			});

			for (var i = 0; i < points.length; i++) {
				var angle = startAngle + i * slice;
				var duration = durations[i];

				var point = points[i];

				tweens[i] = gsap.to(point,duration, {
					x: centerX + Math.cos(angle) * maxRadius,
					y: centerY + Math.sin(angle) * maxRadius,
					repeat: -1,
					yoyo: true,
					ease: Sine.easeInOut,
				});

				if ( initiallyPaused ) {
					tweensBack[i] = gsap.to(point,duration/1.5, {
						x: points[i].x,
						y: points[i].y,
						ease: Sine.easeOut,
						overwrite: true,
					});
				}

				tl.add(tweens[i] ,- duration);
			}

			thisItem.addClass('q-m-morph-paused');

			var startMorph = function(){
				if (thisItem.hasClass('q-m-morph-paused')){
					thisItem.removeClass('q-m-morph-paused');
				}
				tweens.forEach(function(tween) {
					tween.play();
				});
			}

			var endMorph = function(){
				tweens.forEach(function(tween) {
					tween.pause();
				});
				tweensBack.forEach(function(tweenBack) {
					tweenBack.restart();
				});
			}


			if (initiallyPaused) {//animation on interaction
				if (item.parent().hasClass('qodef-button')){
					item.parent('.qodef-button')[0].addEventListener(
						'mouseenter',
						startMorph
					);
					item.parent('.qodef-button')[0].addEventListener(
						'mouseleave',
						endMorph
					);
				} else {
					item[0].addEventListener(
						'mouseenter',
						startMorph
					);
					item[0].addEventListener(
						'mouseleave',
						endMorph
					);
				}
			} else {//check if element is or gets in viewport
				setTimeout(function() {//delay needed to calc svg computed sizes
					if ( qodefSvgMorph.isInViewport( thisItem ) ) {//animation in viewport
						startMorph();
					};
				}, 300);

				$(window).on('scroll', function () {//check if element is in viewport
					var viewportTop = qodef.scroll;
					if ( qodefSvgMorph.isInViewport( thisItem ) ) {//animation in viewport
						startMorph();
					} else {
						thisItem.addClass('q-m-morph-paused');
					}
				});
			}

			// Cardinal spline - a uniform Catmull-Rom spline with a tension option
			function cardinal(data, closed, tension) {

				if (data.length < 1) return "M0 0";
				if (tension == null) tension = 1;

				var size = data.length - (closed ? 0 : 1);
				var path = "M" + data[0].x + " " + data[0].y + " C";

				for (var i = 0; i < size; i++) {

					var p0, p1, p2, p3;

					if (closed) {
						p0 = data[(i - 1 + size) % size];
						p1 = data[i];
						p2 = data[(i + 1) % size];
						p3 = data[(i + 2) % size];

					} else {
						p0 = i == 0 ? data[0] : data[i - 1];
						p1 = data[i];
						p2 = data[i + 1];
						p3 = i == size - 1 ? p2 : data[i + 2];
					}

					var x1 = p1.x + (p2.x - p0.x) / 6 * tension;
					var y1 = p1.y + (p2.y - p0.y) / 6 * tension;

					var x2 = p2.x - (p3.x - p1.x) / 6 * tension;
					var y2 = p2.y - (p3.y - p1.y) / 6 * tension;

					path += " " + x1 + " " + y1 + " " + x2 + " " + y2 + " " + p2.x + " " + p2.y;
				}

				return closed ? path + "z" : path;
			}

			function update() {
				if (!item.hasClass('q-m-morph-paused')){
					path.setAttribute("d", cardinal(points, true, 1));
				}
			}
		},
		isInViewport: function(element) {
			var el = window.getComputedStyle(element[0]),
				elHeight = parseInt(el.getPropertyValue('height')),
				elWidth = parseInt(el.getPropertyValue('width')),
				elTop = element.offset().top,
				elBottom = elTop + elHeight,
				viewportTop = qodef.scroll,
				viewportBottom = viewportTop + qodef.windowHeight;

			if (elBottom > viewportTop && elTop < viewportBottom){
				return true;
			} else {
				return false;
			}
		}
	};

	qodef.qodefSvgMorph = qodefSvgMorph;

	var qodefArrowCursor = {
		init: function () {
			var $holder = $('.qodef-custom-rev-arrows rs-module');

			if ( $holder.length && qodef.windowWidth > 1024 ) {
				qodefArrowCursor.attachCursor();

				$holder.each( function () {
					var $thisHolder = $(this);

					setTimeout(function () {
						var $cursor = $('.qodef-m-cursor-holder');

						qodefArrowCursor.initCursor( $cursor, $thisHolder );
					}, 100);
				});
			}
		},
		attachCursor: function () {
			var $arrow = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="37.4px" height="73.3px" viewBox="0 0 37.4 73.3" style="enable-background:new 0 0 37.4 73.3;" xml:space="preserve">\n' +
				'\t<polyline points="0.4,0.4 36.7,36.6 0.4,73 "/>\n' +
				'</svg>';
			$('body').append('<div class="qodef-m-cursor-holder"><span class="qodef-m-cursor">' + $arrow + '</span></div>');
		},
		initCursor: function ( $cursor, $holder ) {
			// Init
			$cursor.css({
				transform: "matrix(1, 0, 0, 1, " + qodef.windowWidth / 2 + ", " + qodef.windowHeight / 2 + ")"
			});

			// Move
			$(document).on('mousemove', function ( $e ) {
				var $x = $e.clientX,
					$y = $e.clientY;

				if ( qodef.body.hasClass('qodef-cursor--enabled') ) {
					$cursor.css({
						transform: "matrix(1, 0, 0, 1, " + $x + ", " + $y + ")"
					});
				}
			});

			// Check Sliders
			var $items = '.qodef-custom-rev-arrows rs-module',
				$overrides = '.qodef-custom-rev-arrows rs-module a, .qodef-custom-rev-arrows rs-module rs-bullet';

			$(document).on('mouseover', $items, function () {
				qodef.body.addClass('qodef-cursor--enabled');
			});
			$(document).on('mouseleave', $items, function () {
				qodef.body.removeClass('qodef-cursor--enabled');
			});

			$($items).on( 'mousemove', function ( $e ) {
				var $thisItem = $(this),
					$offset = $thisItem.offset(),
					$pos_x = $e.clientX - $offset.left,
					$middle = $(this).outerWidth() / 2;

				if ( $pos_x < $middle) {
					$cursor.removeClass('qodef--right-side');
					$cursor.addClass('qodef--left-side');
				} else if ( $pos_x > $middle ) {
					$cursor.removeClass('qodef--left-side');
					$cursor.addClass('qodef--right-side');
				}

				$($overrides).on( 'mouseover', function () {
					$cursor.addClass('qodef--hide');
				});

				$($overrides).on( 'mouseleave', function () {
					$cursor.removeClass('qodef--hide');
				});
			});

			// Disable on scroll
			var $elementItems = $('.qodef-custom-rev-nav rs-module, .qodef-custom-rev-nav-light rs-module');

			if ( $elementItems.length ) {
				$elementItems.each( function () {
					var $thisItem = $(this);

					if ( !$thisItem.parents('.qodef-custom-scroll-fix').length ) {
						$(document).on('scroll', function () {
							if ($(document).scrollTop() > $thisItem.height() / 2) {
								qodef.body.removeClass('qodef-cursor--enabled');
							} else {
								qodef.body.addClass('qodef-cursor--enabled');
							}
						});
					}
				})
			}

			qodefArrowCursor.revNavigationHandler( $cursor, $holder );
		},
		revNavigationHandler: function ( $cursor, $holder ) {
			$holder.on('click', function () {
				if ( qodef.body.hasClass('qodef-cursor--enabled') && !$cursor.hasClass('qodef--hide')) {
					if ( $cursor.hasClass( 'qodef--left-side' ) ) {
						$holder.revprev();
					} else {
						$holder.revnext();
					}
				} else if ($cursor.hasClass('qodef--hide')){
					$holder.revpause();
				}
			});
		}
	}

	qodef.qodefArrowCursor = qodefArrowCursor;

})(jQuery);

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefResizeIframes.init();
		}
	);

	$( window ).resize(
		function () {
			qodefResizeIframes.init();
		}
	);

	$( document ).on(
		'oraiste_trigger_get_new_posts',
		function ( e, $holder ) {
			if ( $holder.hasClass( 'qodef-blog' ) ) {
				qodefReInitMediaElementPostFormats.resize( $holder );
				qodefResizeIframes.resize( $holder );
			}
		}
	);

	/**
	 * Re init media element post formats (audio, video)
	 */
	var qodefReInitMediaElementPostFormats = {
		init: function () {
			var $holder = $( '.qodef-blog' );

			if ( $holder.length ) {
				qodefReInitMediaElementPostFormats.resize( $holder );
			}
		},
		resize: function ( $holder ) {
			var $mediaElement = $holder.find( '.wp-video-shortcode, .wp-audio-shortcode' ).not( '.mejs-container' );

			if ( $mediaElement.length ) {
				$mediaElement.each(
					function () {
						var $thisMediaElement = $( this );

						if ( typeof $thisMediaElement.mediaelementplayer === 'function' ) {
							$thisMediaElement.mediaelementplayer(
								{
									videoWidth: '100%',
									videoHeight: '56.5%',
								}
							);
						}
					}
				);
			}
		}
	};

	qodef.qodefReInitMediaElementPostFormats = qodefReInitMediaElementPostFormats;

	/**
	 * Resize oembed iframes
	 */
	var qodefResizeIframes = {
		init: function () {
			var $holder = $( '.qodef-blog' );

			if ( $holder.length ) {
				qodefResizeIframes.resize( $holder );
			}
		},
		resize: function ( $holder ) {
			var $iframe = $holder.find( '.qodef-e-media iframe' );

			if ( $iframe.length ) {
				$iframe.each(
					function () {
						var $thisIframe = $( this ),
							width       = $thisIframe.attr( 'width' ),
							height      = $thisIframe.attr( 'height' ),
							newHeight   = $thisIframe.width() / width * height; // rendered width divided by aspect ratio

						$thisIframe.css( 'height', newHeight );
					}
				);
			}
		}
	};

	qodef.qodefResizeIframes = qodefResizeIframes;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFilter.init();
		}
	);

	$( document ).on(
		'oraiste_trigger_get_new_posts',
		function ( e, $holder ) {
			if ( $holder.hasClass( 'qodef-filter--on' ) ) {
				$holder.removeClass( 'qodef--filter-loading' );
			}
		}
	);

	/*
	 **	Init filter functionality
	 */
	var qodefFilter = {
		customListQuery: {},
		init: function ( settings ) {
			this.holder = $( '.qodef-filter--on' );

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $holder      = $( this ),
							$filterItems = $holder.find( '.qodef-m-filter-item' );

						qodefFilter.checkCustomListQuery( $holder.data( 'options' ) );
						qodefFilter.clickEvent( $holder, $filterItems );
					}
				);
			}
		},
		checkCustomListQuery: function ( options ) {
			if ( typeof options.additional_query_args !== 'undefined' && typeof options.additional_query_args.tax_query !== 'undefined' ) {
				qodefFilter.customListQuery = options.additional_query_args.tax_query;
			}
		},
		clickEvent: function ( $holder, $filterItems ) {
			$filterItems.on(
				'click',
				function ( e ) {
					e.preventDefault();

					var $thisItem = $( this );

					if ( ! $thisItem.hasClass( 'qodef--active' ) ) {
						$holder.addClass( 'qodef--filter-loading' );
						$filterItems.removeClass( 'qodef--active' );
						$thisItem.addClass( 'qodef--active' );

						qodefFilter.setVisibility( $holder, $thisItem );
					}
				}
			);
		},
		setVisibility: function ( $holder, $item ) {
			var filterTaxonomy  = $item.data( 'taxonomy' ),
				filterValue     = $item.data( 'filter' ),
				isShowAllFilter = filterValue === '*',
				options         = $holder.data( 'options' ),
				taxQueryOptions = {};

			if ( ! isShowAllFilter ) {
				taxQueryOptions = {
					0: {
						taxonomy: filterTaxonomy,
						field: typeof filterValue === 'number' ? 'term_id' : 'slug',
						terms: filterValue,
					},
				};
			} else {
				taxQueryOptions = qodefFilter.customListQuery;
			}

			options.additional_query_args = {
				tax_query: taxQueryOptions,
			};

			qodef.body.trigger(
				'oraiste_trigger_load_more',
				[$holder, 1]
			);
		},
		isMasonryLayout: function ( $holder ) {
			return $holder.hasClass( 'qodef-layout--masonry' );
		},
		hasLoadMore: function ( $holder ) {
			return $holder.hasClass( 'qodef-pagination-type--load-more' );
		}
	};

	qodef.qodefFilter = qodefFilter;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefMasonryLayout.init();
		}
	);

	$( window ).resize(
		function () {
			qodefMasonryLayout.reInit();
		}
	);

	$( document ).on(
		'oraiste_trigger_get_new_posts',
		function ( e, $holder ) {
			if ( $holder.hasClass( 'qodef-layout--masonry' ) ) {
				qodefMasonryLayout.init();
			}
		}
	);

	/**
	 * Init masonry layout
	 */
	var qodefMasonryLayout = {
		init: function ( settings ) {
			this.holder = $( '.qodef-layout--masonry' );

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefMasonryLayout.createMasonry( $( this ) );
					}
				);
			}
		},
		reInit: function ( settings ) {
			this.holder = $( '.qodef-layout--masonry' );

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $masonry = $( this ).find( '.qodef-grid-inner' );

						if ( typeof $masonry.isotope === 'function' ) {
							$masonry.isotope( 'layout' );
						}
					}
				);
			}
		},
		createMasonry: function ( $holder ) {
			var $masonry     = $holder.find( '.qodef-grid-inner' ),
				$masonryItem = $masonry.find( '.qodef-grid-item' );

			$masonry.waitForImages(
				function () {
					if ( typeof $masonry.isotope === 'function' ) {
						$masonry.isotope(
							{
								layoutMode: 'packery',
								itemSelector: '.qodef-grid-item',
								percentPosition: true,
								masonry: {
									columnWidth: '.qodef-grid-masonry-sizer',
									gutter: '.qodef-grid-masonry-gutter'
								}
							}
						);

						if ( $holder.hasClass( 'qodef-items--fixed' ) ) {
							var size = qodefMasonryLayout.getFixedImageSize( $masonry, $masonryItem );

							qodefMasonryLayout.setFixedImageProportionSize( $masonry, $masonryItem, size );
						}

						$masonry.isotope( 'layout' );
					}

					$masonry.addClass( 'qodef--masonry-init' );
				}
			);
		},
		getFixedImageSize: function ( $holder, $item ) {
			var $squareItem = $holder.find( '.qodef-item--square' );

			if ( $squareItem.length ) {
				var $squareItemImage      = $squareItem.find( 'img' ),
					squareItemImageWidth  = $squareItemImage.width(),
					squareItemImageHeight = $squareItemImage.height();

				if ( squareItemImageWidth !== squareItemImageHeight ) {
					return squareItemImageHeight;
				} else {
					return squareItemImageWidth;
				}
			} else {
				var size    = $holder.find( '.qodef-grid-masonry-sizer' ).width(),
					padding = parseInt( $item.css( 'paddingLeft' ), 10 );

				return (size - 2 * padding); // remove item side padding to get real item size
			}
		},
		setFixedImageProportionSize: function ( $holder, $item, size ) {
			var padding         = parseInt( $item.css( 'paddingLeft' ), 10 ),
				$squareItem     = $holder.find( '.qodef-item--square' ),
				$landscapeItem  = $holder.find( '.qodef-item--landscape' ),
				$portraitItem   = $holder.find( '.qodef-item--portrait' ),
				$hugeSquareItem = $holder.find( '.qodef-item--huge-square' ),
				isMobileScreen  = qodef.windowWidth <= 680;

			$item.css( 'height', size );

			if ( $landscapeItem.length ) {
				$landscapeItem.css( 'height', Math.round( size / 2 ) );
			}

			if ( $portraitItem.length ) {
				$portraitItem.css( 'height', Math.round( 2 * (size + padding) ) );
			}

			if ( ! isMobileScreen ) {

				if ( $landscapeItem.length ) {
					$landscapeItem.css( 'height', size );
				}

				if ( $hugeSquareItem.length ) {
					$hugeSquareItem.css( 'height', Math.round( 2 * (size + padding) ) );
				}
			}
		}
	};

	qodef.qodefMasonryLayout = qodefMasonryLayout;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefMobileHeader.init();
		}
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeader = {
		init: function () {
			var $holder = $( '#qodef-page-mobile-header' );

			if ( $holder.length ) {
				qodefMobileHeader.initMobileHeaderOpener( $holder );
				qodefMobileHeader.initDropDownMobileMenu();
			}
		},
		initMobileHeaderOpener: function ( holder ) {
			var $opener = holder.find( '.qodef-mobile-header-opener' );

			if ( $opener.length ) {
				var $navigation = holder.find( '.qodef-mobile-header-navigation' );

				$opener.on(
					'tap click',
					function ( e ) {
						e.preventDefault();

						if ( $navigation.is( ':visible' ) ) {
							$navigation.slideUp( 450 );
							$opener.removeClass( 'qodef--opened' );
						} else {
							$navigation.slideDown( 450 );
							$opener.addClass( 'qodef--opened' );
						}
					}
				);
			}
		},
		initDropDownMobileMenu: function () {
			var $dropdownOpener = $( '.qodef-mobile-header-navigation .menu-item-has-children > a' );

			if ( $dropdownOpener.length ) {
				$dropdownOpener.each(
					function () {
						var $thisItem = $( this );

						$thisItem.on(
							'tap click',
							function ( e ) {
								e.preventDefault();

								var $thisItemParent                 = $thisItem.parent(),
									$thisItemParentSiblingsWithDrop = $thisItemParent.siblings( '.menu-item-has-children' );

								if ( $thisItemParent.hasClass( 'menu-item-has-children' ) ) {
									var $submenu = $thisItemParent.find( 'ul.sub-menu' ).first();

									if ( $submenu.is( ':visible' ) ) {
										$submenu.slideUp( 450 );
										$thisItemParent.removeClass( 'qodef--opened' );
									} else {
										$thisItemParent.addClass( 'qodef--opened' );

										if ( $thisItemParentSiblingsWithDrop.length === 0 ) {
											$thisItemParent.find( '.sub-menu' ).slideUp(
												400,
												function () {
													$submenu.slideDown( 400 );
												}
											);
										} else {
											$thisItemParent.siblings().removeClass( 'qodef--opened' ).find( '.sub-menu' ).slideUp(
												400,
												function () {
													$submenu.slideDown( 400 );
												}
											);
										}
									}
								}
							}
						);
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {

	$( document ).ready(
		function () {
			qodefDefaultNavMenu.init();
		}
	);

	var qodefDefaultNavMenu = {
		init: function () {
			var $menuItems = $( '.qodef-header-navigation.qodef-header-navigation-initial > ul > li.qodef-menu-item--narrow.menu-item-has-children' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var thisItem          = $( this ),
							menuItemPosition  = thisItem.offset().left,
							dropdownMenuItem  = thisItem.find( ' > ul' ),
							dropdownMenuWidth = dropdownMenuItem.outerWidth(),
							menuItemFromLeft  = $( window ).width() - menuItemPosition;

						var dropDownMenuFromLeft;

						if ( thisItem.find( 'li.menu-item-has-children' ).length > 0 ) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						dropdownMenuItem.removeClass( 'qodef-drop-down--right' );

						if ( menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth ) {
							dropdownMenuItem.addClass( 'qodef-drop-down--right' );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefPagination.init();
		}
	);

	$( window ).scroll(
		function () {
			qodefPagination.scroll();
		}
	);

	$( document ).on(
		'oraiste_trigger_load_more',
		function ( e, $holder, nextPage ) {
			qodefPagination.triggerLoadMore( $holder, nextPage );
		}
	);

	/*
	 **	Init pagination functionality
	 */
	var qodefPagination = {
		init: function ( settings ) {
			this.holder = $( '.qodef-pagination--on' );

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $holder = $( this );

						qodefPagination.initPaginationType( $holder );
					}
				);
			}
		},
		scroll: function ( settings ) {
			this.holder = $( '.qodef-pagination--on' );

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $holder = $( this );

						if ( $holder.hasClass( 'qodef-pagination-type--infinite-scroll' ) ) {
							qodefPagination.initInfiniteScroll( $holder );
						}
					}
				);
			}
		},
		initPaginationType: function ( $holder ) {
			if ( $holder.hasClass( 'qodef-pagination-type--standard' ) ) {
				qodefPagination.initStandard( $holder );
			} else if ( $holder.hasClass( 'qodef-pagination-type--load-more' ) ) {
				qodefPagination.initLoadMore( $holder );
			} else if ( $holder.hasClass( 'qodef-pagination-type--infinite-scroll' ) ) {
				qodefPagination.initInfiniteScroll( $holder );
			}
		},
		initStandard: function ( $holder ) {
			var $paginationItems = $holder.find( '.qodef-m-pagination-items' );

			if ( $paginationItems.length ) {
				var options = $holder.data( 'options' );

				qodefPagination.changeStandardState( $holder, options.max_pages_num, 1 );

				$paginationItems.children().each(
					function () {
						var $thisItem = $( this );

						$thisItem.on(
							'click',
							function ( e ) {
								e.preventDefault();

								if ( ! $thisItem.hasClass( 'qodef--active' ) ) {
									qodefPagination.getNewPosts( $holder, $thisItem.data( 'paged' ) );
								}
							}
						);
					}
				);
			}
		},
		changeStandardState: function ( $holder, max_pages_num, nextPage ) {
			if ( $holder.hasClass( 'qodef-pagination-type--standard' ) ) {
				var $paginationNav = $holder.find( '.qodef-m-pagination-items' ),
					$numericItem   = $paginationNav.children( '.qodef--number' ),
					$prevItem      = $paginationNav.children( '.qodef--prev' ),
					$nextItem      = $paginationNav.children( '.qodef--next' );

				qodefPagination.standardPaginationVisibility( $paginationNav, max_pages_num );

				$numericItem.removeClass( 'qodef--active' ).eq( nextPage - 1 ).addClass( 'qodef--active' );

				$prevItem.data( 'paged', nextPage - 1 );

				if ( nextPage > 1 ) {
					$prevItem.show();
					$prevItem.next().removeClass( 'qodef-prev--hidden' );
				} else {
					$prevItem.hide();
					$prevItem.next().addClass( 'qodef-prev--hidden' );
				}

				$nextItem.data( 'paged', nextPage + 1 );

				if ( nextPage === max_pages_num ) {
					$nextItem.hide();
				} else {
					$nextItem.show();
				}
			}
		},
		standardPaginationVisibility: function ( $paginationNav, max_pages_num ) {
			if ( max_pages_num === 1 ) {
				$paginationNav.hide();
			} else if ( max_pages_num > 1 && ! $paginationNav.is( ':visible' ) ) {
				$paginationNav.show();
			}
		},
		changeStandardHtml: function ( $holder, max_pages_num, nextPage, pagination_html ) {
			if ( $holder.hasClass( 'qodef-pagination-type--standard' ) && 1 == nextPage ) {
				var $paginationNav     = $holder.find( '.qodef-m-pagination' ),
					$paginationSpinner = $holder.find( '.qodef-m-pagination-spinner' );

				qodefPagination.standardPaginationVisibility(
					$paginationNav,
					max_pages_num
				);

				$paginationNav.remove();
				$paginationSpinner.remove();

				$holder.append( pagination_html );
				qodefPagination.initStandard( $holder );
			}
		},
		triggerStandardScrollAnimation: function ( $holder ) {
			if ( $holder.hasClass( 'qodef-pagination-type--standard' ) ) {
				$( 'html, body' ).animate(
					{
						scrollTop: $holder.offset().top - 100
					},
					500
				);
			}
		},
		initLoadMore: function ( $holder ) {
			var $loadMoreButton = $holder.find( '.qodef-load-more-button' );

			$loadMoreButton.on(
				'click',
				function ( e ) {
					e.preventDefault();

					qodefPagination.getNewPosts( $holder );
				}
			);
		},
		triggerLoadMore: function ( $holder, nextPage ) {
			qodefPagination.getNewPosts( $holder, nextPage );
		},
		loadMoreButtonVisibility: function ( $holder, options ) {
			if ( $holder.hasClass( 'qodef-pagination-type--load-more' ) ) {

				if ( options.next_page > options.max_pages_num || options.max_pages_num === 1 ) {
					$holder.find( '.qodef-load-more-button' ).hide();
				} else if ( options.max_pages_num > 1 && options.next_page <= options.max_pages_num ) {
					$holder.find( '.qodef-load-more-button' ).show();
				}
			}
		},
		initInfiniteScroll: function ( $holder ) {
			var holderEndPosition = $holder.outerHeight() + $holder.offset().top,
				scrollPosition    = qodef.scroll + qodef.windowHeight,
				options           = $holder.data( 'options' );

			if ( ! $holder.hasClass( 'qodef--loading' ) && scrollPosition > holderEndPosition && options.max_pages_num >= options.next_page ) {
				qodefPagination.getNewPosts( $holder );
			}
		},
		getNewPosts: function ( $holder, nextPage ) {
			$holder.addClass( 'qodef--loading' );

			var $itemsHolder = $holder.children( '.qodef-grid-inner' );
			var options      = $holder.data( 'options' );

			qodefPagination.setNextPageValue( options, nextPage, false );

			$.ajax(
				{
					type: 'GET',
					url: qodefGlobal.vars.restUrl + qodefGlobal.vars.paginationRestRoute,
					data: {
						options: options
					},
					beforeSend: function ( request ) {
						request.setRequestHeader(
							'X-WP-Nonce',
							qodefGlobal.vars.restNonce
						);
					},
					success: function ( response ) {

						if ( response.status === 'success' ) {
							// Override max page numbers options
							if ( options.max_pages_num !== response.data.max_pages_num ) {
								options.max_pages_num = response.data.max_pages_num;
							}

							qodefPagination.setNextPageValue( options, nextPage, true );
							qodefPagination.changeStandardState( $holder, options.max_pages_num, nextPage );
							qodefPagination.changeStandardHtml( $holder, options.max_pages_num, nextPage, response.data.pagination_html );

							$itemsHolder.waitForImages(
								function () {
									qodefPagination.addPosts( $itemsHolder, response.data.html, nextPage );
									qodefPagination.reInitMasonryPosts( $holder, $itemsHolder );

									setTimeout(
										function () {
											qodef.body.trigger(
												'oraiste_trigger_get_new_posts',
												[$holder, response.data, nextPage]
											);
										},
										300
									); // 300ms is set in order to be after the masonry script initialize
								}
							);

							qodefPagination.triggerStandardScrollAnimation( $holder );
							qodefPagination.loadMoreButtonVisibility( $holder, options );
						} else {
							console.log( response.message );
						}
					},
					complete: function () {
						$holder.removeClass( 'qodef--loading' );
					}
				}
			);
		},
		setNextPageValue: function ( options, nextPage, ajaxTrigger ) {
			if ( typeof nextPage !== 'undefined' && nextPage !== '' && ! ajaxTrigger ) {
				options.next_page = nextPage;
			} else if ( ajaxTrigger ) {
				options.next_page = parseInt( options.next_page, 10 ) + 1;
			}
		},
		addPosts: function ( $itemsHolder, newItems, nextPage ) {
			if ( typeof nextPage !== 'undefined' && nextPage !== '' ) {
				$itemsHolder.html( newItems );
			} else {
				$itemsHolder.append( newItems );
			}
		},
		reInitMasonryPosts: function ( $holder, $itemsHolder ) {
			if ( $holder.hasClass( 'qodef-layout--masonry' ) ) {
				$itemsHolder.isotope( 'reloadItems' ).isotope( { sortBy: 'original-order' } );

				setTimeout(
					function () {
						$itemsHolder.isotope( 'layout' );
					},
					200
				);
			}
		}
	};

	qodef.qodefPagination = qodefPagination;

})( jQuery );

(function ($) {
	'use strict';

	$(document).ready(
		function () {
			qodefWooSelect2.init();
			qodefWooQuantityButtons.init();
			qodefWooMagnificPopup.init();
		}
	);

	var qodefWooSelect2 = {
		init: function (settings) {
			this.holder = [];
			this.holder.push(
				{
					holder : $('#qodef-woo-page .woocommerce-ordering select'),
					options: {
						minimumResultsForSearch: Infinity,
						dropdownCssClass       : "qodef--flat"
					}
				}
			);
			this.holder.push(
				{
					holder : $('#qodef-woo-page .variations select'),
					options: {
						minimumResultsForSearch: Infinity
					}
				}
			);
			this.holder.push(
				{
					holder: $('#qodef-woo-page #calc_shipping_country'),
				}
			);
			this.holder.push(
				{
					holder: $('#qodef-woo-page .shipping select#calc_shipping_state'),
				}
			);

			// Allow overriding the default config
			$.extend(this.holder, settings);

			if (typeof this.holder === 'object') {
				$.each(
					this.holder,
					function (key, value) {
						qodef.qodefSelect2.createSelect2(value.holder, value.options);
					}
				);
			}
		},
	};

	var qodefWooQuantityButtons = {
		init: function () {
			$(document).on(
				'click',
				'.qodef-quantity-minus, .qodef-quantity-plus',
				function (e) {
					e.stopPropagation();

					var $button = $(this),
						$inputField = $button.siblings('.qodef-quantity-input'),
						step = parseFloat($inputField.data('step')),
						max = parseFloat($inputField.data('max')),
						min = parseFloat($inputField.data('min')),
						minus = false,
						inputValue = typeof Number.isNaN === 'function' && Number.isNaN(parseFloat($inputField.val())) ? min : parseFloat($inputField.val()),
						newInputValue;

					if ($button.hasClass('qodef-quantity-minus')) {
						minus = true;
					}

					if (minus) {
						newInputValue = inputValue - step;
						if (newInputValue >= min) {
							$inputField.val(newInputValue);
						} else {
							$inputField.val(min);
						}
					} else {
						newInputValue = inputValue + step;
						if (max === undefined) {
							$inputField.val(newInputValue);
						} else {
							if (newInputValue >= max) {
								$inputField.val(max);
							} else {
								$inputField.val(newInputValue);
							}
						}
					}

					$inputField.trigger('change');
				}
			);
		}
	};

	var qodefWooMagnificPopup = {
		init: function () {
			if (typeof qodef.qodefMagnificPopup === 'object') {
				var $holder = $('.qodef--single.qodef-magnific-popup.qodef-popup-gallery .woocommerce-product-gallery__image');

				if ($holder.length) {
					$holder.each(
						function () {
							$(this).children('a').attr('data-type', 'image').addClass('qodef-popup-item');
						}
					);

					qodef.qodefMagnificPopup.init();
				}
			}
		}
	};

	qodef.qodefWooMagnificPopup = qodefWooMagnificPopup;

})(jQuery);

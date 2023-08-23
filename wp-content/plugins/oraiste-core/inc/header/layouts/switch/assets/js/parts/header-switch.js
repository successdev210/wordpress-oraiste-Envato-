(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefSwitchNavMenu.init();
	});

	/**
	 * Function object that represents switch menu area.
	 * @returns {{init: Function}}
	 */
	var qodefSwitchNavMenu = {
		calcDropdown            : function ($switchMenuObject) {
			var $menu = $switchMenuObject.find('.qodef-header-switch-navigation'),
				$dropdowns = $menu.find('.qodef-drop-down-second').children().children('.sub-menu'),
				top = 0;

			if ($dropdowns.length) {
				$dropdowns.each(function () {
					var $thisDropdown = $(this),
						$subMenu = $thisDropdown.find('.sub-menu'),
						$items = $thisDropdown.children().children('a'),
						maxWidth = 0,
						translation = 0;

					top = $thisDropdown.parent().offset().top - $menu.offset().top;

					$items.each(
						function () {
							var $this = $(this);

							// 300 is max width of parent holder
							if (300 <= $this.width()) {
								// $this.addClass('qodef-wider');
								maxWidth = 300;
							} else if (maxWidth < $this.width()) {
								maxWidth = $this.width();
							}
						}
					);

					translation = $thisDropdown.parent().width() - maxWidth;

					$thisDropdown.css({
						'top'      : -top,
						'width'    : maxWidth,
						'transform': 'translateX(' + translation + 'px)'
					});

					$thisDropdown.append('<li class="qodef-menu--back"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.7" y1="4.5" x2="18.8" y2="4.5"/><polyline points="4.6,8.4 0.7,4.4 4.6,0.6 "/></svg></a></li>');

					if ($subMenu.length) {
						$subMenu.each(function () {
							var $thisSub = $(this),
								$items = $thisSub.children().children('a'),
								maxWidth = 0,
								translation = 0;

							top = $thisSub.parent().offset().top - $menu.offset().top;

							$items.each(
								function () {
									var $this = $(this);

									//300 is max width of parent holder
									if (300 <= $this.width()) {
										$this.addClass('qodef-wider');
										maxWidth = 300;

									} else if (maxWidth < $this.width()) {
										maxWidth = $this.width();
									}
								}
							);

							translation = $thisSub.parent().width() - maxWidth;

							$thisSub.css({
								'top'      : -top,
								'width'    : maxWidth,
								'transform': 'translateX(' + translation + 'px)'
							});

							$thisSub.append('<li class="qodef-menu--back"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.7" y1="4.5" x2="18.8" y2="4.5"/><polyline points="4.6,8.4 0.7,4.4 4.6,0.6 "/></svg></a></li>');
						});
					}
				});
			}

		},
		dropdownClickToggle     : function ($switchMenuObject) {
			var $menuItems = $switchMenuObject.find('.qodef-header-switch-navigation ul li.menu-item-has-children'),
				$backItems = $switchMenuObject.find('.qodef-menu--back');

			$menuItems.each(function () {
				var $menuItem = $(this),
					$dropdownOpener = $(this).find('> a');

				$dropdownOpener.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();

					$menuItem.siblings().addClass('qodef-menu-sibling--open');
					$menuItem.addClass('qodef-menu-item--open');
				});
			});

			$backItems.each(function () {
				var $backItem = $(this),
					$dropdownClose = $backItem.find('a'),
					$parentMenuItem = $backItem.closest('.menu-item-has-children');

				$dropdownClose.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();

					$parentMenuItem.siblings().removeClass('qodef-menu-sibling--open');
					$parentMenuItem.removeClass('qodef-menu-item--open');
				});
			})
		},
		initNavigationAreaScroll: function ($switchNavigation) {
			if (typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($switchNavigation);
			}
		},
		init                    : function () {
			var $switchMenuObject = $('.qodef-header--switch #qodef-page-header');

			if ($switchMenuObject.length) {
				qodefSwitchNavMenu.calcDropdown($switchMenuObject);
				qodefSwitchNavMenu.dropdownClickToggle($switchMenuObject);
				qodefSwitchNavMenu.initNavigationAreaScroll($switchMenuObject.find('.qodef-header-switch-navigation'));
			}
		}
	};

})(jQuery);

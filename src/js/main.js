'use strict'
// Custom scripts:

//Фиксируем хидер при скролле на десктопе
//Десктоп меню
//Мобильное меню
//Кнопка скролла страницы
//Hero Slider
//Лайтбокс

jQuery(document).ready(function ($) {
    $('html').removeClass('no-js').addClass('js');
    //Фиксируем хидер при скролле на десктопе
    (function stickyHeader() {
        var isStick = false,
            $header = $('.js-header'),
            header,
            page,
            lastWinW = $.viewportW(), //кэшируем ширину экрана
            rtime,//переменные для пересчета при ресайзе окна
            timeout = false,
            delta = 200,
            method = {};

        method.check = function (winW) {
            if (winW >= 992 && !isStick) {
                method.set();
            };
            if (winW < 992 && isStick) {
                method.unset();
            };
        };

        method.set = function () {
            header = new Waypoint.Sticky({
                element: $header[0],
                stuckClass: 'b-header__main--stuck'            
            });

            page = new Waypoint({//когда промотаем на 1000 пикселей, скроем хидер. При скролле вверх - покажем
                element: $('.page__content')[0],
                handler: function (direction) {
                    if (direction === 'down') {
                        $header.addClass('hidden');
                    }
                    if (direction === 'up') {
                        $header.removeClass('hidden');
                    }
                },
                offset: -1000
            });

            isStick = true;
        };

        method.unset = function () {//отключаем waypoints
            header.destroy();
            page.destroy();
            $header.removeClass('hidden');
            isStick = false;
        };

        method.endResize = function () {//если после ресайза окна изменилась ширина - проверяем разрешение экрана и подключаем или отключаем waypoints
            if (new Date() - rtime < delta) {
                setTimeout(method.endResize, delta);
            } else {
                timeout = false;
                var winW = $.viewportW();
                if (winW !== lastWinW) {
                    lastWinW = winW;
                    method.check(winW);
                }
            }
        };

        method.startResize = function () {
            rtime = new Date();
            if (timeout === false) {
                timeout = true;
                setTimeout(method.endResize, delta);
            }
        };

        method.init = function () {
            method.check(lastWinW);
            $(window).bind('resize', method.startResize);
        };

        method.init();
    })();
    
    //Десктоп меню
    (function () {
        var $menu = $('.js-menu li');
        $menu.has('ul').children('a').addClass('has-menu');

        $menu.on({
            mouseenter: function () {
                $(this).find('ul:first').stop(true, true).addClass('hover').fadeIn();
                $(this).find('a:first').addClass('hover');
            },
            mouseleave: function () {
                $(this).find('ul').stop(true, true).removeClass('hover').fadeOut();
                $(this).find('a:first').removeClass('hover');
            }
        });
    })();

    //Мобильное меню
    (function () {
        var $btn = $('.js-mtoggl'), //кнопка toggle
            $menu = $('.js-mmenu'), //панель меню
            $body = $('body'),
            method = {};

        method.hideMenu = function () {
            $btn.removeClass('active');
            $menu.removeClass('active');
            $body.css('overflow', 'auto');
            method.hideAllSubmenu();

            method.removeOverlay();
        };

        method.showMenu = function () {
            $btn.addClass('active');
            $menu.addClass('active');
            $body.css('overflow', 'hidden');
            method.addOverlay();
        };

        method.showSubmenu = function (el) {
            el.find('.m-menu__toggle').addClass('active');
            el.find('ul').slideDown(400);
        };

        method.hideSubmenu = function (el) {
            el.find('.m-menu__toggle').removeClass('active');
            el.find('ul').slideUp(400);
        };

        method.hideAllSubmenu = function () {
            $menu.find('.m-menu__toggle').removeClass('active');
            $menu.find('.m-menu__sub-menu').slideUp(400);
        };

        method.addOverlay = function () {
            $body.append('<div id="overlay" class="page__overlay"></div>');
            $('#overlay').bind('click', method.hideMenu);
        };

        method.removeOverlay = function () {
            $('#overlay').unbind('click', method.hideMenu).remove();
        }

        method.init = function () {
            $menu.find('li').filter(':first').before('<li class="m-menu__item"><label class="m-menu__label">Menu</label></li>');
            $menu.find('li').has('ul').addClass('has-menu').append('<button type="button" class="m-menu__toggle"><i class="icon-down"></i></button>');

            $('.js-header').on('click', '.js-mtoggl', function () {//покажем - спрячем панель моб.меню
                if ($(this).hasClass('active')) {
                    method.hideMenu();
                } else {
                    method.showMenu();
                };
            });

            $menu.on('click', '.m-menu__label', method.hideMenu); //закроем панель по клику по заголовку

            $menu.on('click', '.m-menu__toggle', function () {
                var $el = $(this).parent('li');
                if ($(this).hasClass('active')) {
                    method.hideSubmenu($el);
                } else {
                    method.hideAllSubmenu();
                    method.showSubmenu($el);
                };
            });
        };
        method.init();
    })();

    //Кнопка скролла страницы
    (function () {
        var $scroller = $('<button type="button" class="page__scroll"><i class="icon-up"></i></button>'),
            isScrollerVisible = false,
            lastScrollTop = $.scrollY(),
            method = {};

        var raf = window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.msRequestAnimationFrame ||
                window.oRequestAnimationFrame; //будем пытаться экономить ресурсы браузера

        method.showScroller = function () {
            $scroller.show();
            isScrollerVisible = true;
        };

        method.hideScroller = function () {
            $scroller.hide();
            isScrollerVisible = false;
        };

        method.checkState = function (top) {
            if (top >= 500 && !isScrollerVisible) {
                method.showScroller();
            } else if (top < 500 && isScrollerVisible) {
                method.hideScroller();
            };
        };

        method.loop = function () {
            var fromTop = $.scrollY();
            if (lastScrollTop === fromTop) {
                raf(method.loop);
                return;
            } else {
                lastScrollTop = fromTop;
                method.checkState(fromTop);
                raf(method.loop);
            }
        };

        method.init = function () {
            $('body').append($scroller);

            $scroller.on('click', function () {
                $('html, body').animate({ scrollTop: 0 }, 800);
                return false;
            });

            method.checkState(lastScrollTop);
            if (raf) {
                method.loop();
            };
        };

        method.init();
    })();

    //Hero Slider
    function heroSlider() {
        var $slider = $('.js-slider'),
            slider = $slider,
            $content = $slider.find('.b-hero__content'),//будем анимировать при смене слайдов
            lastWinW = $.viewportW(),
            isStarted = false, //флаги состояний
            isImagesAdded = false,
            isNavFixed = false,
            lastWinW = $.viewportW(), //кэшируем ширину экрана - будем запускать слайдер на планшетах и выше
            rtime,//переменные для пересчета при ресайзе окна
            timeout = false,
            delta = 300,
            method = {};

        method.check = function (winW) {
            if (winW >= 768 && !isStarted) {
                if (!isImagesAdded) {
                    method.addImages();
                }
                method.start();
            };
            if (winW < 768 && isStarted) {
                method.stop();
            }
        }

        method.addImages = function () {//добавим бэкграунды
            var count = $slider.children('li').length;
            for (var i = 1; i < count; i++) {//для первого элемента вывели изображенния скриптом на странице, начинаем цикл со второго
                var $el = $slider.children('li').eq(i),
                    $thumb = $el.find('.b-hero__thumb');
                $thumb.css('background-image', 'url(' + $thumb.data('src') + ')');
            };
            isImagesAdded = true;
        };

        method.start = function () {
            slider.bxSlider({
                controls: true,
                mode: 'fade',
                pager: true,
                auto: true,
                speed: 1000,
                autoDelay: 8000,//дадим время на подгрузку изображений
                pause: 8000,
                prevText: '<i class="icon-arrow-left"></i>',
                nextText: '<i class="icon-arrow-right"></i>',
                onSliderLoad: function (currentIndex) {
                    $content.addClass('js-animate').filter(':first').addClass('active');//запускаем анимацию
                    isStarted = true;
                    if (!isNavFixed) {
                        method.fixNavigate();
                    }
                },
                onSlideBefore: function ($slideElement) {
                    $content.removeClass('active');
                },
                onSlideAfter: function ($slideElement) {
                    $slideElement.find('.b-hero__content').addClass('active');
                }
            });
        };

        method.stop = function () {
            slider.destroySlider();
            isStarted = false;
        };

        method.fixNavigate = function () {
            var $hero = $slider.parents('.b-hero');
            $hero.on('mouseenter', '.bx-pager-link, .bx-prev, .bx-next', function () {
                slider.stopAuto();
            }).on('mouseleave', '.bx-pager-link, .bx-prev, .bx-next', function () {
                slider.startAuto();
            });
            isNavFixed = true;
        }

        method.endResize = function () {//если после ресайза окна изменилась ширина - проверяем разрешение экрана и подключаем / отключаем слайдер
            if (new Date() - rtime < delta) {
                setTimeout(method.endResize, delta);
            } else {
                timeout = false;
                var winW = $.viewportW();
                if (winW !== lastWinW) {
                    lastWinW = winW;
                    method.check(winW);
                }
            }
        };

        method.startResize = function () {
            rtime = new Date();
            if (timeout === false) {
                timeout = true;
                setTimeout(method.endResize, delta);
            }
        };

        method.init = function () {
            method.check(lastWinW);
            $(window).bind('resize', method.startResize);
        };

        method.init();
    };
    if ($('.js-slider').length) {
        heroSlider();
    };

    //Лайтбокс
    function initGallery() {
        var $gallery = $('.js-gallery');
        $gallery.each(function () {
            $(this).find('a').simpleLightbox({
                navText: ['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'],
                captions: true,
                captionSelector: 'figcaption',
                captionType: 'text',
                close: true,
                closeText: '<i class="icon-close"></i>',
                showCounter: true,
                disableScroll: false,
                widthRatio: .9
            });
        });
    };
    if ($('.js-gallery').length) {
        initGallery();
    }
});

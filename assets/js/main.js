/*!
	Author: Jehison Perez
	Creation date: september of 2017
	Project name: weddings
	File name: main.js
*/
'use strict';
(function ($) {

  var MC = '',
    iframe = '',
    player = '',
    activado = false,
    anchoDesktopMax = 1920,
    formHeaderReady = true,
    anchoDesktop = 1200,
    anchoTablet = 992,
    anchoMobile = 767,
    lan = '',
    checkOut = '',
    checkIn = '';

  MC = MC || {};

  MC.fn = {
    init: function init() {

      MC.fn.submenu();
      MC.fn.slider();
      MC.fn.header();
      MC.fn.imagenesFondo();
      MC.fn.galerias();
      MC.fn.tabs();
      MC.fn.globalEvents();
      MC.fn.selectResort();
      MC.fn.formsValidation();
      MC.fn.search();
    },

    submenu: function submenu() {

      if ($(window).width() > anchoMobile) {
        $('.menu > li').hover(function () {
          $(this).find('.submenu').show();

          var areaActiva = '<div class="area-activa"></div>';
          $(areaActiva).appendTo(this);

          if ($(this).find('.triangulo').is(":visible")) {
            $(this).find('.triangulo').css({
              left: $(this).find('.triangulo').parent().parent().offset().left + $(this).find('.triangulo').parent().parent().find('> a').width() / 2 - 14
            })
          }

        }, function () {
          $('.submenu').hide();
          $('.area-activa').remove();
        })
      }

      if ($(window).width() <= anchoMobile) {
        $('li.down').on('click', function () {
          if ($(this).hasClass('open')) {
            $(this).removeClass('open');
          } else {
            $('li.down').removeClass('open');
            $(this).addClass('open');
          }
        })
      }
    },

    slider: function slider() {
      var sonido = '<div class="volumenVideo" id="volumenVideo"></div>';
      $('.bloque-slider.flexslider').append(sonido);

      //Slider Principal
      $('.flexslider.bloque-slider').flexslider({
        controlNav: false,
        animation: 'fade',
        prevText: '',
        nextText: '',
        touch: true,
        slideshow: false,
        start: function () {
          if ($('.bloque-slider.flexslider iframe').is(":visible")) {
            iframe = document.querySelector('.container-video iframe');
            player = new Vimeo.Player(iframe);
            player.setVolume(0);

            $('.volumenVideo').click(function () {
              if (activado == false) {
                $(this).addClass('activado');
                player.setVolume(1)
                activado = true;
              } else {
                $(this).removeClass('activado');
                player.setVolume(0)
                activado = false;
              }
            })

            if ($('.flex-active-slide .container-video').is(":visible")) {
              player.play();
              $('.volumenVideo').fadeIn();

              player.on('ended', function (data) {
                $('.bloque-slider.flexslider').flexslider('next');
                $('.volumenVideo').fadeOut();
              });

            }
          }
        },
        before: function () {
          if ($('.flex-active-slide .container-video').length >= 1) {
            player.pause();
            $('.volumenVideo').fadeOut();
          }
        },
        after: function () {
          if ($('.flex-active-slide .container-video').is(":visible")) {
            player.play();
            $('.volumenVideo').fadeIn();

            player.on('ended', function (data) {
              $('.bloque-slider.flexslider').flexslider('next');
              $('.volumenVideo').fadeOut();
            });
          }
        }
      });

      // Sliders

      $('.bloque-slider-interna.flexslider').flexslider({
        controlNav: true,
        animation: 'fade',
        prevText: '',
        nextText: '',
        touch: true,
        slideshow: false
      });

      $('.flexslider').flexslider();

      $('.owl-carousel').owlCarousel()
    },

    // Header 
    header: function header() {
      if ($(document).scrollTop() >= 30) {
        $('header.header').addClass('transform');
      } else {
        $('header.header').removeClass('transform');
      }

      //Menu

      $("#brand-type").change(function () {
        var marca = $(this).val();
        var rooms = $('#number-rooms').val();
        $.ajax({
          type: "POST",
          url: '/get/resorts',
          data: {
            "marca": marca,
            "rooms": rooms,
            "lg": Drupal.settings.mice_config.language
          },
          success: function (data) {
            console.log(data);
            if (data != 0) {
              $('#filter-content-resorts').html(data);
            } else {
              console.log('no results')
              $('#filter-content-resorts').html('No results')
            }
          }
        });
      });

      $("#number-rooms ").change(function () {
        var marca = $('#brand-type').val();
        var rooms = $(this).val();
        $.ajax({
          type: "POST",
          url: '/get/resorts',
          data: {
            "marca": marca,
            "rooms": rooms,
            "lg": Drupal.settings.mice_config.language
          },
          success: function (data) {
            console.log(data);
            if (data != 0) {
              $('#filter-content-resorts').html(data);
            } else {
              $('#filter-content-resorts').html('No Results');
            }
          }
        });
      });
    },
    // Fin Header 

    // Search 
    search: function search() {
      $('.search-results.node-results').addClass('container');

      $('#buscador').submit(function (event) {
        var valor = $('#parametro_search').val();
        window.location.href = '/search/node/' + valor;
        event.preventDefault();
      });
    },
    // Fin Search 


    // Select Resort
    selectResort: function selectResort() {
      MC.fn.changeResort($('.info-resorts li')[0]);

      var resorts = $('.info-resorts li');
      for (var i = 0; i < resorts.length; i++) {
        var resort = resorts[i];
        $('select#select-resort').append('<option value="' + $(resort).attr('data-id') + '">' + $(resort).find('.subtitulo-h2').html() + '</option>');
      }
      $('select#select-resort').selectpicker();

      /*$('select#select-resort').on('change', function (e) {
      	if($(e.currentTarget).val() != ''){
      		MC.fn.changeResort($('.info-resorts li[data-id="'+ $(e.currentTarget).val() +'"]'));
      	}
      });*/

      jQuery("#select-resort").change(function () {
        var tid = jQuery(this).val();
        jQuery.ajax({
          type: "POST",
          url: '/send/resort',
          data: {
            "tid": tid
          },
          success: function (data) {
            if (data != 0) {
              var datos = JSON.parse(data);
              jQuery('.content-img').html(datos['content-img']);
              jQuery('.box > a').remove();
              jQuery('.box').append(datos['box']);
              jQuery('.info-resorts').html(datos['info-resorts']);
              MC.fn.changeResort($('.info-resorts li')[0]);
            }
          }
        });
      });
    },
    // Fin Select Resort

    changeResort: function changeResort(resort) {
      var newResort = resort;

      $('.front .bloque-content3 .content-info h4').html($(newResort).find('.subtitulo-h4').html());
      $('.front .bloque-content3 .content-info h2').html($(newResort).find('.subtitulo-h2').html());
      $('.front .bloque-content3 .content-info h3').html($(newResort).find('.subtitulo-h3').html());
      $('.front .bloque-content3 .content-info p').html($(newResort).find('.text').html());
      $('.front .bloque-content3 .content-info a').attr('href', $(newResort).find('.link').html());
      $('.front .bloque-content3 .content-img').css({
        'background-image': 'url(' + $(newResort).find('img.img-background').attr('src') + ')'
      });
    },

    formsValidation: function formsValidation() {
      $('#newsletter-form').parsley();

      // Form
      $('#edit-submitted-f3-city').selectpicker({
        title: "City*"
      });
      $('#edit-submitted-f3-country').selectpicker();

      $('#edit-submitted-f4-state').selectpicker({
        title: "State*"
      });
      $('#edit-submitted-f12-purpose').selectpicker({
        title: "Purpose of Meeting"
      });

      $('.bloque-form .form-actions').addClass('submit');

      $('#edit-submitted-f12-number-rooms').attr('data-parsley-type', 'number');
      $('#edit-submitted-f12-number-rooms').attr('maxlength', '5');
      $('#edit-submitted-f12-number-rooms').attr('required', 'required');
      $('#edit-submitted-f12-number-rooms').attr('data-parsley-min', '1');

      $('#edit-submitted-f7-number-of-attendees').attr('data-parsley-type', 'number');
      $('#edit-submitted-f7-number-of-attendees').attr('maxlength', '5');
      $('#edit-submitted-f7-number-of-attendees').attr('required', 'required');

      $('#edit-submitted-f2-phone').attr('data-parsley-type', 'number');
      $('#edit-submitted-f2-phone').attr('data-parsley-maxlength', '10');
      $('#edit-submitted-f2-phone').removeAttr('maxlength');


      if ($('body').hasClass('i18n-es')) {
        lan = 'es'
      } else {
        lan = 'en'
      }

      $('.date_inputs').datepicker({
        autoclose: true,
        language: lan,
        disableTouchKeyboard: true,
        format: 'yyyy-mm-dd',
        immediateUpdates: true,
        startDate: 'today',
        endDate: '+2y'
      }).on('changeDate', function (event) {
        if (event.currentTarget.id === 'check_in_input') {
          MC.fn.checkInDate(event);
          MC.fn.checkOutDate(event);
        } else if (event.currentTarget.id === 'check_out_input') {
          checkOut = event.format('yyyy-mm-dd');
        }
      }).on('hide', function () {
        if ($('.check_in_input').val() == '') {
          $('.check_out_input').val('');
        }
      });

      if ($('.bloque-form form').is(':visible')) {
        $('.bloque-form .webform-component--f10').append('<div id="container-error-resorts"></div>');
        $('.bloque-form .webform-component--f10 #edit-submitted-f10-resorts-1').attr('data-parsley-mincheck', '1');
        $('.bloque-form .webform-component--f10 #edit-submitted-f10-resorts-1').attr('data-parsley-maxcheck', '3');
        $('.bloque-form .webform-component--f10 #edit-submitted-f10-resorts-1').attr('data-parsley-errors-container', '#container-error-resorts');
        $('.bloque-form .webform-component--f10 .form-checkbox').attr('data-parsley-multiple', 'resorts');
        $('.bloque-form .webform-component--f10 #edit-submitted-f10-resorts-1').attr('required', 'required');
        $('.bloque-form form').parsley().on('field:success', function () {
          var selects = $('.bloque-form form select');
          for (var i = 0; i <= selects.length; i++) {
            var select = selects[i];
            if ($(select).hasClass('parsley-error')) {
              $(select).siblings('button').addClass('parsley-error');
            } else {
              $(select).siblings('button').removeClass('parsley-error');
            }
          }
        });
      }

      $('#edit-submitted-f10-resorts .form-type-checkbox').addClass('col-md-6 col-sm-6 col-xs-12');

      // Filters
      $('.filters select').selectpicker();

      // Newsletter

      $('#newsletter-form').submit(function (event) {
        var mail = $('#email_news').val();
        var cheboxTerms = $('#chek-terms').is(':checked') ? 1 : 0;
        var cheboxSing = $('#chek-sing').is(':checked') ? 1 : 0;
        jQuery.ajax({
          type: "POST",
          url: '/send/newsletter',
          data: {
            "email_newsletter": mail,
            "chebox_Terms": cheboxTerms,
            "chebox_sing": cheboxSing
          },
          success: function (data) {
            if (data == 1) {
              $('#respuesta').css('display', 'block');
              $('#newsletter-form').css('display', 'none');
              $('#suscribe-title').css('display', 'none');
            }

          }
        });
        event.preventDefault();
      });

      // Tabla 

      $('.bloque-table .table tbody td, .bloque-table .table thead th').css({
        width: 90 / ($('.table').attr('data-column') - 1) + '%'
      });

      $('.bloque-table .table td a').append('<span></span>');
    },

    // Check in date
    checkInDate: function checkInDate(e) {

      var dateIn = '';

      checkIn = e.format('yyyy-mm-dd');
      dateIn = $(e.currentTarget).datepicker('getDate', '+1d');

      $('.check_in_input').each(function (i) {
        $('.check_in_input').eq(i).val(' ').datepicker('update', ('startDate', dateIn));
      });
    },
    // end Check in date

    // Check out date
    checkOutDate: function checkOutDate(e) {
      var dateOut = '',
        minDate = '';

      dateOut = $(e.currentTarget).datepicker('getDate', '+1d');

      if ($('.book__form').hasClass('is--flight')) {
        dateOut.setDate(dateOut.getDate() + 7);
      } else {
        dateOut.setDate(dateOut.getDate() + 5);
      }

      minDate = new Date(e.date.valueOf());
      minDate.setDate(minDate.getDate() + 1);

      $('.check_out_input').each(function (i) {
        $('.check_out_input').eq(i).val(' ').datepicker('setStartDate', minDate).datepicker('update', ('startDate', dateOut));
      });

      checkOut = $('.check_out_input').eq(0).val();
    },
    // end Check out date

    // Imagenes Fondo
    imagenesFondo: function imagenesFondo() {
      var images = $('.img-background');
      for (var i = 0; i < images.length; i++) {
        var image = images[i];
        $(image).parent().css({
          'background-image': 'url(' + $(image).attr('src') + ')'
        })
      }
    },
    // Fin Imagenes Fondo

    // Galerías
    galerias: function galerias() {
      $('.grid').masonry({
        itemSelector: '.grid-item',
        percentPosition: true
      });

      $("[data-fancybox]").fancybox({
        loop: true,
        buttons: [
          'close'
        ]
      });
    },
    // Fin Galerías

    // Tabs
    tabs: function tabs() {
      if ($('.bloque-tabs').is(':visible')) {
        $('.bloque-tabs header ul li').click(function () {
          $(this).parent().find('li').removeClass('active');
          $(this).addClass('active');

          $(this).parent().parent().parent().find('.container-tabs > div').removeClass('active');
          $(this).parent().parent().parent().find('.container-tabs').find('.' + $(this).attr('data-media')).addClass('active');

          var alto = $(this).parent().parent().parent().find('.container-tabs').find('.' + $(this).attr('data-media')).offset().top;

          if ($(window).width() < anchoMobile) {
            $('html, body').animate({
              scrollTop: alto
            }, 800);
          }

          $('.grid').masonry({
            itemSelector: '.grid-item',
            percentPosition: true
          });

          $(".fancybox").fancybox();

          $('.fancybox-media').fancybox({
            helpers: {
              media: {}
            }
          });
        })
      }

      if ($('.bloque-mach').is(':visible')) {
        $('.bloque-mach ul li').click(function () {
          $('.bloque-mach ul li').removeClass('active');
          $(this).addClass('active');

          $('.box-answer .triangulo').css({
            left: $(this).offset().left + $(this).width() / 2 - 31
          })

          $('.box-answer').removeClass('active');
          $('section[data-id="' + $(this).attr('id') + '"]').addClass('active');
        })
      }
    },
    // Fin Tabs

    // Global click events
    clickEvents: function clickEvents() {

      $('.icon-menu').on('click', function () {
        $('.container-header nav').addClass('right');
      })

      $('#closeMenu').on('click', function () {
        $('.container-header nav').removeClass('right');
      })

      $('.close-back').on('click', function () {
        $('.container-header nav').removeClass('right');
      })

      $(".collapse").on("hide.bs.collapse", function () {
        $('.read_more .more').show();
        $('.read_more .less').hide();
      });

      $(".collapse").on("show.bs.collapse", function () {
        $('.read_more .more').hide();
        $('.read_more .less').show();
      });

      //Search
      $('.search_desktop').on('click', function () {
        $('.search_input').addClass('visible');
      });

      $('.search_input .close').on('click', function () {
        $('.search_input').removeClass('visible');
      });

      $('.btn-plano3d').on('click', function () {
        var enlace = $(this).attr('data-url');
        var title = $(this).attr('data-title');
        MC.fn.PopupWindowCenter(enlace, title, 1110, 735)
      })

    },
    // end Global click events

    PopupWindowCenter: function PopupWindowCenter(URL, title, w, h) {
      var left = (screen.width / 2) - (w / 2);
      var top = (screen.height / 2) - (h / 2);
      var newWin = window.open(URL, title, 'toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width=' + w + ',   height=' + h + ', top=' + top + ', left=' + left);
    },

    // Global events
    globalEvents: function globalEvents() {
      MC.fn.clickEvents();
    }
    // end Global events
  }

  MC.documentOnReady = {
    init: function init() {
      MC.fn.init();
    }
  };

  MC.documentOnLoad = {
    init: function init() {
      if ($('.box-answer .triangulo').is(":visible")) {
        $('.box-answer .triangulo').css({
          left: $('.bloque-mach ul li.active').offset().left + $('.bloque-mach ul li.active').width() / 2 - 31
        })
      }

      $('.grid').masonry({
        itemSelector: '.grid-item',
        percentPosition: true
      });

      $("[data-fancybox]").fancybox({
        loop: true,
        buttons: [
          'close'
        ]
      });
    }
  };

  MC.documentOnResize = {
    init: function init() {
      if ($(window).width() <= anchoMobile) {
        $('.bloque-booking').removeClass('vertical');
        $('.bloque-booking').removeClass('visible');
      }

      if ($(window).width() <= anchoMobile) {
        $('.bloque-boxes .boxes-images').addClass('owl-carousel').addClass('owl-theme');
        $('.bloque-boxes .boxes-images').owlCarousel({
          items: 1,
          margin: 0,
          nav: false,
          dots: true
        });
      } else {
        $('.bloque-boxes .boxes-images').removeClass('owl-carousel').removeClass('owl-theme');
        $('.bloque-boxes .boxes-images').owlCarousel('destroy');
      }

      if ($('.box-answer .triangulo').is(":visible")) {
        $('.box-answer .triangulo').css({
          left: $('.bloque-mach ul li.active').offset().left + $('.bloque-mach ul li.active').width() / 2 - 31
        })
      }
    }
  };

  MC.documentOnScroll = {
    init: function init() {

      if ($(document).scrollTop() >= 30) {
        $('header.header').addClass('transform');
      } else {
        $('header.header').removeClass('transform');
      }

    }
  };

  MC.run = {
    init: function init() {
      $(document).on('ready', MC.documentOnReady.init);
      $(window).on('load', MC.documentOnLoad.init);
      $(window).on('resize', MC.documentOnResize.init);
      $(window).on('scroll', MC.documentOnScroll.init);
    }
  };

  MC.run.init();

})($);

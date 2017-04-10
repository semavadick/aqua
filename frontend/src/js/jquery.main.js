$(document).ready(function(){
	initParalax();
	initPlayerForm();
	maskInput();
	initProductSlider();
	resolutions();
	initFlexImage();
	init_and_resize();
	$(window).resize(function() {
		init_and_resize();
	});
	$(window).load(function() {
		if (device.mobile() || device.tablet()) {
			if ($('html').hasClass('landscape')) {
				$('head').append('<meta name="viewport" class="meta-1" content="width=1000">');
				$('head').find($('.meta-2')).remove();
			} else if ($('html').hasClass('portrait')) {
				$('head').find($('.meta-1')).remove();
				$('head').append('<meta name="viewport" class="meta-2" content="width=device-width">');
			}

 		}
	});
	if (device.mobile() || device.tablet()) {
		$(window).on("orientationchange", function() {
			if ($('html').hasClass('landscape')) {
				$('head').append('<meta name="viewport" class="meta-1" content="width=1000">');
				$('head').find($('.meta-2')).remove();
			} else if ($('html').hasClass('portrait')) {
				$('head').find($('.meta-1')).remove();
				$('head').append('<meta name="viewport" class="meta-2" content="width=device-width">');
			}
		});
 	}

	$('.category-chooser a').on('click', function() {
		$('.category-chooser li .drop').toggleClass("active");
		return false;
	});
	 $(document).click(function(event) {
		if ($(event.target).closest('.category-chooser li .drop').length) return;
		$('.category-chooser li .drop').removeClass('active');
		event.stopPropagation();
	})
	$('.mob-btn').on('click', function() {
		$('#header').toggleClass("active");
		$('.mobile-nav-container').toggleClass("active");
		return false;
	});
	$('.catalog-group .price-box input[type="text"]').on('focus', function() {
		$('.amount').addClass("active");
		return false;
	});
	$('.catalog-group .price-box input[type="text"]').on('focusout', function() {
		$('.amount').removeClass("active");
		return false;
	});
	$('#nav.mobile li.has-drop>a').on('click', function() {
		$('#header #nav.mobile .back').addClass("active");
		$('#header #nav.mobile').addClass("drop-opened");
		$(this).parent().addClass("opened");
		return false;
	});
	$('#header #nav.mobile .back a').on('click', function() {
		$('#header #nav.mobile').removeClass("drop-opened");
		$('#header #nav.mobile .back').removeClass("active");
		$('#nav.mobile li.has-drop').removeClass('opened');
		return false;
	});
	$('.sl1 , .sl2').selecter();
	$('.fancy').fancybox();
		mobmenu();
		initPopups();
	$('#main .gallery-main').bxSlider({
			pager: true,
			controls: false,
			maxSlides: 1,
			auto: false,
			minSlides: 1,
			moveSlides: 1,
			speed: 1500,
	});
	$('.knowledge-base-gallery').bxSlider({
			pager: true,
			controls: false,
			maxSlides: 1,
			auto: false,
			minSlides: 1,
			moveSlides: 1,
			speed: 1500,
	});
	var slider= $('.sert .gallery').bxSlider({
			pager: true,
			controls: false,
			maxSlides: 4,
			auto: false,
			minSlides: 4,
			moveSlides: 1,
			slideWidth:362,
			slideMargin: 48,
			speed: 1500,
	});
	$('.advantages-tech .gallery').bxSlider({
			pager: true,
			controls: false,
			maxSlides: 1,
			auto: false,
			minSlides: 1,
			moveSlides: 1,
			speed: 1500,
	});

	var _articleSlider = new Array();
	 $('.knowledge-base article .gallery').each(function(i, _articleSlider){
    _articleSlider[i] = $(_articleSlider).bxSlider({
    		pager: true,
			controls: true,
			maxSlides: 1,
			auto: false,
			minSlides: 1,
			slideWidth:818,
			moveSlides: 1,
			speed: 500,
       });
   })
	$('.article .gallery li').click(function(){
		var _index = $(this).index();
		var _len = $(this).closest('.gallery').find('li').length;
		$('.article .gallery ').each(function(i, _articleSlider){
			if(_index < _len - 2){
	    		_articleSlider[i].goToSlide(_index);
	    	} else {
	    		_articleSlider[i].goToSlide(0);
	    	}
	   	})
	});

	var _tabSlider;
	var sliders = new Array();
   $('.gallery-tabs .gallery').each(function(i, sliders){
    sliders[i] = $(sliders).bxSlider({
    		pager: true,
			controls: true,
			maxSlides: 1,
			auto: false,
			minSlides: 1,
			moveSlides: 1,
			speed: 500,
    });
   })
    $('.gallery-tabs .gallery li').click(function(){
		var _index = $(this).index();
		var _len = $(this).closest('.gallery').find('li').length;
		var _thisSlider = $(this).closest('.tab').index();
		$('.gallery-tabs .gallery').each(function(i, sliders){
			if(_index < _len - 2){
	    		sliders[i].goToSlide(_index);
	    	} else {
	    		sliders[i].goToSlide(0);
	    	}
	    })
		// return false;
	});
	$('.gallery-tabs li a').click(function(){
		$('.gallery-tabs .gallery').each(function(i, sliders){
	    	sliders[i].goToSlide(0);
	    })
	})
   $('#wrapper').addClass('slider-load');

	$('.catalog-group .gallery').bxSlider({
			pager: true,
			controls: false,
			maxSlides: 1,
			auto: false,
			minSlides: 1,
			moveSlides: 1,
			pagerCustom: '#bx-pager',
			speed: 1500,
	});
	$(window).load(function(){
		initSly();
	});
	$(window).resize(function(){
		initSly();
		$('.menu-cover').sly('reload');
	});
	$(window).load(function(){
		if($('.sert .gallery').size()) {
			if ($(window).width() < 1220) {
			  slider.reloadSlider({
				pager: true,
				controls: false,
				maxSlides: 3,
				auto: false,
				minSlides: 3,
				moveSlides: 1,
				slideWidth:362,
				slideMargin: 48,
				speed: 1500,
				});
			} else {
				slider.reloadSlider({
				pager: true,
				controls: false,
				maxSlides: 4,
				auto: false,
				minSlides: 4,
				moveSlides: 1,
				slideWidth:362,
				slideMargin: 48,
				speed: 1500,
				});
			};
			if ($(window).width() < 960) {
			slider.reloadSlider({
				pager: true,
				controls: false,
				maxSlides: 2,
				auto: false,
				minSlides: 2,
				moveSlides: 1,
				slideWidth:362,
				slideMargin: 48,
				speed: 1500,
				});
			}
		}

	});
	$(window).resize(function(){
		if($('.sert .gallery').size()) {
			if ($(window).width() < 1220) {
			  slider.reloadSlider({
				pager: true,
				controls: false,
				maxSlides: 3,
				auto: false,
				minSlides: 3,
				moveSlides: 1,
				slideWidth:362,
				slideMargin: 48,
				speed: 1500,
				});
			} else {
				slider.reloadSlider({
				pager: true,
				controls: false,
				maxSlides: 4,
				auto: false,
				minSlides: 4,
				moveSlides: 1,
				slideWidth:362,
				slideMargin: 48,
				speed: 1500,
				});
			};
			if ($(window).width() < 960) {
			slider.reloadSlider({
				pager: true,
				controls: false,
				maxSlides: 2,
				auto: false,
				minSlides: 2,
				moveSlides: 1,
				slideWidth:362,
				slideMargin: 48,
				speed: 1500,
				});
			}
		}
	});

	 $('.personal-cabinet .profile .btn').on('click', function(){
	 	 $('.list-user-info li').each(function(){
		 	$(this).find('input').removeAttr("disabled")
		 });
        $(this).text("сохранить");
        return false;
    });

	 $('#header .user-logining .user-name').on('mouseover touchstart', function(){
        $('#header .user-logining .drop').toggleClass("active");
        $(this).toggleClass("active");
        return false;
    });
	 $(document).click(function(event) {
		if ($(event.target).closest('#header .user-logining .drop').length) return;
		$('#header .user-logining .user-name').removeClass('active');
		$('#header .user-logining .drop').removeClass('active');
		event.stopPropagation();
	})
	 $('.tabset li a').on('click', function(){
        var thisHold = $(this).closest(".gallery-tabs ,.tab-map, .info");
        var _ind = $(this).closest('li').index();
        thisHold.children('.tab-body').children(".tab").removeClass('active');
        thisHold.children('.tab-body').children("div.tab:eq("+_ind+")").addClass('active');
        $(this).closest("ul").find(".active").removeClass("active");
        $(this).parent().addClass("active");
        return false;
    });
	$('.answers .columns a').on('click  touchstart', function (e) {
		var self = $(this);
		var currentMenu = $(this).closest('li').find('.answer');
		$('li .answer').not(currentMenu).slideUp();
		currentMenu.slideToggle();
		 $(this).not( $(' a.active')).toggleClass('active');
		$('.answers .columns a').not(self).removeClass('active');
		 return false;
 	});
 	$('.nav>li>a').on('click  touchstart', function (e) {
		var self = $(this);
		var par = $(this).parent();
		var currentMenu = $(this).closest('li').find('.nav-drop');
		$('li .nav-drop').not(currentMenu).slideUp();
		currentMenu.slideToggle();
		 $(this).toggleClass('active');
		$('.nav>li>a').not(self).removeClass('active');
		//  par.toggleClass('active');
		// $('.nav>li').not(par).removeClass('active');
		 return false;
 	});
 	$('#header .login-holder .search-btn').on('click  touchstart', function (e) {
		$('#header .popup-form').addClass('active');
		$('#header .holder .tel').addClass('active');
		 return false;
 	});
 	$('#header .popup-form .btn-close').on('click  touchstart', function (e) {
		$('#header .popup-form').removeClass('active');
		$('#header .holder .tel').removeClass('active');
		 return false;
 	});
 	$('#popup-basket table .close').on('click', function (e) {
		$(this).closest('tr').hide();
 		alert(a)
		 return false;
 	});
 	quantitySwitch();

});
	$(window).load(function() {
		setTimeout(function() {
			initProductSlider()
		}, 1000);
	});
	$(window).resize(function() {
		initProductSlider()
	});

function resolutions(){
	$('body').append('<div class="resolutions900"></div>');
}
function init_and_resize(){
	if($('.resolutions900').is(':visible')){
		$('.catalog-group-begin .catalog .item7').insertBefore($('.catalog-group-begin .catalog .item9'));
	}
	if($('.resolutions900').is(':hidden')){
		$('.catalog-group-begin .catalog .item7').insertBefore($('.catalog-group-begin .catalog .item8'));
	}
}


var _productSlider;
var sliders2 = new Array();
function initProductSlider(){
 if ($(window).width() > 1170) {
  if ($('#wrapper').hasClass('slider-load')) {
   $.each(sliders2, function(i, _productSlider) {
    _productSlider.destroySlider();
   });
   $('#wrapper').removeClass('slider-load');
  }
 } else {
  if ($('#wrapper').hasClass('slider-load')) {} else {
   $('.bottom-news-box .bottom-news').each(function(i, slider2){
    sliders2[i] = $(slider2).bxSlider({
     controls: false
    });
   })
   $('#wrapper').addClass('slider-load');
  }
 }
}

function initParalax(){
	$(window).scroll(function(){
		if ($('.solutions .visual').size()) {
			var _num3 = -($(window).scrollTop()+$(window).height()- $('.solutions .visual').offset().top )
				$('.solutions .visual').css({
					'background-position': '0% '+_num3/2 +'px'
				})
		}
		if ($('.knowledge-base-gallery li').size()) {
			var _num4 = -($(window).scrollTop()+$(window).height()/2- $('.knowledge-base-gallery li').offset().top)
				$('.knowledge-base-gallery li').css({
					'background-position': '50% '+_num4 +'px'
				})
		}
		if ($('.catalog-group .title').size()) {
			var _num5 = -($(window).scrollTop()+$(window).height()- $('.catalog-group .title').offset().top)
				$('.catalog-group .title').css({
					'background-position': '0% '+_num5/2 +'px'
				})
		}
		if ($('.building-steps .head').size()) {
			var _num6 = -($(window).scrollTop()+$(window).height()- $('.building-steps .head').offset().top)
				$('.building-steps .head').css({
					'background-position': '50% '+_num6/1.3 +'px'
			})
		}
		if ($('.gallery-main li ').size()) {
			var _h = $('.gallery-main li').height()/2;
			var _num7 = -($(window).scrollTop()+$(window).height()/2- $('.gallery-main li ').offset().top)
				$('.gallery-main li ').css({
					'background-position': '50%'+_num7/2.1 +'px'
				})
		}
		if ($('.knowledge-base-title').size()) {
			var _num8 = -($(window).scrollTop()+$(window).height()/2- $('.knowledge-base-title').offset().top)
				$('.knowledge-base-title').css({
					'background-position': '50% '+_num8/2 +'px'
				})
		}
	});
}


function initFlexImage(){
 $('.flex-image').each(function(){
  $(this).closest('.flex-image-holder').css({
   'background':'url('+$(this).attr('src')+') no-repeat 50% 0%',
   'background-size':'cover'
  })
 });
}


function quantitySwitch(){
  $(document).on('click','.amount .minus,.amount .plus',function(e){
    var input=$(this).parent().find('input'),
      val=parseInt(input.val());
    if($(this).is('.plus')){
      input.val((++val))
    }else{
      if(val-1<=1)
        input.val("1")
      else
        input.val((--val)+"")
    }
    e.preventDefault();
  });
};
function mobmenu(){
        var opener = $('.btn-more');
        var menu = $('.box-hidden');
        opener.on('click', function(e){
            e.preventDefault();
            $(this).closest('.text').find('.box-hidden').slideToggle();
            $(this).toggleClass("active");
        });
    }




function initSly() {
	if ('sly' in $.fn) {

		$frame1 = $('.menu-cover');
		$frame1.each(function() {
			var _this = $(this);
			var $wrap = $(this).parent();

		 var _thisW = $(this).width(),
		_listW = $('.menu-elements', this).width();
		if (!$( _this).parent().find('.scrollbar').size()) {
			_this.parent().append('<div class="center"><div class="scrollbar"><div class="handle"><div class="mousearea"></div></div></div></div>');
		}

		var _w =0;
		 $(this).find('li').each(function(){
		 	_w = _w + $(this).outerWidth(true);
		 });
		 $(this).find('ul').width(_w);

		if (_w > _thisW) {
			_this.parent().addClass('has-scroll');
		} else {
			_this.parent().removeClass('has-scroll');
		}


		$(this).sly({
			horizontal: 1,
			smart: 0,
			activateOn: 'click',
			itemNav: 'Centered',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 1,
			cycleBy: 0,
			cycleInterval: 0,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 0,
			speed: 450,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,
			draggedClass: 'dragged', // Class for dragged elements (like SLIDEE or scrollbar handle).
			activeClass: 'active', // Class for active items and pages.
			disabledClass: 'disabled'
			}, {
			move: function(angel) {
			 wst = this.pos.cur;
			 $(window).trigger('scroll');
			}
		});
		$frame1.sly('reload');
		$frame1.on('touchmove', function(e) {
			e.preventDefault();
		});
		});
	}
}
function initPopups(){
	$('body')
		.popup({
			"opener":".btn.btn-calc",
			"popup_holder":"#popup-calc",
			"popup":".popup",
			"close_btn":".close-popup"
		})
		.popup({
			"opener":".basket-btn",
			"popup_holder":"#popup-basket",
			"popup":".popup",
			"close_btn":".close-popup"
		})
		.popup({
			"opener":"#header .holder .btn , .about-company .content .btn,.about-company .aside .btn, .btn-order-cat , .btn-discount , .btn-help",
			"popup_holder":"#popup-call",
			"popup":".popup",
			"close_btn":".close-popup"
		})
		.popup({
			"opener":"#header .login-holder .user",
			"popup_holder":"#popup-reg",
			"popup":".popup",
			"close_btn":".close-popup"
		})
		.popup({
			"opener":".order-block .btn.ask-btn",
			"popup_holder":"#popup-ask",
			"popup":".popup",
			"close_btn":".close-popup"
		})
}
$.fn.popup = function(o){
 var o = $.extend({
    "opener":".call-back a",
    "popup_holder":"#call-popup",
    "popup":".popup",
    "close_btn":".btn-close",
    "close":function(){
    	 $('.popup-holder .bg').hide();
    },
    "beforeOpen": function(popup) {
     $(popup).css({
      'left': 0,
      'top': 0
     }).hide();
    }
   },o);
 return this.each(function(){
  var container=$(this),
   opener=$(o.opener,container),
   popup_holder=$(o.popup_holder,container),
   popup=$(o.popup,popup_holder),
   close=$(o.close_btn,popup),
   bg=$('.bg',popup_holder);
   popup.css('margin',0);
   opener.click(function(e){
    o.beforeOpen.apply(this,[popup_holder]);
    popup_holder.fadeIn(400);
    alignPopup();
    bgResize();
    bg.show();
    e.preventDefault();
   });
  function alignPopup(){
   var deviceAgent = navigator.userAgent.toLowerCase();
   var agentID = deviceAgent.match(/(iphone|ipod|ipad|android)/i);
   if(agentID){
    if(popup.outerHeight()>window.innerHeight){
     popup.css({'top':$(window).scrollTop(),'left': ((window.innerWidth - popup.outerWidth())/2) + $(window).scrollLeft()});
     return false;
    }
    popup.css({
     'top': ((window.innerHeight-popup.outerHeight())/2) + $(window).scrollTop(),
     'left': ((window.innerWidth - popup.outerWidth())/2) + $(window).scrollLeft()
    });
   }else{
    if(popup.outerHeight()>$(window).outerHeight()){
     popup.css({'top':$(window).scrollTop(),'left': (($(window).width() - popup.outerWidth())/2) + $(window).scrollLeft()});
     return false;
    }
    popup.css({
     'top': (($(window).height()-popup.outerHeight())/2) + $(window).scrollTop(),
     'left': (($(window).width() - popup.outerWidth())/2) + $(window).scrollLeft()
    });
   }
  }
  function bgResize(){
   var _w=$(window).width(),
    _h=$(document).height();
   bg.css({"height":_h,"width":_w+$(window).scrollLeft()});
  }
  $(window).resize(function(){
   if(popup_holder.is(":visible")){
    bgResize();
    alignPopup();
   }
  });
  if(popup_holder.is(":visible")){
    bgResize();
    alignPopup();
  }
  close.add(bg).click(function(e){
   var closeEl=this;
   popup_holder.fadeOut(400,function(){
    o.close.apply(closeEl,[popup_holder]);
   });
   e.preventDefault();
  });
  $('body').keydown(function(e){
   if(e.keyCode=='27'){
    popup_holder.fadeOut(400);
   }
  })
 });
};

	function maskInput() {
		if ($(".phone-input").size()) $(".phone-input").mask("+7 (999) 999-99-99", {
			placeholder: "_"
		});
	}

function initPlayerForm(){
	if("mask" in $.fn){
		$('.phone').mask("+7 (999) 999 - 99 - 99");
	}
	$('form').each(function(){
      var form=$(this),
      input=form.find('input:text');
  		form.find('.required').blur(function(){
            var val=$(this).val();
            if((/^[a-zA-Zа-яА-ЯіІєЄїЇ\s-]{1,40}$/ig).test(val)){
                $(this).removeClass('error');
                $(this).closest('.holder-error').removeClass('active');
            }
            else{
                $(this).addClass('error');
                $(this).closest('.holder-error').addClass('active');
				$(this).val('');
            }
        });
        form.on('keyup keydown', '.required.error', function(){
            var val=$(this).val();
            if((/^[a-zA-Z0-9а-яА-ЯіІєЄїЇ\s-\(\)\+]{1,40}$/ig).test(val)){
                $(this).removeClass('error');
                $(this).closest('.holder-error').removeClass('active');
            }
            else{
                $(this).addClass('error active');
                $(this).closest('.holder-error').addClass('active');
            }
        });
		 form.find('.phone').blur(function(){
            var val=$(this).val();
             if((/^[0-9\s-\(\)\+]{18}$/ig).test(val)){
                $(this).removeClass('error');
                $(this).closest('.holder-error').removeClass('active');
            }
            else{
                $(this).addClass('error');
                $(this).closest('.holder-error').addClass('active');
				        $(this).val('');
            }
        });
        form.on('keyup keydown', '.phone.error', function(){
            var val=$(this).val();
            if((/^[0-9\s-\(\)\+]{18}$/ig).test(val)){
                $(this).removeClass('error');
                $(this).closest('.holder-error').removeClass('active');
            }
            else{
                $(this).addClass('error');
                $(this).closest('.holder-error').addClass('active');
            }
        });
      form.find('.email').blur(function(){
          var val=$(this).val();
          if((/^[-\._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/ig).test(val) && val.length<=30){
              $(this).removeClass('error ');
              $(this).closest('.holder-error').removeClass('active');
          }
          else{
              $(this).addClass('error active');
              $(this).closest('.holder-error').addClass('active');
			  $(this).val('');
          }
      });
      form.on('keyup keydown', '.email.error', function(){
          var val=$(this).val();
          if((/^[-\._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/ig).test(val) && val.length<=30){
              $(this).removeClass('error');
              $(this).closest('.holder-error').removeClass('active');
          }
          else{
              $(this).addClass('error');
              $(this).closest('.holder-error').addClass('active');
          }
      });
      form.submit(function(e){
          input.trigger('blur');
          if(form.find('.error').size()){
			/*alert('error');*/
			return false;
		} else {
			// $.post("feedback.php", $(this).serialize());
			values = $(this).serialize();
			$.ajax({
				url: "feedback.php",
				type: "post",
				data: values,
				success: function(){
					// успех
					$('#popup-call .popup-info').addClass('active');
					$('#popup-ask .popup-info').addClass('active');
				},
				error:function(){
					// ошибка
				}
			});
			return false;
		}
      });
  });
};


/*! device.js 0.1.58 */
(function(){var a,b,c,d,e,f,g,h,i,j;a=window.device,window.device={},c=window.document.documentElement,j=window.navigator.userAgent.toLowerCase(),device.ios=function(){return device.iphone()||device.ipod()||device.ipad()},device.iphone=function(){return d("iphone")},device.ipod=function(){return d("ipod")},device.ipad=function(){return d("ipad")},device.android=function(){return d("android")},device.androidPhone=function(){return device.android()&&d("mobile")},device.androidTablet=function(){return device.android()&&!d("mobile")},device.blackberry=function(){return d("blackberry")||d("bb10")||d("rim")},device.blackberryPhone=function(){return device.blackberry()&&!d("tablet")},device.blackberryTablet=function(){return device.blackberry()&&d("tablet")},device.windows=function(){return d("windows")},device.windowsPhone=function(){return device.windows()&&d("phone")},device.windowsTablet=function(){return device.windows()&&d("touch")},device.fxos=function(){return d("(mobile; rv:")||d("(tablet; rv:")},device.fxosPhone=function(){return device.fxos()&&d("mobile")},device.fxosTablet=function(){return device.fxos()&&d("tablet")},device.mobile=function(){return device.androidPhone()||device.iphone()||device.ipod()||device.windowsPhone()||device.blackberryPhone()||device.fxosPhone()},device.tablet=function(){return device.ipad()||device.androidTablet()||device.blackberryTablet()||device.windowsTablet()||device.fxosTablet()},device.portrait=function(){return 90!==Math.abs(window.orientation)},device.landscape=function(){return 90===Math.abs(window.orientation)},device.noConflict=function(){return window.device=a,this},d=function(a){return-1!==j.indexOf(a)},f=function(a){var b;return b=new RegExp(a,"i"),c.className.match(b)},b=function(a){return f(a)?void 0:c.className+=" "+a},h=function(a){return f(a)?c.className=c.className.replace(a,""):void 0},device.ios()?device.ipad()?b("ios ipad tablet"):device.iphone()?b("ios iphone mobile"):device.ipod()&&b("ios ipod mobile"):device.android()?device.androidTablet()?b("android tablet"):b("android mobile"):device.blackberry()?device.blackberryTablet()?b("blackberry tablet"):b("blackberry mobile"):device.windows()?device.windowsTablet()?b("windows tablet"):device.windowsPhone()?b("windows mobile"):b("desktop"):device.fxos()?device.fxosTablet()?b("fxos tablet"):b("fxos mobile"):b("desktop"),e=function(){return device.landscape()?(h("portrait"),b("landscape")):(h("landscape"),b("portrait"))},i="onorientationchange"in window,g=i?"orientationchange":"resize",window.addEventListener?window.addEventListener(g,e,!1):window.attachEvent?window.attachEvent(g,e):window[g]=e,e()}).call(this);
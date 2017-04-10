function checkStoreProducts() {
	var cart = MyCart.Cart.getInstance();
	$('.add-to-cart').each(function() {
		var $btn = $(this);
		if($btn.hasClass('unavailable')) {
			return;
		}
		var addText = $btn.data('add');
		var addedText = $btn.data('added');
		var params = $btn.data('params');
		if(cart.hasProduct(params.id)) {
			$btn.text(addedText);
			$btn.addClass('added');

		} else {
			$btn.text(addText);
			$btn.removeClass('added');
		}
	});
}

$(function() {

	$('.sl1 , .sl2').selecter();
	$('input').iCheck({
		checkboxClass: 'check',
		radioClass: 'radio',
		increaseArea: '20%' // optional
	});

    // Application
    (function() {
        var $modal = $('#application-modal');
        $modal.myModal();

        $('.send-application').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#application-form').on('beforeSubmit', function() {
            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                success: function(responseText) {
                    $form.addClass('success');
                    setTimeout(function() {
                        $modal.close();
                    }, 4000);
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                }
            });
            return false;
        });
    })();

    // Discount
    (function() {
        var $modal = $('#discount-modal');
        $modal.myModal();

        $('.btn-disc').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#discount-form').on('beforeSubmit', function() {
            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                success: function(responseText) {
                    $form.addClass('success');
                    setTimeout(function() {
                        $modal.close();
                    }, 4000);
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                }
            });
            return false;
        });
    })();

	// Exclusive type
	(function() {
		var $modal = $('#exclusive-type-modal');
		$modal.myModal();

		var sendSuccess = false,
			lastType;
		var form = $('#exclusive-type-form');
		$('.request-exclusive-type').on('click', function() {
			if(lastType != $(this).data('type-title')) {
				form[0].reset();
				form.find('input[type="file"]').trigger('change');
			}
			form.find('input.type-title-hidden').val($(this).data('type-title'));
			lastType = $(this).data('type-title');
			$modal.open();
			sendSuccess = false;
			return false;
		});

		/**
		 * Send the form
		 */
		form.on('beforeSubmit', function() {
			var $form = $(this);
			var formObj = new FormData(this);
			var closeTimeout = null;
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method'),
				data: formObj,
				processData: false,
				contentType: false,
				success: function(responseText) {
					sendSuccess = true;
					$modal.setOnAfterClose(function(){
						if(sendSuccess) {
							$form[0].reset();
							$form.find('input[type="file"]').trigger('change');
							$form.removeClass('success');
							if(closeTimeout != null) {
								clearTimeout(closeTimeout);
							}
						}
					});
					$form.addClass('success');
					closeTimeout = setTimeout(function() {
						$modal.close();
					}, 4000);
				},
				error: function(jqXHR) {
					alert(jqXHR.responseText);
				}
			});
			return false;
		});
	})();


	// Video
	(function() {
		var $cont = $('.video');
		if(!$cont.length) {
			return;
		}
		$cont.find('.btn-play').on('click', function() {
			$(this).closest('.video').addClass('clicked');
			player.playVideo();
			return false;
		});
		var $frame = $cont.find('iframe');
		if(!$frame.length) {
			return;
		}
		var ratio = $frame.width() / $frame.height();
		var width = $cont.width();
		var height = width / ratio;
		$frame.width(width);
		$frame.height(height);
	})();

	// Map
	$('.tab-map .tabset li a').on('click', function(){
		var thisHold = $(this).closest(".gallery-tabs ,.tab-map, .info");
		var _ind = $(this).closest('li').index();
		thisHold.children('.tab-body').children(".tab").removeClass('active');
		thisHold.children('.tab-body').children("div.tab:eq("+_ind+")").addClass('active');
		$(this).closest("ul").find(".active").removeClass("active");
		$(this).parent().addClass("active");
		return false;
	});

	// Cart
	(function() {
		checkStoreProducts();
		var cart = MyCart.Cart.getInstance();
		cart.addProductsListUpdatedListener(checkStoreProducts);
		$('body').on('click', '.add-to-cart', function() {
			var $btn = $(this);
			if($btn.hasClass('unavailable')) {
				return false;
			}
			var params = $btn.data('params');
			cart.addProduct(params.id, params.name, params.price, params.quantity, params.sku, params.type, params.options, params.discount);
			return false;
		});
		function changeProductPrice(price, discount) {
		  var $btn = $('.add-to-cart');
		  if($btn.hasClass('unavailable')) {
				return false;
			}
			if(discount > 0) {
				var priceWithDiscount = price - ((price/100) * discount);
				$('.price-box .price').html(formatProductPrice(priceWithDiscount));
				$('.price-box .price-without-discount').html(formatProductPrice(price));
			} else {
				$('.price-box .price').html(formatProductPrice(price));
			}
		}

		function formatProductPrice(price) {
			var result = '';
			var myCartModel = cart.model;
			if(myCartModel.currency == MyCart.CartModel.CURRENCY_RUB) {
				result = cart.view.numberFormat(Math.round(price), 0, '.', ' ') + " <span class=\"rub\">руб.</span>";
			} else {
				result =  "<sub>&euro;</sub>" + cart.view.numberFormat(Math.round(price), 0, '.', ',');
			}
			return result;
		}

		$('body').on('click', '.options a.option', function(){
			var data_option = $(this).data('option'),
				data_product = $('.add-to-cart').data('params');
			$('.options-group[data-options-type="'+data_option.type+'"]').find('.selected').removeClass('selected');
			$(this).addClass('selected');
			if(data_option.type != 1) {
				if(data_product.options != undefined && data_product.options[data_option.id] == undefined){
					for(var optId in data_product.options) {
						if(data_product.options[optId].type == data_option.type) {
							delete data_product.options[optId];
						}
					}
				}
				if(data_product.options == undefined) data_product.options = {};
				data_product.options[data_option.id] = data_option;
			}
			var price = data_product.price;
			if(data_product.options != undefined) {
				for(var optIndex in data_product.options) {
					if(data_product.options[optIndex].main == undefined || !data_product.options[optIndex].main || data_product.options[optIndex].type == 1) {
						if(data_product.options[optIndex].value) {
							price += parseInt(data_product.options[optIndex].value);
						}
					}
				}
			}
			changeProductPrice(price, data_product.discount);
			$('.add-to-cart').data('params', data_product);
			return false;
		});

		$('body').on('ifChanged', '.options input[type="checkbox"]', function(event){
			var checkbox = $(event.target);
			var data_option = checkbox.data('option'),
				data_product = $('.add-to-cart').data('params'),
				checked = checkbox.is(':checked');
			if(checked) {
				if(data_product.options == undefined) data_product.options = {};
				if(data_product.options[data_option.id] == undefined) {
					data_product.options[data_option.id] = data_option;
				}
			} else if(data_product.options[data_option.id] != undefined) {
					delete data_product.options[data_option.id];
			}
			var price = data_product.price;
			if(data_product.options != undefined) {
				for(var optIndex in data_product.options) {
					if(data_product.options[optIndex].main == undefined || !data_product.options[optIndex].main || data_product.options[optIndex].type == 1) {
						if(data_product.options[optIndex].value) {
							price += parseInt(data_product.options[optIndex].value);
						}
					}
				}
			}
			changeProductPrice(price, data_product.discount);
			$('.add-to-cart').data('params', data_product);
			return false;
		});
	})();

	// Auth
	(function() {
		var $modal = $('#auth-modal');
		$modal.myModal();

		$('.btn-auth').on('click', function() {
			$modal.open();
			return false;
		});

		/**
		 * Send the registration form
		 */
		$('#registration-form').on('beforeSubmit', function() {
			var $form = $(this);
			var formData = new FormData($(this)[0]);
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method'),
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(responseText) {
					$form.addClass('success');
					setTimeout(function() {
						$modal.close();
					}, 4000);
				},
				error: function(jqXHR) {
					alert(jqXHR.responseText);
				}
			});
			return false;
		});

		/**
		 * Send the login form
		 */
		$('#login-form').on('beforeSubmit', function() {
			var $form = $(this);
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method'),
				data: $form.serialize(),
				success: function(responseText) {
					document.location.reload();
				},
				error: function(jqXHR) {
					alert(jqXHR.responseText);
				}
			});
			return false;
		});
	})();

	(function() {
		/**
		 * Плавный скрол пользователя к блоку
		 *
		 *
		 * @param {string} hash Строка #ID блока
		 */
		function scrollToBlock(hash) {
			var $target = $(hash);
			if($target.length > 0) {
				var scrollTop = $target.offset().top;
				$('html,body').animate({
					scrollTop: scrollTop
				}, 1000);
			}
		}

		/**
		 * Скролл при загрузке страницы
		 */
		scrollToBlock(document.location.hash);

		/**
		 * Скролл по ссылкам в меню
		 */
		$('a').click(function() {
			if(this.hash.length > 0) {
				if(
					location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
					&& location.hostname == this.hostname
					&& $(this.hash).length > 0
				) {
					scrollToBlock(this.hash);
					return false;
				}
			}
		});
	})();

	/**
	 * Ajax-пагинация
	 */
	(function() {
		var $spinners = $('.spinner');
		if($spinners.length > 0) {
			$spinners.ajaxPagination();
		}
	})();
});

$(document).ready(function(){
	initParalax();
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

    mobmenu();

    $('#wrapper').addClass('slider-load');

	$(window).load(function(){
		initSly();
	});
	$(window).resize(function(){
		initSly();
		$('.menu-cover').sly('reload');
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

function initParalax(){
	$(window).scroll(function(){
		if ($('.solutions .visual').size()) {
            var _num3 = -($(window).scrollTop())
				$('.solutions .visual').css({
					'background-position': '100% '+_num3/1.6 +'px'
				})
		}
		if ($('.knowledge-base-gallery li').size()) {
		    var imheight = $(".knowledge-base-gallery li").height();
			var _num4 = -($(window).scrollTop()+$(window).height()/2- $('.knowledge-base-gallery li').offset().top);
            var mycount = imheight+$('.knowledge-base-gallery li').offset().top;
            if (mycount >= $(window).scrollTop()){
				$('.knowledge-base-gallery li').css({
					'background-position': '50% '+_num4/2 +'px'
				})
            }
		}
		if ($('.catalog-group .title').size()) {
            var _num5 = -($(window).scrollTop())
				$('.catalog-group .title').css({
					'background-position': '50% '+_num5/2 +'px'
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
			var _num8 = -($(window).scrollTop()+$(window).height()/2- $('.knowledge-base-title').offset().top);
				$('.knowledge-base-title').css({
					'background-position': '50% '+_num8/2 +'px'
				})
		}
		if ($('.rebuilding-page .head').size()) {
			var _num8 = -($(window).scrollTop())
			$('.rebuilding-page .head').css({
				'background-position': '100% '+_num8/1.6 +'px'
			})
		}
	});
}


function initFlexImage(){
 $('.flex-image').each(function(){
  var _tnum = -($(window).scrollTop()+$(window).height()/2- $(this).closest('.flex-image-holder').offset().top);
  if ($(this).closest('ul').attr('class') == 'gallery-main') {
    var _num7 = -($(window).scrollTop()+$(window).height()/2- $('.gallery-main li ').offset().top)
  $(this).closest('.flex-image-holder').css({
   'background':'url('+$(this).attr('src')+') no-repeat 50%'+_num7/2.1 +'px',
   'background-size':'cover'
  })
  }
  else {
    $(this).closest('.flex-image-holder').css({
      'background':'url('+$(this).attr('src')+') no-repeat 50% '+_tnum/2+'px',
      'background-size':'cover'
   })
  }
 });
}


function quantitySwitch(){
  $(document).on('click','.amount .minus,.amount .plus',function(e){
    var input=$(this).parent().find('input'),
      val=parseInt(input.val());
    if($(this).is('.plus')){
      input.val((++val));
    }else{
      if(val-1<=1)
        input.val("1")
      else
        input.val((--val)+"")
    }
	  input.change();
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
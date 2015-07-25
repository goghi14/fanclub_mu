
(function( $ ) {
	"use strict";
	
	jQuery(window).resize(function() {
		refreshSidebar();
	});

	jQuery(window).ready(function() {

		jQuery('img').each( function(i){
			var bottom_of_object = jQuery(this).offset().top + jQuery(this).outerHeight();
			var bottom_of_window = jQuery(window).scrollTop() + jQuery(window).height() + 200;

			if( bottom_of_window <= bottom_of_object ){
				jQuery(this).css("opacity", "0");
			}
		});

		jQuery(window).scroll( function(){
			jQuery('img').each( function(i){
				var bottom_of_object = jQuery(this).offset().top + jQuery(this).outerHeight();
				var bottom_of_window = jQuery(window).scrollTop() + jQuery(window).height() + 200;

				if( bottom_of_window > bottom_of_object ){
					jQuery(this).animate( {'opacity':'1'}, 500 );
				}
			});
		});

		jQuery(".tab-a").each(function(){
			jQuery(this).find("h3").eq(0).addClass("active");
		});

		jQuery(".tab-d").each(function(){
			jQuery(this).children("div").eq(0).addClass("active");
		});

		jQuery(".tab-a h3").click(function(){
			var thisel = jQuery(this);
			var thisindex = thisel.index();
			thisel.addClass("active").siblings("h3.active").removeClass("active");
			thisel.parent().siblings(".tab-d").children("div").eq(thisindex).addClass("active").siblings("div.active").removeClass("active");
			refreshSidebar();
		});

		jQuery(".w-photos .photo-images").each(function(){
			jQuery(this).children("a").eq(0).addClass("active");
		});

		jQuery(".gallery-link-left").click(function(){
			slideGalleryWidget(jQuery(this).siblings(".photo-images").children("a.active").prev());
			return false;
		});

		jQuery(".gallery-link-right").click(function(){
			slideGalleryWidget(jQuery(this).siblings(".photo-images").children("a.active").next());
			return false;
		});

		jQuery(".carousel-right").click(function(){
			var thisel = jQuery(this);
			var maxcount = Math.ceil((thisel.siblings(".inner-carousel").children(".item").size())/3);
			if(thisel.parent().attr("rel")){
				if(thisel.parent().attr("rel") < maxcount-1){
					var nuum = parseInt(thisel.parent().attr("rel"))+1;
				}else{
					var nuum = parseInt(thisel.parent().attr("rel"));
				}
			}else{
				if(maxcount-1 >= 1){
					var nuum = 1;
				}else{
					var nuum = 0;
				}
			}
			thisel.parent().attr("rel", nuum);
			thisel.siblings(".inner-carousel").animate({
				"left" : "-"+(nuum*103.5)+"%"
			}, 200);
			return false;
		});

		jQuery(".carousel-left").click(function(){
			var thisel = jQuery(this);
			if(thisel.parent().attr("rel")){
				if(thisel.parent().attr("rel") > 0){
					var nuum = parseInt(thisel.parent().attr("rel"))-1;
				}else{
					var nuum = parseInt(thisel.parent().attr("rel"));
				}
			}else{
				var nuum = 0;
			}
			thisel.parent().attr("rel", nuum);
			thisel.siblings(".inner-carousel").animate({
				"left" : "-"+(nuum*103.5)+"%"
			}, 200);
			return false;
		});

		jQuery(".slider .slider-navigation li > a").click(function() {
			var thisel = jQuery(this);
			var thisindex = thisel.parent().index();
			thisel.parent().addClass("active").siblings("li.active").removeClass("active");
			thisel.parent().parent().siblings(".slider-image").children("a").eq(thisindex).addClass("active").siblings("a.active").each(function() {
				var curel = jQuery(this);
				setTimeout(function () {
					curel.removeClass("active");
				}, 100);
			});
			return false;
		});


		// Alert box close
		jQuery('a[href="#close-alert"]').click(function() {
			jQuery(this).parent().animate({
				opacity: 0,
				padding: "0px 13px",
				margin: "0px",
				height: "0px"
			}, 300, function() {
				refreshSidebar();
			});
			return false;
		});

		// Accordion blocks
		jQuery(".accordion > div > a").click(function() {
			var thisel = jQuery(this).parent();
			if(thisel.hasClass("active")){
				thisel.removeClass("active").children("div").animate({
					"height": "toggle",
					"opacity": "toggle",
					"padding-top": "toggle"
				}, 300);
				return false;
			}
			// thisel.siblings("div").removeClass("active");
			thisel.siblings("div").each(function() {
				var tz = jQuery(this);
				if(tz.hasClass("active")){
					tz.removeClass("active").children("div").animate({
						"height": "toggle",
						"opacity": "toggle",
						"padding-top": "toggle"
					}, 300, function() {
						refreshSidebar();
					});
				}
			});
			// thisel.addClass("active");
			thisel.addClass("active").children("div").animate({
				"height": "toggle",
				"opacity": "toggle",
				"padding-top": "toggle"
			}, 300, function() {
				refreshSidebar();
			});
			return false;
		});
	  
	  	$(document).ready(function(){
		  	$('.chat-form').submit(function (e) {
		        e.preventDefault();
		        $.ajax({
		            type: 'post',
		            url: '/fanpage/writeMsg',
		            data: $(this).serialize(),
		            success: function (data) {
		                // $('.feedback').html(data);
		                // $('.feedback').fadeIn(1000, function() {
		                // 	$('.feedback').delay(2000).fadeOut(2000);
		                //});
		                $('.chat-area').val('');
		            }
		        });
		        e.preventDefault();
	    	});
	  	});

	  		jQuery(".chat-area").keypress(function (e) {
	  			if(e.which == 13) {
		        	$.ajax({
			            type: 'post',
			            url: '/fanpage/writeMsg',
			            data: $(this).serialize(),
			            success: function (data) {
			                $('.chat-area').val('');
			            }
		        	});
		        	e.preventDefault();
	    		}
	  			});

		jQuery(document).ready(function() {
			var interval = setInterval(function() {
				$.ajax({
					url: '/fanpage/showMsg',
					success: function(data) {
						$('.chat-box').html(data);
					}
				})
			}, 1000);
		});

		$(document).ready(function(){
		    $('.fp-activ-user').click(function() {
		    	$('.fp-activ-user').removeClass("active");
		    	$(this).addClass("active");
		    	$('.fp-option').removeClass("active");
		    	$('.imagini').addClass("active");
			    var userID = $(this).data("id");
			    $.ajax(
			    {
				    url: "/fanpage/getImagini",
				    type: "POST",
				    data: { id_user: userID},
				    success: function (data) {
			            $(".fp-result").html(data);
			    }
			    });
			});
		});

		$(document).ready(function() {
			$(document).on("mouseover", ".fp-imagini-style", function() {
				$(this).find(".fp-imagini-descr").slideDown(400);
				$(this).find(".fp-imagini-zoom").fadeIn(400);
			});
		});
		$(document).ready(function() {
			$(document).on("mouseleave", ".fp-imagini-style", function() {
				$(this).find(".fp-imagini-descr").slideUp(300);
				$(this).find(".fp-imagini-zoom").fadeOut(300);
			});
		});

		$(document).ready(function(){
		    $('.imagini').click(function() {
		    	$('.fp-option').removeClass("active");
		    	$(this).addClass("active");
			    var userID = $(".fp-activ-user.active").data("id");
			    $.ajax(
			    {
				    url: "/fanpage/getImagini",
				    type: "POST",
				    data: { id_user: userID},
				    success: function (data) {
			            $(".fp-result").html(data);
			    }
			    });
			});
		});

		$(document).ready(function(){
		    $('.video').click(function() {
		    	$('.fp-option').removeClass("active");
		    	$(this).addClass("active");
			    var userID = $(".fp-activ-user.active").data("id");
			    $.ajax(
			    {
				    url: "/fanpage/getVideo",
				    type: "POST",
				    data: { id_user: userID},
				    success: function (data) {
			            $(".fp-result").html(data);
			    }
			    });
			});
		});

		$(document).ready(function(){
		    $('.citate').click(function() {
		    	$('.fp-option').removeClass("active");
		    	$(this).addClass("active");
			    var userID = $(".fp-activ-user.active").data("id");
			    $.ajax(
			    {
				    url: "/fanpage/getCitate",
				    type: "POST",
				    data: { id_user: userID},
				    success: function (data) {
			            $(".fp-result").html(data);
			            // jQuery
						var $container = jQuery('#masonry-grid');
						// initialize
						$container.masonry({
						  columnWidth: 300,
						  percentPosition: true,
						  itemSelector: '.grid-item'
						});
			    }
			    });
			});
		});

		// Tabbed blocks
		
		jQuery(".comment-show-replies").click(function() {
			var id = $(this).data("id");
			$('.reply-for-comm' + id).show(500);
			$('.show-text-pos' + id).hide(300);
		});

		jQuery(".reply-button").click(function() {
			var id = $(this).data("id");
			if($('.reply-msg-' + id).is(":visible")) {
				$('.reply-msg-' + id).hide(200);
				$('.reply-btn-txt' + id).text('Raspunde');
			} else {
				$('.reply-msg-' + id).show(200);
				$('.reply-btn-txt' + id).text('Ascunde');
			}
		});

		jQuery(".comment-show-replies2").click(function() {
			var id = $(this).data("id");
			if($('.reply-for-reply' + id).is(":visible")) {
				$('.reply-for-reply' + id).hide(300);
				$(this).text('Afiseaza raspunsurile la comentariu');
			} else {
				$('.reply-for-reply' + id).show(300);
				$(this).text('Ascunde raspunsurile la comentariu');
			}
		});

		$('.add-pl-news').click(function() {
			if($('.pl-news').is(":visible")) {
				$('.pl-news').slideUp(250);
				$('.pl-text').text('Adauga Noutate');
			} else {
				$('.pl-news').slideDown(250);
				$('.pl-text').text('Ascunde');
			}
		});

		$('.add-football-news').click(function() {
			if($('.football-news').is(":visible")) {
				$('.football-news').slideUp(250);
				$('.football-text').text('Adauga Noutate');
			} else {
				$('.football-news').slideDown(250);
				$('.football-text').text('Ascunde');
			}
		});

		$(document).ready(function(){
		  	$('.set_like_up').submit(function (e) {
		        var id = $(this).data("id");
		        e.preventDefault();
		        $.ajax({
		            type: 'post',
		            url: '/noutati/likeUp',
		            data: $(this).serialize(),
		            success: function () {
		                var numberUp = parseInt($('.counter-like-up' + id).text());
						numberUp = numberUp + 1;
						var numberDown = parseInt($('.counter-like-down' + id).text());
						if(numberDown != 0) {
							numberDown = numberDown - 1;
						}
						$('.counter-like-up' + id).text(numberUp);
						$('.counter-like-down' + id).text(numberDown);
						$('.current-like-up-' + id).val(numberUp);
						$('.current-like-down-' + id).val(numberDown);
						$("#like-up-like" + id).attr('class', 'like_no_action_up');
						$("#like-down-like" + id).attr('class', 'like-down');
		            }
		        });
		        e.preventDefault();
	    	});
	  	});

	  	$(document).ready(function(){
		  	$('.set_like_down').submit(function (e) {
		        var id = $(this).data("id");
		        e.preventDefault();
		        $.ajax({
		            type: 'post',
		            url: '/noutati/likeDown',
		            data: $(this).serialize(),
		            success: function () {
		                var numberDown = parseInt($('.counter-like-down' + id).text());
						numberDown = numberDown + 1;
						var numberUp = parseInt($('.counter-like-up' + id).text());
						if(numberUp != 0) {
							numberUp = numberUp - 1;
						}
						$('.counter-like-up' + id).text(numberUp);
						$('.counter-like-down' + id).text(numberDown);
						$('.current-like-up-' + id).val(numberUp);
						$('.current-like-down-' + id).val(numberDown);
						$("#like-down-like" + id).attr('class', 'like_no_action_down');
						$("#like-up-like" + id).attr('class', 'like-up');
		            }
		        });
		        e.preventDefault();
	    	});
	  	});

	  	$('#login-box').on("click", ":submit", function(e){
			var submitBtn = $(this).val();
			$('.next_submit').val(submitBtn);
		});

		$("#email").on("click", function() {
	        if ($(this).is(':focus')) {
	            $('.wrong-psw').delay(1500).slideUp(200);
	        }
	    });
	    $("#password").on("click", function() {
	        if ($(this).is(':focus')) {
	            $('.wrong-psw').delay(1500).slideUp(200);
	        }
	    });


	  	$(document).ready(function(){
		  	$('#login-box').submit(function (e) {
		        var submitBtn = $('.next_submit').val();
		        if(submitBtn == 'Cancel') {
		        	$('#logindiv').hide(100);
		        	return false;
		        } else if(submitBtn == 'Login') {
		        	$.ajax({
		            type: 'post',
		            url: '/verifylogin',
		            data: $(this).serialize(),
		            success: function (check) {         	
		                if(check == 0) { //if wrong password
		                	$('.wrong-psw').slideDown(200);
		                }
		                else if(check == 1) {
		                	var redirectUrl = $('.current_url').val();
		                	window.location.replace(redirectUrl);
		                }
		            }
		        });
		        e.preventDefault();
		        }
	    	});
	  	});

	  	$(document).ready(function(){
		    $('.user-id').click(function() { 
			    var userID = $(this).data("id");
			    $.ajax(
			    {
				    url: "/users",
				    type: "POST",
				    data: { id_user: userID},
				    success: function (data) {
			            var array = data.split('#');
			            $('.my-profile-block').fadeIn(600);
			            $(".avatar").attr("src", "http://localhost/resources/images/avatars/" + array[2]);
			            if(array[0] === array[1]) {
			            	$(".edit-profile").attr("src", "http://localhost/resources/images/edit_button.png");
			            	$(".a-edit-profile").show();
			            } else {
			            	$(".a-edit-profile").hide();
			            }
			            $(".avatar").attr("title", array[3]);
				    	$('.username').text(array[3]);
				    	$('.dob').text(array[4]);
				    	$('.email').text(array[5]);
				    	$('.living').text(array[6]);
				    	$('.userClass').text(array[7]);
			    }
			    });
			});
		});

	  	$('.close-my-profile').click(function() {
	  		$('.my-profile-block').fadeOut(500);
	  	});

		// // this is the id of the form
		// $(".like-up").submit(function() {
		// 	var url = "noutati/articol"; // the script where you handle the form input.
		// 	$.ajax({
	 //           type: "POST",
	 //           url: url,
	 //           data: $(".like-up").serialize(), // serializes the form's elements.
	 //           success: function(data)
	 //           {
	 //               var id = $(this).data("id");
		// 	var number = +($('.counter-like-up' + id).find('.counter-like-up' + id).text());
		// 	number = number + 1;
		// 	$('.counter-like-up' + id).text(number);
	 //           }
  //        	});
		// return false; // avoid to execute the actual submit of the form.
		// });

		// $(".like-up").click(function() {
		// 	var id = $(this).data("id");
		// 	var number = +($('.counter-like-up' + id).find('.counter-like-up' + id).text());
		// 	number = number + 1;
		// 	$('.counter-like-up' + id).text(number);
		// });

		$(".like-down").click(function() {
			var id = $(this).data("id");
			var number = +($('.counter-like-down' + id).find('.counter-like-down' + id).text());
			number = number + 1;
			$('.counter-like-down' + id).text(number);
		});

		jQuery(".short-tabs").each(function() {
			var thisel = jQuery(this);
			thisel.children("div").eq(0).addClass("active");
			thisel.children("ul").children("li").eq(0).addClass("active");
		});

		jQuery(window).ready(function() {
			jQuery(document).on("click", ".add-img", function() {
				$(".img-box").fadeIn(300);
			});
			jQuery(".add-fp-box-close").click(function() {
				$(".add-fp-box").fadeOut(200);
				$(".video-box").fadeOut(200);
			});
		});

		jQuery(window).ready(function() {
			jQuery(document).on("click", ".add-video", function() {
				$(".video-box").fadeIn(300);
			});
		});
		jQuery(window).ready(function() {
			jQuery(document).on("click", ".add-citat", function() {
				$(".citat-box").fadeIn(300);
			});
		});



		jQuery(".fp-chk-local").click(function() {
			if($(this).is(':checked')) {
				$(".fp-img-url").fadeOut(50, function() {
					$(".fp-img-browse").fadeIn(200);
				});
				$(".chck-lbl").fadeIn(100);
			}
		});

		jQuery(".fp-chk-url").click(function() {
			if($(this).is(':checked')) {
				$(".fp-img-browse").fadeOut(50, function(){
					$(".fp-img-url").fadeIn(200);
				});
				$(".chck-lbl").fadeIn(100);
			}
		});

		jQuery(".short-tabs > ul > li a").click(function() {
			var thisel = jQuery(this).parent();
			thisel.siblings(".active").removeClass("active");
			thisel.addClass("active");
			thisel.parent().siblings("div.active").removeClass("active");
			thisel.parent().siblings("div").eq(thisel.index()).addClass("active");
			refreshSidebar();
			return false;
		});

		jQuery(".lightbox").click(function () {
			jQuery(".lightbox").css('overflow', 'hidden');
			jQuery("body").css('overflow', 'auto');
			jQuery(".lightbox .lightcontent").fadeOut('fast');
			jQuery(".lightbox").fadeOut('slow');
		}).children().click(function(e) {
			return false;
		});


		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=1376493815923097";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		// Responsive menu
		jQuery(".main-menu > div").append('<a href="#" class="toggle-menu"><i class="fa fa-ban"></i> Toggle Menu</a>');
		jQuery(".header-topmenu > div").append('<a href="#" class="toggle-menu"><i class="fa fa-ban"></i> Toggle Menu</a>');
		
		jQuery(".toggle-menu").click(function() {
			var thisel = jQuery(this).siblings("ul");
			thisel.fadeToggle();
			return false;
		});


		// Refresh sidebars look
		refreshSidebar();

	});

})(jQuery);


function lightboxclose(){
	jQuery(".lightbox").css('overflow', 'hidden');
	jQuery(".lightbox .lightcontent").fadeOut('fast');
	jQuery(".lightbox").fadeOut('slow');
	jQuery("body").css('overflow', 'auto');
}

function refreshSidebar() {
	jQuery("#sidebar").each(function() {
		jQuery(this).css("height", "auto");
		var maxheight = jQuery(this).height();
		var secondheight = jQuery(".main-content").height();
		maxheight = (parseInt(secondheight) > parseInt(maxheight))?secondheight:maxheight;
		jQuery("#sidebar").css("height", maxheight);
	});
}

function slideGalleryWidget(theitem) {
	theitem.css("opacity", "0").css("display", "block").animate({
		"opacity" : "1"
	}, 200, function(){
		jQuery(this).addClass("active").siblings("a.active").removeClass("active").css("display", "none");
		refreshSidebar();
	});
}




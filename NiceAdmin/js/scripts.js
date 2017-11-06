var sidew = $("#sidebar").width();

function initializeJS() {

    //tool tips
    jQuery('.tooltips').tooltip();

    //popovers
    jQuery('.popovers').popover();

    //custom scrollbar
        //for html
    jQuery("html").niceScroll({styler:"fb",cursorcolor:"#007AFF", cursorwidth: '6', cursorborderradius: '10px', background: '#F7F7F7', cursorborder: '', zindex: '1000'});
        //for sidebar
    //jQuery("#sidebar").niceScroll({styler:"fb",cursorcolor:"#007AFF", cursorwidth: '3', cursorborderradius: '10px', background: '#F7F7F7', cursorborder: ''});
        // for scroll panel
    jQuery(".scroll-panel").niceScroll({styler:"fb",cursorcolor:"#007AFF", cursorwidth: '3', cursorborderradius: '10px', background: '#F7F7F7', cursorborder: ''});
		//for table

    
    //sidebar dropdown menu
    jQuery('#sidebar .sub-menu > a').click(function () {
        var last = jQuery('.sub-menu.open', jQuery('#sidebar'));        
        jQuery('.menu-arrow').removeClass('arrow_carrot-right');
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.menu-arrow').addClass('arrow_carrot-right');            
            sub.slideUp(200);
        } else {
            jQuery('.menu-arrow').addClass('arrow_carrot-down');            
            sub.slideDown(200);
        }
        var o = (jQuery(this).offset());
        diff = 200 - o.top;
        if(diff>0)
            jQuery("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            jQuery("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });

    // sidebar menu toggle
    jQuery(function() {
        function responsiveView() {
            var wSize = jQuery(window).width();
            if (wSize <= 768) {
                jQuery('#container').addClass('sidebar-close');
                jQuery('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                jQuery('#container').removeClass('sidebar-close');
                jQuery('#sidebar > ul').show();
            }
        }
        jQuery(window).on('load', responsiveView);
        jQuery(window).on('resize', responsiveView);
    });

    jQuery('.toggle-nav').click(function () {
        if (jQuery('#sidebar > ul').is(":visible") === true) {
            jQuery('#main-content').css({
                'margin-left': '0px'
            });
            jQuery('#sidebar').css({
                'margin-left': sidew+10
            });
            jQuery('#sidebar > ul').hide();
            jQuery("#container").addClass("sidebar-closed");
        } else {
            jQuery('#main-content').css({
                'margin-left': sidew+10
            });
            jQuery('#sidebar > ul').show();
            jQuery('#sidebar').css({
                'margin-left': '0'
            });
            jQuery("#container").removeClass("sidebar-closed");
        }
    });
	
	$('#main-content').css('margin-left',sidew);

    //bar chart
    if (jQuery(".custom-custom-bar-chart")) {
        jQuery(".bar").each(function () {
            var i = jQuery(this).find(".value").html();
            jQuery(this).find(".value").html("");
            jQuery(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }

}

jQuery(document).ready(function(){
    initializeJS();
});

//popcard

$(document).ready(function(){
	// Basic hovercard
	$('.basic-hovercard').popover({ 
		html : true,
		trigger: 'manual',
		placement: function (context, source) {
			var get_position = $(source).position();
			if (get_position.left > 515) {
				return "left";
			}
			if (get_position.left < 515) {
				return "right";
			}
			if (get_position.top < 110){
				return "bottom";
			}
			return "top";
		},
		content: function() {
			return $('.basic-content').html();   
		}
	}).on("click", function(e) {
		e.preventDefault();
	}).on("mouseenter", function() {
		var _this = this;
		$(this).popover("show");
		$(this).siblings(".popover").on("mouseleave", function() {
			$(_this).popover('hide');
		});
	}).on("mouseleave", function() {
		var _this = this;
		setTimeout(function() {
			if (!$(".popover:hover").length) {
				$(_this).popover("hide")
			}
		}, 100);
	});

//sidebar toggle
	//$("#sidebar").hover(function(){
	//	$("#sidebar ul li a span").css({display:block});
	//}
});

//sidebar auto collapse
/*
$(".sidebar-menu li a span").hide();

$("#main-content").css("margin-left","40px");
$("#sidebar").hover(function(){
	$(".sidebar-menu li a span").show();
	var sidemargin = $("#sidebar").width();
	$("#main-content").css("margin-left",sidemargin);
},function(){
	$(".sidebar-menu li a span").hide();
	$("#main-content").css("margin-left","40px");
	$(".sidebar-menu li ul").hide();
});
*/

//table fixed columns
var max = 0;    
    $('table td:first-child').each(function() {
        max = Math.max($(this).width(), max);
    }).width(max);
	
$(".dropdown-menu li a").click(function(){
  $(this).parents(".dropdown").find('.fltbox').html($(this).text());
  $(this).parents(".dropdown").find('.fltbox').val($(this).data('value'));
});

$(".flt-btn").click(function(){
	$.get("filtersection.html", function (data) {
		console.log(data);
    $(".filterrow").append(data);
});
});

$(".deletebtn").click(function(){
	$(this).parent().closest("div#filters").remove();
});

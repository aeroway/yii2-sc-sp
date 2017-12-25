/*price range*/

 $('#sl2').slider();

var RGBChange = function()
                {
                    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
                };

/*scroll to top*/

$(document).ready(function() {
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
			scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});

    zoomImg();

});

function lists(id)
{
    return $.post
            (
                base_url() + "site/lists/" + id,

                function(data)
                {
                    $("#lists" + id).html(data);
                }
            );
}

function detailimg(id, num)
{
    return $.post
            (
                base_url() + "product/detailimg/" + id + "/" + num,

                function(data)
                {
                    $("#img_" + id).html(data);
                }
            );
}

function base_url()
{
    var pathparts = location.pathname.split('/');

    if (location.host == 'localhost')
    {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/';
    }
    else
    {
        var url = location.origin;
    }

    return url;
}

function zoomImg()
{
    $('#zoom').hover
    (
        function()
        {
            $("#zoom").addClass('transition');
        },

        function()
        {
            $("#zoom").removeClass('transition');
        }
    );
}

$(document).on
(
    'pjax:send',

    function()
    {
        $('#p0').showLoading();
    }
);

$(document).on
(
    'pjax:success',

    function()
    {
        $('#p0').hideLoading();
        zoomImg();
    }
);

$(document).on
(
    'pjax:timeout',
    $('#p0').hideLoading()
);

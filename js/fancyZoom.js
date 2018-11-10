var
	shown = null;
(function($){
$.fn.fancyZoom = function(options)
{
	var
		options = options || {};
	var
		zoom = $('#zoom'),
  		zoomContent = $('#zoomContent');
	
	$('#zoomClose').click(function()
	{
		hide(shown);
	});
		
	this.each(function(i)
	{
    	$(this).click(show);
  	});
	return this;
	function show(e)
	{
		var
			contentDiv = $($(this).attr('href')),
			width = window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
  			height = window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight),
  			x = window.pageXOffset || (window.document.documentElement.scrollLeft || window.document.body.scrollLeft),
  			y = window.pageYOffset || (window.document.documentElement.scrollTop || window.document.body.scrollTop),
  			windowSize = {'width':width, 'height':height, 'x':x, 'y':y},
			width = (options.width || contentDiv.width()),
			height = (options.height || contentDiv.height());
			newTop = Math.max((windowSize.height/2) - (height/2) + y, 0),
			newLeft = (windowSize.width/2) - (width/2);

    	zoom.hide().css(
		{
			position: 'absolute',
			top: e.pageY + 'px',
			left: e.pageX + 'px',
			width: '1px',
			height: '1px'
		});
		zoomContent.html('');
		shown = $(this);
		$('#zoomOverlay').css(
		{
			top: $(this).offset().top + 'px',
			left: $(this).offset().left + 'px',
			width: '5px',
			height: '5px',
			opacity: '0'
		}).stop().animate(
		{
			top: '0px',
			left: '0px',
			opacity: "0.8",
			width: '100%',
			height: '100%'
		});
		zoom.stop().animate(
		{
			top: newTop + 'px',
      		left: newLeft + 'px',
      		opacity: "show",
      		width: width,
      		height: height
		}, 300, null, function()
		{
      		if (options.scaleImg != true)
			{
		  		zoomContent.css({display: 'none'});
    			zoomContent.html(contentDiv.html());
				zoomContent.stop().fadeIn(500);
				
				$('.li').each(function()
				{
					switch($(this).parent().attr('id'))
					{
						case '_input_':
							if($('#inputObjectFormatText').html() == $(this).html())
								$(this).removeClass('li').addClass('liSelected');
							break;
						case '_inputv_':
							if($('#inputVehicleFormatText').html() == $(this).html())
								$(this).removeClass('li').addClass('liSelected');
							break;
						case '_output_':
							if($('#outputObjectFormatText').html() == $(this).html())
								$(this).removeClass('li').addClass('liSelected');
							break;
						case '_outputv_':
							if($('#outputVehicleFormatText').html() == $(this).html())
								$(this).removeClass('li').addClass('liSelected');
							break;
					}
				});
  			}
    	})
    	return false;
	}
	function hide(shown)
  	{
		zoom.unbind('click');
		$('#zoomOverlay').stop().fadeOut(300);
		if(shown != 'MESSAGE')
		{
			zoom.stop().animate(
			{
				top: shown.offset().top + 'px',
				left: shown.offset().left + 'px',
				opacity: "hide",
				width: '1px',
				height: '1px'
			}, 300, null);
		}
		else
		{
			var
				width = window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth);
			zoom.stop().animate(
			{
				top: '5px',
				left: (width / 2) + 'px',
				opacity: "hide",
				width: '1px',
				height: '1px'
			}, 300, null);			
		}
		return false;
  	}  
}
})(jQuery);
function showMessage(title, message, wHeight)
{
	var
		zoom = $('#zoom'),
		zoomContent = $('#zoomContent');
	var
		width = window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
  		height = window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight),
  		x = window.pageXOffset || (window.document.documentElement.scrollLeft || window.document.body.scrollLeft),
  		y = window.pageYOffset || (window.document.documentElement.scrollTop || window.document.body.scrollTop),
  		windowSize = {'width':width, 'height':height, 'x':x, 'y':y},
		width = 350,
		height = wHeight,
		newTop = Math.max((windowSize.height/2) - (height/2) + y, 0),
		newLeft = (windowSize.width/2) - (width/2);

    	zoom.hide().css(
		{
			position: 'absolute',
			top: '5px',
			left: (windowSize.width / 2) + 'px',
			width: '1px',
			height: '1px'
		});
		zoomContent.html('');
		shown = 'MESSAGE';
		$('#zoomOverlay').css(
		{
			top: '5px',
			left: (windowSize.width / 2) + 'px',
			width: '5px',
			height: '5px',
			opacity: '0'
		}).stop().animate(
		{
			top: '0px',
			left: '0px',
			opacity: "0.8",
			width: '100%',
			height: '100%'
		});
		zoom.stop().animate(
		{
			top: newTop + 'px',
      		left: newLeft + 'px',
      		opacity: "show",
      		width: width,
      		height: height
		}, 300, null, function()
		{
		  	zoomContent.css({display: 'none'});
    		zoomContent.html('<strong style="font-size:large">'+title+'</strong><br /><br />'+message);
			zoomContent.stop().fadeIn(500);
    	})
    	return false;
}
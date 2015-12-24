/**************** MP3 Player ***********/
// threeSixtyPlayer.config = {
//   playNext: false, // stop after one sound, or play through list until end
//   autoPlay: false, // start playing the first sound right away
//   allowMultiple: false, // let many sounds play at once (false = one at a time)
//   loadRingColor: '#d9edf7',// amount of sound which has loaded
//   playRingColor: '#337ab7', // amount of sound which has played
//   backgroundRingColor: '#f00', // "default" color shown underneath everything else
//   animDuration: 500,
//   animTransition: Animator.tx.bouncy// http://www.berniecode.com/writing/animator.html
// }


function form_category_check()
{
	/*********** Form to create a new category **********/
	$form = $('#form-category-create');
	$name = $form.find('input[name=name]');
	$slug = $form.find('input[name=slug]');

	$name.on('blur', function()
	{
		$this = $(this);

		$arr = ['\',-', 'à,a', 'á,a', 'â,a', 'è,e', 'ê,e', 'é,e', 'ì,i', 'í,i', 'î,i', 'ò,o', 'ó,o', 'ô,o', 'ù,u', 'û,u', 'ú,u'];
		$newSlug = $.trim( $this.val() ).toLowerCase().replace(/ /g, '-');

		$( $arr ).each(function(index, el) {
			$odd = el.split(',');
			$reg = $odd[0];
			$newSlug = $newSlug.replace( $reg, $odd[1] );
		});

		$slug.val(  $newSlug );

	});
}

function views_count()
{
	$spanView = $('span.views_count');

	param = {
		id: $spanView.data('id'),
		obj: $spanView.data('obj'),
		fn: 'views_count'
	};

	$.post('/ajax', param, function( data )
	{
		$spanView.text( data );
	});
}

function play_count()
{
	$spanPlay = $('span.play_count');

	param = {
		id: $spanPlay.data('id'),
		obj: $spanPlay.data('obj'),
		fn: 'play_count'
	};

	$.post('/ajax', param, function( data )
	{
		$spanPlay.text( data );
	});
}

function download_count()
{
	$spanDownload = $('span.download_count');

	param = {
		id: $spanDownload.data('id'),
		obj: $spanDownload.data('obj'),
		fn: 'download_count'
	};

	$.post('/ajax', param, function( data )
	{
		$spanDownload.text( data );
	});
}

function vote()
{
	$voteBtn = $('#vote-btn');

	$voteBtn.find('button').on('click', function()
	{
		$this = $(this);

		// $this.toggleClass('btn-default btn-primary');

		$siblings = $this.siblings('button');

	    if ( $siblings.attr('disabled') )
	    {
	        $siblings.removeAttr('disabled');
	    } else
	    {
	        $siblings.attr('disabled', 'disabled');
	    }
	});

	$voteBtn.find('#voteUp').on('click', function()
	{
		$this = $(this);

		if ( $this.hasClass('btn-default') )
		{
			voteUp();
		} else
		{
			voteNull('up');
		}

		$this.toggleClass('btn-default btn-success');
	});

	$voteBtn.find('#voteDown').on('click', function()
	{
		$this = $(this);

		if ( $this.hasClass('btn-default') )
		{
			voteDown();
		} else
		{
			voteNull('down');
		}

		$this.toggleClass('btn-default btn-danger');

	});
}

function voteUp()
{
	// console.log('Vote up dude');

	$spanView = $('span.views_count');

	param = {
		id: $spanView.data('id'),
		fn: 'vote',
		ud: 'up',
		obj: $spanView.data('obj')
	};

	$.post('/ajax', param, function( data )
	{
		console.log( data );

		if ( data.vote_down != 0 )
		{
			$('#vote-down-num').empty().html( data.vote_down );
		}

		$('#vote-up-num').empty().html( data.vote_up );
	});
}

function voteDown()
{
	// console.log('Vote Down dude');

	$spanView = $('span.views_count');

	param = {
		id: $spanView.data('id'),
		fn: 'vote',
		ud: 'down',
		obj: $spanView.data('obj')
	};

	$.post('/ajax', param, function( data )
	{
		console.log( data );

		if ( data.vote_up != 0 )
		{
			$('#vote-up-num').empty().html( data.vote_up );
		}

		$('#vote-down-num').empty().html( data.vote_down );
	});
}

function voteNull( ud )
{
	// console.log('voting null');

	$spanView = $('span.views_count');

	param = {
		id: $spanView.data('id'),
		fn: 'vote',
		ud: 'null',
		obj: $spanView.data('obj'),
		action: ud
	};

	$.post('/ajax', param, function( data )
	{
		$voteUpNum = $('#vote-up-num');
		$voteDownNum = $('#vote-down-num');

		console.log( data );

		$voteUpNum.empty();

		if ( data.vote_up != 0 )
		{
			$voteUpNum.html( data.vote_up );
		}

		$voteDownNum.empty();

		if ( data.vote_down != 0 )
		{
			$voteDownNum.html( data.vote_down );
		}
	});
}

$(function()
{
	form_category_check();
	new app.views.SearchViews();

	/********** Views Count, Play Count & Download Count ********/
	// views_count();
	// play_count();
	// download_count();

	vote();

	// AJAX Upload

	var options = {
	    beforeSend: function()
	    {
	        //clear everything
	        $('#progress').show();
	        $('.progress-bar').html('0%');
	        $('.progress-bar').width('0%');
	        $('#upMessage').empty();
	        submitButton = $('#submitButton');
	        buttonText = submitButton.html();
	        $ajaxLoaderImg	= '<img src="/images/ajax-loader.gif">';
	        submitButton.html( $ajaxLoaderImg );
	    },
	    uploadProgress: function(event, position, total, percentComplete)
	    {
	        $('.progress-bar').width(percentComplete + '%');
	        $('.progress-bar').html(percentComplete + '%');
	    },
	    success: function()
	    {
	        $('.progress-bar').width('100%');
	        $('.progress-bar').html('100%');

	        submitButton.html( buttonText );

	    },
	    complete: function(response)
	    {
	        console.log( response.responseText );

	        var res = $.parseJSON( response.responseText );
	        var messages = '';


	        if ( res.success == true )
	        {
	        	console.log( res.url );
	        	window.location = res.url;
	        } else if ( res.errors !== undefined )
	        {
	        	$('#progress').slideUp();
	        	$('#upMessage').parent().removeClass('hide-panel');

	        	if ( res.errors.name )
	        	{
	        		$.each( res.errors.name, function(index, val) {
		    			// console.log( val );
	    				messages += '<li class="list-group-item transparent">' + val + '</li>';
	        		});
	        	}

	        	if ( res.errors.mp3 )
	        	{
	        		$.each( res.errors.mp3, function(index, val) {
	        			 // console.log( val );
	        			 messages += '<li class="list-group-item transparent">' + val + '</li>';
	        		});
	        	}

    			if ( res.errors.image )
    			{
    				$.each( res.errors.image, function(index, val) {
		    			// console.log( val );
	    				messages += '<li class="list-group-item transparent">' + val + '</li>';
	        		});
    			}

        		$('#upMessage').html( messages );
	        }
	    },
	    error: function()
	    {
	        $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

	    }

	};

	$("#upForm").ajaxForm(options);

	/********* Confirmation on file deletion **********/
	$('input[name=del]').on('click', function()
	{
		$(this).siblings('small').toggleClass('hide');
	});


});
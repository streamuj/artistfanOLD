var divs = $('.Signup1');
$(window).on('scroll', function() {
    var st = $(this).scrollTop();
    if (st > 600 && st < 2200) {
        $('.Signup1').css({'-webkit-transition': 'all 0.3s ease-in-out', '-moz-transition': 'all 0.3s ease-in-out', '-o-transition': 'all 0.3s ease-in-out', 'transition': 'all 0.3s ease-in-out'}),
        $('#signArtist').css({'opacity': '0.4'}).parents('a').attr('href', ''),
        $('#signFan').css({'opacity': '1'}).parents('a').attr('href', 'reg/?status=1');
    }
    else if (st > 2201 && st < 8000) {
        $('.Signup1').css({'-webkit-transition': 'all 0.3s ease-in-out', '-moz-transition': 'all 0.3s ease-in-out', '-o-transition': 'all 0.3s ease-in-out', 'transition': 'all 0.3s ease-in-out'}),
        $('#signFan').css({'opacity': '0.4'}).parents('a').attr('href', ''),		
        $('#signArtist').css({'opacity': '1'}).parents('a').attr('href', 'reg/?status=2');      
    }
    else {
        $('.Signup1').css({'-webkit-transition': 'all 0.3s ease-in-out', '-moz-transition': 'all 0.3s ease-in-out', '-o-transition': 'all 0.3s ease-in-out', 'transition': 'all 0.3s ease-in-out'}),
        $('#signArtist').css({'opacity': '1'}).parents('a').attr('href', 'reg/?status=2'),
        $('#signFan').css({'opacity': '1'}).parents('a').attr('href', 'reg/?status=1');
    }    
});

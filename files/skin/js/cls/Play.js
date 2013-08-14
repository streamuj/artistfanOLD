function Play()
{

}

Play.prototype =
{
    ShowPlayer: function( action, data ,fellow, userId, explore) {
        var data = (typeof data != "undefined") ? data : '';
        
        if (typeof mPlayer == "undefined" || mPlayer.closed || mPlayer.document==null || mPlayer.location==null)
        {
			//если документ не существует - нужно указать, что именно туда грузить
            //
            //get modal window
            var params = "menubar=no,location=yes,resizable=0,fullscreen=0,scrollbars=0,status=yes,width=687,height=736";
			
            mPlayer = window.open('/base/player/play?action='+action+'&data='+data+'&fellow='+fellow+'&userId='+userId+'&explore='+explore, "player", params);
            mPlayer.focus();
        }
        else
        {
            var params = "menubar=no,location=yes,resizable=no,scrollbars=no,status=yes,width=687,height=736";
            mPlayer = window.open('/base/player/play?action='+action+'&data='+data+'&fellow='+fellow+'&userId='+userId, "player", params);
            mPlayer.focus();
        }
    },
    DeleteMusic: function(id, user_id)
    {
        var user_id = typeof user_id != "undefined" ? user_id : 0;

        if(!confirm('Do you really want to delete this song from your music library?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+'&user_id='+user_id,
            url:      '/base/fan/Music',
            success: function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#music_track').html(data.data);
					$('#track_'+id).remove();
                }
            }
        });
    },	
    DeleteVideo: function( id )
    {
        var user_id = typeof user_id != "undefined" ? user_id : 0;

        if(!confirm('Do you really want to delete this video from your video list?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "delete_video_id="+id,
            url:      '/base/fan/Video',
            success: function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#video_list').html(data.data);
					$('#video_'+id).remove();					
                }
            }
        });
    },

    DeleteArtistVideo: function( id )
    {
        var user_id = typeof user_id != "undefined" ? user_id : 0;

        if(!confirm('Do you really want to delete this video from your video list?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "delete_video_id="+id,
            url:      '/base/artist/Video',
            success: function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#list').html(data.data);
                }
            }
        });
    },
    DeleteArtistPricedVideo: function( id )
    {
        var user_id = typeof user_id != "undefined" ? user_id : 0;

        if(!confirm('Do you really want to delete this video from your video list?'))
        {
            return;
        }
		   $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "delete_video_id="+id,
            url:      '/base/artist/ArtisttwoartistVideoDelete',
            success: function (data)
            {
                if (data.q == 'ok')
                {
                    $('#video_list').html(data.data);
					$('#video_'+id).remove();					

                }
            }
        });
    },	
	
	
    InitPlayButtons: function()
    {
        $('body').on('click', '.play_album', function(){
            oPlay.ShowPlayer('add_album', $(this).attr('mid'), $(this).attr('fellow'), $(this).attr('UserId') );
        });

        $('body').on('click', '.play_exp_album', function(){
            oPlay.ShowPlayer('add_album', $(this).attr('mid'), $(this).attr('fellow'), $(this).attr('UserId'), 1);
        });
		
        $('body').on('click', '.play_track', function(){
			oPlay.ShowPlayer('add_track', $(this).attr('mid'),$(this).attr('fellow'),0);
        });
		$('body').on('click', '.playlist_track', function(){
            oPlay.ShowPlayer('playlist', $(this).attr('mid'),$(this).attr('fellow'),$(this).attr('UserId'));
        });
		$('body').on('click', '.playlist', function(){
            oPlay.ShowPlayer('playlist');
        });
    }
}
//play class
var oPlay = new Play;
//player window
var mPlayer;
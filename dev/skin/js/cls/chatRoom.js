var state;
var mes;
var file;
var numOfUsers = 0;
var roomid;
var usernameid;
var tm;
doLoadChat = 0;

function Chat (filetxt) {
	file = filetxt;
	this.init = chatInit;
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
	this.trim = trimstr;
}

function chatInit(){
	getStateOfChat();
}

function wait(){
	updateChat();
}

$.ajaxSetup({
    cache: false // for ie
});

//gets the state of the chat
function getStateOfChat(){
	if(doLoadChat){
		return false;
	}
	doLoadChat = 1;
	$.ajax({
		   type: "POST",
		   //url :'http://sub.localartistfan.com/chatLog.php',
		   url :'/chatLog.php',
		   data: { 
					'file': file,
					'function': 'getState',
				},
		    //dataType: "jsonp",
		   dataType: "json",
		   success: function(data){
			   checkResponseRedirect(data);
			   state = data.state-5;
			   doLoadChat = 0;
			   updateChat();
		   },
	});
}
		 
//Updates the chat
function updateChat(chatStatus){
	if(typeof chatStatus != "undefined"){
		doLoadChat  = chatStatus;	
	}
	if(doLoadChat){
		return false;
	}
	doLoadChat = 1;
     $.ajax({
        type: "GET",
		url :'/chatLog.php',
		//url :'http://sub.localartistfan.com/chatLog.php',
        data: {  
            'state': state,
            'file' : file,
			'function': 'updateChat'
            },
        dataType: "json",
		//dataType: "jsonp",
        cache: false,
        success: function(data) {
			checkResponseRedirect(data);
			doLoadChat = 0;
            if (data.text != null) {
                for (var i = 0; i < data.text.length; i++) {  
                	$('#chat-area ul').append($("<li>"+ data.text[i] +"</li>"));
            	}
            	document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
        	}
			instanse = false;
			state = data.state;
			if(state <= 0) {
				setTimeout('updateChat(0)', 3*1000);
			} else {
				setTimeout('updateChat(0)', 1);
			}
        },
    });
}

//send the message
function sendChat(message, nickname, avatar) {       
     $.ajax({
		   type: "POST",
		   //url :'http://sub.localartistfan.com/chatRoom.php',
		   url :'/chatRoom.php',
		   data: {  
					'message': message,
					'nickname': nickname,
					'avatar':avatar,
					'file': file
					},
		   //dataType: "jsonp",
		   dataType: "json",
		   success: function(data){ },
		});

}

function trimstr(s, limit) {
    return s.substring(0, limit);
}
/* Send Chat Messages */
$(function() {
    $("#sendie").keydown(function(event) {  
        var key = event.which;  
         // all keys including return 
         if (key >= 33) {
             var maxLength = $(this).attr("maxlength");  
             var length = this.value.length;  
             
             if (length >= maxLength) {  
                 event.preventDefault();  
             }  
         }  
	});
    $('#sendie').keyup(function(e) {
		var code = (e.keyCode ? e.keyCode : e.which);										
		if(code == 13 && e.shiftKey == 0)  {
			var text = $(this).val();
			var maxLength = $(this).attr("maxlength");  
			var length = text.length; 
			if (length <= maxLength + 1) {    
				chat.send(text, name, avatar);	
				$(this).val("");
			} else {
				$(this).val(text.substring(0, maxLength));
			}
		}
    });
});
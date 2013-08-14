//Javascript for chatting
$(document).ready(function(){
	var docTitle = $('title').html();
	try {
		$("#changeStatus").msDropDown();
	} catch(e) {
		/* alert(e.message); */
	}
	chatWindows = [];
	//Get all chat windows on load
	getChatWindows();
	
	$('body').delegate('.chatUser', 'click', function(e){
		e.preventDefault();
		var chatUserId = $(this).attr('id').split('_')[1];
		var chatUserName = $('#chatProfileUser_'+chatUserId).html();
		createChatWindow(chatUserId, chatUserName);
		return false;
	})
	$('body').delegate('.chatMsg', 'keypress', function(event){
		//Check for enter key
		var thisObj = $(this);
		var thisChatWindow = $(this).parents('.chatWindow');
		var toUserId = thisChatWindow[0].id.split('_')[1];
		//alert(toUserId);
		if(event.keyCode == 13 && event.shiftKey == 0)  {
			var msg = thisObj.val();
			msg = $.trim(msg);
			//Post the message to server
			$.ajax({
				type:'post',
				url: 'getModuleInfo.php?rand='+Math.random(),
				dataType: 'json',
				data: {chatUserId: toUserId, message: msg, module:'chatMessage'},
				success: function(response){
					checkResponseRedirect(response);
					$(thisChatWindow).children('.chatArea').append(response.message);
					$("#chatWindow_"+toUserId+" .chatArea").scrollTop($("#chatWindow_"+toUserId+" .chatArea")[0].scrollHeight);
					thisObj.val('');
				}
			})
			return false;	
		} else {
			return true;
		}
	});
	//Function to minimize the windows
	$('body').delegate('.chatMin', 'click', function(event){
		var thisChatWindow = $($(this).parents('.chatWindow'));
		thisChatWindow.children('.chatArea').hide();
		thisChatWindow.children('.chatText').hide();
		$(this).removeClass('chatMin').addClass('chatMax');
	});
	//Function to maximize the windows
	$('body').delegate('.chatMax', 'click', function(event){
		var thisChatWindow = $($(this).parents('.chatWindow'));
		thisChatWindow.children('.chatArea').show();
		thisChatWindow.children('.chatText').show();
		$('.chatHead', thisChatWindow).removeClass('chatNew');
		$(this).removeClass('chatMax').addClass('chatMin');
		$(".chatArea", thisChatWindow).scrollTop($(".chatArea", thisChatWindow)[0].scrollHeight);
	});
	//Function to close the windows
	$('body').delegate('.chatClose', 'click', function(event){
		var thisChatWindow = $($(this).parents('.chatWindow'));
		var userId = thisChatWindow.attr('id').split('_')[1];
		//Remove the current chat window
		thisChatWindow.remove();
		//Remove the user Id from Session
		$.ajax({
			type:'post',
			url: 'chat.php',
			dataType: 'json',
			data: {chatUserId: userId, removeUser: 1},
			success: function(response){
				checkResponseRedirect(response);
			}
		})
		
	});
	//Get the Existing Chat windows on page loading
	setInterval('getNewChatMessage()', 2000);
	setInterval('chkNewUser()', 5000);
	setInterval('getOnlineUsers()', 10000);
});

function addChatWindows(chatWindowObj)
{
	if(!chatWindowObj.length) return;
	for(cnt = 0; cnt < chatWindowObj.length; cnt++){
		var chatUserId = chatWindowObj[cnt].chatUserId;
		var chatWindow = chatWindowObj[cnt].chatWindow;
		if(chatWindow && $('#chatWindow_'+chatUserId).length) {
			//Store the data in temporary chat message
			var tempChatWindow = $(chatWindow);
			//Get the chat messages
			var chatMessage = tempChatWindow.children('.chatArea').html();
			//Add to the user window
			$('#chatWindow_'+chatUserId).children('.chatArea').html(chatMessage);
		} else {
			$('body').append(chatWindow);
		}
	}
	alignChatWindows();
}
/* Get any new users send chat message to the user */
function chkNewUser()
{
	$.ajax({
		type:'post',
		url: 'getModuleInfo.php?rand='+Math.random(),
		dataType: 'json',
		data: {module:'newChatWindow'},
		success: function(response){
			if(response){
				checkResponseRedirect(response);
				addChatWindows(response.message);
			}
		}
	})
}
/* Get all of the chat windows on page load */
function getChatWindows()
{
	$.ajax({
		type:'post',
		url: 'getModuleInfo.php?rand='+Math.random(),
		dataType: 'json',
		async: false,
		data: {module:'loadChatWindow'},
		success: function(response){
			if(response){
				checkResponseRedirect(response);
				addChatWindows(response.message);
			}
		}
	});
	alignChatWindows();
}
/* Create a chat window when user click on chat link */
function createChatWindow(userId, userName)
{
	if($('#chatWindow_'+userId).length){
		$('#chatWindow_'+userId).show();
	} else {
		$.ajax({
			type:'post', 
			url: 'getModuleInfo.php?rand='+Math.random(),
			data:{module: 'chatWindow', chatUserId: userId, chatUserName: userName},
			dataType: 'json',
			success: function(response){
				checkResponseRedirect(response);
				$('body').append(response.message);
				alignChatWindows();
			}
		});
	}
	return false;
}

function alignChatWindows()
{
	//Get the chat windows
	$('.chatWindow').each(function(index){
		var thisChat = $(this);
		var thisChatArea = $(this).children('.chatArea')
		$(thisChatArea).scrollTop($(thisChatArea)[0].scrollHeight);
		right = (thisChat.width() + 10) * index
		thisChat.css({'right': right+'px' });
		thisChat.show();
	})
}
//Check for new chat messages in each chat window
function getNewChatMessage()
{
	$.ajax({
		type:'post', 
		url: 'getModuleInfo.php?rand='+Math.random(),
		data:{module: 'newChatMessage'},
		dataType: 'json',
		success: function(response){
			if(response) {
				checkResponseRedirect(response);
				var chatItem = response.message;
				if(!chatItem.length) return;
				//Get the response message and add it on relative chat windows
				for(cnt = 0; cnt < chatItem.length; cnt++){
					var chatUserId = chatItem[cnt].chatUserId;
					var chatMsg = chatItem[cnt].chatMessage;
					var onlineStatus = chatItem[cnt].status;
					chatWindow = $('#chatWindow_'+chatUserId);
					if(chatMsg && chatWindow.length) {
						$(chatWindow).show();
						$(chatWindow).children('.chatArea').append(chatMsg);
						if(chatWindow.find('div.chatMax').length){
							chatWindow.children('div.chatHead').addClass('chatNew');
						} else {
							$(".chatArea", chatWindow).scrollTop($(".chatArea", chatWindow)[0].scrollHeight);
						}
					} else if (chatMsg){ //New window as created.
						$('body').append(chatMsg);
						alignChatWindows();
					}
				}
			}
		}
	});
}

//Function to check and update online users list
function getOnlineUsers()
{
	$.ajax({
		type:'post', 
		url: 'getModuleInfo.php?rand='+Math.random(),
		data:{module: 'onlineStatus'},
		dataType: 'json',
		success: function(response){
			checkResponseRedirect(response);
			var result = response.message;
			for(cnt = 0; cnt < result.length; cnt++){
				var userId = result[cnt].user_id;
				var userStatus = parseInt(result[cnt].online, 10);
				//User is online
				if(userStatus == 1){
					$('#userStatus_'+userId).attr('class', 'fellowJammersOnline');
					$('#chatProfileUser_'+userId).attr('class', 'chatUser');
				} else {
					//User is offline
					$('#userStatus_'+userId).attr('class', 'fellowJammersOffline');
					$('#chatProfileUser_'+userId).removeClass('chatUser');
				}
			}
		}
	});
}

function changeChatStatus(newStatus)
{	
	$.ajax({
		type:'post',
		url: 'chat.php',
		dataType: 'json',
		data: {changeStatus: 1, status: newStatus},
		success: function(response){
			checkResponseRedirect(response);
		}
	})
}
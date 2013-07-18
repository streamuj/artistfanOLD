<?php 
// Error Collection Files 
//Mail Subject Msg
define('CHANGED_PROFILE_DATA_ON_SITE', 'Changed profile data on site ');
define('ACCOUNT_ACTIVATION', 'Your ArtistFan registration has been approved! ');
define('ACCOUNT_DE_ACTIVATION', 'Your ArtistFan registration has been rejected ');
define('NEW_FOLLOWER_FROM', 'New Follower ');
define('NEW_FRIEND_FROM', 'New Friend ');

define('EVENT_HAS_ADDED_FROM', ' Event has added from ');
define('MUSIC_TRACK_HAS_UPLAODED_FROM', ' Music track has uploaded from ');
define('PHOTO_HAS_UPLOADED_FROM', ' has added a new photo! ');
define('MUSIC_ALBUM_HAS_UPLOADED_FROM', ' has uploaded a new album!');
define('VIDEO_HAS_UPLOADED_FROM', ' Video has uploaded from ');
define('PAYOUT_INFO_FROM', 'Payout info from ');

define('PHOTO_PURCHASED_INFO_FROM', 'Your ArtistFan purchase ');
define('VIDEO_PURCHASED_INFO_FROM', 'Your ArtistFan purchase ');
define('MUSIC_PURCHASED_INFO_FROM', 'Your ArtistFan purchase ');
define('ALBUM_MUSIC_PURCHASED_INFO_FROM', 'Your ArtistFan purchase ');
define('EVENT_PURCHASED_INFO_FROM', 'Your ArtistFan purchase  ');

define('REGISTRATION_ARTIST', 'Registration '); 
define('REGISTRATION_FAN', 'Registration confirmation from '); 
define('REGISTRATION_APPROVAL_REQUEST', 'Registration approval request '); 

define('RESTORE_PASSWORD', 'You requested a password reset at ');
define('EVENT_STATUS_FROM', 'Event status from ');

//COMMON MSG
define('I_HAVE_CHANGED_MY_PROFILE_PHOTO', 'I have changed my profile photo ');
define('I_HAVE_JUST_ADDED_A_NEW_PHOTO', 'I have just added a new photo ');
define('I_HAVE_CREATED_AN_EVENT', 'I have created an event ');
define('I_HAVE_JUST_ADDED_A', 'I have just added a ');

//ERROR COMMON 
define('ERR', 'err');
define('OK', 'ok');
define('CANCEL', 'cancel');

//Error :: user_class-->RegistrationSelect function
define('YOUR_ACCOUNT_WAS_BLOCKED_REASON', 'Your account was blocked. Reason: ');
define('THE_EMAIL_PASSWORD_YOU_ENTERED_IS_INCORRECT_PLEASE_TRY_AGAIN', 'The email/password you entered is incorrect. Please try again.');
define('ADMIN_NEED_TO_APPROVE_YOUR_PROFILE_PLEASE_CHECK_LATER', 'Admin need to approve your profile. Please check later');
define('THIS_EMAIL_ADDRESS_HAS_NOT_BEEN_CONFIRMED_YET', 'This email address has not been confirmed yet. We can <a href="/base/user/resendemail" style="text-decoration:underline; color:#53576C;">Resend a confirmation mail</a> to you.');
define('NO_USERS_FOUND_WITH_THAT_NOT_CONFIRMED_EMAIL', 'No users found with that not confirmed email ');

//Error :: user_class-->RegistrationSelect function
define('PLEASE_SELECT_YOUR_ROLE', 'Please select your role!');

//Error :: user_class-->Registration function
define('PLEASE_SPECIFY_USERNAME', 'Please specify username');
define('PLEASE_ENTER_THE_ADDRESS', 'Please enter the address');
define('PLEASE_SPECIFY_CORRECT_EMAIL', 'Please specify correct email');
define('USER_WITH_THAT_EMAIL_ALREADY_EXIST', 'User with that email already exist');
define('PLEASE_SPECIFY_PASSWORD', 'Please specify password');
define('MIN_PASSWORD_LENGTH_6_SYMBOLS', 'Min password length - 6 symbols');
define('PLEASE_REPEAT_PASSWORD', 'Please repeat password');
define('PASSWORDS_DO_NOT_MATCH', 'Passwords do not match');
define('PLEASE_SPECIFY_FIRST_NAME', 'Please specify first name');
define('PLEASE_SPECIFY_LAST_NAME', 'Please specify last name');
define('MAX_FIRST_NAME_LENGTH_26_SYMBOLS', 'Max first name length - 26 symbols');
define('MAX_LAST_NAME_LENGTH_26_SYMBOLS', 'Max last name length - 26 symbols');
define('USERNAME_MUST_CONTAIN_ALPHABETS_AND_NUMERICS_WITHOUT_ANY_SPACE', 'Username must contain Alphabets and numerics without any space.');
define('MAX_USERNAME_LENGTH_40_SYMBOLS', 'Max username length - 40 symbols');
define('USER_WITH_THAT_USERNAME_ALREADY_EXISTS', 'User with that username already exists');
define('PLEASE_SPECIFY_USER_ZIP_CODE_AS_INTEGER', 'Please specify user zip code as integer');

//Error :: user_class-->RegistrationStep2 function
define('ITS_NOT_VALID_HASHTAG', 'Its not Valid Hashtag.');
define('YOU_MUST_SELECT_GENRES', 'You must select genres');
define('YOU_CAN_CHOOSE_TO_NOT_MORE_THAN_3_GENRES', 'You can choose to not more than 3 genres.');
define('PLEASE_SPECIFY_USER_PHONE_NUMBER_AS_INTEGER', 'Please specify user phone number as integer');

//Error :: user_class-->ValidateRegisterFields function
define('PLEASE_ENTER_VALID_EMAIL', 'please enter valid email');
define('ADDRESS_ALREADY_REGISTERED', 'Address already registered');
define('THE_USERNAME_IS_TOO_LONG', 'The Username is too long');
define('USERNAME_CAN_BE_JOHNPUBLIC_OR_USER1234', 'Username can be JohnPublic or User1234.');
define('THAT_USERNAME_IS_ALREADY_TAKEN', 'That Username is already taken');

//Error :: user_class-->Forgot function
define('NO_USERS_FOUND_WITH_SPECIFIED_EMAIL', 'No users found with specified email');
define('YOU_SIGNED_UP_WITH_FACEBOOK_USE_CONNECT_WITH_FACEBOOK_BUTTON_TO_SIGN_IN', 'You signed up with Facebook. Use "Connect with Facebook" button to sign in.');
define('YOU_SIGNED_UP_WITH_TWITTER_USE_SIGN_IN_WITH_TWITTER_BUTTON_TO_SIGN_IN', 'You signed up with Twitter. Use "Sign in with Twitter" button to sign in.');

//Error :: user_class-->Edit function
define('PLEASE_SPECIFY_DISPLAY_NAME', 'Please specify Display name');
define('DISPLAY_NAME_CAN_BE_JOHN_PUBLIC_OR_USER1234', 'Display name can be John Public or User1234');
define('MAX_DISPLAY_NAME_LENGTH_40_SYMBOLS', 'Max display name length - 40 symbols');
define('USER_WITH_THAT_DISPLAY_NAME_ALREADY_EXISTS', 'User with that display name already exists');

//Error :: user_class-->UploadAvatar function
define('ERROR_FILE_TYPE_ONLY_JPG_PNG_GIF_ALLOWED', 'Error file type. Only JPG, PNG, GIF allowed');
define('YOUR_PICTURE_IS_TOO_LARGE_MAX_PICTURE_SIZE_IS_500_KB', 'Your picture is too large. Max picture size is 500 Kb');

//Error :: user_class-->FbAuth function
define('ACCOUNT_EMAIL_IS_NOT_CONFIRMED', 'Account email is not confirmed');
define('YOU_ARE_ALREADY_LOGGED_IN_ANOTHER_SYSYTEM', 'You are already logged in another system!');
define('COULD_NOT_FIND_YOUR_ACCOUNT', 'Could not find your account');

//Error :: user_class-->TwtGetAuthUrl function
define('COULD_NOT_CONNECT_TO_TWITTER_REFRESH_THE_PAGE_OR_TRY_AGAIN_LATER', 'Could not connect to Twitter. Refresh the page or try again later.');

//Error :: user_class-->TwitterAuth function
define('COULD_NOT_FIND_YOUR_TWITTER_ACCOUNT', 'Could not find your Twitter account.');
define('TO_CREATE_YOUR_TWITTER_ACCOUNT_SELECT_STATUS', 'Could not find your twitter account. Please sign up as artist or fan.');//'To create your Twitter account. Click sign up as fan or artist button to select your status');

define('TO_CREATE_YOUR_FB_ACCOUNT_SELECT_STATUS', 'Could not find your facebook account. Please sign up as artist or fan.');//'To create your Twitter account. Click sign up as fan or artist button to select your status');

//Error :: user_class-->TwitterConnect function
define('YOUR_SPECIFIED_TWITTER_ACCOUNT_ID_DOES_NOT_MATCH_ACCOUNT_YOU_LOGGED_IN', 'Your specified twitter account ID does not match account you logged in.');
define('ACCOUNT_WAS_NOT_CONNECTED', 'Account was not connected');

//Error :: user_class-->FacebookAuth function
define('YOU_MUST_SIGN_IN_WITH_YOUR_FACEBOOK_ACCOUNT', 'You must sign in with your facebook account.');
define('COULD_NOT_FIND_YOUR_FACEBOOK_ACCOUNT', 'Could not find your Facebook account.');

//Error :: user_class-->FacebookConnect function
define('YOUR_SPECIFIED_FACEBOOK_ACCOUNT_ID_DOES_NOT_MATCH_ACCOUNT_YOU_LOGGED_IN', 'Your specified Facebook account ID does not match account you logged in.');

//Error :: user_class-->AdminEditUser function
define('PLEASE_SPECIFY_EMAIL', 'Please specify email');

//Error :: user_class-->AddSlider function
define('PLEASE_SPECIFY_NAME_FOR_NEW_ALBUM', 'Please specify name for new album');


//Artist class 
//Error :: user_class-->AddSlider function
define('POFILE_IMAGE_ERR', 'Image is not uploading. Image size should be above 234 pixels (width) X 234 pixels (height)');
define('ALBUM_IMAGE_SIZE_ERR', 'Image is not uploading. Image size should be above 200 pixels (width) X 200 pixels (height)');
define('HOMEPAGE_EVENT_SLIDE_IMAGE_SIZE_ERR', 'Image is not uploading. Image size should be above 769 pixels (width) X 442 pixels (height)');
define('HOMEPAGE_ALBUM_SLIDE_IMAGE_ERR', 'Image is not uploading. Image size should be above '.ALBUM_SLIDE_WIDTH.' pixels (width) X '.ALBUM_SLIDE_HEIGHT.' pixels (height)');


//Profile class 
//Error :: Profile class-->PurchaseVideo function
define('YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO', 'You have to be a registered artistsfan.com user to ');
define('CONTENT_FROM_ARTISTS_PLEASE_SIGNUP_OR_SIGNIN_BELOW', ' content from artists. Please sign up or sign in below.');
define('YOU_DO_NOT_HAVE_ENOUGH_POINTS_IN_THE_ACCOUNT', 'You do not have enough points in the account');
define('THIS_VIDEO_HAS_ALREADY_PURCHASED', 'This video has already purchased');
define('THIS_VIDEO_HAS_ALREADY_ADDED_TO_YOUR_LIST', 'This video has already added to your list');
define('THE_VIDEO_NOT_FOUND', 'The video not found');
define('THE_ALBUM_HAS_ALREADY_PURCHASED', 'The album has already purchased');
define('THE_ALBUM_HAS_NO_SONGS', 'The album has no songs');
define('THE_ALBUM_NOT_FOUND', 'The album not found');
define('PLEASE_SPECIFY_MESSAGE_TEXT', 'Please specify message text');
define('YOU_ARE_SENDING_TOO_MANY_MESSAGES_PLEASE_WAIT_A_FEW_SECONDS', 'You are sending too many messages.Please wait a few seconds.');
define('NO_VALID_PARAMETERS', 'No Valid parameters');
define('NO_AUTH', 'No auth');
define('WRONG_USER_ID', 'Wrong user ID');
define('FILE_NOT_FOUND', 'File Not Found');
define('THERE_IS_NO_SUCH_FILE', 'There is no such file');
define('DONE', 'Done!');
define('THE_EVENT_IS_ALREADY_IN_YOUR_CALENDAR', 'The event is already in your calendar');
define('YOU_HAVE_TO_BE_A_REGISTERED_ARTISTSFAN_COM_USER_TO_COMPLETE_THIS_ACTION_PLEASE_SIGN_UP_OR_SIGN_IN_BELOW', 'You have to be a registered artistsfan.com user to complete this action. Please sign up or sign in below.');
define('THIS_EVENT_IS_NOT_IN_YOUR_CALENDAR', 'This event is not in your calendar');
define('NO_EVENT_TO_RECORD', 'No Event To Record');
define('RECORDING_NOT_STARTED_YET', 'Recording Not Started Yet');
define('RECORDING_STARTED', 'Recording Started');
define('PLEASE_START_BROADCAST_OR_TRY_AGAIN', 'Please Start Broadcast OR Try Again');
define('RECORDING_NOT_STOPPED', 'Recording Not Stopped');
define('RECORDING_NOT_STARTED', 'Recording Not Started');
define('THE_TRACK_HAS_ALREADY_PURCHASED', 'The track has already purchased');
define('THE_TRACK_HAS_ALREADY_ADDED', 'The track has already added');
define('THE_TRACK_NOT_FOUND', 'The track not found');
define('PLEASE_SPECIFY_OLD_PASSWORD', 'Please specify old password');
define('INCORRECT_OLD_PASSWORD', 'Incorrect old password');
define('PLEASE_SPECIFY_NEW_PASSWORD', 'Please specify new password');
define('THE_PASSWORD_DONT_MATCH', 'The passwords don\'t match');
define('THE_NEW_PASSWORD_MUST_NOT_MATCH_WITH_THE_OLD', 'The new password must not match with the old');

//Artist Class.php 
define('PLEASE_UPLOAD_PHOTO_FILE', 'Please upload photo file');
define('PLEASE_SPECIFY_EVENT_DATE', 'Please speicfy event date');
define('WRONG_EVENT_DATE', 'Wrong event date');
define('PLEASE_SPECIFY_EVENT_TIME', 'Please speicfy event time');
define('WRONG_EVENT_TIME', 'Wrong event time');
define('PLEASE_SPECIFY_EVENT_TITLE', 'Please specify event title');
define('PLEASE_SPECIFY_EVENT_PRICE', 'Please specify event price');
define('PLEASE_SPECIFY_VALID_EVENT_URL', 'Please specify valid event url');
define('PLEASE_SPECIFY_RELEASE_DATE', 'Please speicfy release date');
define('WRONG_RELEASE_DATE', 'Wrong release date');
define('ALBUM_NAME_ALREADY_EXIST', 'Album name already exist');
define('PLEASE_SPECIFY_ALBUM_TITLE', 'Please specify album title');
define('PLEASE_SELECT_TRACKS_TO_DELETE', 'Please select tracks to delete');
define('YOU_ARE_NOT_AUTHORIZED_TO_DELETE_THE_TRACK', 'You are not authorized to delete the track');
define('PLEASE_SPECIFY_TRACK_TITLE', 'Please specify track title');
define('PLEASE_SPECIFY_VIDEO_TITLE', 'Please specify video title');
define('PLEASE_UPLOAD_VIDEO_FILE', 'Please upload video file');
define('PLEASE_SPECIFY_VIDEO_CODE_OR_VIDEO_LINK', 'Please specify video code or video link');
define('PLEASE_SPECIFY_CORRECT_VIDEO_LINK', 'Please specify correct video link');
define('FACEBOOK_ID_MUST_BE_NUMERIC', 'Facebook ID must be numeric');
define('YOU_CAN_NOT_CHANGE_YOUR_FACEBOOK_ACCOUNT', 'You can not change your facebook account');
define('THAT_ACCOUNT_ALREADY_TAKEN', 'That account already taken');
define('TWITTER_ID_MUST_BE_NUMERIC', 'Twitter ID must be numeric');
define('YOU_CAN_NOT_CHANGE_YOUR_TWITTER_ACCOUNT', 'You can not change your twitter account');
define('PLEASE_SPECIFY_PAYOUT_AMOUNT', 'Please specify payout amount');
define('IT_IS_NOT_ENOUGH_MONEY_IN_THE_ACCOUNT', 'It is not enough money in the account');
define('PLEASE_SPECIFY_ROUTING_ABA_CODE', 'Please specify routing / ABA code');
define('PLEASE_SPECIFY_BANK_ACCOUNT_NUMBER', 'Please specify bank account number');
define('PLEASE_SPECIFY_BANK_ACCOUNT_HOLDER_NAME', 'Please specify bank account holder name');
define('PLEASE_SPECIFY_ACCOUNT_TYPE', 'Please specify Account Type');
define('PLEASE_SPECIFY_CHECK_ADDRESS_TO', 'Please specify check address to!');
define('PLEASE_SPECIFY_MAIL_ADDRESS_1', 'Please specify mail address 1');
define('PLEASE_SPECIFY_MAIL_CITY', 'Please specify mail city');
define('PLEASE_SPECIFY_MAIL_ZIP', 'Please specify mail zip');
define('PLEASE_SPECIFY_CORRECT_PAYMENT_ID', 'Please specify correct payment Id!');
define('USER_WITH_THAT_PAYPAL_ID_ALREADY_EXIST', 'User with that paypal id already exist');
define('PLEASE_SPECIFY_PAYMENT_ID', 'Please specify payment Id!');
define('WRONG_PHOTO_DATE', 'Wrong photo date');
define('ALBUM_ALREADY_EXIST_PLEASE_TRY_AGAIN_WITH_OTHER_ALBUM_TITLE', 'Album already exists , Please try again with other album title');
define('YOU_ARE_NOT_ALLOW_TO_REDUCE_THE_ALBUM_PRICE', 'You are not allow to reduce the album price');

//Fan Class.php 
define('PLEASE_SPECIFY_AMOUNT', 'Please specify amount');
define('PLEASE_SPECIFY_CORRECT_AMOUNT', 'Please specify correct amount');
define('PLEASE_SPECIFY_CARD_HOLDER_NAME', 'Please specify card holder name');
define('PLEASE_SELECT_COUNTRY', 'Please select country');
define('PLEASE_SPECIFY_STREET_ADDRESS', 'Please specify street address');
define('MAX_STREET_ADDRESS_LENGTH_20_CHARACTERS', 'Max street address length - 20 characters');
define('PLEASE_SPECIFY_ZIP_CODE', 'Please specify zip code');
define('MAX_ZIP_CODE_LENGTH_9_CHARACTERS', 'Max zip code length - 9 characters');
define('PLEASE_SPECIFY_CARD_NUMBER', 'Please specify card number');
define('MAX_CARD_NUMBER_LENGTH_16_CHARACTERS', 'Max card number length - 16 characters');
define('PLEASE_SPECIFY_CARD_EXPIRATION_DATE', 'Please specify card expiration date');
define('PLEASE_SPECIFY_CORRECT_CARD_EXPIRATION_DATE', 'Please specify correct card expiration date');
define('PLEASE_SPECIFY_CARD_VALIDATION_CODE', 'Please specify card validation code');
define('ERROR_IN_PAYMENT_PROCESS', 'Error in payment process');
define('ERRORS_WERE_FOUND_WITH_YOUR_POINTS_BUY_PLEASE_CORRECT_THE_HIGHLIGHTED_FIELDS_BELOW', 'Errors were found with your points buy. Please correct the highlighted fields below.');
define('MAX_FIRST_NAME_LENGTH_26_CHARACTERS', 'Max first name length - 26 characters');
define('MAX_LAST_NAME_LENGTH_26_CHARACTERS', 'Max last name length - 26 characters');
define('MAX_USERNAME_LENTH_40_CHARACTERS', 'Max username length - 40 characters');
define('PLEASE_UPLOAD_PHOTO_COVER_IMAGE', 'Please upload photo cover image');

//Payment Class.php 
define('PLEASE_ENTER_THE_CARD_HOLDER_NAME', 'Please enter the card holder name');
define('PLEASE_ENTER_THE_CARD_NUMBER', 'Please enter the card number');
define('PLEASE_ENTER_THE_CARD_TYPE', 'Please enter the card type');
define('PLEASE_ENTER_THE_CVV', 'Please enter the CVV');
define('PLEASE_ENTER_THE_USERNAME', 'Please enter the username');
define('PLEASE_ENTER_THE_CITY', 'Please enter the city');
define('PLEASE_ENTER_THE_COUNTRY', 'Please enter the country');
define('PLEASE_ENTER_THE_STATE', 'Please enter the state');
define('PLEASE_ENTER_THE_ZIP', 'Please enter the zip');
define('PLEASE_ENTER_THE_PHONENUMBER', 'Please enter the phone number');
define('PLEASE_SPECIFY_PHONE_NUMBER_AS_INTEGER', 'Please specify phone number as integer');
define('PLEASE_ENTER_A_VALID_CVV_CODE', 'Please enter a valid CVV code');
define('ERROR_OOPS_NOT_LESS_THAN_PRICED_RATES', 'Error! Oops not less than priced rates : $');
define('ALREADY_MUSIC_HAS_PURCHASED', 'Already music has purchased');
define('ALREADY_PHOTO_HAS_PURCHASED', 'Already photo has purchased');
define('ALREADY_VIDEO_HAS_PURCHASED', 'Already video has purchased');
define('ALREADY_EVENT_HAS_PURCHASED', 'Already event has purchased');
define('SUCCESSFULLY_PURCHASED', 'Successfully purchased');
define('THE_ALBUM_HAS_ALREADY_ADDED', 'The album has already added');
define('THE_PHOTO_HAS_ALREADY_ADDED', 'The Photo has already added');
define('THE_ALBUM_HAS_NO_PHOTOS', 'The album has no photos');
define('THANKS_FOR_PURCHASING_MUSIC', 'Thanks for purchasing music');
define('THANKS_FOR_PURCHASING_EVENT', 'Thanks for purchasing event');
define('THE_ACCESS_HAS_ALREADY_PURCHASED', 'The access has already purchased');
define('THE_ACCESS_HAS_ALREADY_GOTTEN', 'The access has already gotten');

//chatRoom class 
define('NO_FILE', 'No File');

//page class
define('PLEASE_SPECIFY_TITLE', 'Please specify title');
define('PLEASE_SPECIFY_ALIAS', 'Please specify alias');
define('PAGE_WITH_THAT_ALIAS_ALREADY_EXIST', 'Page with that alias already exist');

//download class
define('YOU_ARE_NOT_AUTHORIZED_TO_DOWNLOAD_THE_VIDEO', 'You are not authorized to download the video');

//admin class
define('ADMIN_TO_ARTIST_PAYMENT', 'Admin TO Artist Payment');
define('PAYOUT_STATUS_FROM', 'Payout Status From ');
define('EMAIL_ID_IS_MISSING', 'Email id is missing');
define('CURRENCY_CODE_IS_MISSING', 'Currency code  is missing');
define('PREAPPROVAL_STARTDATE_IS_MISSING', 'Preapproval startdate  is missing');
define('PREAPPROVAL_ENDDATE_IS_MISSING', 'Preapproval enddate  is missing');
define('MAXIMUM_AMOUNT_PERPAYMENT_IS_MISSING', 'Maximum amount perpayment is missing');
define('MAXIMUM_NUMBER_OF_PAYMENTS_IS_MISSING', 'Maximum number of payments is missing');
define('MAXIMUM_TOTAL_AMOUNT_IS_MISSING', 'Maximum Total Amount Is Missing');

/*HTML ERROR LIST COLLECTIONS */
//FLODER NAME : MODS/INDEX 
define('NO_EVENTS', 'No events');
define('EVENT_PURCHASED', 'Event Purchased');
define('NO_NOTIFICATION', 'No Notification');

//404 html page
define('PAGE_NOT_FOUND', 'Page not found!');
define('PAGE_NOT_FOUND_MSG0', "We're sorry, but we could not find the page you're trying to access.");
define('SORRY_NO_CONTENT_ADDED', 'Sorry no content added :)');

//FLODER NAME : MODS/PROFILE/ *.HTML
define('NO_MUSICS_ADDED_YET', 'No Musics Added Yet');
define('NO_VIDEOS_ADDED_YET', 'No Videos Added Yet');
define('NO_PHOTOS_ADDED_YET', 'No Photos Added Yet');
define('NO_FANS_FOLLOWED_YET', 'No Fans Followed Yet');
define('NO_FELLOW_ARTIST_CONNECTED_YET', 'No Fellow Artist Connected Yet');
define('NO_ARTISTS_FOLLOWED_YET', 'No Artists Followed Yet');
define('NO_FRIENDS_CONNECTED_YET', 'No Friends Connected Yet');
define('NO_EVENTS_ADDED', 'No Events Added Yet');

//FLODER NAME : MODS/PROFILE/EDIT_ARTIST *.HTML
define('INDIVIDUALIZE_YOUR_PROFILE_BY_UPLOADING_A_COVER_IMAGE', 'Individualize your profile by uploading a cover image');
define('NO_TRANSACTION_HISTORY_FOUND', 'No Transaction History Found');
define('NO_PENDING_TRANSFERS', 'No pending transfers');
define('NO_VIEWERS', 'No Viewers');

define('VIDEO_ADDED_SUCCESS', ' Your audio/video file is under the conversion process. This may take a while (10-15 minutes to an hour depend on the file size). This page will reload once the file is converted.');




//{$smarty.const.LIVE_EVENT}


//DIALOG POPUP MSG
define('ARE_YOU_SURE_YOU_WANT_TO_CANCEL_THE_PAYOUT', 'Are you sure you want to cancel the payout ?');
// annonce event
define('EVENT_ANNOUNCE','Your newly created event is now visible in your upcoming events list. If you would like your fans and fellow artists to know about this event then please announce it.');

//{$smarty.const.ARE_YOU_SURE_YOU_WANT_TO_CANCEL_THE_PAYOUT}

define('ARTIST_REGISTRATION_CONFIRM','Registration complete! Your request to create a profile has been submitted. You will be notified once your profile has been approved.');
define('FAN_REGISTRATION_CONFIRM','Registration completed!. Please check your email for confirmation.');


?>
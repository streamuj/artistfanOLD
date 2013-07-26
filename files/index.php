<?php
$siteDir = dirname(dirname(__FILE__));
require_once($siteDir.'/dev/config/main.php');
header('HTTP/1.1 404 Not Found');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Artistfan</title>
<link rel="stylesheet" href="/ss/styles.css" type="text/css" media="screen"/>
<link href='//fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,300,600' rel='stylesheet' type='text/css' />
<link href="/ss/menu.css" rel="stylesheet" type="text/css" />
<link href="/si/favicon.ico" rel="icon" type="image/x-icon" />
<script type="text/javascript" src="/sj/jquery-1.7.2.min.js"></script>
<script src="/sj/menu.js" type="text/javascript"></script>
<script type="text/javascript" src="/sj/jquery.backstretch.js"></script>
<script type="text/javascript">
var subDomain = "/";
$(document).ready(function ()
{
	if($('#navH').length)
	var menu = $('#navH').Menu(); 
	$.backstretch("/si/bigIMg1.jpg");
	$("#footerMain").addClass("fixed");
	if ($(document).height() > $(window).height()) {
		$("#footerMain").removeClass("fixed");
	}	
});
</script>
</head>
<body class="HOME4">
<div class="clear"></div>
<div id="blueBarHolder">
  <div id="pageHead"> <a href="<?php echo ROOT_HTTP_PATH; ?>/base/user/login" class="logBtn caps font16">Login</a> <a href="<?php echo ROOT_HTTP_PATH; ?>"  id="logoH" class="LF"></a>
    <div class="cenTi">
      <ul id="navH">
        <li><a href="javascript:void(0)">Explore</a>
          <ul>
            <li class="vid"><span></span><a href="<?php echo ROOT_HTTP_PATH; ?>/base/index/video">Videos</a></li>
            <li class="mus"><span></span><a href="<?php echo ROOT_HTTP_PATH; ?>/base/index/music">Music</a></li>
          </ul>
        </li>
        <li><a href="<?php echo ROOT_HTTP_PATH; ?>/base/index/events">LIVE STREAMS</a></li>
      </ul>
      <div id="searchH" class="relative">
        <form method="post" action="<?php echo ROOT_HTTP_PATH; ?>/base/search/search" id="search_form">
          <input type="hidden" name="do" value="do_search" />
          <input type="text" class="txtBox" name="search_key" id="search_key" value="Search" onBlur="javascript:if(this.value=='')this.value='Search'" onFocus="javascript:if(this.value=='Search')this.value=''" />
          <input name="apdiv" type="submit" class="btn" value="" />
        </form>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="clear"></div>
<div class="contentArea" >
  <div>
    <div class="content_block big_content" style="padding:250px 310px;">
      <h1>Page not found!</h1>
      <br />
      <p style="width:500px;">We're sorry, but we could not find the page you're trying to access.</p>
      <p>
      <ul>
        <li>Please double check the address in the address bar</li>
        <li>Or try our <a href="<?php echo ROOT_HTTP_PATH; ?>">home page</a> instead</li>
      </ul>
      </p>
    </div>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>
<div id="footerMain">
  <div class="footer font12 caps">
    <div class="socNet">
      <ul>
        <li><a href="http://pinterest.com/artistfanmedia" target="_blank"><img src="/si/fs-ic1.png" alt="ic" hspace="5" vspace="10" height="18" /></a></li>
        <li><a href="https://facebook.com/artistfanmedia" target="_blank"><img src="/si/fs-ic2.png" alt="ic" hspace="5" vspace="10" height="18"  /></a></li>
        <li><a href="https://twitter.com/artistfanmedia" target="_blank"><img src="/si/fs-ic3.png" alt="ic" hspace="5" vspace="10" height="18"  /></a></li>
        <li><a href="http://instagram.com/artistfanmedia" target="_blank"><img src="/si/fs-ic4.png" alt="ic" hspace="5" vspace="10" height="18"  /></a></li>
      </ul>
    </div>
    <span class="LF copyTxt">COPYRIGHT &copy; <?php date('Y');?> ARTISTFAN.COM. ALL RIGHTS RESERVED.</span> <span class="Fnav"> <a href="<?php echo ROOT_HTTP_PATH; ?>/pages/about.html">About </a> <a href="<?php echo ROOT_HTTP_PATH; ?>/pages/terms.html">Terms &amp; Conditions</a> <a href="<?php echo ROOT_HTTP_PATH; ?>/pages/privacy.html">Privacy policy</a> <a href="<?php echo ROOT_HTTP_PATH; ?>/pages/faq.html">FAQ</a> <a href="<?php echo ROOT_HTTP_PATH; ?>/pages/pricing.html">Pricing</a> </span> </div>
</div>
</body>
</html>
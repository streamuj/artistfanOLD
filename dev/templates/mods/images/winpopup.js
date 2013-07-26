function winpopup(url, width, height, name)
{

  var leftPosition = screen.width - width;
  var topPosition = screen.height - height;

  leftPosition = (leftPosition < 0) ? 0 : leftPosition/2;
  topPosition  = (topPosition < 0)  ? 0 : topPosition /2;

  window.open(url, name, "width="+width+",height="+height+", top="+topPosition+",left="+leftPosition+",toolbar=0,directories=0,menubar=0,resizable=0,location=0,scrollbars=0,copyhistory=0");
  return false;
}

function winpopup_scroll(url, width, height, name)
{

  var leftPosition = screen.width - width;
  var topPosition = screen.height - height;

  leftPosition = (leftPosition < 0) ? 0 : leftPosition/2;
  topPosition  = (topPosition < 0)  ? 0 : topPosition /2;
  window.open(url, name, "width="+width+",height="+height+", top="+topPosition+",left="+leftPosition+",toolbar=0,directories=0,menubar=0,resizable=0,location=0,scrollbars=1,copyhistory=0,innerHeight=100,innerWidth=650");
  return false;
}

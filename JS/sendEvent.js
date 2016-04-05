function sendEvent(event, category, virtual) {
    var mname = 'yaCounter10865746';
    var m = window[mname];
    var c = typeof console !== "undefined";
		if (event == "")
				return;
		if (typeof category == "undefined")
				category = 'form';
		if (typeof m !== "undefined"){
				m.reachGoal(event);
  		if (c)
  			console.log(mname+".reachGoal('"+event+"');");				
		} else {
  		if (c)
  			console.log("Счетчик "+mname+" не найден" );				
		}
		if (typeof _gaq !== "undefined"){
        if(typeof virtual !== "undefined"){ 
          _gaq.push(['_trackPageview', virtual]);
      		if (c)
      				console.log("_gaq.push(['_trackPageview', '"+virtual+"']);");
        } 
				_gaq.push(['_trackEvent', category, event]);
  		if (c)
  				console.log("_gaq.push(['_trackEvent', '"+category+"', '"+event+"']);");				
  	} else
		if (typeof ga !== "undefined"){
      if(typeof virtual !== "undefined"){ 
        ga('send', 'pageview', virtual) 
    		if (c)
    				console.log("ga('send', 'pageview', '"+virtual+"');");
      } 
			ga('send', 'event', category, event); 
  		if (c)
  				console.log("ga('send', 'event', '"+category+"', '"+event+"');");
		} else 
		if (typeof pageTracker !== "undefined"){
				pageTracker._trackEvent(category, event);
        if(typeof virtual !== "undefined"){
          pageTracker._trackPageview(virtual);
      		if (c)
      				console.log("pageTracker._trackPageview('"+virtual+"');");
        } 
  		if (c)
  				console.log("pageTracker._trackEvent('"+category+"', '"+event+"');");				
  	} else {
  		if (c)
  			console.log("Счетчик GOOGLE ANALYTICS не найден");				
		}
		return true;
}

//email select event

if(!window.Kolich){
  Kolich = {};
}

Kolich.Selector = {};
Kolich.Selector.getSelected = function(){
  var t = '';
  if(window.getSelection){
    t = window.getSelection();
  }else if(document.getSelection){
    t = document.getSelection();
  }else if(document.selection){
    t = document.selection.createRange().text;
  }
  t = t.toString().replace(/^\s+/,'');
  t = t.replace(/\s+$/,'');
  return t;
}

Kolich.Selector.mouseup = function(){
  var st = Kolich.Selector.getSelected();
  if(st!=''){
	var re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(re.test(st)){
      sendEvent('click-copy', 'e-mail');
    }
  }
}

$(document).bind("mouseup", Kolich.Selector.mouseup);

//наведение на элемент
$(document).mouseover(function(event){
  var x = event.clientX, y = event.clientY,
    elementMouseIsOver = document.elementFromPoint(x, y);
    if(jQuery(elementMouseIsOver).hasClass('phone')){
      sendEvent('phone', 'phone-cursor');
      //console.log(jQuery(elementMouseIsOver));
    }
});
function sendEvent(event, category, virtual) {
    var mname = 'yaCounter10865746';
    var m = window[vname];
    var c = typeof console !== "undefined";
		if (event == "")
				return;
		if (typeof category == "undefined")
				category = 'form';
		if (typeof m !== "undefined"){
				m.reachGoal(event);
  		if (c)
  			console.log(vname+".reachGoal('"+event+"');");				
		}
		if (typeof _gaq !== "undefined"){
				_gaq.push(['_trackEvent', category, event]);
  		if (c)
  				console.log("_gaq.push(['_trackEvent', '"+category+"', '"+event+"']);");				
  	}
		if (typeof ga !== "undefined"){
      if(typeof virtual !== "undefined"){ 
        ga('send', 'pageview', virtual) 
    		if (c)
    				console.log("ga('send', 'pageview', '"+virtual+"');");
      } 
			ga('send', 'event', category, event); 
  		if (c)
  				console.log("ga('send', 'event', '"+category+"', '"+event+"');");
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
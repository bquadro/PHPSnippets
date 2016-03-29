
$(document).ready(function(){
  var d = $('#wrapcont');
  if (document.layers) {
    //Disable the OnMouseDown event handler.
    d.mousedown(function(e){
      alert('Копирование материалов с сайта запрещено!');
      return false;
    });
  }
  else {
    //Disable the OnMouseUp event handler.
    d.mouseup(function(e){
      if (e != null && e.type == "mouseup") {
        //Check the Mouse Button which is clicked.
        if (e.which == 2 || e.which == 3) {
            //If the Button is middle or right then disable.
            alert('Копирование материалов с сайта запрещено!');
            return false;
        }
      }
    });
  }
  //Disable the Context Menu event.
  d.contextMenu(function(){
       alert('Копирование материалов с сайта запрещено!');
      return false;
  });
});


/*
  
CSS 

.middle * {
    -moz-user-select: -moz-none;
   -khtml-user-select: none;
   -webkit-user-select: none;
   -ms-user-select: none;
   user-select: none;
}

*/
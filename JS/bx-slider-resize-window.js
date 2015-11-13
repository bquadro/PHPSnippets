
	  var settings = function(target) {
    var settings1 = { /* Desktop */
            minSlides: 5,
            maxSlides: 5,
            moveSlides: 1,
            slideWidth: 2000, /* Intentionally set to high value, bxslider will auto calculate */
            slideMargin: 36,
            prevSelector: $(target+' .slider_nav'),
            nextSelector: $(target+' .slider_nav'),
            prevText: 'Предыдущая',
            nextText: 'Следующая',
            pager:false,
            onSliderLoad: function(){ loadedsliders[target] = true; }
        };
        var settings2 = { /* Mobile */
            minSlides: 4,
            maxSlides: 4,
            moveSlides: 1,
            slideWidth: 2000, /* Intentionally set to high value, bxslider will auto calculate */
            slideMargin: 36,
            prevSelector: $(target+' .slider_nav'),
            nextSelector: $(target+' .slider_nav'),
            prevText: 'Предыдущая',
            nextText: 'Следующая',
            pager:false,
            onSliderLoad: function(){ loadedsliders[target] = true; }
        };
        return ($(window).width()>=1200) ? settings1 : settings2;
    }

    var catSliderSale, catSliderRent, catSliderObj;
    var catSliderSaleTarget='#block-views-techcat-block';
    var catSliderRentTarget='#block-views-techcat-rent-block';
    var catSliderObjTarget='#block-views-objcat-block';
    var loadedsliders = [];
    loadedsliders[catSliderSaleTarget]=false;
    loadedsliders[catSliderRentTarget]=false;
    loadedsliders[catSliderObjTarget]=false;

    function reloadonresize() {
      if($(catSliderRentTarget).length && loadedsliders[catSliderRentTarget]) catSliderRent.reloadSlider(settings(catSliderRentTarget));
      if($(catSliderSaleTarget).length && loadedsliders[catSliderSaleTarget]) catSliderSale.reloadSlider(settings(catSliderSaleTarget));
      if($(catSliderObjTarget).length && loadedsliders[catSliderObjTarget]) catSliderObj.reloadSlider(settings(catSliderObjTarget));
    }

    catSliderRent = $(catSliderRentTarget).find('.slider_cat > ul').bxSlider(settings(catSliderRentTarget));
    catSliderSale = $(catSliderSaleTarget).find('.slider_cat > ul').bxSlider(settings(catSliderSaleTarget));
    catSliderObj = $(catSliderObjTarget).find('.slider_cat > ul').bxSlider(settings(catSliderObjTarget));
    
    $(window).resize(reloadonresize);

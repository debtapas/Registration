jQuery(function() {
  
  var slideCount =  jQuery(".slider ul li").length;
  var slideWidth =  jQuery(".slider ul li").width();
  var slideHeight =  jQuery(".slider ul li").height();
  var slideUlWidth =  slideCount * slideWidth;
  
  jQuery(".slider").css({"max-width":slideWidth, "height": slideHeight});
  jQuery(".slider ul").css({"width":slideUlWidth, "margin-left": - slideWidth });
  jQuery(".slider ul li:last-child").prependTo(jQuery(".slider ul"));
  
  function moveLeft() {
    jQuery(".slider ul").stop().animate({
      left: + slideWidth
    },700, function() {
      jQuery(".slider ul li:last-child").prependTo(jQuery(".slider ul"));
      jQuery(".slider ul").css("left","");
    });
  }
  
  function moveRight() {
    jQuery(".slider ul").stop().animate({
      left: - slideWidth
    },700, function() {
      jQuery(".slider ul li:first-child").appendTo(jQuery(".slider ul"));
      jQuery(".slider ul").css("left","");
    });
  }
  
  
  jQuery(".next").on("click",function(){
    moveRight();
  });
  
  jQuery(".prev").on("click",function(){
    moveLeft();
  });
  
  
});
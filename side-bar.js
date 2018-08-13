/* store navigation */


function LoopForever() {
if($(".navigation").hasClass("hider")){
  
  $(document).ready(function(){
  $('.fa').click(function(){
    $('.navigation').removeClass("hider");
    $('.toggle2').addClass("toggle-animate");
  })
})
  
} else {
  
  $(document).ready(function(){
  $('.fa').click(function(){
    $('.navigation').addClass("hider");
    $('.toggle2').removeClass("toggle-animate");
  })
})
  
  }
}

var interval = self.setInterval(function(){LoopForever()},500);
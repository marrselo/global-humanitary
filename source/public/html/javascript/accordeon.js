$(document).ready(function(){

if($("#nav > li > a.active")){

  $("#nav > li > a.active").next().slideToggle();
}

	$('#nav > li > a').click(function(){
    if ($(this).attr('class') != 'active'){
      $('#nav li ul').slideUp();
      $(this).next().slideToggle();
      $('#nav li a').removeClass('active');
      $(this).addClass('active');
    }
/*	else{
		$('#nav li ul').slideDown();
      $(this).next().slideToggle();
      //$('#nav li a').removeClass('active');
      $(this).removeClass('active');
		}*/
  });
	});
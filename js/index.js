$(document).ready(

  $(".show_pizzas .card").matchHeight(),
  $('.cart_form').submit(function()
  {
   return false;
  }),
  // $(".cart_btn").click(function(e){
  //   //e.perfentdefualt();
  //   console.log('clicked');
  //   $curform=$(this).parent().parent();
  //   console.log($curform);

  //   $.ajax({
  //     type:'POST',
  //     url:'/index.php',
  //     data:$curform.serialize(),
  //     success: function(data)
  //     {
   

  //       alert("this pizza has been added to your card"); 
  //      var $cart=$('.cart .modal-body .container');
  //      $cart.append(
  //      '<div class="col">'+
  //      '<div class="card">'+
  //      '<div class="card-body">'+
  //        '<h5 class="card-title">'+$curform.children().eq(1).attr('value')+'</h5>'+
  //        '<h5 class="card-title">$'+$curform.children().eq(0).attr('value')+'</h5>'+
  //        '<a href="#" class="row card-link">'+                                   
  //       '<i class="col-centered grey-text fas fa-trash fa-2x"></i>'+
  //        '</a></div></div></div>'
      
  //        )
       
  //     }

  //   })
  // })
)




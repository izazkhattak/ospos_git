// CODIGOS ATAJOS CON EL TECLADO	
document.onkeyup=function(e){
  var e = e || window.event;
  if(e.which == 119) {
    $("#add_payment_button").click()
  }else if(e.which == 120){
    $("#finish_sale_button").click()
  }
//******************************************
  var a = a || window.event;
  if(e.which == 145) {
    $("#suspend_sale_button").click()
  }else if(e.which == 27){
    $("#cancel_sale_button").click()
  }
//******************************************
  var i = i || window.event;
  if(e.which == 9) {
    $("#amount_tendered").click()
  }else if(e.which == 113){
    $("#suspend_sale_button").click()
  }
}
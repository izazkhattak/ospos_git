//	SONIDOS Y VIBRACION EN BOTONES

// SONIDIOS
function playSound () {
    document.getElementById('payment').play();
}

function playSound2 () {
    document.getElementById('touch').play();
}

// VIBRAR 
  const button = document.getElementById('button');
  button.addEventListener('click', hacerVibrar);
  function hacerVibrar(){
  window.navigator.vibrate([1000]);
  }
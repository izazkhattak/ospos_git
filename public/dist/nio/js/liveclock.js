 // codigo js usamos onload para asegurarnos que existan los elementos en nuestro DOM
            window.onload = function() {
                var liveclock = document.getElementById("liveclock");         
                
                // le asociamos el evento a nuestro elemento para tener un codigo 
                // html mas limpio y manejar toda la interaccion
                // desde nuestro script
                liveclock.onclick = function() {
                    // una variable donde pongo la url a donde quiera ir, 
                    //podria estar de mas pero asi queda mas limpio la funcion window.open()
                    var url = "dist/nio/app/calendario/index.html";
                    window.open(url, "_blank", 'width=200,height=185'); 
                    // el return falase es para eviar que se progrague el evento y se vaya al href de tu liveclock.
                    return false;
                };
            }
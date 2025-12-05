document.addEventListener("DOMContentLoaded", function() {
    var juegos = window.miPluginPersonalizadoJuegos; // Obtiene los juegos desde una variable global

    juegos.forEach(function(juego) {
        var fechaSorteo = new Date(juego.fecha_sorteo).getTime();
        var contador = document.getElementById("contador-" + juego.id);
        
        setInterval(function() {
            var ahora = new Date().getTime();
            var tiempoRestante = fechaSorteo - ahora;
            
            if (tiempoRestante > 0) {
                var dias = Math.floor(tiempoRestante / (1000 * 60 * 60 * 24));
                var horas = Math.floor((tiempoRestante % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutos = Math.floor((tiempoRestante % (1000 * 60 * 60)) / (1000 * 60));
                var segundos = Math.floor((tiempoRestante % (1000 * 60)) / 1000);

                contador.innerHTML = dias + "d " + horas + "h " + minutos + "m " + segundos + "s";
            } else {
                contador.innerHTML = "¡El sorteo ha comenzado!";
            }
        }, 1000);
    });
});
// script.js
// Con AJAX detectamos cambios en la base de datos y enviamos notificaciones al navegador

// Función para comprobar cambios en la base de datos
function checkForUpdates(userId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'checkUpdates.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);

            if (response.updated) {
                notificar();
            }
        }
    };

    xhr.send(`userId=${userId}`);
}

// Función para enviar la notificación
function notificar() {
    if (!("Notification" in window)) {
        alert("Tu navegador no soporta notificaciones");
    } else if (Notification.permission === "granted") {
        const notificacion = new Notification("Nueva Orden", {
            body: "Has recibido una nueva orden",
            icon: "path/to/your/icon.png" // Cambia a la ruta de tu icono
        });

        notificacion.onclick = function() {
            window.location.href = "path/to/your/page"; // Cambia a la ruta de la página a la que quieres dirigir
        };
    } else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                notificar();
            }
        });
    }
}

// Evento al hacer clic en el botón para notificar
document.getElementById("notificarBtn").addEventListener("click", function() {
    const userId = "tu_id_de_usuario"; // Reemplaza con el ID de usuario
    notificar(userId);
});

// Comprobar cambios en la base de datos cada cierto tiempo
setInterval(() => {
    const userId = "tu_id_de_usuario"; // Reemplaza con el ID de usuario
    checkForUpdates(userId);
}, 5000); // Comprobar cada 5 segundos

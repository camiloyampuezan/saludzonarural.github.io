const socket = io();

// Enviar mensaje
function sendMessage() {
    const input = document.getElementById("messageInput");
    const message = input.value;
    if (message.trim() !== "") {
        socket.emit("chatMessage", message);
        input.value = "";
    }
}

// Recibir mensajes y mostrarlos en la página
socket.on("chatMessage", (msg) => {
    const messagesList = document.getElementById("messages");
    const li = document.createElement("li");
    li.textContent = msg;
    messagesList.appendChild(li);
});

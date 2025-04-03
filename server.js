const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const path = require("path");

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

// Servir archivos estáticos desde la carpeta "public"
app.use(express.static(path.join(__dirname, "SaludRural/public")));


io.on("connection", (socket) => {
    console.log("Nuevo usuario conectado");

    // Recibir mensaje del cliente y enviarlo a todos
    socket.on("chatMessage", (msg) => {
        io.emit("chatMessage", msg);
    });

    socket.on("disconnect", () => {
        console.log("Usuario desconectado");
    });
});

// Iniciar servidor en el puerto 3000
server.listen(3000, () => {
    console.log("Servidor corriendo en http://localhost:3000");
});

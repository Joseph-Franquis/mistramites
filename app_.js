//importamos la libreria express para configurar el servidor
const express = require('express');
//creamos la aplicacion con la libreria de express
const app = express();
//importamos http para crear el servidor
const http = require('http');
//creamos el servidor
const server = http.createServer(app);

const chalk = require('chalk');
const cors = require('cors');

app.use(cors());
const options = {
  cors: {
    origin: 'http://localhost:4200',
  },
};

//importamos la libreria socket
const {Server} = require('socket.io');
//instanciamos el sokect en el servidor para usarlo
const io = new Server(server);

//ponemos al socket a escuhar el event connection
io.on('connection', (socket)=>{
    const idHandShake = socket.id;

    // const {room } = socket.handshake.query;

    console.log(`Hola dispositivo ${idHandShake} `);

    socket.on('chat1', (msg)=>{
        console.log(msg)
        io.emit('chat1', msg);
    });
})

//incializamos la primera ruta /
app.get('/', (req, res) =>{
    //res => respose
    //req => request
    //sendFile envia un archivo
    res.sendFile(`${__dirname}/cliente/index.html`)
    console.log("connect");
});

//hacemos funcionar el servidor en el puerto 3000
server.listen(5000, ()=>{

    console.log('Servidor corriendo en http://localhost:5000/')
});
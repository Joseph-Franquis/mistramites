const express = require('express');
const app = express();
const chalk = require('chalk');
const cors = require('cors');

const mysql = require('mysql');
// const connection = mysql.createConnection({
//   host     : 'localhost',
//   user     : 'root',
//   password : '',
//   database : 'arbol'
// });



const connection = mysql.createConnection({
  host:'db4free.net',
  user: 'joseph_23',
  password:'29866830J@s',
  database: 'arbol'
});

connection.connect(function(err) {
  console.log(1);
  if (err){
    console.log("Esto ha fallado :"+err);
  } else{
    console.log("Connected!");
    connection.query("SELECT * FROM usuarios", function (err, result, fields) {
      if (err){ console.log("Esto ha fallado :"+err) }else{
        result.forEach(element => {
          console.log(element.id);
        });
      }
    });
  }

});

//para permitir la conexion con el servidor de frontend
app.use(cors());
const options = {
  cors: {
    origin: 'http://localhost:4200',
    // origin: 'https://mistramites.000webhostapp.com',
  },
};

const server = require('http').Server(app);
const io = require('socket.io')(server, options);



app.get('/', function (req, res) {
  // res.sendFile(`${__dirname}/cliente/index.html`)
  console.log("connect");
});



io.on('connection', function (socket) {

  const handshake = socket.id;

  let { id } = socket.handshake.query;
  let { id_recep } = socket.handshake.query;

  console.log(`${chalk.green(`Nuevo dispositivo: ${handshake}`)} conentado a la ${nameRoom}`);
  socket.join(nameRoom)

  // console.log(`Hola dispositivo ${handshake} `);

  socket.on('chat-gen', (msg)=>{
      io.emit('chat-gen', msg);
  });

  socket.on('chat'+id+id_recep, (msg)=>{
    console.log(msg)
    io.emit('chat1', msg);
});
});

server.listen(5000, function () {
  console.log('\n')
  console.log(`>> Socket listo y escuchando por el puerto: ${chalk.green('5000')}`)
})
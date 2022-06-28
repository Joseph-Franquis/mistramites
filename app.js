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



// const connection = mysql.createConnection({
//   host:'db4free.net',
//   user: 'joseph_23',
//   password:'29866830J@s',
//   database: 'mistramites'
// });

// connection.connect(function(err) {
//   if (err){
//     console.log("Esto ha fallado :"+err);
//   } else{
//     console.log("Connected!");
//     connection.query("SELECT * FROM usuarios", function (err, result, fields) {
//       if (err){ console.log("Esto ha fallado :"+err) }else{
//         result.forEach(element => {
//           console.log("id de usuarios =>"+element.id);
//         });
//       }
//     });
//   }

// });

//para permitir la conexion con el servidor de frontend
app.use(cors());
const options = {
  cors: {
    origin: 'http://localhost:4200',
    //  origin: 'https://mistramites.000webhostapp.com',
  },
};

const server = require('http').Server(app);
const io = require('socket.io')(server, options);



app.get('/', function (req, res) {
  res.sendFile(`${__dirname}/cliente/index.html`)
  console.log("connect");
});


//coneccion del sokect
io.on('connection', function (socket) {

  const handshake = socket.id;

  // let { id } = socket.handshake.query;
  // let { id_recep } = socket.handshake.query;

  console.log(`${chalk.green(`Nuevo dispositivo: ${handshake}`)}`);

  socket.on('chat-gen', (msg)=>{
    io.emit('chat-gen', msg);
  });

  socket.on('chat1', (msg)=>{
    console.log(msg)
    io.emit('chat1', msg);
  });
});

server.listen(3000, function () {
  console.log('\n')
  console.log(`>> Socket listo y escuchando por el puerto: ${chalk.green('5000')}`)
})

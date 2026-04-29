const express = require('express');
const { exec } = require('child_process');
const path = require('path');
const app = express();

// Ruta para archivos estáticos (HTML, CSS, JS, imágenes, etc.)
app.use(express.static('public'));

// Ruta para ejecutar scripts PHP en la carpeta 'public'
app.get('/php/:script', (req, res) => {
  const script = req.params.script;
  const phpPath = path.join(__dirname, 'public', script);
  exec(`php ${phpPath}`, (error, stdout, stderr) => {
    if (error) {
      res.status(500).send(`Error al ejecutar ${script}: ${error.message}`);
      return;
    }
    res.send(stdout);
  });
});

// Ruta principal (redirige a index.php)
app.get('/', (req, res) => {
  res.redirect('/php/index.php');
});

app.listen(3000, () => {
  console.log('Servidor Node.js en http://localhost:3000');
});
<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Website Layout</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Estilos enlazados-->
<link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>

<div class="logo">Re-Read</div>

<div class="header">
  <h1>Re-Read</h1>
  <p>En Re-Read podrás encontrar libros de segunda mano en perfecto estado. También vender los tuyos. Porque siempre hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de los dos.</p>
</div>

<div class="row">
  
  <div class="column left">
    <div class="topnav">
      <a href="../index.php">Re-Read</a>
      <a href="libros.php">Libros</a>
      <a href="ebooks.php">eBooks</a>
    </div>

    <h3>Todos los libros tienen el mismo precio</h3>
    <p>Libros casi nuevos a un precio casi imposible.</p>
    <!--Imagenes de libros con precio-->
    <div class="alineacionImg">
      <img src="../img/1-libro-3€.gif" alt="imagen 1">
    </div>
    <div class="alineacionImg">
      <img src="../img/2-libros-5€.gif" alt="imagen 2">
    </div>
    <div class="alineacionImg">
      <img src="../img/5-libros-10€.gif" alt="imagen 3">
    </div>


    <h3>¿Te cambias de piso? ¿Tienes que vaciar la casa? ¿O sencillamente necesitas algo más de espacio?</h3>
    <p>En Re-Read compramos tus libros para darles una segunda vida. Los compramos todos al mismo precio: 0,20 euros. Siempre hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de los dos.</p>
  </div>
  
  <div class="column right">
    <h3>Top Ventas</h3>
    <?php 
    // 1. Conexión con la base de datos.
    include '../services/connection.php';

    // 2. Selección y muestra de datos de la base de datos.
    $result = mysqli_query($conn, "SELECT Books.Title FROM Books WHERE Top = '1'");

    if (!empty($result) && mysqli_num_rows($result) > 0) {
    // datos de salida de cada fila (fila = row)
      while ($row = mysqli_fetch_array($result)) {
        // Añadimos la imagen a la página con la etiqueta img de HTML
        echo "<p>".$row['Title']."</p>";
      }  
    } else {
      echo "o resultados";
    }
    ?>
  </div>

</div>
  
</body>
</html>

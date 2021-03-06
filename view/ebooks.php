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
  
    <h3>Toda la actualidad en eBooks.</h3>
    <!--Nuevo desarrollo-->
   
    
    <div class="form">
      <form action="ebooks.php" method="POST">
        <label for="fautor">Autor: </label>
        <input type="text" id="fautor" name="fautor" placeholder="Introduce el autor..">
        <label for="ftitulo">Titulo: </label>
        <input type="text" id="ftitulo" name="ftitulo" placeholder="Introduce el titulo..">
        <label for="country">Country</label>
        <?php
        // 1. Conexión con la base de datos.
        include '../services/connection.php';
        $result = mysqli_query($conn, "SELECT DISTINCT Authors.Country FROM Authors ORDER BY Country");
        echo '<select id="country" name="country">';
        echo '<option value="%">Todos los paises</option>';
        while ($valores = mysqli_fetch_array($result)) {            
          echo '<option value="'.$valores[Country].'">'.$valores[Country].'</option>';
        }
        echo '</select>';
        echo '<input type="submit" value="Buscar">';
      echo '</form>';
    echo '</div>';
    
    // 1. Conexión con la base de datos.
    include '../services/connection.php';
    if (isset($_POST['fautor'])) {
      $autor=$_POST['fautor'];
      $titulo=$_POST['ftitulo'];
      $pais=$_POST['country'];

      //filtrará los ebooks que se mostraran en la pagina.
      $result = mysqli_query($conn, "SELECT Books.Description, Books.img, Books.Title FROM Books INNER JOIN BooksAuthors ON Books.Id = BooksAuthors.BookId INNER JOIN Authors ON BooksAuthors.AuthorId = Authors.Id WHERE Authors.Name LIKE '%$autor%' AND Books.Title LIKE '%$titulo%' AND Authors.Country LIKE '$pais'");
      // '%{$_POST['fautor']}%'
      echo "El autor introducido es: ".$autor."</br>";
      echo "El titulo introducido es: ".$titulo."</br>";
      echo "El pais seleccionado es: ".$pais."</br>";

    } else {
      //mostrará todos los ebooks de la base de datos.
      $result = mysqli_query($conn, "SELECT Books.Description, Books.img, Books.Title FROM Books WHERE eBook != 'o'");

    }

    if (!empty($result) && mysqli_num_rows($result) > 0) {
      // datos de salida de cada fila (fila = row)
      $i=0;
        while ($row = mysqli_fetch_array($result)) {
          $i++;
          echo "<div class='ebook'>";
          // Añadimos la imagen a la página con la etiqueta img de HTML
          echo "<img src=../img/".$row['img']." alt='".$row['Title']."'>";
          // Aádimos el título a la pagina con la etiqueta h2 de HTML
          echo "<div class='desc' id='desc'>".$row['Description']." </div>";
          echo "</div>";
          if ($i%3==0) {
            echo "<div style='clear:both;'></div>";
          }
        }  
      } else {
        echo "o resultados";
      }
    ?>
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

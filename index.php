<?php
    include "./admin/php/conexion.php";
    $resultado= $conexion->query("select * from productos order by id desc limit 3")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soluciones GAJA</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/media.css">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <header>
        <div id="logo">
            <img src="./img/logo.png" alt="">
        </div>
        <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
        <nav>
            <ul>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Conócenos</a>
                </li>
                <li>
                    <a href="#">Productos</a>
                </li>
                <li>
                    <a href="#">Ofertas</a>
                </li>
                <li>
                    <a href="#">Acerca de</a>
                </li>
            </ul>
        </nav>
    </header>
    <section id="slide">
        <h1>Soluciones GAJA</h1>
        <h3>La tecnología al alcance de tu mano</h3>
        <button>Conoce nuestros productos</button>
    </section>
    <section id="ofert">
        <h2>Nuestras ofertas</h2>
        <div>
        <?php
          while($fila=mysqli_fetch_array($resultado)){
        ?>
            <div id="columna3">
                <img src="./img/productos/<?php echo $fila['imagen'];?>" alt="">
                <div id="mitad">
                    <div>
                        <p><?php echo $fila['nombre'];?></p>
                        <button>Comprar</button>
                    </div>
                    <div>
                        <p id="precio">$<?php echo $fila['precio'];?></p>
                    </div>
                </div>
            </div>
        <?php
          }
        ?>
            
            </div>
        </div>
    </section>
    <footer>
        <div id="fi">
            <p style="font-size: 1.5rem;">Contacto</p>
            <p>sales@example.com</p>
            <p>support@example</p>
            <p>+52 636 127 64 83</p>
        </div>
        <div id="se">
            <p style="font-size: 1.5rem;">Conócenos</p>
            <div>
                <a href=""><img src="./img/fa.png" alt=""></a>
                <a href=""><img src="./img/me.png" alt=""></a>
                <a href=""><img src="./img/wh.png" alt=""></a>
                <a href=""><img src="./img/tw.png" alt=""></a>
                <a href=""><img src="./img/yt.png" alt=""></a>
            </div>
        </div>
        <div id="th">
            <p style="font-size: 1rem;">Deseas recibir nuestras ofertas</p>
            <div>
               <input type="mail" placeholder="@ Correo">
               <button>Registrar</button>
            </div>
            
        </div>
    </footer>
</body>
</html>
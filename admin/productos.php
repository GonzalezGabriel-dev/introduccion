<?php
    session_start();
    if(!isset($_SESSION['userData'])){
      header("Location: ./login.php");
    }
    $userData=$_SESSION['userData'];
    include "./php/conexion.php";
    $resultado= $conexion->query("select * from productos order by id desc")or die($conexion->error);
  

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Soluciones GAJA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
    <?php include "./layouts/header.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "./layouts/sideBar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Agregar productos</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        
        <div class="card-body">
            <?php
             if(isset($_GET['error'])){
            ?>
                <div class="alert alert-danger">
                    <b>Error:</b> <?php echo $_GET['error'];?>
                </div>
            <?php
             }
            ?>
        
          <form action="./php/insertarProducto.php" class="row" method="POST" enctype="multipart/form-data">
            <div class="col-4">
                <label for="">Nombre</label>
                <input type="text" class="form-control" placeholder="Inserta el Nombre" name="nombre" required>
            </div>
            <div class="col-4">
                <label for="">Precio</label>
                <input type="number" class="form-control" placeholder="Inserta el precio" name="precio" required>
            </div>
            <div class="col-4">
                <label for="">Inventario</label>
                <input type="number" min="1" class="form-control" placeholder="Inserta el inventario" name="inventario" required>
            </div>
            <div class="col-4">
                <label for="">Imagen</label>
                <input type="file" class="form-control" placeholder="" name="imagen" required>
            </div>
            <div class="col-12 p-2">
                <br>
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Insertar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Productos</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
        <?php
             if(isset($_GET['succes'])){
            ?>
                <div class="alert alert-success">
                    <?php echo $_GET['succes'];?>
                </div>
            <?php
             }
            ?>
        <table class="table">
          <thead>
              <th>Id</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Inventario</th>
              <th></th>
          </thead>
          <tbody>
          <?php
          while($fila=mysqli_fetch_array($resultado)){
          ?>
              <tr>
                  <td><?php echo $fila['id'];?></td>
                  <td>
                  <img src="./img/productos/<?php echo $fila['imagen'];?>" width="50px" height="50px" alt="">  
                  <?php echo $fila['nombre'];?></td>
                  <td><?php echo $fila['precio'];?></td>
                  <td><?php echo $fila['inventario'];?></td>
                  <td><button class="btn btn-warning btnEdit" data-toggle="modal" data-target="#modal-editar" data-id="<?php echo $fila['id'];?>"  data-nom="<?php echo $fila['nombre'];?>" data-precio="<?php echo $fila['precio'];?>" data-inv="<?php echo $fila['inventario'];?>"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btnEliminar" data-id="<?php echo $fila['id'];?>" data-img="<?php echo $fila['imagen'];?>" data-toggle="modal" data-target="#modal-eliminar"><i class="fa fa-trash"></i></button>
                  </td>
                  
              </tr>
          <?php
          }
          ?>
          </tbody>
      </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "./layouts/footer.php"; ?>



</div>
<!-- ./wrapper -->
<!-- Modal eliminar-->
<div class="modal fade" id="modal-eliminar">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="./php/eliminarProducto.php" method="POST">
            <div class="modal-body">
              <p>¿Desea eliminar al usuario?</p>
                <input type="hidden" id="idEliminar" name="id">
                <input type="hidden" id="img" name="img">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-outline-light">Eliminar</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- Modal Editar-->
<div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="./php/editarProducto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="col-12">
                <label for="">Nombre</label>
                <input type="hidden" name="id" id="idEditar">
                <input type="hidden" name="img" id="imagen">
                <input type="text" class="form-control" placeholder="Inserta el Nombre" id="nombre" name="nombre" >
            </div>
            <div class="col-12">
                <label for="">Precio</label>
                <input type="number" class="form-control" placeholder="Inserta el precio" id="precio" name="precio" >
            </div>
            <div class="col-12">
                <label for="">Inventario</label>
                <input type="number" min="1" class="form-control" placeholder="Inserta el inventario" id="inventario" name="inventario" >
            </div>
            <div class="col-12">
                <label for="">Imagen</label>
                <input type="file" class="form-control" placeholder="" name="imagen" >
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- jQuery -->
<script src="./dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dashboard/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dashboard/dist/js/demo.js"></script>
<script>
  var idEliminar=0;
  var img="";
  $(document).ready(function(){
    $(".btnEliminar").click(function(){
      idEliminar=$(this).data('id');
      img=$(this).data('img');
      $("#idEliminar").val(idEliminar);
      $("#img").val(img);
    });
    $(".btnEdit").click(function(){
      var idEdit=$(this).data('id');
      var nombre=$(this).data('nom');
      var precio=$(this).data('precio');
      var inventario=$(this).data('inv');
      var img=$(this).data('img');
      $("#idEditar").val(idEdit);
      $("#nombre").val(nombre);
      $("#precio").val(precio);
      $("#inventario").val(inventario);
      $("#imagen").val(img);
    });
  });
</script>
</body>
</html>

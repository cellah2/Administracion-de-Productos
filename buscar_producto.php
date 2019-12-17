<?php 
session_start();
$varsession = $_SESSION['email'];
if($varsession==null || $varsession=''){
    echo 'Usted no tiene autorizacion';
	header("Location: index.php");
    die();

}
include("conexion.php"); 
include("includes/header.php");
?>

<section>
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-xl-10 col-lg-9 col-md-8 mt-5 ml-auto">
                <?php 
                if(isset($_SESSION['message'])){
                ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" data-auto-dismiss="1000" id="success-alert" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>
                </div>
                <?php } ?>
                <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista de Productos</li>  
                        </ol>
                    </nav>
                <table class="table table-striped table-hover table-bordered table-sm bg-white">
        <thead>
          <tr>
            <td>ID</td>
            <td>PRODUCTO</td>
            <td>PRECIO</td>
            <td>STOCK</td>
	<td>
  <?php
      $query_categorias = mysqli_query($link,"select * from categorias");
      $result_categorias = mysqli_num_rows($query_categorias);
      ?>
      <form action="/buscar_producto.php?categoria='<?php $_POST['id_cat'];?>'" method="POST">
      <select id="search_categorias" class="select_location" >
      <option selected>CATEGORIA</option>
                  <?php 
                  if($result_categorias > 0){
                    while($categoria = mysqli_fetch_array($query_categorias)) {
                      ?>
                      <option name="id_cat" id="<?php echo $categoria["id_categoria"] ?>" value="<?php echo $categoria["id_categoria"] ?>'"> <?php echo $categoria["nombre_categoria"]; ?> </option>
                      <?php

                    }
                  }
                  ?>
                  
      </select>
      <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i>Filtrar</button>
      </form>
  </td>
            <td>OPERACIONES</td>
          </tr>
        </thead>
        <?php
        $llave=$categoria["id_categoria"];
        alert("$llave");
$consulta="SELECT * FROM productos where cod_categoria=$llave";
$resultado = $link->query($consulta);

?>
        <tbody>
        <?php
        while($mostrar=$resultado->fetch_assoc()){

       
        ?>
          <tr>
            <td><?php echo $mostrar['id_producto'] ?></td>
            <td><?php echo $mostrar['nombre'] ?></td>
            <td><?php echo $mostrar['precio'] ?></td>
            <td><?php echo $mostrar['stock'] ?></td>
<td>
<?php $cat = $mostrar['cod_categoria'];
$var=mysqli_query($link,"SELECT * from categorias where id_categoria=$cat");
$ext = $var->fetch_array();

echo $cat . " - " . $ext['nombre_categoria'];

?>
</td>

            <td>
              <a href="/editar.php?id_producto='<?php echo $mostrar['id_producto']?>'" class="btn btn-secondary">Edit</a>
              <a href="/eliminar.php?id_producto='<?php echo $mostrar['id_producto']?>'" class="btn btn-danger btn-delete">Delete</a>
            </td>
          </tr>
        <?php
        }
        ?>

        </tbody>
      </table>


                </div>
            </div>
        </div>

    </section>

<?php include("includes/footer.php"); 
unset($_SESSION["message"]);
?>
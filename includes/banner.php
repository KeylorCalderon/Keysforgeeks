<div class ="slider">
<?php
    $conn = conectar();
    $sql = "SELECT * FROM Promocion";
    $resultado = $conn->query($sql);
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    $randomisa = rand(1,$count);

    if($resultado -> num_rows > 0){
        $img = "";
             while($row = $resultado->fetch_assoc()){
              if($randomisa == $row['ID']){
                $img = $row['imagen'];
              } 
             } 
?>
        <ul>
            <li><img src="<?php echo $img; ?>" ></li>
            <li><img src="<?php echo $img; ?>" ></li>
            <li><img src="<?php echo $img; ?>" ></li>
        </ul>
<?php         
     }
     cerrar($conn);
?>
</div>

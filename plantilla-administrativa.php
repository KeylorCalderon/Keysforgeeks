<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/Encabezado.php";
?>

<body>
    <?php
           include "includes/banner.php";
    ?>

    <?php
            include "includes/anuncios.php";
    ?>
    <div class="wrapper">
        
        <main>
            <div><img src="img/menu.png" alt="" class="menu">
                <nav class="menu-navegacion">
                    <a href="#productos">Gestion productos</a>
                    <a href="#transacciones">Transacciones</a>
                </nav>
            </div>


            <div class="administrativo">
                <div class="cont-seccion" id="productos">
                    <h2 class="subtitulos">Gestion producto</h2>
                    <div class="contenedores productos">

                        <div class="superior">
                            <div class="buscadorproducto">
                                <p class="text">Nombre producto:</p>
                                <input class="input-producto" type="text" name="input-producto" id="input-producto">
                            </div>

                            <p class="text descripcion">
                                Descripcion de producto</p>

                            <div class="partessuperior">
                                <div class="parts">
                                    <div class="contenido">
                                        <p class="text"> Precio:</p>
                                        <p class="text valor">$ 43.43</p>
                                    </div>
                                    <div class="contenido">
                                        <p class="text"> Tipo producto:</p>
                                        <p class="text valor">key</p>
                                    </div>
                                    <div class="contenido">
                                        <p class="text"> Oferta:</p>
                                        <p class="text valorO">20%</p>
                                    </div>
                                    <p class="text"> Descripcion:</p>
                                    <p class="descrip">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                        Nesciunt exercitationem necessitatibus similique aliquid quia sit delectus
                                        laboriosam consequatur.</p>
                                </div>
                                <div class="parts derecha">
                                    <img src="img/minecraft.jpg" alt="">
                                    <img class="cambiarimagen" src="img/Imagen.png" alt="">
                                </div>

                            </div>
                        </div>
                        <div class="inferior">
                            <div class="partesinferior">
                                <div class="parts">
                                    <div class="contenido">
                                        <p class="text"> Nuevo precio:</p>
                                        <p class="text valor"> <input class="input-precio" type="text"
                                                name="input-precio" id="input-precio"></p>
                                    </div>
                                    <div class="contenido">
                                        <p class="text">Nueva oferta:</p>
                                        <p class="text valor">
                                        <p class="text valor"> <input class="input-oferta" type="text"
                                                name="input-oferta" id="input-oferta"></p>
                                        </p>
                                    </div>
                                </div>
                                <div class="parts">
                                    <p class="text">Nueva Descripcion:</p>
                                    <form action="">
                                        <textarea class="textarea-descripcion" name="" id="" cols="30"
                                            rows="10"></textarea>
                                    </form>
                                </div>
                            </div>
                            <a href="#" class="btn">
                                <p class="text">Modificar</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="cont-seccion" id="transacciones">
                    <h2 class="subtitulos">Transacciones</h2>
                    <div class="contenedores Transacciones">
                        <div class="selecionador">
                            <p class="text">Nombre cliente:</p>
                            <p class="text valor"> <input class="input-precio" type="text" name="input-precio"
                                    id="input-precio"></p>
                            <form action="">
                                <input type="date" class="input-date">
                            </form>
                            
                            <form action="">
                                <select class="input-transacciones" name="transacciones" id="">
                                    <option>Todas las transacciones</option>
                                    <option>Todas las transacciones</option>
                                    <option>Todas las transacciones</option>
                                </select>
                            </form>

                            <img class= "img-buscar-trans" src="img/search-icon.png" alt="">

                        </div>


                        <div class="jtable">
                            <table>
                                <thead>
                                    <tr class="tr">
                                        <th class = "th " >Fecha</th>
                                        <th class = "th">Cliente</th>
                                        <th class = "th">Producto</th>
                                        <th class = "th"> Estado</th>
                                        <th class = "th">Monto</th>
                                    </tr>
                                </thead>
                                <tr class="tr">
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                </tr>
                                <tr class="tr">
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                </tr>
                                <tr class="tr">
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                </tr>
                                <tr class="tr">
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                    <td class = "td">Valor</td>
                                </tr>
                               
                            </table>



                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>
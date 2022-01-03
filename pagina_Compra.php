<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/Encabezado.php";
?>

<body>

    <div class="wrapper">
        
        <main>
            <section class="compra">
                <div class="cont-seccion">
                    <h2 class="subtitulo">Resumen del pedido</h2>
                    <div class="cont-info">
                        <table class="table-fill">
                            <thead>
                                <tr>
                                    <th class="table-left" id="Producto">Producto</th>
                                    <th class="table-left" id="Plataforma">Plataforma</th>
                                    <th class="table-left" id="Precio">Precio</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <tr>

                                    <td class="text-left">
                                        <img src="img/minecraft.jpg" alt="">
                                        Minecraft
                                    </td>
                                    <td class="text-left">
                                        Xbox One
                                    </td>
                                    <td class="text-left">
                                        $19.05
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <img src="img/GTA.jpg" alt="">
                                        Gta 5
                                    </td>
                                    <td class="text-left">
                                        PC
                                    </td>
                                    <td class="text-left">
                                        $9.62
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="caja-total">
                            <table class="table-fill">
                                <tbody>
                                    <tr>
                                        <td class="tect-left">
                                            IVA:
                                        </td>
                                        <td class="tect-left">
                                            $0.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tect-left">
                                            Total:
                                        </td>
                                        <td class="tect-left">
                                            $28.67
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="line-total"></div>
                        </div>
                        <div class="terminos">
                            <label class="checkbox" for="myCheckboxId">
                                <input class="checkbox-input" type="checkbox" name="myCheckboxName" id="myCheckboxId">
                                <p class="text-terminos">Acepto los Términos y Condiciones</p>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="cont-seccion">
                    <h2 class="subtitulo">Información de facturación</h2>
                    <div class="cont-info cont2">
                        <div class="part">
                            <p class="text-fact">País</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-pais">
                            <p class="text-fact">Nombre completo</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-nombre">
                            <p class="text-fact">Número de telefono</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-numero">
                            <p class="text-fact">Código postal</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-cod-postal">
                        </div>
                        <div class="part">
                            <p class="text-fact">Dirección</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-direccion">
                            <p class="text-fact">Dirección 2</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-direccion-2">
                            <p class="text-fact">Estado / Provincia</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-provincia">
                            <p class="text-fact">Ciudad</p>
                            <input class="input-fact" type="text" name="info-factura" id="input-ciudad">
                        </div>
                    </div>
                </div>
                <div class="cont-seccion">
                    <h2 class="subtitulo">Metodo de pago</h2>

                    <div class="cont-info">
                        <div class="seleccion-metodo">
                            <div class="metodo">
                                <label for="metodoPagoPaypal" class="checkbox">
                                    <input class="checkbox-input" type="checkbox" name="checkboxPaypal" id="metodoPagoPaypal">
                                    <p>Paypal</p>
                                </label>
                                <img class="imgPaypal" src="img/Paypal.png" alt="">
                            </div>
                            <div class="metodo">
                                <label for="metodoPagoTarjeta" class="checkbox">
                                    <input class="checkbox-input" type="checkbox" name="checkboxTarjeta" id="metodoPagoTarjeta">
                                    <p>Tarjeta de crédito</p>
                                </label>
                                <img src="img/VISA.png" alt="">
                                <img src="img/MasterCard.png" alt="">
                            </div>
                            
                            
                        </div>

                        <div class="datos-tarjeta">
                            <p class="text-fact">Nombre de la tarjeta</p>
                            <input class="input-tarjeta" type="text" placeholder="Alonso Pérez" name="info-tarjeta" id="input-num-tarjeta">
                            <p class="text-fact">Número de tarjeta</p>
                            <input class="input-tarjeta" type="text" placeholder="1234 5678 9012 3456" name="info-tarjeta" id="input-nombre-tarjeta">
                        </div>
                        <div class="part-tarjeta">
                            <div class="part-division-tarjeta">
                                <p class="text-fact">Fecha de expiración</p>
                                <input class="input2-tarjeta" type="text" placeholder="MM/AA" name="info-tarjeta" id="input-exp-tarjeta" maxlength="5">
                            </div>
                            <div class="part-division-tarjeta">
                                <p class="text-fact">CVC/CVV</p>
                                <input class="input2-tarjeta" type="text" placeholder="***" name="info-tarjeta" id="input-cvc-tarjeta" maxlength="3">
                            </div>
                        </div>
                        <div class="boton-pagar">
                            <button type="submit" class="btn-pagar">Pagar</button>
                        </div>
                    </div>
                </div>

            </section>
        </main>

    </div>

    <?php
        include "includes/PiePagina.php";
    ?>

    
</body>

</html>
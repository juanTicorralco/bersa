<?php
    // if(isset($_GET["Editar"])){
    //     $select = "id_order,code_stock_order,envio_order,url_product,pago_prev_order,url_category,image_product,hour_order,name_product,id_category,id_product,image_stock,name_buyer_order,phone_order,stacion_order,day_order,spesifications_order,status_order,price_order,follow_order,name_product,color_stock,size_stock,color_hexa_stock,stock_out_order,number_stock,id_stock_order";
    //     $url = CurlController::api()."relations?rel=orders,products,categories,stocks&type=order,product,category,stock&linkTo=id_order&equalTo=".$_GET["Editar"]."&select=".$select."&token=".$_SESSION["user"]->token_user;
    //     $method = "GET";
    //     $fields = array();
    //     $headers = array();
    //     $editProduct = CurlController::request($url,$method,$fields,$headers)->result[0];
    // }
    //   echo '<pre>'; print_r($editProduct); echo '</pre>'; 
    //                                      return;
?>
<div class="ps-checkout ps-section--shopping">
    <div class="container">
        <div class="ps-section__header">
            <h1>Crear Orden</h1>
        </div>
        <div class="ps-section__content">            
            <form class="ps-form--checkout ps-tab-root needs-validation" novalidate method="post">
                <div class="row">
                    <div class="col-xl-5 col-lg-8 col-sm-12">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Crear ORDEN</h5>
                            <a href="<?php echo TemplateController::path() ?>acount&registers" class="btn btn-danger">Cancel</a>
                        </div>
                        <input type="hidden" value="<?php echo CurlController::api();?>" id="urlApi">
                        <input type="hidden" value="<?php 
                            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                $url = "https://"; 
                            }else{
                                $url = "http://"; 
                            }
                            echo $url . $_SERVER['HTTP_HOST']."/";
                        ?>" id="urlLocal">
                        <!-- Product -->
                        <div class="modal-body text-left p-5">
                            <div class="form-group">
                                <div class="row mb-5">
                                    <!-- Categria -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Categoria:
                                            </span>
                                        </div>
                                        <?php
                                            $url = CurlController::api()."categories?type=category&select=id_category,name_category";
                                            $method= "GET";
                                            $header= array();
                                            $fields= array();
                                            $categories= CurlController::request($url, $method, $header, $fields)->result;
                                        ?>
                                        <select 
                                        class="form-control"
                                        name="categoryProduct"
                                        id="categoryProductAdd"
                                        onchange="changecategory(event)"
                                        required>
                                        <option value="">Categoria</option>
                                        <?php foreach($categories as $key => $value): ?>
                                        <?php //echo '<pre>'; print_r($value->id_category); echo '</pre>';  ?>
                                        <option value="<?php echo $value->id_category."_".$value->name_category; ?>"><?php echo $value->name_category; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>
                                    </div>
                                    <!-- SubCategoria -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3 subcategoryProduct" style="display: none ;">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                SubCategoria:
                                            </span>
                                        </div>
                                        <select 
                                            class="form-control"
                                            name="subcategoryProduct"
                                            id="subCategoryProductAdd"
                                            onchange="changeToProduct(event)"
                                            required>
                                            <option value="">Subcategoria</option>
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>
                                    </div>
                                </div>
                                <label>Producto<sup class="text-danger productPrincipal">*</sup></label>
                                <div class="form-group__content productPrincipal">
                                    <select 
                                    class="form-control"
                                    name="SelectProduct"
                                    id="productAdd"
                                    onchange="changeProduct(event)"
                                    required>
                                        <option value="">Producto</option>
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">El nombre es requerido</div>
                                </div>
                                <figure id="imageProduct" class="imageProduct">
                                </figure>
                                <div id="stokeorderProduct" class="stokeorderProduct"></div>
                                <input type="hidden" name="stockApro" id="stockApro" class="stockApro">
                                <input type="hidden" class="idTalla" >
                                <input type="hidden" class="idColor" >
                            </div>
                            <div class="form-group">
                                <label>ESPESIFICACIONES ORDEN<sup class="text-danger">*</sup></label>
                                <div class="row mb-5">
                                    <!-- Color -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3 ColorProduct" style="display: none ;">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Color:
                                            </span>
                                        </div>
                                        <select 
                                        class="form-control"
                                        name="ColorProduct"
                                        id="colorProductAdd"
                                        onchange="changeColor(event)"
                                        required>
                                        <option value="">Select Color</option>
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>
                                    </div>
                                    <!-- talla -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3 TallaProduct" style="display: none ;">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Talla:
                                            </span>
                                        </div>
                                        <select 
                                        class="form-control"
                                        name="TallaProduct"
                                        id="tallaProductAdd"
                                        onclick="changeTalla(event)"
                                        required>
                                        <option value="">Select Talla</option>
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>
                                    </div>
                                    <!-- Peso -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Peso:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control"
                                        placeholder="Peso"
                                        name="PesoProduct"
                                        id="pesoProductAdd"
                                        maxlength="50"
                                        required
                                        pattern = "[.\\,\\0-9]{1,}"
                                        onchange="validatejs(event, 'numbers')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                    <!-- Altura -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Altura:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control"
                                        placeholder="Altura"
                                        name="AlturaProduct"
                                        id="alturaProductAdd"
                                        maxlength="50"
                                        required
                                        pattern = "[.\\,\\0-9]{1,}"
                                        onchange="validatejs(event, 'numbers')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                    <!-- Precio -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Precio:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control precioProduct"
                                        placeholder="Precio"
                                        name="precioProduct"
                                        maxlength="50"
                                        id="precioProductAdd"
                                        required
                                        pattern = '[.\\,\\0-9]{1,}'
                                        onchange="validatejs(event, 'numbers')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                   <!-- Catidad -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Cantidad:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control"
                                        placeholder="Cantidad"
                                        name="CantiProduct"
                                        maxlength="50"
                                        id="cantidadProductAdd"
                                        value="0"
                                        required
                                        pattern = '[.\\,\\0-9]{1,}'
                                        onchange="validatejs(event, 'numbers')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                </div>
                                <button type="button" class="ps-btn ps-btn--fullwidth" onclick="agregarProductTicket('pedido')">Agregar</button>
                            </div>
                            <div class="form-group">
                                <label>ESPESIFICACIONES ENTREGA<sup class="text-danger">*</sup></label>                
                                <div class="row mb-5">
                                     <!-- Pago Previo -->
                                     <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Pago Prev:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control"
                                        placeholder="Pago previo"
                                        name="pagoPrevProduct"
                                        maxlength="50"
                                        id="pagoPrevProductAdd"
                                        value="0"
                                        required
                                        pattern = '[.\\,\\0-9]{1,}'
                                        onchange="validatejs(event, 'numbers'),resetCampo('pagoPrev')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                    <!-- Envio -->
                                    <!-- <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                ENVIO:
                                            </span>
                                        </div>
                                        <input class="form-control" id="envioProductAdd" name="envioProduct" type="checkbox">
                                    </div> -->
                                    <!-- Dia -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Dia:
                                            </span>
                                        </div>
                                        <input 
                                        type="date"
                                        class="form-control"
                                        placeholder="Dia"
                                        name="diaProduct"
                                        id="diaProductAdd"
                                        maxlength="50"
                                        required
                                        pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                        onchange="validatejs(event, 'parrafo')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                    <!-- Hora -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Hora:
                                            </span>
                                        </div>
                                        <input 
                                        type="time"
                                        class="form-control"
                                        placeholder="Hora"
                                        name="horaProduct"
                                        id="horaProductAdd"
                                        maxlength="50"
                                        required
                                        pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                        onchange="validatejs(event, 'parrafo')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                    <!-- Transporte -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Linea:
                                            </span>
                                        </div>
                                        <?php
                                            $data = file_get_contents("views/json/Transportes.json");
                                            $transportes= json_decode($data);
                                            //echo '<pre>'; print_r($value3->tipoTrasporte); echo '</pre>';
                                        ?>
                                        <select 
                                        class="form-control"
                                        name="TransporteProduct"
                                        id="transporteProductAdd"
                                        onchange="changeTransporte(event, 'Linea')"
                                        required>
                                            <option value="">Seleccionar Transporte</option>
                                            <?php foreach($transportes as $key2 => $value3):?>
                                                <?php foreach($value3->tipoTrasporte as $key3 => $value4):?>
                                                    <option value="<?php echo $value4; ?>"><?php echo $value4; ?></option>
                                                    <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>
                                    </div>
                                    <!-- Linea -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3 LineaProduct" style="display: none ;">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Linea:
                                            </span>
                                        </div>
                                        <select 
                                            class="form-control"
                                            name="LineaProduct"
                                            id="lineaProductAdd"
                                            onchange="changeTransporte(event, 'Estacion')"
                                            required>
                                            <option value="">Select Linea</option>
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>
                                    </div>
                                    <!-- Estacion -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3 EstacionProduct" style="display: none ;">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Estacion:
                                            </span>
                                        </div>
                                        <select 
                                            class="form-control"
                                            name="EstacionProduct"
                                            id="estacionProductAdd"
                                            onchange="resetCampo('estacion')"
                                            required>
                                            <option value="">Select Color</option>
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>
                                    </div>
                                    <!-- Nombre -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                nombre:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control"
                                        placeholder="Nombre cliente"
                                        name="nombreProduct"
                                        id="nameProductAdd"
                                        maxlength="50"
                                        required
                                        pattern = '[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}'
                                        onchange="validatejs(event, 'text')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                    <!-- Telefono -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Telefono:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control"
                                        placeholder="Telefono cliente"
                                        name="telefonoProduct"
                                        maxlength="50"
                                        id="telefonoProductAdd"
                                        required
                                        pattern = '[-\\(\\)\\0-9 ]{1,}'
                                        onchange="validatejs(event, 'phone')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                    <!-- Messenguer -->
                                    <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Messenger:
                                            </span>
                                        </div>
                                        <input 
                                        type="text"
                                        class="form-control"
                                        placeholder="Id messenger"
                                        name="messengerProduct"
                                        maxlength="50"
                                        required
                                        pattern = '[.\\,\\0-9]{1,}'
                                        onchange="validatejs(event, 'numbers')">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Acompleta el campo</div>
                                    </div>
                                </div>
                                <button type="button" class="ps-btn ps-btn--fullwidth" onclick="agregarProductTicket('contacto')">Agregar</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group submit">
                                <?php
                                $newPass = new ControllerUser();
                                $newPass->AgregarNewRegister();
                                ?>
                                <button type="submit" class="ps-btn ps-btn--fullwidth">Registrar</button>
                            </div>
                        </div> 
                    </div>
                    <div class="col-xl-7 col-lg-4 col-sm-12 p-5">
                        <div class="ps-form__total">
                        <img src='img/users/default/fondo3.png' class="rounded mx-auto d-block" alt="fondo.png">
                            <h3 class="ps-form__heading">Ticket de Compra</h3>
                            <div class="content">
                                <div class="ps-block--checkout-total">
                                <div class="ps-block__header d-flex justify-content-between">
                                    <p>Product</p>
                                    <p>Total</p>
                                </div>
                                    <?php 
                                        // if(isset($_COOKIE["listSC"]) && json_decode($_COOKIE["listSC"]) != []){
                                        //     $order=json_decode($_COOKIE["listSC"], true);
                                        // }else{
                                        //     echo '<script>
                                        //             window.location="' . $path .'";
                                        //     </script>';
                                        //     return;
                                        // }
                                        // $order = array();
                                    ?>
                                    <div class="ps-block__content">
                                        <table class="table ps-block__products">
                                            <tbody class="product_name_order">
                                                <input type="hidden" class="nombreProduct" value="Abrigo de lana acolchado,Abrigo Trinde Lujo,Bandolera">
                                                <input type="hidden" class="cantidad" value="1,2,3">
                                                <input type="hidden" class="subtotal" value="900,800,400">
                                                <input type="hidden" class="salesProduct" value="<?php //echo $pOrder->sales_product ?>">
                                                <input type="hidden" class="stockProduct" value="<?php //echo $pOrder->stock_product ?>">
                                                <input type="hidden" class="deliverytime" value="<?php //echo $pOrder->delivery_time_product ?>">
                                                <input type="hidden" class="numerostar" value="<?php //echo $numero ?>">
                                                <input type="hidden" class="estrellaStar" value="<?php //echo $estrella ?>">
                                                <input type="hidden" id="envioSubmit" value="0">
                                                <input type="hidden" id="pagoPrevProductSubmit" value="0">
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <h5 class="text-right totalOrder" total="<?php //echo $totalPriceSC2; ?>">Envio $ <span class="envioSubmit">0</span></h5>
                                        <h5 class="text-right totalOrder" total="<?php //echo $totalPriceSC2; ?>">Pago Previo $ -<span class="PagoPrev_ticket">0</span></h5>
                                        <h3 class="text-right totalOrder" total="<?php //echo $totalPriceSC2; ?>">Total $<span class="totalOrder_ticket"> 0</span></h3>
                                        <div>Contacto:<strong><span class="telefonoTicket"> <?php //echo $count; ?></span></strong></div>
                                        <div>Nombre:<strong><span class="nameTicket"> <?php //echo $count; ?></span></strong></div>
                                        <div>Estacion:<strong><span class="estacionTicket"> <?php //echo $count; ?></span></strong></div>
                                        <div>Fecha:<strong><span class="fechaTicket"> <?php //echo $count; ?></span></strong></div>
                                        <div>Hora:<strong><span class="horaTicket"> <?php //echo $count; ?></span></strong></div>
                                        <div class="text-center"><strong>Hecho en México por</strong></div>
                                        <div class="text-center">Altitex Services SA de CV</div>
                                        <div class="text-center">5564115039</div>
                                        <div class="text-center">bersani.mx@gmail.com</div>
                                        <div class="text-center">https://www.facebook.com/Bersani.shop</div>
                                        <div class="text-center">https://instagram.com/bersani.shop</div>
                                    </div>
                                </div>
                                <?php if($_SESSION["user"]->method_user == "direct"): ?>
                                <hr class="py-3">
                                <div class="form-group">
                                    <div class="ps-radio">
                                        <input class="form-control" type="radio" id="pay-paypal" name="payment-method" value="paypal" checked onchange="changemetodpay(event)">
                                        <label for="pay-paypal">Pay with paypal?  <span><img src="img/payment-method/paypal.jpg" class="w-50"></span></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="ps-radio">
                                        <input class="form-control" type="radio" id="pay-payu" name="payment-method" value="payu" onchange="changemetodpay(event)">
                                        <label for="pay-payu">Pay with payu? <span><img src="img/payment-method/payu.jpg" class="w-50"></span></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="ps-radio">
                                        <input class="form-control" type="radio" id="pay-mercadopago" name="payment-method" value="mercado-pago" onchange="changemetodpay(event)">
                                        <label for="pay-mercadopago">Pay with Mercado Pago? <span><img src="img/payment-method/mercado_pago.jpg" class="w-50"></span></label>
                                    </div>
                                </div>
                                <button type="submit" class="ps-btn ps-btn--fullwidth">Proceed to checkout</button>
                                <?php endif; ?>
                                <?php if($_SESSION["user"]->method_user == "globalAdminister"): ?>
                                    <!-- <div class="form-group">
                                        <div class="ps-radio">
                                            <input class="form-control" type="radio" id="pay-efectivo" name="payment-method" value="efectivo" checked onchange="changemetodpay(event)">
                                            <label for="pay-efectivo">Pay with efectivo? <span><img src="img/payment-method/mercado_pago.jpg" class="w-50"></span></label>
                                        </div>
                                    </div> -->
                                    <div class="d-flex flex-row-reverse">
                                        <button title="PDF" type="button" class="ps-btn mt-5" onclick="pdfRegister('<?php echo TemplateController::path(); ?>')">Crear Ticket</button>
                                    </div>
                        
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


            
        

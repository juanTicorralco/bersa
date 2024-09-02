<?php
    if(isset($_GET["Editar"])){
        $select = "id_order,code_stock_order,envio_order,url_product,pago_prev_order,url_category,image_product,hour_order,name_product,id_category,id_product,image_stock,name_buyer_order,phone_order,stacion_order,day_order,spesifications_order,status_order,price_order,follow_order,name_product,color_stock,size_stock,color_hexa_stock,stock_out_order,number_stock,id_stock_order";
        $url = CurlController::api()."relations?rel=orders,products,categories,stocks&type=order,product,category,stock&linkTo=id_order&equalTo=".$_GET["Editar"]."&select=".$select."&token=".$_SESSION["user"]->token_user;
        $method = "GET";
        $fields = array();
        $headers = array();
        $editProduct = CurlController::request($url,$method,$fields,$headers)->result[0];
    }
?>
<?php if($editProduct == "n"): ?>
    <h4 class="text-center">No existe este producto en tu inventario</h4><br>
<?php else: ?>
    <form class="ps-form--account ps-tab-root needs-validation" novalidate method="post">
       
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title text-center">EDITAR ORDEN</h5>
                <a href="<?php echo TemplateController::path() ?>acount&registers" class="btn btn-danger">Cancel</a>
            </div>
            <div class="modal-body text-left p-5">
                <!-- Product -->
                <div class="form-group">
                    <label>Producto<sup class="text-danger">*</sup></label>
                    <div class="form-group__content">
                        <select 
                        class="form-control"
                        name="Selectedit"
                        onclick="changeProduct(event)"
                        required
                        readonly>    
                        <option class="Selectedit" value="<?php echo $editProduct->id_category."_".$editProduct->id_product."_".$editProduct->name_product; ?>"><?php echo $editProduct->name_product; ?></option>
                        </select>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">El nombre es requerido</div>
                    </div>
                    <figure id="imageProduct" class="imageProduct">
                        <img src="img/products/<?php echo $editProduct->url_category; ?>/stock/<?php echo $editProduct->image_stock; ?>" alt="img" class="p-0 m-0 img-circle mw-50 mx-auto d-block imgfunStock">
                    </figure>
                    <div class="stokeorderProduct"></div>
                    <input type="hidden" class="idTalla" value="<?php echo $editProduct->id_stock_order."_".$editProduct->size_stock; ?>">
                    <input type="hidden" class="idColor" value="<?php echo $editProduct->id_stock_order."_".$editProduct->color_stock; ?>">
                    <input type="hidden" name="stockApro" class="stockApro" value="<?php echo $editProduct->stock_out_order;  ?>">
                    <input type="hidden" name="idOrderUP" value="<?php echo $editProduct->id_order;  ?>">
                    <input type="hidden" name="numOrderStock" value="<?php echo $editProduct->code_stock_order;  ?>">
                    <input type="hidden" name="stockAproOld" value="<?php echo $editProduct->stock_out_order;  ?>">
                    <input type="hidden" name="numberStockols" value="<?php echo $editProduct->number_stock;  ?>">
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
                            name="Coloredit"
                            onchange="changeColor(event)"
                            required>
                            <option value="<?php echo $editProduct->id_stock_order."_".$editProduct->color_stock; ?>"><?php echo $editProduct->color_stock; ?></option>
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
                            name="Tallaedit"
                            onclick="changeTalla(event)"
                            required>
                            <option value="<?php echo $editProduct->id_stock_order."_".$editProduct->size_stock; ?>"><?php echo $editProduct->size_stock; ?></option>
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
                            name="Pesoedit"
                            maxlength="50"
                            value="<?php echo json_decode($editProduct->spesifications_order,true)[0]["peso"][0];?>"
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
                            name="Alturaedit"
                            maxlength="50"
                            value="<?php echo json_decode($editProduct->spesifications_order,true)[0]["altura"][0];?>"
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
                            name="precioedit"
                            maxlength="50"
                            value="<?php echo $editProduct->price_order;?>"
                            required
                            pattern = '[.\\,\\0-9]{1,}'
                            onchange="validatejs(event, 'numbers')">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Acompleta el campo</div>
                        </div>
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
                            name="pagoPrevedit"
                            maxlength="50"
                            value="<?php echo $editProduct->pago_prev_order;?>"
                            value="0"
                            required
                            pattern = '[.\\,\\0-9]{1,}'
                            onchange="validatejs(event, 'numbers')">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Acompleta el campo</div>
                        </div>
                        <!-- Envio -->
                        <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    ENVIO:
                                </span>
                            </div>
                            <?php if($editProduct->envio_order == 1): ?>
                                <input class="form-control" name="envioedit" type="checkbox" checked>
                            <?php else: ?>
                                <input class="form-control" name="envioedit" type="checkbox" >
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>ESPESIFICACIONES ENTREGA<sup class="text-danger">*</sup></label>                
                    <div class="row mb-5">
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
                            name="diaedit"
                            maxlength="50"
                            required
                            value="<?php echo $editProduct->day_order;?>"
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
                            name="horaedit"
                            maxlength="50"
                            value="<?php echo $editProduct->hour_order;?>"
                            required
                            pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                            onchange="validatejs(event, 'parrafo')">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Acompleta el campo</div>
                        </div>
                        <!-- Linea -->
                        <div class="col-12 col-lg-6 form-group__content input-group mx-0 pr-0 mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    Linea:
                                </span>
                            </div>
                            <?php
                                $data = file_get_contents("views/json/metro.json");
                                $metro= json_decode($data, true);
                            ?>
                            <select 
                            class="form-control"
                            name="SelectLinea"
                            onchange="changeLinea(event)"
                            required>
                                <option value="">Seleccionar Linea</option>
                                <?php foreach($metro as $key => $value): print_r($value['_id']);  ?>
                                    <?php if(key($value)=="nombre"): ?>
                                    <option value="<?php echo $value['_id']['v']."_".$value['nombre']; ?>"><?php echo $value["nombre"]; ?></option>
                                        <?php endif ?>
                                <?php endforeach; ?>
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
                                name="Estacionedit"
                                required>
                                <option value="1_<?php echo $editProduct->stacion_order;?>"><?php echo $editProduct->stacion_order; ?></option>
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
                            name="nombreedit"
                            maxlength="50"
                            value="<?php echo $editProduct->name_buyer_order;?>"
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
                            name="telefonoedit"
                            value="<?php echo $editProduct->phone_order;?>"
                            maxlength="50"
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
                            name="messengeredit"
                            value="<?php echo $editProduct->follow_order;?>"
                            maxlength="50"
                            required
                            pattern = '[.\\,\\0-9]{1,}'
                            onchange="validatejs(event, 'numbers')">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Acompleta el campo</div>
                        </div>
                    </div>
                </div>
                <div class="form-group submtit">
            </div>
            <div class="modal-footer">
                <div class="form-group submit">
                    <button class="ps-btn ps-btn-fullwidth" type="submit">Editar</button>
                    <?php 
                        $editProduct =new ControllerUser();
                        $editProduct->editRegister();
                    ?>
                </div>
            </div>
       
</form>
<?php endif; ?>
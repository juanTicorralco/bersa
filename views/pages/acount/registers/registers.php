<?php
if (!isset($_SESSION['user'])) {
    echo '<script>
            window.location="' . $path . 'acount&login";
    </script>';
    return;
}else{
    $time= time();
    if($_SESSION["user"]->token_exp_user < $time){
        echo '<script>
        switAlert("error", "Para proteger tus datos, si no hay actividad en tu cuenta, se cierra automaticamente. Vuelve a logearte!", "' . $path . 'acount&logout","");
            
    </script>';
    return;
    }else{
        // traer la lista de deseos
        $products= array();
        $select="id_order,url_product,pago_prev_order,url_category,image_stock,hour_order,name_product,name_buyer_order,phone_order,stacion_order,day_order,spesifications_order,status_order,price_order,follow_order,name_product,color_stock,size_stock,color_hexa_stock,stock_out_order,number_stock,id_stock_order";
        $method= "GET";
        $header= array();
        $filds= array();
        if(isset($_GET["entregados"])){
            $url= CurlController::api()."relations?rel=orders,products,categories,stocks&type=order,product,category,stock&linkTo=status_order&equalTo=Finalizado&orderBy=day_order&orderMode=DESC&select=".$select."&token=".$_SESSION["user"]->token_user;
            $response= CurlController::request($url, $method, $header, $filds);
            if($response->status == 200){
                array_push($products, $response->result);
            }
        }else if(isset($_GET["cancelados"])){
            $url= CurlController::api()."relations?rel=orders,products,categories,stocks&type=order,product,category,stock&linkTo=status_order&equalTo=cancelado&orderBy=day_order&orderMode=DESC&select=".$select."&token=".$_SESSION["user"]->token_user;
            $response= CurlController::request($url, $method, $header, $filds);
            if($response->status == 200){
                array_push($products, $response->result);
            }
        }else{
            date_default_timezone_set('UTC');
            date_default_timezone_set("America/Mexico_City");
            $date = date("Y-m-d");
            $between1 =  date("Y-m-d",strtotime($date."- 10 days"));
            $between2 = date("Y-m-d",strtotime($date."+ 10 days"));
            $url= CurlController::api()."relations?rel=orders,products,categories,stocks&type=order,product,category,stock&linkTo=day_order&between1=".$between1."&between2=".$between2."&filterTo=status_order&inTo=Cancelado,Finalizado&not=not&select=".$select."&token=".$_SESSION["user"]->token_user;
            $response= CurlController::request($url, $method, $header, $filds);
            if($response->status == 200){
                array_push($products, $response->result);
            }
        }
    }
    //  echo '<pre>'; print_r($products); echo '</pre>'; 
    //                                      return;
}
?>
<!--=====================================
My Account Content
======================================-->
<div class="ps-vendor-dashboard pro">
    <div class="container">
        <div class="ps-section__header mt-0">
            <!--=====================================
            Profile
            ======================================-->
            <?php include "views/pages/acount/profile/profile.php"; ?>
            <!--=====================================
            Nav Account
            ======================================-->
            <div class="ps-section__content">
                <ul class="ps-section__links">
                    <?php if($_SESSION["user"]->method_user == "direct"): ?>
                    <li><a href="<?php echo $path; ?>acount&orders">Ordenes</a></li>
                    <li class="active"><a href="<?php echo $path; ?>acount&registers">Registros</a></li>
                    <li><a href="<?php echo $path; ?>acount&inventario">Inventario</a></li>
                    <li><a href="<?php echo $path; ?>acount&wishAcount">My Wishlist</a></li>
                    <li><a href="<?php echo $path; ?>acount&my-shopping">My Shopping</a></li>
                    <?php endif; ?>
                    <?php if($_SESSION["user"]->method_user == "administer"): ?>
                    <li ><a href="<?php echo $path; ?>acount&my-shopping">My Shopping</a></li>
                    <li><a href="<?php echo $path; ?>acount&list-vendor">Lista vendidos</a></li>
                    <?php endif; ?>
                    <?php if($_SESSION["user"]->method_user == "globalAdminister"): ?>
                    <li><a href="<?php echo $path; ?>acount&my-store">My Store</a></li>
                    <li><a href="<?php echo $path; ?>acount&my-sales">My Sales</a></li>
                    <?php endif; ?>
                </ul>
                <?php if(isset($_GET["Editar"]) && is_numeric($_GET["Editar"])):?>
                    <?php  include_once("modules/editRegister.php"); ?>
                <?php else:?>
                    <!--=====================================
                    Wishlist
                    ======================================-->
                    <button class="btn btn-dark btn-lg m-3" data-toggle="modal" data-target="#registerNew">Nuevo</button>
                    <a href="http://bersani.com/acount&registers?entregados" type="button" class="btn btn-success btn-lg m-3">Entregados</a>
                    <a href="http://bersani.com/acount&registers?cancelados" type="button" class="btn btn-danger btn-lg m-3">Cancelados</a>
                    <div class="table-responsive ">
                        <table class="table ps-table--whishlist dt-responsive dt-client pr-5">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre producto</th>
                                    <th>Nombre cliente</th>
                                    <th>Estacion</th>
                                    <th>Hora</th>
                                    <th>Color</th>
                                    <th>Talla</th>
                                    <th>Peso</th>
                                    <th>Altura</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                    <th>Precio</th>
                                    <th>Pago previo</th>
                                    <th>Messenger</th>
                                    <th>Telefono</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Product -->
                                <?php
                                if(count($products) >0):
                                foreach ($products[0] as $key => $value):?>
                                    <tr >
                                        <?php
                                            if($value->stock_out_order == 0){
                                                $colorStock = "danger";
                                            }else if($value->stock_out_order == 1){
                                                $colorStock = "success";
                                            }
                                        ?>
                                        <td class="bg-<?php echo $colorStock; ?>">
                                            <div class="ps-product--cart">
                                                <div class="ps-product__thumbnail">
                                                    <a href="<?php echo $path . $value->url_product; ?>">
                                                        <img src="img/products/<?php echo $value->url_category; ?>/stock/<?php echo $value->image_stock; ?>" alt="<?php echo $value->name_product; ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="ps-product__content"><a href="<?php echo $path . $value->url_product; ?>"><?php echo $value->name_product; ?></a></div></td>
                                        <td><div class="ps-product__content"><?php echo $value->name_buyer_order; ?></div></td>
                                        <td><div class="ps-product__content"><?php echo $value->stacion_order; ?></div></td>
                                        <?php $hour_order= date("g:i a",strtotime($value->hour_order));?>
                                        <td><div class="ps-product__content"><?php echo $hour_order; ?></div></td>
                                        <?php $spesificationsProduct = json_decode($value->spesifications_order);
                                        if($value->color_hexa_stock == "000000"){
                                            $textColor= "#FFF";
                                        }else{
                                            $textColor= "#000";
                                        }
                                        ?>
                                        <td style="background-color: #<?php echo $value->color_hexa_stock; ?>;color: <?php echo $textColor; ?>;"><div class="ps-product__content"><?php echo $value->color_stock; ?></div></td>
                                        <td><div class="ps-product__content"><?php echo $value->size_stock; ?></div></td>
                                        <td><div class="ps-product__content"><?php echo $spesificationsProduct[0]->peso[0];?></div></td>
                                        <td><div class="ps-product__content"><?php echo $spesificationsProduct[0]->altura[0];?></div></td>
                                        <td><div class="ps-product__content"><?php echo $value->status_order; ?></div></td>
                                        <td>
                                        <input type="hidden" id="url" value="<?php echo $path ?>" >
                                            <?php if($value->status_order == "Pendiente" && $value->stock_out_order ==1): ?>
                                            <button title="Confirmar" type="button" class="btn btn-success rounded-circle mr-2" onclick="statusConfirmRegister(<?php echo $value->stock_out_order ?>,<?php echo $value->number_stock;?>,<?php echo $value->id_stock_order;?>,<?php echo $value->id_order;?>,'Confirmado', '<?php echo CurlController::api(); ?>')"><i class='fa  fa-check-square'></i></button>
                                            <?php endif; ?>
                                            <?php if($value->stock_out_order == 0): ?>
                                            <button title="En Stock" type="button" class="btn btn-success rounded-circle mr-2" onclick="plusStock(<?php echo $value->id_order;?>, '<?php echo CurlController::api(); ?>')"><i class='fa  fa-plus'></i></button>
                                            <?php endif; ?>
                                            <a title="Editar" href="http://bersani.com/acount&registers?Editar=<?php echo $value->id_order; ?>" class="btn btn-info rounded-circle mr-2"><i class='fa fa-pencil-alt'></i></a>
                                            <button title="Cancelar" type="button" class="btn btn-danger rounded-circle mr-2" onclick="statusConfirmRegister(<?php echo $value->stock_out_order ?>,<?php echo $value->number_stock;?>,<?php echo $value->id_stock_order;?>,<?php echo $value->id_order;?>,'Cancelado', '<?php echo CurlController::api(); ?>')"><i class='fa fa-trash'></i></button>
                                        </td>
                                        <td><div class="ps-product__content"><?php echo '$'. $value->price_order; ?></div></td>
                                        <td><div class="ps-product__content"><?php echo $value->pago_prev_order; ?></div></td>
                                        <td><a href="https://www.facebook.com/messages/t/<?php echo $value->follow_order; ?>" target='_blank' class='btn btn-info rounded-circle mr-2'><i class='fa fa-eye'></i></a></td>
                                        <td><div class="ps-product__content"><?php echo $value->phone_order; ?></div></td>
                                        <?php $fecha = date("d/m", strtotime($value->day_order));  ?>
                                        <td><div class="ps-product__content"><?php echo $fecha; ?></div></td>
                                    </tr>
                                <?php endforeach;  endif;  ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="registerNew">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Registro</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="ps-form--account ps-tab-root needs-validation" novalidate method="post">
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
                    <div class="form-group">
                        <label>Producto<sup class="text-danger">*</sup></label>
                        <?php
                            $url = CurlController::api()."relations?rel=products,categories&type=product,category&select=id_product,name_product,url_product,id_category";
                            $method= "GET";
                            $header= array();
                            $fields= array();
                            
                            $produts= CurlController::request($url, $method, $header, $fields)->result;
                        ?>
                        <div class="form-group__content">
                            <select 
                            class="form-control"
                            name="SelectProduct"
                            onchange="changeProduct(event)"
                            required>
                                <option value="">Seleccionar producto</option>
                                <?php foreach($produts as $key => $value):?>
                                    <option class="Selectedit" value="<?php echo $value->id_category."_".$value->id_product."_".$value->name_product; ?>"><?php echo $value->name_product; ?></option>
                                <?php endforeach; ?>
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
                                name="pagoPrevProduct"
                                maxlength="50"
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
                                <input class="form-control" name="envioProduct" type="checkbox">
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
                                name="diaProduct"
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
                                maxlength="50"
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
                                    name="EstacionProduct"
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
                    </div>
                    <div class="form-group submtit">

                        <?php
                        $newPass = new ControllerUser();
                        $newPass->AgregarNewRegister();
                        ?>

                        <button type="submit" class="ps-btn ps-btn--fullwidth">Registrar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
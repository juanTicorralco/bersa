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
        $select="url_product,url_category,image_product,name_product,id_product";
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
            $url= CurlController::api()."relations?rel=products,categories&type=product,category&select=".$select;
            $response= CurlController::request($url, $method, $header, $filds);
            if($response->status == 200){
                array_push($products, $response->result);
            }

        }
    }
    // echo '<pre>'; print_r($products); echo '</pre>'; 
    // return;
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
                    <li><a href="<?php echo $path; ?>acount&registers">Registros</a></li>
                    <li class="active"><a href="<?php echo $path; ?>acount&inventario">Inventario</a></li>
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
                                <th>Colores</th>
                                <th>Tallas</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                                <th>Actualizacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product -->
                            <?php
                            if(count($products) >0):
                            foreach ($products[0] as $key => $value):?>
                                <tr >
                                    <?php
                                        $stockProduct = [];
                                         $select="number_stock";
                                         $url= CurlController::api()."stocks?linkTo=id_product_stock&equalTo=".$value->id_product."&counTo=color_stock,size_stock&select=".$select;
                                         $response= CurlController::request($url, $method, $header, $filds);
                                         if($response->status == 200){
                                             array_push($stockProduct, $response->result);
                                         }
                                    ?>
                                    <td>
                                        <div class="ps-product--cart">
                                            <div class="ps-product__thumbnail">
                                                <a>
                                                    <img src="img/products/<?php echo $value->url_category; ?>/<?php echo $value->image_product; ?>" alt="<?php echo $value->name_product; ?>">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><div class="ps-product__content"><a href="<?php echo $path . $value->url_product; ?>"><?php echo $value->name_product; ?></a></div></td>
                                    <td><div class="ps-product__content">
                                    <?php foreach($stockProduct[0] as $key2 => $value2){
                                        if(isset($value2->color_stock)){
                                            echo $value2->color_stock;
                                            echo "<br>";
                                        }
                                    } 
                                    ?>
                                    </div></td>
                                    <td><div class="ps-product__content">
                                    <?php foreach($stockProduct[0] as $key2 => $value2){
                                        if(isset($value2->size_stock)){
                                            echo $value2->size_stock;
                                            echo "<br>";
                                        }
                                    } 
                                    ?>
                                    </div></td>
                                    <td><div class="ps-product__content">
                                    <?php foreach($stockProduct[0] as $key2 => $value2){
                                        if(isset($value2->number_stock)){
                                            echo $value2->number_stock;
                                        }
                                    } 
                                    ?>
                                    </div></td>
                                    <td><a target="_blank" class="btn btn-success rounded-circle mr-2"><i class='fa  fa-check-square'></i></a>
                                        <a target="_blank" class="btn btn-info rounded-circle mr-2"><i class='fa fa-pencil-alt'></i></a>
                                        <a target="_blank" class="btn btn-danger rounded-circle mr-2"><i class='fa fa-trash'></i></a>
                                        <a target='_blank' class='btn btn-info rounded-circle mr-2'><i class='fa fa-eye'></i></a>
                                    </td>
                                    <td><div class="ps-product__content">
                                    <?php foreach($stockProduct[0] as $key2 => $value2){
                                        if(isset($value2->date_update_stock)){
                                            echo $value2->date_update_stock;
                                        }
                                    } 
                                    ?>
                                    </div></td>
                                </tr>
                            <?php endforeach;  endif;  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div
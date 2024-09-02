<footer class="ps-footer">
    <div class="container">
        <div class="ps-footer__widgets">
            <!--=====================================
            Contact us
            ======================================-->
            <aside class="widget widget_footer widget_contact-us">
                <h4 class="widget-title">Contactanos</h4>
                <div class="widget_content">
                    <p>Whatsapp 24/7</p>
                    <h3>55-64-11-50-39</h3>
                    <p>Ciudad de México, CDMX <br><a href="mailto:bersani.mx@gmail.com">bersani.mx@gmail.com</a></p>
                    <ul class="ps-list--social">
                        <li><a class="facebook" href="https://www.facebook.com/Bersani.shop/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="google-plus" href="https://youtube.com/@BERSANI-shop" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        <li><a class="instagram" href="https://instagram.com/bersani.shop" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </aside>
            <!--=====================================
            Quick Links
            ======================================-->
            <aside class="widget widget_footer">
                <h4 class="widget-title">Quick links</h4>
                <ul class="ps-list--link">
                    <li><a >Policy</a></li>
                    <li><a >Term &amp; Condition</a></li>
                    <li><a >Shipping</a></li>
                    <li><a >Return</a></li>
                    <li><a >FAQs</a></li>
                </ul>
            </aside>
            <!--=====================================
            Company
            ======================================-->
            <aside class="widget widget_footer">
                <h4 class="widget-title">Company</h4>
                <ul class="ps-list--link">
                    <li><a >About Us</a></li>
                    <li><a >Affilate</a></li>
                    <li><a >Career</a></li>
                    <li><a >Contact</a></li>
                </ul>
            </aside>
            <!--=====================================
            Bussiness
            ======================================-->
            <aside class="widget widget_footer">
                <h4 class="widget-title">Bussiness</h4>
                <ul class="ps-list--link">
                    <li><a >Our Press</a></li>
                    <li><a >Checkout</a></li>
                    <li><a >My account</a></li>
                    <li><a >Shop</a></li>
                </ul>
            </aside>
        </div>
        <!--=====================================
        Categories Footer
        ======================================-->
        <div class="ps-footer__links">
            <!-- filter the categories and subcategories -->
            <h5>Categorias</h5>
            <?php foreach($menuCategories as $key => $value): ?>
            <p>
                <strong> <?php echo $value->name_category;?> </strong>
                <?php        
                $url = CurlController::api() . "subcategories?linkTo=id_category_subcategory&equalTo=" . rawurlencode($value->id_category)."&select=url_subcategory,name_subcategory";
                $method= "GET";
                $field=array();
                $header=array();
                $menuSubcategories=CurlController::request($url, $method, $field, $header)->result;
                ?>
                <?php if(isset($menuSubcategories) && $menuSubcategories != "no found"): 
                    foreach($menuSubcategories as $key => $value): ?>
                    <a href="<?php echo $path.$value->url_subcategory;?>"> <?php echo $value->name_subcategory;?> </a>
                <?php endforeach; 
                endif; ?>
            </p>
            <?php endforeach; ?>
        </div>
        <!--=====================================
        CopyRight - Payment method Footer
        ======================================-->
        <div class="ps-footer__copyright">
            <p>© 2023 Bersani. Todos los derechos reservados</p>
            <p>
                <span>Usamos pagos seguros con:</span>
                <a ><img src="img/payment-method/5.jpg" alt=""></a>
                <a ><img src="img/payment-method/3.jpg" alt=""></a>
                <a ><img src="img/payment-method/1.jpg" alt=""></a>
                <a ><img src="img/payment-method/2.jpg" alt=""</a>
                <a ><img src="img/payment-method/4.jpg" alt=""</a>
            </p>
        </div
    </div
</footer>
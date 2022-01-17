<!DOCTYPE html>
<html>
    <?php include 'header.php';
    
    //Navigation record
    if(isset($_SESSION['navigation']) && $_SESSION['role']=='user'){
        array_push($_SESSION['navigation'], array("Home Page" => date("Y-m-d H:i:s")));
    }

    ?>

    <body>
        <main>
            <div class="gif">
                <img src="src/slide.gif" alt="slide">
            </div>
            <div class="products">
                <div>
                    <img src="src/butter_sugar.png" alt="butter-sugar">
                </div>
                <div class="products-contents">
                    <h2>Check out our Latest Product now!</h2>
                    <p>Try the creamy buttery goodness of Gardenia</p>
                    <p>Delicious . Fresh . Convenient</p>
                    <button class="pacifico_normal" type="button" onclick="document.location='products.php'">Know More</button>
                </div>
            </div>
        </main>

        <footer>
            <div class="footer-container">
                <div class="icon" id="contactus">
                    <h3 class="pacifico_normal">Contact Us</h3>
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p>Lot 3, Jalan Pelabur 23/1, 40300 Shah Alam, Selangor Darul Ehsan Malaysia</p>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p>customer_service@gardenia.com.my</p>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <p>03-55423228</p>
                    </div>
                </div>
                <div class="subscribe">
                    <h3 class="pacifico_normal">Subscribe</h3>
                    <form method="POST">
                        <input type="email" id="Sub-email" name="Sub-email" placeholder="Enter your Email ">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="bottom">
                <div class="social-media">
                    <div class="social-media-container">
                        <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="src/fb.png" alt="Facebook"></a>
                        <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img src="src/ig.png" alt="Instagram"></a>
                        <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="src/tw.png" alt="Twitter"></a>
                        <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img src="src/yt.png" alt="Youtube"></a>
                    </div>
                </div>
                <p>Copyright &copy (2004-2018) Gardenia Bakeries (KL) Sdn. Bhd (139386X) All Rights Reserved. | <a href="#">PRIVACY</a></p>
            </div>
        </footer>
    </body>
</html>

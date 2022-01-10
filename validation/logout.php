<?php
    session_start();
    include '../validation/connectSQL.php';

    //Navigation record
    if (isset($_SESSION['navigation'])) {
        array_push($_SESSION['navigation'], array("Logout" => date("Y-m-d H:i:s")));
        $navigation = $_SESSION['navigation'];
    }

    //Remove COOKIE Created
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
    
    if (isset($_COOKIE['anonymousID'])) {
        $anonymousID = $_COOKIE['anonymousID'];
        $sql = "DROP TABLE anonymous_$anonymousID";
        $result = mysqli_query($conn, $sql);
        unset($_COOKIE['anonymousID']);
    }
    
    if (isset($_COOKIE['productID'])) {
        unset($_COOKIE['productID']);
    }

    //Direct back to index.php if role == admin
    if ($_SESSION['role'] == 'admin') {
        session_unset();
        session_destroy();
        header('Location: ../index.php');
    }

    session_unset();
    session_destroy();
    include "../user/userHeader.php";
?>

<!DOCTYPE html>
</html>

<head>
    <style>
        table, td, th{
            border: solid black;
            border-collapse: collapse;
        }

        th, td{
            padding: 0 30px;
            font-size: large;
        }
    </style>

</head>

<body>
    <?php
    echo
    "
    <br>
    <div align='center'>
    <h2> Thank you so much for browsing our website! </h2>
    <h2> Here is your navigation record for this session. </h2>
    </div>
    <br>
    <table style='margin-left: auto; margin-right: auto;'>
        <tr>
            <th> Page Visited </th>
            <th> Timestamp </th>
        </tr>
    ";

    foreach ($navigation as $page){
        foreach($page as $name => $time){
            echo
            "
            <tr>
                <td> $name</td>
                <td> $time</td>
            </tr>
            ";
        }
    }
    echo "</table><br>";

    echo "<div align='center'>
            <h2> Hope to see you again soon! </h2>
          </div></br>";
    ?>

    <div style="display: flex; justify-content: center; margin: 20px auto 40px">
        <p>Redirecting back to home page in <span id="countdown">4</span> seconds...</p>
    </div>

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
                <form>
                    <input type="email" id="email" name="email" placeholder="Enter your Email ">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="bottom">
            <div class="social-media">
                <div class="social-media-container">
                    <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="../src/fb.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img src="../src/ig.png" alt="Instagram"></a>
                    <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="../src/tw.png" alt="Twitter"></a>
                    <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img src="../src/yt.png" alt="Youtube"></a>
                </div>
            </div>
            <p>Copyright &copy (2004-2018) Gardenia Bakeries (KL) Sdn. Bhd (139386X) All Rights Reserved. | <a href="#">PRIVACY</a></p>
        </div>
    </footer>

    <script>
        //Countdown 4 seconds
        startCountdown(3);

        //Set Logout Page Timeout for 3 seconds (Wait 3 seconds before direct back to index.php)
        setTimeout(function() {
            window.location.href = '../index.php';
        }, 4000);

        function startCountdown(seconds) {
            let counter = seconds;

            const interval = setInterval(() => {
                document.getElementById("countdown").innerHTML = counter;
                console.log(counter);
                counter--;
                if (counter < 0) {
                    clearInterval(interval);
                }
            }, 1000);
        };
    </script>
</body>
</htlm>
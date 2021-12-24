<!DOCTYPE html>
<html>
    <head>
        <title>Gardenia Bakeries (KL) Sdn Bhd</title>
        <link rel="stylesheet" href="src/style.css">
        <link rel="icon" href="src/icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .profile{
                background-color: rgba(109, 109, 109, 0.6); 
                width: 70%;
                margin: 50px auto; 
                border-radius: 12px; 
                position: relative; 
                text-align: center;
                padding: 30px;
                /* left: 50%;
                transform: translateX(-50%) */
            }

            .profile img, button{
                position: relative; 
                /* left: 50%; 
                transform: translateX(-50%); */
            }

            table{
                position: relative; 
                /* left: 50%; 
                transform: translateX(-50%); */
                border: solid black;
                border-collapse: collapse;
            }

            td, th{
                padding: 10px;
                border-bottom: solid black;
                border-collapse: collapse;
            }

            table {
                width: 100%;
            }

            i:hover, a:hover {
                cursor: pointer;
                color: #CE0101;
            }
        </style>
    </head>

    <?php include 'header.php'; ?>

    <body>
        <div class="profile">
            <img src="src/icon.png" style="border: 5px solid black; border-radius: 50%; height: 300px; width: 300px; "/>
            <br><br>
            <button>Change Profile Picture</button>
        </div>
        
        <div class="profile">
            <?php include 'validation/connectSQL.php'; 

                $userID = $_SESSION['userID'];

                $sql = "SELECT * FROM user WHERE UserID=$userID";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
            
                echo "<table>";
                echo "<tr>";
                echo "<th> Name </th>";
                echo "<td><p id='name'>$row[1]</p></td>";
                echo "<td><a onclick=editProfile(0)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th> Email </th>";
                echo "<td><p id='email'> $row[2]</p></td>";
                echo "<td><a onclick=editProfile(1)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th> Phone Number </th>";
                echo "<td><p id='phone'> $row[3]</p></td>";
                echo "<td><a onclick=editProfile(2)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th> State </th>";
                echo "<td><p id='state'> $row[4]</p></td>";
                echo "<td><a onclick=editProfile(3)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th> Gender </th>";
                echo "<td><p id='gender'> $row[5]</p></td>";
                echo "<td><a onclick=editProfile(4)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th> Password </th>";
                echo "<td><p id='password'> $row[6]</p></td>";
                echo "<td><a onclick=editProfile(5)><i class='fa fa-pencil'></i> Edit</a></td>";
                echo "</tr>";
                echo "</table>";
            ?>
        </div>

    </body>

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

        <script>
            function editProfile(type){
                typelist = ["name", "email", "phone", "state", "gender", "password"];
                const xmlhttp = new XMLHttpRequest();
                var x = document.getElementById(typelist[type]);
                xmlhttp.onload = function(){
                    x.innerHTML = this.responseText;
                    
                }
                xmlhttp.open("GET", "editProfile.php?type=" + typelist[type]);
                xmlhttp.send();
            }
        </script>
    </body>
</html>
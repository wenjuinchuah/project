<?php
    session_start();
    //Select UserID from user
    $loginUsername = $_SESSION['loginUser'];
    $userID = $_SESSION['userID'];

    $type = $_REQUEST["type"];

    include 'validation/connectSQL.php';

    $sql = "SELECT * FROM user WHERE UserID=$userID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

    if ($conn) {
        if($type == 'name'){
            echo "<form method='POST'>";
            echo "First name: <input name='firstname' type='text' />  Last name: <input name='lastname' type= 'text' />";
            echo "<br><br>";
            echo "<button>Change</button>";
            echo "</form>";
        }else if($type == 'email'){
            echo "<form>";
            echo "Email: <input name='email' type='text' />";
            echo "<br><br>";
            echo "<button>Change</button>";
            echo "</form>";
        }else if($type == "phone"){
            echo "<form>";
            echo "Phone Number: +60  <input name='phone' type='text'/>";
            echo "<br><br>";
            echo "<button>Change</button>";
            echo "</form>";
        }else if($type == "state"){
            echo "<form>";
            echo "<label>State: </label>
                    <select name='state' id='stat'>
                        <option value='state' disabled>- Select Your State-</option>
                        <option value='Johor'>Johor</option>
                        <option value='Kedah'>Kedah</option>
                        <option value='Kelantan'>Kelantan</option>
                        <option value='Melaka'>Melaka</option>
                        <option value='Negeri Sembilan'>Negeri Sembilan</option>
                        <option value='Pahang'>Pahang</option>
                        <option value='Perak'>Perak</option>
                        <option value='Perlis'>Perlis</option>
                        <option value='Pulau Pinang'>Pulau Pinang</option>
                        <option value='Sabah'>Sabah</option>
                        <option value='Sarawak'>Sarawak</option>
                        <option value='Selangor'>Selangor</option>
                        <option value='Terengganu'>Terengganu</option>
                        <option value='federal' disabled>-Federal Territories-</option>
                        <option value='Kuala Lumpur'>Kuala Lumpur</option>
                        <option value='Labuan'>Labuan</option>
                        <option value='Putrajaya'>Putrajaya</option>
                    </select>";
            echo "<br><br>";
            echo "<button>Change</button>";
            echo "</form>";
        }else if($type == "gender"){
            echo "<form>";
            echo "Gender:  
            <input type='radio' id='male' name='gender' value='Male' checked='true' />
            <label for='male'>Male</label>
            <input type='radio' id='female' name='gender' value='Female' />
            <label for='female'>Female</label> ";
            echo "<br><br>";
            echo "<button>Change</button>";
            echo "</form>";
        }else if($type == "password"){
            echo "<form>";
            echo "New password: <input name='password' type='password'/>";
            echo "  Reenter password: <input name='confirmpassword' type='password'/>";
            echo "<br><br>";
            echo "<button>Change</button>";
            echo "</form>";
        }
    }
?>
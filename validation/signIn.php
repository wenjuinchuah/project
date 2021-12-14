<?php
    if ($username != '' || $password != '') {
        $signInData = 'SELECT * FROM user WHERE Email = $username AND Password = $password';
        
        if ($result = $mysqli->query($signInData)) {
            echo $result;
        }
        /*if ($usernameData === $username && $passwordData === $password) {
            echo 'success';
        } else {
            echo 'fail';
        }*/
    }
?>
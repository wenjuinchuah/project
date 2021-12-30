<?php 
    include 'adminHeader.php'; 
    
    $sql = "SELECT * FROM user ORDER BY UserID";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <body class="w3-light-grey">

        <!--Order-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-shopping-bag"></i> Orders</b></h5>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>State</th>
                    <th>Gender</th>
                    <th>Password</th>
                    <th>UserType</th>
                </tr>
                <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                    <?php if ($user['UserType'] !== 'admin') { ?>
                        <?php echo "<tr>
                                <td>$user[UserID]</td>
                                <td>$user[Name]</td>
                                <td>$user[Email]</td>
                                <td>$user[Mobile]</td>
                                <td>$user[State]</td>
                                <td>$user[Gender]</td>
                                <td>$user[Password]</td>
                                <td>$user[UserType]</td>
                            </tr>";
                        ?>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
        
        <!-- Footer -->
        <footer class="w3-container w3-padding-16 w3-light-grey">
            <h4>FOOTER</h4>
            <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
        </footer>
    
    <!--End of Page-->
    </div>

    <script src="dashboardScript.js"></script>
    </body>
</html>

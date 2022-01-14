<?php 
    include 'adminHeader.php';
    include '../validation/connectSQL.php';
    
    $sql = "SELECT * FROM user ORDER BY UserID";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <body class="w3-light-grey">

        <!--User-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-users"></i> Users</b></h5>
            <div class="w3-right" style="margin-right: 15px">
                <h5 class="addFunction" onclick="addUser()"><i class="fa fa-plus"></i> Add User</h5>
            </div>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th style="width: 50px">ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>State</th>
                    <th>Gender</th>
                    <!-- <th>Password</th> -->
                    <th>UserType</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                    <?php if ($user['UserType'] !== 'admin') { ?>
                        <?php 
                            $user['Password'] = substr($user['Password'],0,10) . "...";
                            $mobile = substr($user['Mobile'], 2);
                            echo "<tr>
                                <td>$user[UserID]</td>
                                <td>$user[FirstName]</td>
                                <td>$user[LastName]</td>
                                <td>$user[Email]</td>
                                <td>$user[Mobile]</td>
                                <td>$user[State]</td>
                                <td>$user[Gender]</td>
                                <!--<td>$user[Password]</td>-->
                                <td>$user[UserType]</td>
                                <td><button type='button' class='openEdit' name='openEdit' onclick=\"editUser('$user[UserID]', '$user[FirstName]', '$user[LastName]', '$user[Email]', '$mobile', '$user[State]', '$user[Gender]', '$user[UserType]')\">
                                <i class='fas fa-edit'></i></button></td>
                                <td><button type='button' class='openDelete' name='openDelete' onclick='showModal(\"deleteUserView\")'>	
                                <i class='fa-solid fa-trash-can'></i></button></td>
                            </tr>";
                        ?>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>

        <!--Admin-->
        <div style="margin: 20px 0 0 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-users"></i> Admins</b></h5>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th style="width: 50px">ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>State</th>
                    <th>Gender</th>
                    <!-- <th>Password</th> -->
                    <th>UserType</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php 
                    $result = mysqli_query($conn, $sql);
                    while ($admin = mysqli_fetch_assoc($result)) { ?>
                    <?php if ($admin['UserType'] == 'admin') { ?>
                        <?php 
                            $admin['Password'] = substr($admin['Password'],0,10) . "...";
                            $mobile = substr($admin['Mobile'], 2);
                            echo "<tr>
                                <td>$admin[UserID]</td>
                                <td>$admin[FirstName]</td>
                                <td>$admin[LastName]</td>
                                <td>$admin[Email]</td>
                                <td>$admin[Mobile]</td>
                                <td>$admin[State]</td>
                                <td>$admin[Gender]</td>
                                <!--<td>$admin[Password]</td>-->
                                <td>$admin[UserType]</td>
                                <td><button type='button' class='openEdit' name='openEdit' onclick=\"editUser('$admin[UserID]', '$admin[FirstName]', '$admin[LastName]', '$admin[Email]', '$mobile', '$admin[State]', '$admin[Gender]', '$admin[UserType]')\">
                                <i class='fas fa-edit'></i></button></td>
                                <td><button type='button' class='openDelete' name='openDelete' onclick=\"deleteUser()\">	
                                <i class='fa-solid fa-trash-can'></i></button></td>
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

    <!--Add User View-->
    <div id="addUserView">
        <div class="userView-container">
            <form class="regform" id="addUser" action="../validation/formValidation.php" method="POST" enctype="multipart/form-data" onsubmit="return formValidation()">
            <i class="fa fa-times w3-right w3-xlarge" onclick="closeModal('addUserView')"></i>
                <h2>Add New User</h2>
                <div>
                    <label>First Name</label>
                    <input type="text" id="fname" name="fname" placeholder="First Name" />
                    <small id="fnameError">Error message</small>
                </div>
                <div>
                    <label>Last Name</label>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" />
                    <small id="lnameError">Error message</small>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" />
                    <small id="emailError">Error message</small>
                </div>
                <div>
                    <label>Mobile</label>
                    <div class="mobile-container">
                        <input type="text" id="code" name="code" value="+60" disabled />
                        <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" maxlength="10" />
                        <small id="mobileError">Error message</small>
                    </div>
                </div>
                <div>
                    <label>Gender</label>
                    <div class="gender-container">
                        <input type="radio" id="male" name="gender" value="Male" checked="true" />
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female" />
                        <label for="female">Female</label>
                    </div>
                </div>
                <div>
                    <label>State</label>
                    <select name="state" id="state">
                        <option value="state" disabled>- Select Your State-</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Pulau Pinang">Pulau Pinang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="federal" disabled>-Federal Territories-</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Putrajaya">Putrajaya</option>
                    </select>
                </div>
                <div>
                    <label>Password</label>
                    <i id="i-password1" class="fa fa-eye" onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                    <i id="i-password1-slash" class="fa fa-eye-slash" onclick="isVisible('password1', 'i-password1', 'i-password1-slash')"></i>
                    <input type="password" id="password1" name="password1" placeholder="Password" />
                    <small id="password1Error"></small>
                </div>
                <div>
                    <label>Confirm Password</label>
                    <i id="i-password2" class="fa fa-eye" aria-hidden="true"
                        onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                    <i id="i-password2-slash" class="fa fa-eye-slash" aria-hidden="true"
                        onclick="isVisible('password2', 'i-password2', 'i-password2-slash')"></i>
                    <input type="password" id="password2" name="password2" placeholder="Confirm Password" />
                    <small id="password2Error">Error message</small>
                </div>
                <div>
                    <label>User Role</label>
                    <div class="role-container">
                        <input type="radio" id="user" name="role" value="user" checked="true" />
                        <label for="user">User</label>
                        <input type="radio" id="admin" name="role" value="admin" />
                        <label for="admin">Admin</label>
                    </div>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="t&c" name="t&c" value="value1" />
                    <label for="t&c">I accept the above <u>Terms and Conditions</u></label>
                    <small id="t&cError">Error message</small>
                </div>
                <div class="button">
                    <input type="reset" id="reset" value="Clear"></input>
                    <input type="submit" id="submit" name="register" value="Register"
                        onclick="return  confirm('Do you want to register?')"></input>
                </div>
            </form>
        </div>
    </div>
    
    <!--Edit User View-->
    <div id="editUserView">
        <div class="userView-container">
            <form class="regform" id="editUser" action="editUser.php" method="POST" enctype="multipart/form-data">
                <i class="fa fa-times w3-right w3-xlarge" onclick="closeModal('editUserView')"></i>
                <h2>Edit User Profile</h2>
                <div style='display: none'>
                    <label>UserID</label>
                    <input type="text" id="userID" name="userID" placeholder="UserID" />
                </div>
                <div>
                    <label>First Name</label>
                    <input type="text" id="editfname" name="editfname" placeholder="First Name" />
                    <small id="editfnameError"><?php echo $fnameError ?></small>
                </div>
                <div>
                    <label>Last Name</label>
                    <input type="text" id="editlname" name="editlname" placeholder="Last Name" />
                    <small id="editlnameError"><?php echo $lnameError ?></small>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" id="editemail" name="editemail" placeholder="Email Address" />
                    <small id="editemailError"><?php echo $emailError ?></small>
                </div>
                <div>
                    <label>Mobile</label>
                    <div class="mobile-container">
                        <input type="text" id="editcode" name="code" value="+60" disabled />
                        <input type="tel" id="editmobile" name="editmobile" placeholder="Mobile Number" maxlength="10" />
                        <small id="editmobileError"><?php echo $mobileError ?></small>
                    </div>
                </div>
                <div>
                    <label>Gender</label>
                    <div class="gender-container">
                        <input type="radio" id="editmale" name="editgender" value="Male" checked="true" />
                        <label for="male">Male</label>
                        <input type="radio" id="editfemale" name="editgender" value="Female" />
                        <label for="female">Female</label>
                    </div>
                </div>
                <div>
                    <label>State</label>
                    <select name="editstate" id="editstate">
                        <option value="state" disabled>- Select Your State-</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Pulau Pinang">Pulau Pinang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="federal" disabled>-Federal Territories-</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Putrajaya">Putrajaya</option>
                    </select>
                </div>
                <div>
                    <label>User Type</label>
                    <select name="userType" id="userType">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="button">
                    <input type="submit" id="reset" class="resetPassword" name='resetPassword' value="Reset Password" onclick="alert('Password is reset! New Pasword is: Abc@123')"></input>
                    <input type="submit" id="edit" name="editUser" value="Confirm Edit"></input>
                </div>
            </form>
        </div>
    </div>

    <!--Delete view -->
    <div id="deleteUserView">
        <div class="userView-container">
            <form class="regform" action="" method="POST">
                <i class="fa fa-times w3-right w3-xlarge" onclick="closeModal('deleteUserView')"></i>
                <input type="hidden" id="deleteID" name="deleteID"></input>
                <h2>Delete User</h2>
                <div style="text-align: center">
                    <i class="fa fa-exclamation-triangle fa-9x" style="color: rgb(230, 89, 84)"></i>             
                </div>
                <div style="text-align:center;">
                    <h4>Data can't be restored once deleted. </h4>
                    <h4>Are you sure?</h4>
                </div>
                <div class="button">
                    <input type="submit" class='delete' name="deleteUser" value="Confirm"></input>
                </div>
            </form>
        </div>
    </div>

    <script src="dashboardScript.js"></script>
    <!--JS Libraries-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script>
        //Delete
        $(document).ready(function () {
            $('.openDelete').on('click', function () { 
                //retrieve data from table
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                //set the id to delete
                $('#deleteID').val(data[0]);
            });
        });
    </script>
    </body>
</html>

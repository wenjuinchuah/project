<?php 
    include 'adminHeader.php';
    //remove anonymous cart
    if (isset($_SESSION['anonymousiD'])) {
        $anonymousID = $_SESSION['anonymousID'];
        $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
        $sql = "SELECT * FROM anonymous_$anonymousID";
        if ($result = mysqli_query($conn, $sql)) {
            $sql = "DROP TABLE anonymous_$anonymousID";
            $result = mysqli_query($conn, $sql);
            if (isset($_COOKIE['anonymousID'])) {
                unset($_COOKIE['anonymousID']);
            }
            
            if (isset($_COOKIE['productID'])) {
                unset($_COOKIE['productID']);
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <body class="w3-light-grey">
        <!--Products-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-list"></i> Products</b></h5>
            <div class="w3-right" style="margin-right: 15px">
                <h5 class="addFunction" onclick="addProduct()"><i class="fa fa-plus"></i> Add Product</h5>
            </div>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Picture</th>
                    <th>Price (RM)</th>
                    <th>Stock</th>
                    <th>Sales</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php while ($column = mysqli_fetch_array($productList)) { ?>
                    <?php 
                        $price = number_format($column[2], 2, '.', '');
                        echo "<tr class='product-data'>";
                        echo "<td>$column[0]</td>";
                        echo "<td>$column[1]</td>";
                        echo "<td><img src='../productPic/" . $column[4] . "' width='auto' height='75px;'></td>";
                        echo "<td>$price</td>";
                        echo "<td>
                                <i class='fa fa-minus' class='button-quantity' onclick='minusStock($column[0])'></i>
                                <p style='display: inline-block; padding: 0; margin: 0;' id='product$column[0]'>$column[3]</p>
                                <i class='fa fa-plus' class='button-quantity' onclick='addStock($column[0])'></i>
                            </td>";
                        echo "<td>$column[5]</td>";
                        echo '<td><button type="button" class="openEdit" name="openEdit" onclick="editProduct()">
                              <i class="fas fa-edit"></i></button></td>';
                        echo '<td><button type="button" class="openDelete" name="openDelete" onclick="deleteProduct()">	
                              <i class="fa-solid fa-trash-can"></i></button></td>';
                        echo "</tr>"; 
                    ?>
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

    <!--Add Product View-->
    <div id="addProductView">
        <div class="userView-container">
            <form class="regform" action="" method="POST" enctype="multipart/form-data">
                <i class="fa fa-times w3-right w3-xlarge" onclick="turnOff()"></i>
                <h2>Add New Product</h2>
                <div>
                    <label>Product Name</label>
                    <input type="text" name="productName" placeholder="Product Name" value="<?php echo $productName ?>"/>
                    <?php if (isset($productNameError)) {?>
                        <small id="productNameError"><?php echo $productNameError ?></small>
                    <?php } ?>
                 </div>
                <div style="margin-top: 10px">
                    <label class="priceLabel">Price</label>
                    <input type="text" class="currency" name="currency" value="RM" disabled/>
                    <input type="text" class="price" id="productPrice" name="productPrice" placeholder="10" value="<?php echo $productPrice ?>"/>
                    <?php if (isset($productPriceError)) {?>
                        <small id="productPriceError"><?php echo $productPriceError ?></small>
                    <?php } ?>
                </div>
                <div style="margin-top: 10px">
                    <label class="stockLabel">Stock</label>
                    <input type="text" id="productStock" name="productStock" placeholder="1" value="<?php echo $productStock ?>"/>
                    <?php if (isset($productStockError)) {?>
                        <small id="productStockError"><?php echo $productStockError ?></small>
                    <?php } ?>
                </div>
                <div style="margin-top: 10px">
                    <label class="stockLabel">Product Picture</label>
                    <input type="file" id="productPicture" name="productPicture" value="<?php echo $productPicture ?>"/>
                    <?php if (isset($productPicError)) {?>
                        <small id="productPicError"><?php echo $productPicError ?></small>
                    <?php } ?>
                </div>
                <div class="button">
                    <input type="submit" id="addProduct" name="addProduct" value="Add Product"></input>
                </div>
            </form>
        </div>
    </div>
    
    
    <!--Edit Product View -->
    <div id="editProductView">
        <div class="userView-container">
            <form class="regform" action="" method="POST" enctype="multipart/form-data">
                <i class="fa fa-times w3-right w3-xlarge" onclick="turnOffEdit()"></i>
                <h2>Edit Product</h2>
                <input type="hidden" id="editID" name="editID">
                <input type="hidden" id="oriPic" name="oriPic"> 
                <div>
                    <label>Product Name</label>
                    <input type="text" id="editName" name="editName" placeholder="Product Name" />
                    <?php if (isset($editNameError)) {?>
                        <small id="editNameError"><?php echo $editNameError ?></small>
                    <?php } ?>
                 </div>
                <div style="margin-top: 10px">
                    <label class="priceLabel">Price</label>
                    <input type="text" class="currency" name="currency" value="RM" disabled/>
                    <input type="text" class="price" id="editPrice" name="editPrice" placeholder="10"/>
                    <?php if (isset($editPriceError)) {?>
                        <small id="productPriceError"><?php echo $editPriceError ?></small>
                    <?php } ?>
                </div>
                <div style="margin-top: 10px">
                    <label class="stockLabel">Stock</label>
                    <input type="text" id="editStock" name="editStock" placeholder="1" />
                    <?php if (isset($editStockError)) {?>
                        <small id="editStockError"><?php echo $editStockError ?></small>
                    <?php } ?>
                </div>
                <div style="margin-top: 10px">
                    <label class="stockLabel">Product Picture</label>
                    <input type="file" id="editPicture" name="editPicture" />
                    <?php if (isset($editPicError)) {?>
                        <small id="editPicError"><?php echo $editPicError ?></small>
                    <?php } ?>
                </div>
                <div class="button">
                    <input type="submit" class="edit" name="edit" value="Edit Product"></input>
                </div>
            </form>
        </div>
    </div>

    <!--Delete view -->
    <div id="deleteProductView">
        <div class="userView-container">
            <form class='regform' action="" method="POST">
                <i class="fa fa-times w3-right w3-xlarge" onclick="turnOffDelete()"></i>
                <input type="hidden" id="deleteID" name="deleteID">
                <h2>Delete Product</h2>
                <div style="text-align: center">
                    <i class="fa fa-exclamation-triangle fa-9x" style="color: rgb(230, 89, 84)"></i>             
                </div>
                <div style="text-align:center;">
                    <h4>Data can't be restored once deleted. </h4>
                    <h4>Are you sure?</h4>
                 </div>
                <div class="button">
                    <input type="submit" class="delete" name="delete" value="Confirm"></input>
                </div>
            </form>
        </div>
    </div>


    <script src="dashboardScript.js"></script>
    <script>
        function addStock(id){
                const xmlhttp = new XMLHttpRequest();
                var x = document.getElementById("product"+id);
                xmlhttp.onload = function(){
                    x.innerHTML = this.responseText;
                }
                xmlhttp.open("GET", "editStock.php?action=add&id=" + id);
                xmlhttp.send();
        }

        function minusStock(id){
                const xmlhttp = new XMLHttpRequest();
                var x = document.getElementById("product"+id);
                xmlhttp.onload = function(){
                    x.innerHTML = this.responseText;
                }
                xmlhttp.open("GET", "editStock.php?action=minus&id=" + id);
                xmlhttp.send();
        }
    </script>

    <!--JS Libraries-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script>
        //Edit
        $(document).ready(function () {
            $('.openEdit').on('click', function () { 
                //retrieve data from table
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                //to retrieve image source
                var img = $tr.find("img").attr('src');
                
                //write data to console
                console.log(data,img);

                //set the value for respective attributes
                $('#editID').val(data[0]);
                $('#editName').val(data[1]);
                $('#oriPic').val(img);
                $('#editPrice').val(data[3]);
                $('#editStock').val(data[4].trim());
            });
        });

        //Delete
        $(document).ready(function () {
            $('.openDelete').on('click', function () { 
                //retrieve data from table
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                //write data to console
                console.log(data);

                //set the id to delete
                $('#deleteID').val(data[0]);
            });
        });

    </script>
    </body>
</html>

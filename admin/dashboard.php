<?php include 'adminHeader.php'; ?>

<!DOCTYPE html>
<html>
    <body class="w3-light-grey">
        <!--Products-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-list"></i> Products</b></h5>
            <div class="w3-right" style="margin-right: 15px">
                <h5 class="addProduct" onclick="addProduct()" data-toggle="modal" data-target="#addProductView"><i class="fa fa-plus"></i> Add Product</h5>
            </div>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
                <?php while ($column = mysqli_fetch_array($productList)) { ?>
                    <?php 
                        $price = number_format($column[2], 2, '.', '');
                        echo "<tr>";
                        echo "<td>$column[0]</td>";
                        echo "<td>$column[1]</td>";
                        echo "<td><img src='../productPic/" . $column[4] . "' width='100px' height='75px;'</td>";
                        echo "<td>RM $price</td>";
                        echo "<td>
                                <i class='fa fa-minus' class='button-quantity' onclick='minusStock($column[0])'></i>
                                <p style='display: inline-block; padding: 0; margin: 0;' id='product$column[0]'>$column[3]</p>
                                <i class='fa fa-plus' class='button-quantity' onclick='addStock($column[0])'></i>
                            </td>";
                        echo '<td><button type="button" class="openEdit" name="openEdit">Edit</button>
                              </td>';
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
    <div class='addEditView' id="addProductView">
        <div class="addProductView-container">
            <i class="fa fa-times w3-right w3-xlarge" onclick="turnOff()" data-dismiss="modal"></i>
            <form action="" method="POST" enctype="multipart/form-data">
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
                    <input type="submit" id="submit" name="submit" value="Add Product"></input>
                </div>
            </form>
        </div>
    </div>

    <!--Edit Product View (sql part incomplete)-->
    <div class='addEditView' id="editProductView">
        <div class="addProductView-container">
            <i class="fa fa-times w3-right w3-xlarge" data-dismiss="modal"></i>
            <form action="" method="POST" enctype="multipart/form-data">
                <h2>Edit Product</h2>
                <input type="hidden" id="editID" name="editID">
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
                    <input type="submit" id="edit" name="edit" value="Edit Product"></input>
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

    <!--Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.openEdit').on('click', function () { 
                //show edit view
                $('#editProductView').modal('show');

                //retrieve data from table
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                //write data to console
                console.log(data);

                //set the value for respective attributes
                $('#editID').val(data[0]);
                $('#editName').val(data[1]);
                $('#editPicture').val(data[2]);
                $('#editPrice').val(data[3]);
                $('#editStock').val(data[4].trim());
            });
        });
    </script>
    </body>
</html>

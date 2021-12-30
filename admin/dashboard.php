<?php include 'adminHeader.php'; ?>

<!DOCTYPE html>
<html>
    <body class="w3-light-grey">
        <!--Products-->
        <div style="margin-left: 15px;">
            <h5 style="display: inline-block"><b><i class="fa fa-list"></i> Products</b></h5>
            <div class="w3-right" style="margin-right: 15px">
                <h5 class="addProduct" onclick="addProduct()"><i class="fa fa-plus"></i> Add Product</h5>
            </div>
        </div>
        <div style="padding: 0 15px">
            <table>
                <tr class="table-top">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
                <?php while ($column = mysqli_fetch_array($productList)) { ?>
                    <?php 
                        $price = number_format($column[2], 2, '.', '');
                        echo "<tr>";
                        echo "<td>$column[0]</td>";
                        echo "<td>$column[1]</td>";
                        echo "<td>RM $price</td>";
                        echo "<td>
                                <i class='fa fa-minus' class='button-quantity' onclick='minusStock($column[0])'></i>
                                <p style='display: inline-block; padding: 0; margin: 0;' id='product$column[0]'>$column[3]</p>
                                <i class='fa fa-plus' class='button-quantity' onclick='addStock($column[0])'></i>
                            </td>";
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
        <div class="addProductView-container">
            <i class="fa fa-times w3-right w3-xlarge" onclick="turnOff()"></i>
            <form action="" method="POST">
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
                    <input type="text" id="currency" name="currency" value="RM" disabled/>
                    <input type="text" id="productPrice" name="productPrice" placeholder="10" value="<?php echo $productPrice ?>"/>
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
                <div class="button">
                    <input type="submit" id="submit" name="submit" value="Add Product"></input>
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
    </body>
</html>

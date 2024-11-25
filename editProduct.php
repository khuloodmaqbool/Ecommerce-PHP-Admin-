<?php 
include("header.php");

if (isset($_GET['u_id'])) {
    $p_id = $_GET['u_id'];

    $select = "SELECT p.id, p.Product_name, p.Product_price, p.Product_img, p.Product_description, p.Product_stock, p.Product_flavour, p.Catagory_id, c.Catagory_name
               FROM `products` p
               INNER JOIN `catagory` c ON p.Catagory_id = c.Catagory_id
               WHERE p.id = '$p_id'";

    $query = mysqli_query($connect, $select);
    $fetch = mysqli_fetch_assoc($query);
}
?>

<!-- Form Start -->
<form action="editProduct.php?u_id=<?php echo $p_id ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Product</h6>

                    <label for="pn" class="form-label">Product Name</label>
                    <input type="text" name="p_name" value="<?php echo $fetch['Product_name'] ?>" class="form-control" id="pn">


                    <label for="pp" class="form-label">Product Price</label>
                    <input type="text" name="p_price" value="<?php echo $fetch['Product_price'] ?>" class="form-control" id="pp">

                    
                    <label for="ps" class="form-label">Product Description</label>
                    <input type="text" name="p_description" value="<?php echo $fetch['Product_description'] ?>" class="form-control" id="ps">

                    <label for="ps" class="form-label">Product Stock</label>
                    <input type="text" name="p_stock" value="<?php echo $fetch['Product_stock'] ?>" class="form-control" id="ps">

    
                    <label for="pf" class="form-label">Product Flavour</label>
                    <input type="text" name="p_flavour" value="<?php echo $fetch['Product_flavour'] ?>" class="form-control" id="pf">

                
                    <label for="pf" class="form-label">Category</label>
                    <select name="p_catagory" class="form-select mb-3" aria-label="Default select example">
                        <?php
                        $sel_cat = "SELECT * FROM catagory";
                        $query_cat = mysqli_query($connect, $sel_cat);
                        while ($fetch_cat = mysqli_fetch_assoc($query_cat)) { ?>
                            <option value="<?php echo $fetch_cat['Catagory_id']; ?>" 
                                <?php if ($fetch['Catagory_id'] == $fetch_cat['Catagory_id']) { echo "selected"; } ?>>
                                <?php echo $fetch_cat['Catagory_name']; ?>
                            </option>
                        <?php } ?>
                    </select>

                    <!-- Product Image -->
                    <label for="pi" class="form-label">Product Image</label>
                    <input type="file" name="p_image" class="form-control" id="pi">
                    <img src="product_images/<?php echo $fetch['Product_img'] ?>" alt="Product Image" width="100px">

                  
                    <button type="submit" name="update_product" class="btn btn-primary m-2">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Form End -->

<?php 
if (isset($_POST['update_product'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_description = $_POST['p_description'];
    $p_stock = $_POST['p_stock'];
    $p_flavour = $_POST['p_flavour'];
    $p_catagory = $_POST['p_catagory']; 

    $p_image = $_FILES['p_image'];
    $img_name = $p_image['name'];
    $img_tmpname = $p_image['tmp_name'];

    if (is_uploaded_file($img_tmpname)) {
        $path = 'product_images/' . $img_name;
        move_uploaded_file($img_tmpname, $path);

        $update = "UPDATE `products` SET `Product_name`='$p_name', `Product_price`='$p_price', `Product_description`='$p_description', `Product_stock`='$p_stock', `Product_flavour`='$p_flavour', `Product_img`='$img_name', `Catagory_id`='$p_catagory' WHERE `id`='$p_id'";
    } else {
        $update = "UPDATE `products` SET `Product_name`='$p_name', `Product_price`='$p_price', `Product_description`='$p_description', `Product_stock`='$p_stock', `Product_flavour`='$p_flavour', `Catagory_id`='$p_catagory' WHERE `id`='$p_id'";
    }

    $done = mysqli_query($connect, $update);
    if ($done) {
        echo "<script>alert('Product Updated Successfully!'); window.location.href = 'viewProducts.php';</script>";
    } else {
        echo "<script>alert('Product Update Failed!');</script>";
    }
}
?>

<?php 
include("footer.php");
?>

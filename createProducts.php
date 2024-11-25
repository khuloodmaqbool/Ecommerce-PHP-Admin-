<?php 
include("header.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

$select1 = "SELECT * FROM `catagory`";
$query1 = mysqli_query($connect, $select1);
?>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Add Product Form -->
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Add Products</h6>

                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="c_id" class="form-select mb-3" aria-label="Default select example" required>
                        <option selected disabled>Select Category</option>
                        <?php while($fetch = mysqli_fetch_assoc($query1)) { ?>
                            <option value="<?php echo $fetch['Catagory_id']; ?>">
                                <?php echo $fetch['Catagory_name']; ?>
                            </option>
                        <?php } ?>
                    </select>

                    <div class="form-floating mb-3">
                        <input name="p_name" type="text" class="form-control" id="floatingInput" placeholder="Product Name" required>
                        <label for="floatingInput">Product Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="p_price" type="number" class="form-control" id="floatingPrice" placeholder="Product Price" required>
                        <label for="floatingPrice">Product Price</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="p_stock" type="number" class="form-control" id="floatingStock" placeholder="Product Stock" required>
                        <label for="floatingStock">Product Stock</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="p_flavour" type="text" class="form-control" id="floatingFlavour" placeholder="Product Flavour">
                        <label for="floatingFlavour">Product Flavour</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="p_description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;" required></textarea>
                        <label for="floatingTextarea">Description</label>
                    </div>

                    <div class="my-3">
                        <label for="formFile" class="form-label">Upload Product Image</label>
                        <input name="p_img" class="form-control" type="file" id="formFile" required>
                    </div>

                    <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php
if (isset($_POST['add_product'])) {
    // Collect form data
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_stock = $_POST['p_stock'];
    $p_flavour = $_POST['p_flavour'];
    $p_description = $_POST['p_description'];
    $c_id = $_POST['c_id'];

    // Handle the file upload
    $p_image = $_FILES['p_img'];
    $img_name = $p_image['name'];
    $img_tmpname = $p_image['tmp_name'];
    $img_size = $p_image['size'];

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $max_file_size = 2 * 1024 * 1024; // 2 MB
    $file_extension = pathinfo($img_name, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
        exit();
    }

    if ($img_size > $max_file_size) {
        echo "<script>alert('File size exceeds the 2MB limit.');</script>";
        exit();
    }

    $directory = 'product_images/';
    $path = $directory . $img_name;

    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    if (move_uploaded_file($img_tmpname, $path)) {
        $insert = "INSERT INTO `products`(`Product_name`, `Product_price`, `Product_img`, `Product_description`, `Product_stock`, `Product_flavour`, `Catagory_id`) 
                   VALUES ('$p_name', '$p_price', '$img_name', '$p_description', '$p_stock', '$p_flavour', '$c_id')";

        $done = mysqli_query($connect, $insert);

        if ($done) {
            echo "<script>
                    alert('Product Inserted Successfully!');
                    window.location.href = 'viewProducts.php';
                  </script>";
        } else {
            echo "<script>alert('Failed to Insert Product: " . mysqli_error($connect) . "');</script>";
        }
    } else {
        echo "<script>alert('Failed to Upload Image!');</script>";
    }
}
?>

<?php 
include("footer.php");
?>

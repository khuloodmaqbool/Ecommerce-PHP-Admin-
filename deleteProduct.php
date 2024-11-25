<?php 
include("header.php");

if (isset($_GET['d_id'])) {
    $p_id = $_GET['d_id'];

    $delete = "DELETE FROM `products` WHERE `id` = '$p_id'";
    $query = mysqli_query($connect, $delete);

    if ($query) {
        echo "<script>alert('Product Deleted Successfully!'); window.location.href = 'viewProducts.php';</script>";
    } else {
        echo "<script>alert('Product Deletion Failed!'); window.location.href = 'viewProducts.php';</script>";
    }
}

include("footer.php");
?>

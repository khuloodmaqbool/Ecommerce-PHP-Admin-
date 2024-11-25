<?php 
include("header.php");

// Corrected SQL query with proper table and column names
$select = "SELECT p.id, p.Product_name, p.Product_price, p.Product_img, p.Product_description, p.Product_stock, p.Product_flavour, c.Catagory_name
           FROM `products` p
           INNER JOIN `catagory` c ON p.Catagory_id = c.Catagory_id";

$query = mysqli_query($connect, $select);
?>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
    
        <div class="col-sm-12 col-xl-12">
            <div class="rounded h-100 p-4">
                <h6 class="mb-4">Brands List</h6>
                <div class="table-responsive"> <!-- Added table-responsive class -->
                    <table class="table table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Product Id</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Stock</th>
                                <th scope="col">Product Description</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Flavour</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while($fetch = mysqli_fetch_assoc($query)) { ?>
                            
                                <tr>
                                    <td scope="row"> <?php echo $fetch['id'] ?> </td>
                                    <td> <?php echo $fetch['Product_name'] ?> </td>
                                    <td> <?php echo $fetch['Product_price'] ?> </td>
                                    <td> <?php echo $fetch['Product_stock'] ?> </td>
                                    <td class="product-description"> <?php echo $fetch['Product_description'] ?> </td>
                                    <td> <img src="product_images/<?php echo $fetch['Product_img'] ?>" alt="Product Image" class="img-fluid"></td>
                                    <td> <?php echo $fetch['Catagory_name'] ?> </td>
                                    <td> <?php echo $fetch['Product_flavour'] ?> </td>
                                    <td> <a href="editProduct.php?u_id=<?php echo $fetch['id'] ?>" class="btn btn-warning">Edit</a> </td>
                                    <td> <a href="deleteProduct.php?d_id=<?php echo $fetch['id'] ?>" class="btn btn-danger">Delete</a> </td>   
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- End of table-responsive -->
            </div>
        </div>

    </div>
</div>
<!-- Table End -->

<?php 
include("footer.php");
?>  

<style>
    /* Ensure the image is responsive */
    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    /* Reduce font size and hide columns on smaller screens */
    @media (max-width: 992px) {
        .table th, .table td {
            font-size: 14px;
        }

        /* Stack the columns vertically on small screens */
        .table td, .table th {
            display: block;
            width: 100%;
            text-align: left;
        }

        .table td:before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Make image smaller on mobile */
        .img-fluid {
            width: 100px;
            height: auto;
        }
    }

    /* For very small screens */
    @media (max-width: 576px) {
        .table th, .table td {
            font-size: 12px;
        }

        /* Adjust the 'Product Description' and other columns for small screens */
        .product-description {
            font-size: 11px;
        }
    }
</style>

<?php 
// Include the database connection
include("header.php");
?>

<!-- Form Start -->
<form action="" method="post">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Add Categories</h6>
                    
                    <!-- Input for Category Name -->
                    <label for="category" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="category" name="add_category" required>

                    <!-- Submit Button -->
                    <button type="submit" name="category_btn" class="btn btn-primary m-2">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Form End -->

<?php
// Handle Form Submission
if (isset($_POST['category_btn'])) {
    // Sanitize user input to prevent SQL injection
    $add_category = mysqli_real_escape_string($connect, $_POST['add_category']);

    // Insert Query
    $insert = "INSERT INTO `catagory` (`Catagory_name`) VALUES ('$add_category');";

    // Execute Query
    $done = mysqli_query($connect, $insert);

    // Check if Query was Successful
    if ($done) {
        echo "<script>
        alert('Category Added Successfully!');
        window.location.href = 'viewCategory.php'; // Redirect to view categories
        </script>";
    } else {
        // Display Error Message
        echo "<script>
        alert('Error: " . mysqli_error($connect) . "');
        </script>";
    }
}
?>

<?php 
// Include the footer
include("footer.php");
?>

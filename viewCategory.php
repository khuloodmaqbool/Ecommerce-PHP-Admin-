<?php 
include("header.php");

$select = "SELECT * FROM `catagory`";
$row = mysqli_query($connect, $select);
?>


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Categories List</h6>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Category Id</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                while ($fetch = mysqli_fetch_assoc($row)){
                                ?>
                                    <tr>
                                        <td scope="row"> <?php echo $fetch['Catagory_id'] ?> </td>
                                        <td> <?php echo $fetch['Catagory_name']?> </td>
                                        <td> <a href="viewCategory.php?u=<?php echo $fetch['Catagory_id'] ?>" class="btn btn-warning"> Edit</a> </td>
                                        <td> <a href="viewCategory.php?d=<?php echo $fetch['Catagory_id'] ?>" onclick = "return confirm('Press a button!')" class="btn btn-danger"> Delete</a> </td>
                                    </tr>
                                    <?php
                                } ?>

                                   
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Table End -->

<!-- UPDATE  -->
<?php
if(isset($_GET['u'])){
            $u_id = $_GET['u'];
            $select = "SELECT * FROM `catagory` WHERE `Catagory_id` = '$u_id'";
            $u_row = mysqli_query($connect, $select);
            $fetch = mysqli_fetch_assoc($u_row);
       
?>
            <form action="" method="post">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Categories</h6>
                            
                            <label for="category" class="form-label">Category Name</label>
                                    <input type="text" value="<?php echo $fetch['Catagory_name'] ?>" class="form-control" id="category" name="update_category"
                                        aria-describedby="emailHelp">

                            <button type="submit" name="update_btn" class="btn btn-primary m-2">Update</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            </form>
  <?php 
  if(isset($_POST['update_btn'])){
    $c_name = $_POST['update_category'];
    $updated = "UPDATE `catagory` SET `Catagory_name` = '$c_name' WHERE `Catagory_id` = '$u_id'";
    $done = mysqli_query($connect, $updated);
    if($done){
        echo
        "<script>
        alert('Record Updated!');
        window.location.href = 'viewCategory.php';
        </script>";
    }

  }
  
}
            ?>



            <!-- DELETE  -->
            <?php
        if(isset($_GET['d'])){
            $d_id = $_GET['d'];

            $deleted = "DELETE FROM `catagory` WHERE Catagory_id = '$d_id'";
            $done = mysqli_query($connect, $deleted);

            if($done){
                echo
                "<script>
                alert('Record Deleted!');
                window.location.href = 'viewCategory.php';
                </script>";
            }
        }

        ?>

            <?php 
include("footer.php");
?>
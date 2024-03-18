<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url(images/bgimg.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body>

    <?php
    include 'config/database.php';

    $id = $_GET['name'];
    $sql = "SELECT * FROM product WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['product_name'];
        $details = $_POST['product_details'];
        $stock = $_POST['product_count'];

        $filePath = $row['images'];
        if (isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
            $uploadedFileName = basename($_FILES['images']['name']);
            $targetFilePath = $uploadedFileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $types = array('avif', 'png', 'webp');
            if (in_array($fileType, $types)) {
                if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFilePath)) {
                    $filePath = $targetFilePath;
                } else {
                    die("Error uploading file");
                }
            } else {
                die("Invalid file type");
            }
        }

        $query = "UPDATE product SET product_name = '$name', product_details = '$details', product_count = '$stock', image = '$filePath' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("query failed");
        } else {
            header('location: data.php');
        }
    }

    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <h2 class="h2 mt-5 mb-4">Update Product</h2>
                    <div>
                        <label for="id" class="form-label">ID : </label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $row['id'] ?>">
                    </div>
                    <br>
                    <div>
                        <label for="name" class="form-label">Name : </label>
                        <input type="text" class="form-control" name="product_name" id="name"
                            value="<?php echo $row['product_name'] ?>">
                    </div>
                    <br>
                    <div>
                        <label for="description" class="form-label">Category : </label>
                        <input type="text" class="form-control" name="product_details" id="description"
                            value="<?php echo $row['product_details'] ?>">
                    </div>
                    <br>
                    <div>
                        <label for="price" class="form-label">Stock : </label>
                        <input type="text" class="form-control" name="product_count" id="price"
                            value="<?php echo $row['product_count'] ?>">
                    </div>
                    <br>
                    <div>
                        <label for="image" class="form-label">Image : </label>
                        <input type="file" class="form-control" name="images" id="image"
                            value="<?php echo $row['image'] ?>">
                    </div>
                    <br>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col text-start">
                                <div>
                                    <input type="submit" class="btn btn-primary" value="Update" name="update">
                                </div>
                            </div>
                            <div class="col text-end">
                                <div>
                                    <button class="btn btn-secondary"><a href="data.php"
                                            style="text-decoration:none; color: white;">Details Page</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
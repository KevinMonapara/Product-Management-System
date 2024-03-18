<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

    <style>
        body {
            background-image: url(images/bgimg.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .error {
            color: red;
            margin-top: 2px;
        }
    </style>
</head>

<body>

    <div class="container">

        <?php
        include "config/database.php";

        if (isset($_POST['add'])) {
            $name = $_POST['product_name'];
            $details = $_POST['product_details'];
            $stock = $_POST['product_count'];

            if ($_FILES["image"]["error"] === 4) {
                echo "<script> alert('image doesn't exist');</script>";
            }
            $filename = $_FILES['image']['name'];
            $filesize = $_FILES['image']['size'];
            $tmpname = $_FILES['image']['tmp_name'];
            $folder = "/images";

            $validateImageExtension = ['avif', 'png', 'webp'];
            $imageextension = explode('.', $filename);
            $imageextension = strtolower(end($imageextension));

            if (!in_array($imageextension, $validateImageExtension)) {
                echo "<script> alert('Invalid Image Extension');</script>";
            } elseif ($filesize > 100000000) {
                echo "<script> alert('Image size is too large');</script>";
            } else {
                $newimagename = uniqid();
                $newimagename .= '.' . $imageextension;

                move_uploaded_file($tmpname, 'images/' . $newimagename);
                $query = "INSERT INTO product (product_name,product_details,product_count,image) VALUES('$name','$details','$stock','$newimagename')";
                mysqli_query($conn, $query);
                echo "<script> alert('Successfully added');
                document.location.href = 'data.php';</script>";
            }
        }
        ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-4">
                    <form action="" id="afrm" method="post" enctype="multipart/form-data">
                        <h2 class="h2 mt-5 mb-4 text-center">Product Add</h2>
                        <div>
                            <label for="name" class="form-label">Name : </label>
                            <input type="text" class="form-control" name="product_name" id="name">
                        </div>
                        <br>
                        <div>
                            <label for="description" class="form-label">Category : </label>
                            <input type="text" class="form-control" name="product_details" id="description">
                        </div>
                        <br>
                        <div>
                            <label for="price" class="form-label">Stock : </label>
                            <input type="text" class="form-control" name="product_count" id="price">
                        </div>
                        <br>
                        <div>
                            <label for="image" class="form-label">Image : </label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <br>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col text-start">
                                    <div>
                                        <input type="submit" class="btn btn-primary" value="Add" name="add" required>
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
                    <script src="valid_afrm.js"></script>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .error {
            color: red;
            margin-top: 2px;
        }
    </style>
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'config/database.php';

        $recordIds = $_POST['record_ids'];

        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = $_FILES['images']['name'][$key];
            $filePath = $fileName;

            move_uploaded_file($tmpName, $filePath);
            $recordId = $recordIds[$key];
            $sql = "UPDATE product SET image = '$filePath' WHERE id = $recordId";

            if ($conn->query($sql) !== TRUE) {
                echo "Error updating record: " . $conn->error;
            } else {
                echo "<script> alert('Added'); document.location.href = 'data.php';</script>";
            }
        }

        $conn->close();
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <form id="ifrm" method="post" enctype="multipart/form-data">
                    <h2 class="h2 mt-5 mb-4 text-center">Add Image</h2>
                    <div>
                        <label for="record_ids" class="form-label">Select Id :</label>
                        <input type="number" class="form-control" name="record_ids[]" id="record_ids"
                            autocomplete="off" required>
                    </div>
                    <br>
                    <div>
                        <label for="images" class="form-label">Choose Image :</label>
                        <input type="file" class="form-control" name="images[]" id="images" required>
                    </div>
                    <br>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col text-start">
                                <div>
                                    <input class="btn btn-primary" type="submit" value="Upload Image" name="submit"
                                        required>
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
                <script src="valid_ifrm.js"></script>
            </div>
        </div>
    </div>

</body>

</html>

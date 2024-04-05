<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script>
        function viewDataPerPage(page) {
            var value = page.value;
            window.location.href = "data.php?result_per_page=" + value;
        }
    </script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <?php
    include "config/database.php";

    $result_per_page = 5;

    if (isset($_GET['result_per_page']) && is_numeric($_GET['result_per_page'])) {
        $result_per_page = $_GET['result_per_page'];
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $result_per_page;

    $sql = "SELECT * FROM product LIMIT $start_from, $result_per_page";
    $result = $conn->query($sql);

    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

    $sql3 = "SELECT * FROM product ORDER BY $orderBy $order LIMIT $start_from, $result_per_page";
    $result = $conn->query($sql3);

    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Product Management System</a>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <div class="col-8">
                <form method="get" action="">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="flex-grow-1 ms-2">
                                <div class="col-3 input-group">
                                    <input type="search" class="form-control me-2 rounded bg-transparent" name="search"
                                        value="<?php if (isset($_GET['search'])) {
                                            echo $_GET['search'];
                                        } ?>" placeholder="🔍 Search Item">
                                    <input type="submit" class="btn btn-outline-primary rounded" value="search">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="justify-content-end me-2">
                                <label for="page" class="form-label m-auto">View : </label>
                                <select class="form-select-sm" id="page" onchange="viewDataPerPage(this)">
                                    <option value="5" <?php if ($result_per_page == 5)
                                        echo "selected"; ?>>5</option>
                                    <option value="10" <?php if ($result_per_page == 10)
                                        echo "selected"; ?>>10</option>
                                    <option value="15" <?php if ($result_per_page == 15)
                                        echo "selected"; ?>>15</option>
                                    <option value="20" <?php if ($result_per_page == 20)
                                        echo "selected"; ?>>20</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="text-end me-4">
                    <a class="text-decoration-none" href="add.php"> <button class="btn btn-info text-white">Add
                            Product</button> </a>
                    <a class="text-decoration-none" href="image.php"> <button class="btn btn-dark">Image</button>
                    </a>
                    <a class="text-decoration-none" href="config/logout.php"> <button class="btn btn-danger">Log
                            Out</button> </a>
                </div>
            </div>
        </div>

        <div class="m-5 text-center">
            <h1 style="color: #269cb3; font-weight: 700;">Product Details</h1>
        </div>

        <table class='table text-center table-primary mb-0'>
            <th class="col-2"><a class="text-dark text-decoration-none"
                    href="?orderBy=id&order=<?= ($orderBy == 'id' && $order == 'ASC') ? 'DESC' : 'ASC'; ?>">
                    Id</a></th>
            <th class="col-2"><a class="text-dark text-decoration-none"
                    href="?orderBy=product_name&order=<?= ($orderBy == 'product_name' && $order == 'ASC') ? 'DESC' : 'ASC'; ?>">Name</a>
            </th>
            <th class="col-2"><a class="text-dark text-decoration-none"
                    href="?orderBy=product_details&order=<?= ($orderBy == 'product_details' && $order == 'ASC') ? 'DESC' : 'ASC'; ?>">Category</a>
            </th>
            <th class="col-2"><a class="text-dark text-decoration-none"
                    href="?orderBy=product_count&order=<?= ($orderBy == 'product_count' && $order == 'ASC') ? 'DESC' : 'ASC'; ?>">Stock</a>
            </th>
            <th class="col-2 text-dark">Image</th>
            <th class="col-2 text-dark">Update & Delete</th>
        </table>

        <?php
        
        if (!isset($_GET["search"])) {
            echo "<table class='table text-center table-hover'>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='container'>";
                echo "<td class='col-2'>{$row['id']}</td>";
                echo "<td class='col-2'>{$row['product_name']}</td>";
                echo "<td class='col-2'>{$row['product_details']}</td>";
                echo "<td class='col-2'>{$row['product_count']}</td>"; ?>
                <td class='col-2'> <img src="images/<?php echo $row['image']; ?>" alt="" height="75px" width="90px"></td>
                <?php echo "<td class='col-2'>
                <a href='update.php?name={$row['id']}'><button class='btn btn-success'><i class='bi bi-pencil-square'></i></button></a>&nbsp;
                <a href='delete.php?name={$row['product_name']}'><button class='btn btn-danger'><i class='bi bi-trash3'></i></button></a>
                </td>"; ?>
                <?php echo "</tr>";
            }
            echo "</table>";
        } else {
            $searchTerm = $_GET['search'];
            $sql1 = "SELECT * FROM product WHERE CONCAT(id, product_name, product_details, product_count) LIKE '%$searchTerm%' ";
            $filterdata = mysqli_query($conn, $sql1);
            echo "<table class='table text-center table-hover'>";
            if (mysqli_num_rows($filterdata) > 0) {
                foreach ($filterdata as $row1) {
                    echo "<tr class='container'>";
                    echo "<td class='col-2'>{$row1['id']}</td>";
                    echo "<td class='col-2'>{$row1['product_name']}</td>";
                    echo "<td class='col-2'>{$row1['product_details']}</td>";
                    echo "<td class='col-2'>{$row1['product_count']}</td>"; ?>
                    <td class='col-2'> <img src="images/<?php echo $row1['image']; ?>" alt="" height="75px" width="90px"></td>
                    <?php echo "<td class='col-2'>
                    <a href='update.php?name={$row1['id']}'><button class='btn btn-success'><i class='bi bi-pencil-square'></i></button></a>&nbsp;
                    <a href='delete.php?name={$row1['product_name']}'><button class='btn btn-danger'><i class='bi bi-trash3'></i></button></a>
                    </td>"; ?>
                    <?php echo "</tr>";
                }
            }
            echo "</table>";
        }

        if (isset($_GET["search"]) == 0) {
            $sql1 = "SELECT COUNT(id) AS total FROM product";
            $result = $conn->query($sql1);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $result_per_page);

            echo "<br><nav>";
            echo "<ul class='pagination justify-content-center'>";
            echo " <div class='d-flex'>";

            if ($page > 1) {
                echo "<li class='page-item'><a class='page-link' href='data.php?page=" . ($page - 1) . "&result_per_page=$result_per_page&orderBy=$orderBy&order=$order'><</a></li>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='data.php?page=$i&result_per_page=$result_per_page&orderBy=$orderBy&order=$order'>$i</a></li>";
            }

            if ($page < $total_pages) {
                echo "<li class='page-item'><a class='page-link' href='data.php?page=" . ($page + 1) . "&result_per_page=$result_per_page&orderBy=$orderBy&order=$order'>></a></li>";
            }

            echo "</div>";
            echo "</ul>";
            echo "</nav>";
        }

        $conn->commit();
        ?>

    </div>

</body>

</html>

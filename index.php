<?php
// Connecting to Database
$insert = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect" . mysqli_connect_error());
}

// insert
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $sql = "INSERT INTO `notes` ( `title`, `description`) VALUES ( '$title', '$description')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo $insert = true;
    } else {
        echo "The record was not created successfully because of this error: " . mysqli_error($conn);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "paging": true,  // Enable pagination
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PHP CRUD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<?php
if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your note has been added successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}

?>
<div class="container my-4">
    <h2 class="text-danger text-center">Add a Note</h2>
    <form action="/CRUD/index.php" method="post">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input required type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea rows="4" class="form-control" name="description" id="description">
            </textarea>
        </div>

        <button type="submit" class="btn btn-danger">Add Note</button>

    </form>
</div>
<div class="container my-4">
    <table class="table table-info" id="myTable">
        <thead>
        <tr>
            <th scope="col">S.No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo " <tr>
            <th scope='row'>" . $sno . ".</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>Actions</td>
        </tr>";
        }
        ?>

        </tbody>
    </table>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>

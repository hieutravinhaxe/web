<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .card img {
        max-width: 100%;
        height: 200px;
    }
    .card {
        margin-bottom: 10px;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">Features</a>
                    <a class="nav-item nav-link" href="#">Pricing</a>
                    <a class="nav-item nav-link disabled" href="#">Disabled</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
    <?php
        require_once('connection.php');
        $sql = "SELECT * FROM class";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
    ?>
    <div class="col-xl-4 col-lg-6">
        <div class="card h-100" style="width: 18rem;">
            <img class="card-img-top" src="<?php echo $row['HinhLop'] ?>" alt="Hinh lop">
            <div class="card-body">
                <h5 class="card-title"><?php  echo $row['TenLop'] ?></h5>
                <p class="card-text"><?php echo $row['Phong'] ?></p>
                <a href="detailClass.php?id=<?php echo $row['IdLop'] ?>" class="btn btn-primary">Detail</a>
                <a href="createClass.php?id=<?php echo $row['IdLop'] ?>" class="btn btn-primary">Edit</a>
                <a href="deleteClass.php?id=<?php echo $row['IdLop'] ?>" id="deleClass" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
        </div>
    </div>
</body>
<script src="main.js">
</script>
</html>
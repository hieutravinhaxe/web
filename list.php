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

<body>
    <style>
        .carousel img{
            width: 100%;
            height: 300px;
        }
        .card a{
            width: 100px;
            height: auto;
            position: absolute;
            right: 0px;
        }
    </style>
    <?php 
        if(isset($_GET['id'])){
            require_once("connection.php");
            $id = $_GET['id'];
            $sql = "SELECT * FROM class WHERE IdLop=$id";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
            $file = $row['HinhLop'];
            $sql1 = "SELECT * FROM thanhvien WHERE IdLop=$id and argree=1";
            $result1 = $conn->query($sql1);
        }
    ?>
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
            <div class="col-xl-3 col-md-6">
                <div class="left">
                    <ul class="list-group">
                        <li class="list-group-item text-primary"><a href="detailClass.php?id=<?php echo $id?>">Thông báo</a></li>
                        <li class="list-group-item text-primary"><a href="assignment.php?id=<?php echo $id?>">Bài tập</a></li>
                        <li class="list-group-item text-primary"><a href="list.php?id=<?php echo $id?>">Danh sách lớp</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-md-6">
                <div class="right">
                    <div class="carousel">
                        <img src="<?php echo $file ?>">
                    </div>
                    <div class="list">
                    <a href="" type="button" class="btn btn-primary">Thêm thành viên</a>
                    <?php
                        while($row1 = $result1->fetch_assoc()){
                            $user = $row1['IdNguoiDung'];
                            $sql2 = "SELECT * FROM nguoidung where IdNguoiDung = $user";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                    ?>
                    <div class="card bg-light text-dark">
                        <div class="card-body"><?php echo $row2['UserName'] ?><a href="deleteMember.php?Lop=" type="button" class="btn btn-danger">Xóa</a></div>
                        
                    </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
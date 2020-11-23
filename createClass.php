<?php
    session_start();
    require_once 'db.php';
    if (isset($_SESSION['Username'])) {
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tạo lớp học</title>
        <link href="styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <?php
        $id = '';
        $classname = '';
        $classroom = '';
        $classproject = '';
        $success = '';
        
        if(isset($_GET['id'])){
            require_once("connection.php");
            $id = $_GET['id'];
            $sql = "SELECT * FROM class WHERE IdLop=$id";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$id = $row["IdLop"];
			$classname = $row["TenLop"];
			$classroom = $row["Phong"];
			$classproject = $row["Mon"];
        }
        
    ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-nomal my-4">Tạo lớp học</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="procreateclass.php" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $id ?>" >
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputClassName">Tên lớp</label>
                                                <input name="classname" value="<?= $classname ?>" class="form-control py-4" id="inputClassName" type="text" placeholder="Nhập tên lớp" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputClassRoom">Phòng</label>
                                                <input name="classroom" value="<?= $classroom ?>" class="form-control py-4" id="inputClassRoom" type="text" placeholder="Nhập phòng" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputClassProject">Môn</label>
                                                <input name="classproject" value="<?= $classproject ?>" class="form-control py-4" id="inputClassProject" type="text" placeholder="Nhập môn học" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="fileToUpload">Ảnh</label>
                                                <input name="fileToUpload" class="form-control py-4" id="fileToUpload" type="file" required/>
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                    if (!empty($error)){
                                                        echo "<div class='alert alert-danger text-center'>$error</div>";
                                                    }
                                                ?>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary m-auto">Lưu</button> 
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div> 
        
        <script src="main.js"></script>
    </body>
</html>

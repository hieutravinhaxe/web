<?php
session_start();
if (!isset($_SESSION['Username']) && $_SESSION['Role'] != 0) {
    header('location:../login.php');
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
    <link href="../styles.css" rel="stylesheet" />
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
    require '../db.php';

    

    if (isset($_POST['editUser'])) {

        $role = $_POST['Role'];
        $email = $_POST['Email'];

        if($role == 0 || $role == 1 || $role ==2){
            $conn = open_database();

            $stmt = $conn->prepare("update nguoidung set Role = ? where Email = ?");
            $stmt->bind_param('ss', $role, $email);

            if(!$stmt->execute()){
                die("Query error: " . $stmt->error);
            }
        }
    }

    $conn = open_database();

    $stmt = $conn->prepare('select * from nguoidung');
    if(!$stmt->execute()){
        die("Querry error: ". $stmt->error);
    }

    $result = $stmt->get_result();
?>

<body>

    <?php require_once '../nav.php' ?>
    
    <div id="layoutSidenav" style="height: 600px;">
        
    <?php require_once '../sideBar.php' ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Phân quyền</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Danh sách người dùng
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Họ và Tên</th>
                                            <th>Email</th>
                                            <th>Quyền</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($row = $result->fetch_assoc()){
                                        ?>

                                            <tr>
                                                <td><?= $row['Name']; ?></td>
                                                <td><?= $row['Email']; ?></td>
                                                <td><?php
                                                    if ($row['Role'] == 0) {
                                                        echo 'Admin';
                                                    } else if ($row['Role'] == 1) {
                                                        echo 'Giáo viên';
                                                    } else {
                                                        echo 'Học sinh';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"> <button type="button" class="btn btn-outline-primary btnEditUser" id=""><i class="fas fa-edit mr-2"></i>Edit</button> </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- edit modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="PhanQuyen.php" method="post">
                        <div class="form-group">
                            <label>Họ và tên:</label>
                            <input type="text" class="form-control" id="Name" name="Name" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" class="form-control" id="Email" name="Email" readonly>
                        </div>
                        <div class="form-group">
                            <label>Quyền:</label>
                            <select name="Role" id="Role" class="form-control">
                                <option id="AD" value="0">Admin</option>
                                <option id="GV" value="1">Giáo viên</option>
                                <option id="HS" value="2">Học sinh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="editUser" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    
    <script src="../main.js"></script>
</body>

</html>
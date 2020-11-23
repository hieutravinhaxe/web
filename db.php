<?php
        // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';
    
    function open_database() {
        $conn = mysqli_connect('localhost','root','','qllh');
        if (!$conn){
            echo 'loi ket noi database';
        }
        $conn->set_charset('utf8');
        return $conn;
    }

    function login($user, $pass){
        $sql = "select * from nguoidung where Username = ?";
        $conn = open_database();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $user);

        if(!$stmt->execute()){
            die('khong the thuc hien truy van');
        }

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $hashed_password = $data['Password'];
        if (!password_verify($pass, $hashed_password)){
            return array('code' => 1, 'error' => 'Sai mat khau');
        }
        else return array('code' => 0, 'data' => $data);
    }

    function check_email($email){
        $sql = "select Email from nguoidung where Email = ?";
        $conn = open_database();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        if (!$stmt->execute()) {
            die("Query error:" . $stmt->error);
        }

        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }
        else return false;
    }

    function check_username($username){
        $sql = "select Username from nguoidung where Username = ?";
        $conn = open_database();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        if (!$stmt->execute()) {
            die("Query error:" . $stmt->error);
        }

        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }
        else return false;
    }

    function register($name, $birth, $email, $username, $pass){
        
        if(check_email($email)){
            return array('code' => 1, 'error' => 'Email này đã tồi tại.');
        }

        if(check_username($username)){
            return array('code' => 2, 'error' => 'Tên tài khoản này đã tồi tại.');
        }

        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "insert into nguoidung(Name, Birth, Email, Username, Password, Role) values (?,?,?,?,?,?)";
        $conn = open_database();

        $stmt = $conn->prepare($sql);
        $role = 2;
        $stmt->bind_param('sssssi', $name, $birth, $email, $username, $hash, $role);

        if (!$stmt->execute()) {
            die("Query error:" . $stmt->error);
        }   

        return array('code' => 0, 'error' => 'Thành công');
    }

    function sendEmailResetPassword($email, $token) {
        
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->CharSet = 'UTF-8'; 
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'chientranplus@gmail.com';                     // SMTP username
            $mail->Password   = 'trtnfzdutberkfqc';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('chientranplus@gmail.com', 'Admin QLLH');
            $mail->addAddress($email, 'Người nhận');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Khôi phục mật khẩu của bạn';
            $mail->Body    = "Click <a href='http://localhost/QLLH/reset_password.php?email=$email&token=$token'>vào đây</a> để khôi phục mật khẩu của bạn";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function createToken($email){
        $token = uniqid(md5(time()));


        $conn = open_database();

        $stmt = $conn->prepare('update nguoidung set Token = ? where Email = ?');
        $stmt->bind_param('ss',$token, $email);
        if(!$stmt->execute()){
            return array('code' => 1, 'error' => 'khong thuc thi duoc truy van');
        }
        else return array('code' => 0, 'token' => $token);
    }

    function check_token($email, $token){
        $sql = "select * from nguoidung where Email = ? and Token = ?";
        $conn = open_database();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $email,$token);
        if (!$stmt->execute()) {
            die("Query error:" . $stmt->error);
        }

        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }
        else return false;
    }
?>


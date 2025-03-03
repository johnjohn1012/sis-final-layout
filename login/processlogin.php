<?php
require('connection.php');
session_start(); // Start session to manage user roles

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Customize SweetAlert buttons */
    .swal2-button {
      background-color: #4CAF50; /* Green color for success */
      color: white;
      border-radius: 5px;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
    }

    .swal2-button:focus {
      outline: none;
      box-shadow: 0 0 10px rgba(0, 255, 0, 0.6);
    }

    /* Customize the error message button */
    .swal2-button[aria-label='OK'] {
      background-color: #FF6347; /* Tomato color for error */
    }

    /* Add custom background colors */
    .swal2-popup {
      background: linear-gradient(135deg, rgb(240, 246, 240), rgb(241, 233, 233));
    }

    /* Solid white color for title and text */
    .swal2-title {
      font-size: 24px;
      font-weight: bold;
      color:rgb(6, 6, 6); /* Solid white color */
    }

    .swal2-text {
      font-size: 22px;
      color: #ffffff; /* Solid white color */
    }

    body {
        background: url('../stockclerk/assets/img/images-harah/bg-harah.jpg') no-repeat center center fixed;
      background-size: cover;
    }

  </style>
</head>
<body>

<?php
if (isset($_POST['btnlogin'])) {
    // CAPTCHA verification
    $captcha = $_POST['g-recaptcha-response'] ?? '';
    if (!$captcha) {
        echo "<script>
                Swal.fire({
                    title: 'CAPTCHA Required!',
                    text: 'Please complete the CAPTCHA verification.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'index.php';
                });
              </script>";
        exit();
    }

    // Verify CAPTCHA with Google
    $secretKey = "6LdlLtcqAAAAAEWUO6AFonbNhzNzrkR9cuxqPkZD"; // Your secret key
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response);

    if (!$result->success) {
        echo "<script>
                Swal.fire({
                    title: 'CAPTCHA Failed!',
                    text: 'Invalid CAPTCHA. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'index.php';
                });
              </script>";
        exit();
    }

    // Continue with existing login checks
    $users = trim($_POST['user']);
    $upass = trim($_POST['password']);
    $h_upass = sha1($upass);

    if ($upass == '') {
        echo "<script>
                Swal.fire({
                    title: 'Password Missing!',
                    text: 'Please enter your password.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'login.php';
                });
              </script>";
        exit();
    } else {
        
        // SQL query to get user details from tbl_user, tbl_employee, and tbl_jobs
        $sql = "SELECT u.user_id, u.user_name, u.user_password, e.job_id, j.job_name
                FROM tbl_user u
                INNER JOIN tbl_employee e ON u.employee_id = e.employee_id
                INNER JOIN tbl_jobs j ON e.job_id = j.job_id
                WHERE u.user_name = ? AND u.user_password = ?";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $users, $h_upass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $found_user = $result->fetch_assoc();

            // Set session variable based on the job_name (Admin, Stock Clerk, Cashier, etc.)
            $_SESSION['job_name'] = $found_user['job_name'];  // Store job_name in session

            // Redirect users based on their job_name with SweetAlert message
            if ($found_user['job_name'] == 'Admin') {
                echo "<script>
                        Swal.fire({
                            title: 'Login Successful!',
                            text: 'Welcome Admin!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location = 'http://localhost/sis/admin/index_admin.php';
                        });
                      </script>";
                exit();

            } elseif ($found_user['job_name'] == 'stockclerk') {
                echo "<script>
                        Swal.fire({
                            title: 'Login Successful!',
                            text: 'Welcome Stock Clerk!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location = 'http://localhost/sis-final-layout/stockclerk/index_admin.php';
                        });
                      </script>";
                exit();

            } elseif ($found_user['job_name'] == 'Cashier') {
                echo "<script>
                        Swal.fire({
                            title: 'Login Successful!',
                            text: 'Welcome Cashier!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location = 'http://localhost/sis-final-layout/cashier/index_admin.php';
                        });
                      </script>";
                exit();
            } else {
                // Redirect to login page for other roles or errors
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User role not found!',
                    }).then(function() {
                        window.location = 'login.php';
                    });
                </script>";
                exit();
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username or Password Not Registered! Contact your administrator.',
                }).then(function() {
                    window.location = 'index.php';
                });
            </script>";
            exit();
        }
    }
}
$conn->close();
$stmt->close();
?>

</body>
</html>

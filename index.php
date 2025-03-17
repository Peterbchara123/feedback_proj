<?php

require_once 'config/database.php';

$Name = $email = $phone = $messg = "";
$NameErr = $emailErr = $phoneErr = $messgErr = "";
$formSubmitted = false;
$successMessage = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formSubmitted = true; 

    // Validate name
    if (empty($_POST['name'])) {
        $NameErr = "Name is required";
        $formSubmitted = false;
    } else {
        $Name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
        $formSubmitted = false;
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $formSubmitted = false;
        }
    }

    // Validate phone
    if (empty($_POST['phone'])) {
        $phoneErr = "Phone number is required";
        $formSubmitted = false;
    } else {
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    }

    // Validate message
    if (empty($_POST['messg'])) {
        $messgErr = "Message is required";
        $formSubmitted = false;
    } else {
        $messg = filter_input(INPUT_POST, 'messg', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    
    if ($formSubmitted) {
        
        $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, messg) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Name, $email, $phone, $messg);

        
        if ($stmt->execute()) {

            
            $successMessage = "<div class='alert alert-success'>Your form has been submitted successfully!</div>";
            $Name = $email = $phone = $messg ='';
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";

        }

        $stmt->close();
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <title>Leave Feedback</title>


</head>
<body>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Overlay Fix</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
  </head>
<body>
<style>body{font-family: 'Poppins',sans-serif;
                            }
</style>
    <!-- Navbar  -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-transparent  position-absolute top-0 start-0 w-100 z-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-camera-fill"></i> Traversy Media</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item "><a class="nav-link"href = "index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="Add_feedback.php">Add Feedback</a></li>
                    <li class="nav-item"><a class="nav-link" href="Check_feedback.php">Check Feedback</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                </ul>
            </div>
        </div>
    </nav>

    
    <section class="container-fluid p-0">
        <div class="position-relative vh-100"
            style="background: url('image/landscape2.jpg') center/cover no-repeat; width: 100%;">
            
            <!-- Text Overlay -->
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                <h1 class="display-3 fw-bold">Welcome to Land-Site</h1>
                <p class="lead">Transforming outdoor spaces with expert landscaping services.</p>
            </div>

        </div>
    </section>

    <section id="gallery" class="bg-secondary bg-opacity-25 py-5">
    <div class="container mt-5">
        <h2 class="text-center my-4"><i class="bi bi-signpost-split"></i> A glimpse of our work!!</h2>
        <div class="row g-2">


            <!-- Images Loop -->
            <div class="col-md-2 col-sm-6" onclick="openModal(this)">
                <div class="ratio ratio-16x9">
                    <img src="image/im1.jpg" class="img-fluid" alt="Mountain">
                </div>
            </div>
            <div class="col-md-2 col-sm-6" onclick="openModal(this)">
                <div class="ratio ratio-16x9">
                    <img src="image/im2.jpg" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-2 col-sm-6" onclick="openModal(this)">
                <div class="ratio ratio-16x9">
                    <img src="image/im3.jpg" class="img-fluid shadow-lg " alt="">
                </div>
            </div>
            <div class="col-md-2 col-sm-6" onclick="openModal(this)">
                <div class="ratio ratio-16x9">
                    <img src="image/im4.jpg" class="img-fluid shadow-lg " alt="">
                </div>
            </div>
            <div class="col-md-2 col-sm-6" onclick="openModal(this)">
                <div class="ratio ratio-16x9">
                    <img src="image/im5.jpg" class="img-fluid shadow-lg " alt="">
                </div>
            </div>
            <div class="col-md-2 col-sm-6" onclick="openModal(this)">
                <div class="ratio ratio-16x9">
                    <img src="image/im6.jpg" class="img-fluid shadow-lg " alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- modal lightbox -->


<div class="modal fade" id="imageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="modalImage" class="img-fluid" src="" alt="Expanded View">
      </div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
    </div>
  </div>
</div>




<footer class="bg-dark text-white text-center py-4">
  <p class="mb-2">For any inquiries, feel free to contact us.</p>
  <button class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#contactOffcanvas">
    Contact Us
  </button>
</footer>

<!-- Offcanvas Contact Form -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="contactOffcanvas">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Fill the infos below!</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <?php
    // Display success or error message
    if (!empty($successMessage)) {
        echo $successMessage;
    }
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-75">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control <?php echo empty($NameErr) ? '' : 'is-invalid'; ?>" 
                   id="name" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($Name); ?>">
            <div class="invalid-feedback"><?php echo $NameErr; ?></div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?php echo empty($emailErr) ? '' : 'is-invalid'; ?>" 
                   id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="invalid-feedback"><?php echo $emailErr; ?></div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control <?php echo empty($phoneErr) ? '' : 'is-invalid'; ?>" 
                   id="phone" name="phone" placeholder="+123456789" value="<?php echo htmlspecialchars($phone); ?>">
            <div class="invalid-feedback"><?php echo $phoneErr; ?></div>
        </div>

        <div class="mb-3">
            <label for="messg" class="form-label">Message</label>
            <textarea class="form-control <?php echo empty($messgErr) ? '' : 'is-invalid'; ?>" 
                      id="messg" name="messg" placeholder="Enter your message"><?php echo htmlspecialchars($messg); ?></textarea>
            <div class="invalid-feedback"><?php echo $messgErr; ?></div>
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
        </div>
    </form>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>
    function openModal(img) {
        document.getElementById('modalImage').src = img.querySelector('img').src;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }
</script>



</body>
</html>

















  
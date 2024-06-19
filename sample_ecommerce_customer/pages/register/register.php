<?php
include '../TEMPLATES/header.php';
?>

<div class="untree_co-section register-section before-footer-section">
    <div class="container">
        <div class="row">
            <form action="register.php" method="POST" id="registerForm">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-5 border p-5 rounded bg-white">
                        <h2 class="text-center mb-4">Register</h2>
                        <p class="text-center mb-4">Already have an account? <a href="../login/login.php">Login</a></p>
                        <div class="form-group mb-3">
                            <label class="text-black" for="regfname">First Name</label>
                            <input type="text" class="form-control" id="regfname" name="regfname" value="<?php echo isset($_POST['regfname']) ? htmlspecialchars($_POST['regfname']) : ''; ?>">
                            <span class="error text-danger" id="fnameError"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-black" for="reglname">Last Name</label>
                            <input type="text" class="form-control" id="reglname" name="reglname" value="<?php echo isset($_POST['reglname']) ? htmlspecialchars($_POST['reglname']) : ''; ?>">
                            <span class="error text-danger" id="lnameError"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-black" for="regemail">Email Address</label>
                            <input type="email" class="form-control" id="regemail" name="regemail" value="<?php echo isset($_POST['regemail']) ? htmlspecialchars($_POST['regemail']) : ''; ?>">
                            <span class="error text-danger" id="emailError"></span>
                            <span class="error text-danger" id="emailExist"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-black" for="regusername">Username</label>
                            <input type="text" class="form-control" id="regusername" name="regusername" value="<?php echo isset($_POST['regusername']) ? htmlspecialchars($_POST['regusername']) : ''; ?>">
                            <span class="error text-danger" id="unameError"></span>
                            <span class="error text-danger" id="userExist"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-black" for="regpass">Password</label>
                            <input type="password" class="form-control" id="regpass" name="regpass" value="<?php echo isset($_POST['regpass']) ? htmlspecialchars($_POST['regpass']) : ''; ?>">
                            <span class="error text-danger" id="passError"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-black" for="regconpass">Confirm Password</label>
                            <input type="password" class="form-control" id="regconpass" name="regconpass" value="<?php echo isset($_POST['regconpass']) ? htmlspecialchars($_POST['regconpass']) : ''; ?>">
                            <span class="error text-danger" id="conpassError"></span>
                            <span class="error text-danger" id="conpassNotEqual"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-black" for="regcontact">Contact No.</label>
                            <input type="number" class="form-control" id="regcontact" name="regcontact" value="<?php echo isset($_POST['regconpass']) ? htmlspecialchars($_POST['regconpass']) : ''; ?>">
                            <span class="error text-danger" id="contactError"></span>
                        </div>
                        <div class="form-group mb-5">
                            <label class="text-black" for="regaddress">Address</label>
                            <input type="text" class="form-control" id="regaddress" name="regaddress" value="<?php echo isset($_POST['regaddress']) ? htmlspecialchars($_POST['regaddress']) : ''; ?>">
                            <span class="error text-danger" id="addressError"></span>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitReg">Register</button>
                    </div>
                </div>
            </form>
            <div id="response"></div>
        </div>
    </div>
</div>


<script src="script.js"></script>
<?php
include '../TEMPLATES/footer.php';
?>
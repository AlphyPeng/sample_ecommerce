<?php
include '../TEMPLATES/header.php';
?>
<div class="untree_co-section login-section before-footer-section">
    <div class="container">
        <div class="row">
            <form id="loginForm" method="POST">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-5 border p-5 rounded bg-white">
                        <h2 class="text-center mb-4">Login</h2>
                        <p class="text-center mb-4">Don't have an account? <a href="../register/register.php">Create Account</a></p>
                        <div class="form-group mb-3">
                            <label class="text-black" for="loguseremail">Username or Email</label>
                            <input type="text" class="form-control" id="loguseremail" name="loguseremail">
                            <span class="error text-danger" id="useremailError"></span>
                        </div>
                        <div class="form-group mb-5">
                            <label class="text-black" for="logpass">Password</label>
                            <input type="password" class="form-control" id="logpass" name="logpass">
                            <span class="error text-danger" id="passwordError"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="script.js">
</script>
<?php
include '../TEMPLATES/footer.php';
?>
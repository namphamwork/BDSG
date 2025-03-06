<?php
session_start();
?>

<div class="login-wraper">
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Forgot pass
            </div>
            <div class="title signup">
                Signup Form
            </div>
        </div>
        <div class="form-container">
            <div>

            </div>
            <div class="form-inner">
                <form action="./page/resetpass_process.php" class="login" method="post">
                    <label for="code">Reset Password</label>
                    <div class="field">
                        <input type="password" name="password" placeholder="password" required>
                    </div>
                    <div class="field">
                        <input type="password" name="repassword" placeholder="Re password" required>
                    </div>


                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Reset Password">
                    </div>
                    <div class="signup-link">
                        Not receive email <a href="">Resend</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
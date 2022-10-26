<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="https://www.bootstrapdash.com/demo/login-template-free-2/assets/images/login.jpg" alt="login" class="login-card-img">

                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="brand-wrapper">
                            <img src="https://www.bootstrapdash.com/demo/login-template-free-2/assets/images/logo.svg" alt="logo" class="logo">
                        </div>
                        <p class="login-card-description">Sign into your account</p>
                        <p><?php echo $this->session->flashdata('error'); ?></p>
                        <!-- <form action="<?php echo base_url() ?>welcome/login" method="post"> -->
                        <?php echo  form_open_multipart(); ?>

                        <div class="form-group">
                            <label for="username" class="sr-only">Organisation Name</label>
                            <input type="username" name="form[organisation]" id="username" class="form-control" placeholder="Organisation Name">
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Work Email</label>
                            <input type="username" name="form[username]" id="username" class="form-control" placeholder="Work Email">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="form[password]" id="password" class="form-control" placeholder="***********">
                        </div>


                        <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                        </form>
                        <a href="#!" class="forgot-password-link">Forgot password?</a>
                        <p class="login-card-footer-text">Don't have an account? <a href="<?php echo base_url() ?>welcome/register" class="text-reset">Register here</a></p>
                        <nav class="login-card-footer-nav">
                            <a href="#!">Terms of use.</a>
                            <a href="#!">Privacy policy</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<style>
    /*# sourceMappingURL=login.css.map */
</style>
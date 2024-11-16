<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('templates/head.html'); ?>
</head>

<body>
    <div class="content-wrapper">
        <!-- Sign In Title -->
        <section class="wrapper text-center">
            <div class="container pt-17 pb-20 pt-md-12 pb-md-21">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="display-1 mb-3">Sign In</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sign In Card -->
        <section class="wrapper bg-light">
            <div class="container pb-14 pb-md-16">
                <div class="row">
                    <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                        <div class="card">
                            <div class="card-body p-11 text-center">
                                <h2 class="mb-3 text-center">Step 2</h2>
                                <p class="lead text-center">Enter the 6-digit verification code that was sent to your email</p>
                                <form name="login-form" method="post" action="/verifyotp/" class="text-start mb-3 mt-6">
                                    <div class="form-floating mb-4">
                                        <input type="password" name="otp" class="form-control" />
                                        <label for="loginEmail">Enter OTP</label>
                                    </div>
                                    <input class="btn btn-primary rounded-pill btn-login w-100 mb-2" type="submit" name="send-otp-button" value="Verify">
                                </form>
                                <p class="mb-0">Didn't receive the code? <a href="/resendotp/" class="hover">Resend</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include('templates/foot.html'); ?>
</body>

</html>
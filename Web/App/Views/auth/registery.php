
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a2af703eed.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="vendors/font-awesome-4.7.0/css/font-awesome.min.css" />
    <title>Login</title>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
            height: 100%;
        }
}
    </style>
</head>
<body>
    <div class="loader">
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-8 col-lg-6 col-xl-4 ">
                        <form>
                            <h2>Welcome to PaPals</h2>
                            <h4>Create your account!</h4>
                            <!-- Email input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form3Example3">Email address</label>
                                <input type="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" />
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form3Example4">Create Your Password</label>
                                <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            </div>
                            <!-- Password check -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form3Example4">Retype Your Password</label>
                                <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            </div>                            
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="button" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Create account</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Already an account? <a href="#!"
                                class="link-danger">Log In</a></p>
                            </div>
                            
                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0">Or</p>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                                <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fa-brands fa-facebook-f"></i>
                                </button>
    
                                <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fa-brands fa-google"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <? require "/../../public/inc/footer.php"?>
        </section>
    </div>
</body>
</html>
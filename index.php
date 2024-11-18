<?php require_once ("./stroage/db.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.min.js"></script>
</head>
<body>
    <div class="card mx-auto login-container">
        <div class="card-body">
            <h2 class="text-center">Login Form</h2>
            <form method="post">
                <div class="form-floating my-5">
                    <input type="email" class="form-control" id="email" placeholder="name@gmail.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mt-5 mb-2">
                    <input type="password" class="form-control" id="password" placeholder="password">
                    <label for="password">Password</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="show" class="form-check-input">
                    <label class="form-check-label" for="show">
                        Show Password
                    </label>
                </div>
                <button class="custom-btn mt-3">LOGIN</button>
            </form>  
        </div>
    </div>
    <script>
        let show = $("#show");
        let password = $("#password");
        show.on("click",()=>{
            if(show.is(":checked")){
                password.get(0).type = "text";
            }else{
                password.get(0).type = "password";
            }
        })
    </script>
</body>
</html>
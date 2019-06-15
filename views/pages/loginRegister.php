<?php zabeleziPristupStranici(); ?>
<body>
<div class="container1">
    <div class="row">
        <div class="col-sm-12">
            <ul class="tabs">
                <li><a href="#" id="1">LOGIN</a></li>
                <li><a href="#" id="2">SIGN UP</a></li>
            </ul>
        </div>
        <div class="col-sm-12">
            <form action="models/users/login.php" method="POST">
                <div class="form row" id="login">

                    <div class="col-sm-12 container">
                    <div class="input">
                        <input class="main-form animated bounceInDown" type="text" name="loginMail" id="loginMail" placeholder=" EMAIL ADDRESS"/>
                    </div>
                    <div class="input">
                        <input class="main-form animated bounceInDown" type="password" name="loginPassword" id="loginPassword" placeholder=" PASSWORD"/>
                    </div>
                    <div class="input">
                        <input class="main-form btn animated bounceInDown" type="submit" name="btnLogin" id="btnLogin" value = "LOGIN"/>
                    </div>
                </div>
                </div>
            </form>


            <form action="models/users/registration.php" method="POST">
                <div class="form row" id="register" style="display: none;">

                    <div class="col-sm-12 container">
                        <div class="input">
                            <input class="main-form animated bounceInDown" type="text" name="first_name" id="first_name" placeholder=" FIRST NAME"/>
                        </div>
                        <div class="input">
                            <input class="main-form animated bounceInDown" type="text" name="last_name" id="last_name" placeholder=" LAST NAME"/>
                        </div>

                        <div class="input">
                            <input class="main-form animated bounceInDown" type="text" name="tbMail" id="tbMail" placeholder=" EMAIL ADDRESS"/>
                        </div>
                        <div class="input">
                            <input class="main-form animated bounceInDown" type="password" name="tbPassword" id="tbPassword" placeholder=" PASSWORD"/>
                        </div>

                        <div class="input">
                            <input class="main-form btn animated bounceInDown" type="button" name="btnRegister" id="btnRegister" value = "SIGN UP"/>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
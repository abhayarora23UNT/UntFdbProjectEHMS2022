<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">.
       <link rel="stylesheet" href="../../css/main.css">
       <link rel="stylesheet" href="../../fontawesome/css/all.css">
       <link rel="stylesheet" href="../../fontawesome/css/all.css">
    <title>nurse login</title>
  </head>
  <body class="admin__login">
    <div class="wrapper">
      <div class="form__title">
        <h2>Nurse Login</h2>
      </div>

      <form class="" action="../../../CONTROL/NURSE/nurse_login_contr.php" method="post">
        <fieldset>
							<legend>
								Sign into your account
							</legend>
							<p>
								Please enter your email and password to log in.<br />
							</p>
							<div class="form__inputs">
                <div class="usericon">
              <i class="fas fa-envelope"></i>
                  </div>
									<input type="text" name="email"  placeholder="Email" required><br>
                  <div class="passicon">
                  <i class="fa fa-eye" id="pass__toggle"></i>
                  </div>
									<input type="password" id="password" name="password" placeholder="Password" required>
                  <div class="forgotpassbtn">
                        <a href="forgotpassword.php">Forgot Password?</a>
                  </div>
                  <p style="color:red;font-size:0.8em;">
                    <?php
                    if (isset($_GET['error'])) {
                      echo $_GET['error'];
                    }
                     ?>
                  </p>
                  <p style="color:green;font-size:0.8em;">
                    <?php
                    if (isset($_GET['success'])) {
                      echo $_GET['success'];
                    }
                     ?>
                  </p>
							<div id="login__btn">
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
              	</div>

						</fieldset>
					</form>
          <div class="login__footer">
            <i class="fal fa-at"></i><?php echo date('Y'); ?> Saint Paul II Hospital.All Rights Reserved
          </div>
        </div>
        <footer>
          <div class="footer__content">
            <ul class="footer__list">
              <li class="home"><a  href="../index.php">HOME</a></li>
              <li class="footer__divider"></li>
              <li class="contactus"><a href="contactus.php">CONTACT US</a></li>
            </ul>

          </div>

        </footer>
        <script type="text/javascript">
        const pass__toggle=document.querySelector('#pass__toggle');
        const password=document.querySelector('#password');
        pass__toggle.addEventListener('click',function (e){
          const type=password.getAttribute('type') ==='password' ? 'text' : 'password';
        password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });

        </script>
  </body>
</html>

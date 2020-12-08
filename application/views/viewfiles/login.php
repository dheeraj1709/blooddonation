 <html>
<head>
<?php $this->load->view('commonfiles/header'); ?>
<title></title>
</head>
<body>
    <div class="signup_backdiv">
        <div class="signup_block">
            <div class="signup_left">
                <div class="signup_hospital_div">Login as Hospital</div>
                <div class="signup_hospital_form">
                    <button onclick="slideSignup()">Login as Hospital</button>
                </div>
            </div>
            <div class="signup_slider" >
                <div class="signup_hospital">
                    <span>Login as Hospital</span>
                    <div class="signup_receiver_form">
                    <form action="userLogin" enctype="multipart/form-data" method="POST">
                        <div class="input_div">
                            <span><label class="signup_label" for="">Username</label></span>
                            <span><input type="text" name="username"></span>
                        </div>
                        <input type="text" style="display:none" value="hospital" name="userType">
                        <div class="input_div">
                            <span><label class="signup_label" for="">Password</label></span>
                            <span><input type="password" class="password" userType="hospital" name="password"></span>
                        </div>
                        <div class="input_div">
                            <input type="submit" class="submit_hospital" usertype="hospital">
                        </div>
                    </form>
                </div>
                </div>
                <div class="signup_receiver">
                    <span>Login as Receiver</span>
                    <div class="signup_receiver_form">
                    <form action="userLogin" enctype="multipart/form-data" method="POST">
                        <div class="input_div" >
                            <span><label class="signup_label" for="">Username</label></span>
                            <span><input type="text" name="username"></span>
                        </div>
                        <div class="input_div" >
                            <span><label class="signup_label" for="">Password</label></span>
                            <span><input type="password" class="userName" userType="receiver" name="password"></span>
                        </div>
                        <input type="text" style="display:none" value="receiver" name="userType">
                        <div class="input_div" >
                            <input type="submit" class="submit_receiver" usertype="receiver">
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="signup_right">
                <div class="signup_receiver_div">Login as Receiver</div>
                <div class="signup_receiver_form">
                <button onclick="slideSignup()">Login as Receiver</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!-- https://agile-basin-40179.herokuapp.com/ | https://git.heroku.com/agile-basin-40 
179.git

<html>
<head>
<?php $this->load->view('commonfiles/header'); ?>
</head>
<body>
    <div class="signup_backdiv">
        <div class="signup_block">
            <div class="signup_left">
                <div class="signup_hospital_div">Signup as Hospital</div>
                <div class="signup_hospital_form">
                    <button onclick="slideSignup()">Signup as Hospital</button>
                </div>
            </div>
            <div class="signup_slider" >
                <div class="signup_hospital">
                    <span class="signup_heading">Signup as Hospital</span>
                    <div class="signup_receiver_form">
                    <form action="auth/userSignup" enctype="multipart/form-data" method="POST">
                        <div class="input_div">
                            <span><label class="signup_label" for="">Name</label></span>
                            <span><input type="text" name="name"></span>
                        </div>
                        <div class="input_div">
                            <span><label class="signup_label" for="">User Name</label></span>
                            <span><input type="text" class="userName" userType="hospital" name="username"></span>
                        </div>
                        <div class="input_div">
                            <span><label class="signup_label" for="">Password</label></span>
                            <span><input type="text" name=""></span>
                        </div>
                        <input type="text" style="display:none" value="hospital" name="usertype">
                        <div class="input_div">
                            <span><label class="signup_label" for="">Confirm Password</label></span>
                            <span><input type="text" name="password"></span>
                        </div>
                        <div class="input_div">
                            <span><label class="signup_label" for="">Profile Image</label></span>
                            <span><input type="FILE" name="logo"></span>
                        </div>
                        <div class="input_div">
                            <input type="submit" class="submit_hospital" usertype="hospital">
                        </div>
                        <div class="loginInstead">
                            <i>Already a user?</i>&nbsp;<a href="auth/login">Login</a>
                        </div>
                    </form>
                </div>
                </div>
                <div class="signup_receiver">
                    <span class="signup_heading">Signup as Receiver</span>
                    <div class="signup_receiver_form">
                    <form action="auth/userSignup" enctype="multipart/form-data" method="POST">
                        <div class="input_div" >
                            <span><label class="signup_label" for="">Name</label></span>
                            <span><input type="text" name="name"></span>
                        </div>
                        <div class="input_div" >
                            <span><label class="signup_label" for="">User Name</label></span>
                            <span><input type="text" class="userName" userType="receiver" name="username"></span>
                        </div>
                        <div class="input_div" >
                            <span><label class="signup_label" for="">Blood Group</label></span>
                            <span>
                                <select class="bloodGroup" name="bloodGroup">
                                    <?php 
                                    $groups = json_decode($groups);
                                    foreach($groups->groups as $group){ ?>
                                        <?php $type = $group->type; ?>
                                    <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                                    <?php } ?>    
                                </select>
                            </span>
                        </div>
                        <input type="text" style="display:none" value="receiver" name="usertype">
                        <div class="input_div" >
                            <span><label class="signup_label" for="">Password</label></span>
                            <span><input type="text" name=""></span>
                        </div>
                        <div class="input_div" >
                            <span><label class="signup_label" for="">Confirm Password</label></span>
                            <span><input type="text" name="password"></span>
                        </div>
                        <div class="input_div" >
                            <span><label class="signup_label" for="">Profile Image</label></span>
                            <span><input type="FILE" name="logo"></span>
                        </div>
                        <div class="input_div" >
                            <input type="submit" class="submit_receiver" usertype="receiver">
                        </div>
                        <div class="loginInstead">
                            <i>Already a user?</i>&nbsp;<a href="auth/login">Login</a>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="signup_right">
                <div class="signup_receiver_div">Signup as Receiver</div>
                <div class="signup_receiver_form">
                    <button onclick="slideSignup()">Signup as Receiver</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<html>
    <head>
        <?php $this->load->view('commonfiles/header'); ?>
    </head>
    <body class="pages_wrapper">
        <?php $this->load->view('commonfiles/navbar'); ?>
        <div class="home_mainWrapper">
            <div class="home_wrapper">
                <div class="verticalBlock_upper">
                    <?php if($this->session->userdata('username') != null){ ?>
                        <?php if($this->session->userdata('userType') == 'hospital'){ ?>
                        <span class="plus_icon">
                         <img src="<?php echo "appassets/images/icons/plus.png"; ?>" alt="">
                        </span>
                        <?php } ?>
                    <span class="viewAllIcon">
                        <img src="<?php echo "appassets/images/icons/view.png" ?>" alt="">
                    </span>
                    <span class="viewRequests">
                        <img src="<?php echo "appassets/images/icons/request.png" ?>" alt="">
                    </span>
                    <?php } ?>
                </div>
                <div class="verticalBlock_middle">
                    <?php 
                    if($this->session->userdata('userType') == 'hospital'){
                        $groups = (json_decode($groups))->bloodGroupsByHospital;
                        foreach($groups as $group){ ?>
                        <div class="cardParent">
                            <div class="cardBody"><?php echo $group->bloodgroup; ?></div>
                        </div>
                        <?php } 
                    } if($this->session->userdata('userType') == 'receiver'){ ?>
                        <?php 
                        $groups = (json_decode($groups))->HospitalsWithBloodGroup;
                        foreach($groups as $group){ ?>
                        <div class="cardParent">
                            <div class="cardBody"><?php echo $group->name; ?></div>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="verticalBlock_bottom">bottom</div>
            </div>
        </div>
        <div class="modal">
            <div class="modal_box">
                <div class="modal_header"></div>
                <div class="modal_body"></div>
                <div class="modal_footer"></div>
            </div>
        </div>
    </body>
</html>
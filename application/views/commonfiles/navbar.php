<div class="navbar">
    <div>
        <div class="NameIcon">
            <?php if($this->session->userdata('username') != null){
                $nameVariable = $this->session->userdata('username');
            ?>
            <div class="NameIconChild"><?php  echo $nameVariable[0]; ?></div>
            <?php }else{ ?>
                <div class="NameIconChild"><?php  echo 'G'; ?></div>
            <?php } ?>
        </div>
        <?php if($this->session->userdata('username') != null){ ?>
        <div class="Name">Name</div>
        <?php }else{ ?>
            <div class="Name">Guest</div>
        <?php } ?>
        <div class="bloodgroup">Caption</div>
    </div>
<div class="logout_tab" onclick="logout()">
    <i>
        <img src="<?php echo 'appassets/images/icons/logout.png' ?>" alt="">
    </i>
    <span>Logout</span></div>
</div>
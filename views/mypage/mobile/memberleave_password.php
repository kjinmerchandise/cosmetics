<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="mypage mypage02">
    
    <h2>CONFIRM PASSWORD</h2>

    <?php
    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
    echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-warning"><button type="button" class="close alertclose" >&times;</button>', '</div>');
    ?>

    <div class="form-horizontal">
        <?php
        $attributes = array('class' => 'form-horizontal', 'name' => 'fconfirmpassword', 'id' => 'fconfirmpassword', 'onsubmit' => 'return confirmleave()');
        echo form_open(current_url(), $attributes);
        ?>
            <div class="alert alert-dismissible alert-danger infoalert">
                <span>This is a password entry page for unsubscribing members.
                If you enter your password, your membership will be canceled normally.
                Membership information can not be restored, so please select carefully.</span>
            </div>
            <ol class="askpassword">
                <li>
                    <h3>ID</h3>
                    <div class="form-text"><p><?php echo $this->member->item('mem_userid'); ?></p></div>
                </li>
                <li>
                    <h3>Password</h3>
                    <input type="password" class="input px100" id="mem_password" name="mem_password" />
                </li>
                <li>
                    <button class="btn btn-primary" type="submit">CONFIRM</button>
                    <div>
                        <p>
                            <span class="fa fa-exclamation-circle"></span>
                            In order to protect your information from outside, you need to confirm your password.
                        </p>
                    </div>
                </li>
            </ol>
        <?php echo form_close(); ?>
    </div>
    <section class="ad">
            <?php echo banner('product_details_banner'); ?>
            </section>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fconfirmpassword').validate({
        rules: {
            mem_password : { required:true, minlength:4 }
        }
    });
});
function confirmleave() {
    if (confirm('정말 회원 탈퇴를 하시겠습니까? 탈퇴한 회원정보는 복구할 수 없으므로 신중히 선택하여주세요. 확인을 누르시면 탈퇴가 완료됩니다 ')) {
        return true;
    } else {
        return false;
    }
}
//]]>
</script>

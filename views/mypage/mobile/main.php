<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<article class="content02">
        <!-- mypage -->
    <section class="sign_up mypage">
        <!-- title -->
        <h2>
            MY PAGE
        </h2>
    <!-- 정보영역  -->
        

        <?php
        echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
        echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info">', '</div>');
        echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info">', '</div>');
        $attributes = array('class' => 'form-horizontal', 'name' => 'fchangepassword', 'id' => 'fchangepassword');
        echo form_open_multipart(site_url('membermodify/modify'), $attributes);
        ?>

        <table>
            <tr>
                <td>
                    <h3>ID</h3>
                    <p><?php echo html_escape($this->member->item('mem_userid')); ?></p>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Password</label>
                    <button type="button" onclick="location.href='<?php echo site_url('membermodify/password_modify'); ?>'">Change Password</button>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Leave</label>
                    <button type="button" onclick="location.href='<?php echo site_url('membermodify/memberleave'); ?>'">Leave</button>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>E-mail</h3>
                    <span> (Used for password search)</span>
                    <input type="email" id="mem_email" name="mem_email" value="<?php echo html_escape($this->member->item('mem_email')); ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Nickname</h3>
                    <span>(Please enter your Nickname)</span>
                    <input type="text" id="mem_nickname" name="mem_nickname" value="<?php echo html_escape($this->member->item('mem_nickname')); ?>">
                </td>
            </tr>
            

            <tr>
                <td>
                    <h3>Phone</h3>
                    <span>(Please enter your mobile number)</span>
                    <input type="text" id="mem_phone" name="mem_phone" value="<?php echo html_escape($this->member->item('mem_phone')); ?>">
                </td>
            </tr>

            <tr>
                <td>
                    <h3>Address</h3>
                    <textarea name="mem_address1" cols=3><?php echo html_escape($this->member->item('mem_address1')); ?></textarea>
                </td>
            </tr>
        </table>
    <!-- complete버튼  -->
        <div class="sign_up_btn one_btn">
            <button type="submit" >
                COMPLETE
            </button>
        </div>  
    </section>
    <?php echo form_close(); ?>
<!-- 하단 광고 -->
    <section class="ad">
        <?php echo banner("product_details_banner") ?>
    </section>
</article>
<?php

$this->managelayout->add_js(base_url('assets/js/member_register.js'));

?>
<script type="text/javascript">
//<![CDATA[

$(function() {
    $('#fregisterform').validate({
        onkeyup: false,
        onclick: false,
        rules: {
            mem_email: {required :true, email:true, is_email_available:true},
            mem_nickname: {required :true, is_nickname_available:true},
            mem_phone: {required :true}
        },
        messages: {
            recaptcha: '',
            captcha_key: '자동등록방지용 코드가 올바르지 않습니다.'
        }
    });

    
});
//]]>
</script>
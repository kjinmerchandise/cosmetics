<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>


<article class="content02">
        <!-- 회원가입 02 -->
            <section class="sign_up sign_up02">
                <!-- 타이틀 -->
                    <h2>
                        SIGN UP
                    </h2>
                <!-- step -->
                    <ol>
                        <li>
                            <a href="">
                                <figure>
                                    <img src="<?php echo base_url('assets/images/signup04.png');?>" alt="signup04">
                                    <figcaption>
                                        <h3>
                                            01<br>
                                            Accept<br>
                                            Terms
                                        </h3>
                                    </figcaption>
                                </figure>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <figure>
                                    <img src="<?php echo base_url('assets/images/signup02.png');?>" alt="signup02">
                                    <figcaption>
                                        <h3>
                                            02<br>
                                            Enter<br>
                                            Information
                                        </h3>
                                    </figcaption>
                                </figure>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <figure>
                                    <img src="<?php echo base_url('assets/images/signup06.png');?>" alt="signup03">
                                    <figcaption>
                                        <h3>
                                            03<br>
                                            Signed<br>
                                            Up
                                        </h3>
                                    </figcaption>
                                </figure>
                            </a>
                        </li>
                    </ol>
                <!-- 정보 입력란 -->

                    <?php
                    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
                    echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
                    $attributes = array('class' => 'form-horizontal', 'name' => 'fregisterform', 'id' => 'fregisterform', 'onSubmit' => 'return registerform_submit(this)');
                    echo form_open_multipart(current_full_url(), $attributes);
                    ?>
                    <input type="hidden" name="mem_open_profile" id="mem_open_profile" value="0">
                    <input type="hidden" name="mem_receive_email" id="mem_receive_email" value="0">
                    <input type="hidden" name="mem_receive_sms" id="mem_receive_sms" value="0" >
                    <table>


                        <?php
                        
                        foreach (element('html_content', $view) as $key => $value) {
                            $dispaly='';
                            if(element('field_name',$value)==='mem_nickname') $dispaly='style="display:none";';
                        ?>
                            <tr <?php echo $dispaly ?>>
                                <td>
                                <label><?php echo element('display_name', $value); ?></label>
                                <div class="">
                                    <?php echo element('input', $value); ?>
                                    <?php if (element('description', $value)) { ?>
                                        <p class="help-block"><?php echo element('description', $value); ?></p>
                                    <?php } ?>
                                </div>
                                </td>
                            </tr>
                        <?php
                        }
                        
                        ?>

                           
                    </table>
                    
                <!-- next, cancel 버튼 -->
                    <div class="sign_up_btn">
                        <button type="submit" >Next</button>
                        <button type="button" onclick="location.href='<?php echo site_url(); ?>';">
                            Cancel
                        </button>
                    </div>
                    <?php echo form_close(); ?>
            </section>

        <!-- 하단 광고 -->
            <section class="ad">
                <?php echo banner("product_details_banner") ?>
            </section>
    </article>

<?php
$this->managelayout->add_css(base_url('assets/css/datepicker3.css'));
$this->managelayout->add_js('http://dmaps.daum.net/map_js_init/postcode.v2.js');
$this->managelayout->add_js(base_url('assets/js/bootstrap-datepicker.js'));
$this->managelayout->add_js(base_url('assets/js/bootstrap-datepicker.kr.js'));
$this->managelayout->add_js(base_url('assets/js/member_register.js'));
if ($this->cbconfig->item('use_recaptcha')) {
    $this->managelayout->add_js(base_url('assets/js/recaptcha.js'));
} else {
    $this->managelayout->add_js(base_url('assets/js/captcha.js'));
}
?>

<script type="text/javascript">
//<![CDATA[
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    language: 'kr',
    autoclose: true,
    todayHighlight: true
});
$(function() {
    $('#fregisterform').validate({
        onkeyup: false,
        onclick: false,
        rules: {
            mem_userid: {required :true, minlength:3, maxlength:20, is_userid_available:true},
            mem_email: {required :true, email:true, is_email_available:true},
            mem_password: {required :true, is_password_available:true},
            mem_password_re : {required: true, equalTo : '#mem_password' },
            mem_nickname: {required :true, is_nickname_available:true},
            mem_phone: {required :true}
            
            <?php if ($this->cbconfig->item('use_recaptcha')) { ?>
                , recaptcha : {recaptchaKey:true}
            <?php } else { ?>
                , captcha_key : {required: false, captchaKey:true}
            <?php } ?>
        },
        messages: {
            recaptcha: '',
            captcha_key: '자동등록방지용 코드가 올바르지 않습니다.'
        }
    });

    
});


function registerform_submit(f) {
        if($("#mem_userid").val())
            $("#mem_nickname").val($("#mem_userid").val());

        return true;
}
//]]>
</script>

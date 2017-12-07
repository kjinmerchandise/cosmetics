<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>


<!-- content -->
    <article class="content02">
            
        <!-- 아이디 패스워드 입력 -->
            <section class="sign_up login">
                <!-- 타이틀 -->
                    <h2>
                        LOGIN
                    </h2>

                <!-- 아이디,패스워드 입력 -->
                    <table>
                        <?php
                        echo validation_errors('<div class="alert alert-warning" role="alert"><p>', '</p></div>');
                        echo show_alert_message(element('message', $view), '<div class="alert mt20 alert-auto-close alert-dismissible alert-info" style="margin-bottom:0px;">', '</div>');
                        echo show_alert_message($this->session->flashdata('message'), '<div class="alert mt20 alert-auto-close alert-dismissible alert-info" style="margin-bottom:0px;">', '</div>');
                        $attributes = array('class' => 'form-horizontal', 'name' => 'flogin', 'id' => 'flogin','onsubmit'=> 'return form_submit(this)');
                        echo form_open(element('login_url', $view), $attributes);
                        ?>
                        <input type="hidden" name="url" value="<?php echo html_escape($this->input->get_post('url')); ?>" />
                        <tr>
                            <td>
                                <label>
                                    ID
                                </label>
                                <input type="text" name="mem_userid" id="mem_userid" class="" value="<?php echo set_value('mem_userid'); ?>" accesskey="L" />
                                <p>This is a required field.</p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>
                                    PASSWORD
                                </label>
                                <input type="password" id="mem_password" class="" name="mem_password" />
                                <p>This is a required field.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <button type="submit" class="btn btn-primary btn-sm">Login</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <input type="checkbox" checked="checked" name="autologin" id="autologin" value="1" />
                                <label for="autologin">
                                    Stay signed in
                                </label>
                                
                            </td>
                        </tr>
                        <?php echo form_close(); ?>
                    </table>

                <!-- login 버튼 -->
                    


                <!-- 아이디찾기 , 패스워드분실 , 회원가입 --> 
                    <ul>
                        <li id="findId">
                            <p>Find ID</p>
                        </li>

                        <li id="forgotPass">
                            <p>Forgot your password</p>
                        </li>

                        <li>
                            <a href="<?php echo site_url('register'); ?>">
                                <p>Sign Up</p>
                            </a>
                        </li>
                    </ul>
            </section>

        <!-- 하단 광고 -->
            <section class="ad">
            <?php echo banner('product_details_banner'); ?>
            </section>
    </article>

    <article class="popup03">
        <?php 
        
        $attributes = array('name' => 'findidpwform', 'id' => 'findidpwform');
        echo form_open(element('findidpw_url', $view), $attributes);
         ?>
        <input type="hidden" name="findtype" id="findtype" value="findid" />
        <h2>
            *Notice*
            <span>
                Please enter your<br> registered phone number
            </span>
        </h2>

        <input type="tel" id="telnum" name="telnum" value="">

        <p>This is a required field.</p>

        <span id="span_text">
            Send your ID to your email.
        </span>

        <div class="popup_btn">
            <button type="button" id="popupYes" data-popupid=''>Yes</button>
            <button type="button" id="popupNo">No</button>
        </div>
        <?php
        echo form_close();
        ?>
    </article>

<!-- <div class="access">
    <div class="table-box">
        <div class="table-heading">로그인</div>
        <div class="table-body">
          
                <input type="hidden" name="url" value="<?php echo html_escape($this->input->get_post('url')); ?>" />
                <ol class="loginform">
                    <li>
                        <span><?php echo element('userid_label_text', $view);?></span>
                        <input type="text" name="mem_userid" class="input" value="<?php echo set_value('mem_userid'); ?>" accesskey="L" />
                    </li>
                    <li>
                        <span>비밀번호</span>
                        <input type="password" class="input" name="mem_password" />
                    </li>
                    <li>
                        <span></span>
                        <button type="submit" class="btn btn-primary btn-sm">로그인</button>
                        <label for="autologin">
                            <input type="checkbox" name="autologin" id="autologin" value="1" /> 자동로그인
                        </label>
                    </li>
                </ol>
                <div class="alert alert-dismissible alert-info autologinalert" style="display:none;">
                    자동로그인 기능을 사용하시면, 브라우저를 닫더라도 로그인이 계속 유지될 수 있습니다. 자동로그이 기능을 사용할 경우 다음 접속부터는 로그인할 필요가 없습니다. 단, 공공장소에서 이용 시 개인정보가 유출될 수 있으니 꼭 로그아웃을 해주세요.
                </div>
          
            <?php
            if ($this->cbconfig->item('use_sociallogin')) {
                $this->managelayout->add_js(base_url('assets/js/social_login.js'));
            ?>
                <ol class="loginform">
                    <li>
                        <span>소셜로그인</span>
                        <div>
                            <?php if ($this->cbconfig->item('use_sociallogin_facebook')) {?>
                                <a href="javascript:;" onClick="social_connect_on('facebook');" title="페이스북 로그인"><img src="<?php echo base_url('assets/images/social_facebook.png'); ?>" width="22" height="22" alt="페이스북 로그인" title="페이스북 로그인" /></a>
                            <?php } ?>
                            <?php if ($this->cbconfig->item('use_sociallogin_twitter')) {?>
                                <a href="javascript:;" onClick="social_connect_on('twitter');" title="트위터 로그인"><img src="<?php echo base_url('assets/images/social_twitter.png'); ?>" width="22" height="22" alt="트위터 로그인" title="트위터 로그인" /></a>
                            <?php } ?>
                            <?php if ($this->cbconfig->item('use_sociallogin_google')) {?>
                                <a href="javascript:;" onClick="social_connect_on('google');" title="구글 로그인"><img src="<?php echo base_url('assets/images/social_google.png'); ?>" width="22" height="22" alt="구글 로그인" title="구글 로그인" /></a>
                            <?php } ?>
                            <?php if ($this->cbconfig->item('use_sociallogin_naver')) {?>
                                <a href="javascript:;" onClick="social_connect_on('naver');" title="네이버 로그인"><img src="<?php echo base_url('assets/images/social_naver.png'); ?>" width="22" height="22" alt="네이버 로그인" title="네이버 로그인" /></a>
                            <?php } ?>
                            <?php if ($this->cbconfig->item('use_sociallogin_kakao')) {?>
                                <a href="javascript:;" onClick="social_connect_on('kakao');" title="카카오 로그인"><img src="<?php echo base_url('assets/images/social_kakao.png'); ?>" width="22" height="22" alt="카카오 로그인" title="카카오 로그인" /></a>
                            <?php } ?>
                        </div>
                    </li>
                </ol>
            <?php } ?>
        </div>
        <div class="table-footer">
            <a href="<?php echo site_url('register'); ?>" class="btn btn-success btn-sm" title="회원가입">회원가입</a>
            <a href="<?php echo site_url('findaccount'); ?>" class="btn btn-default btn-sm" title="아이디 패스워드 찾기">아이디 패스워드 찾기</a>
        </div>
    </div>
</div> -->

<script type="text/javascript">
//<![CDATA[

$(document).on('change', "input:checkbox[name='autologin']", function() {
    if (this.checked) {
        $('.autologinalert').show(300);
    } else {
        $('.autologinalert').hide(300);
    }
});

// $(document).on('click', 'section.sign_up > h2', function() {

 
//     if($('#mem_userid').val().length === 0){
//         $('#mem_userid').siblings('p').slideDown();
//     }else{
//         $('#mem_userid').siblings('p').slideUp();
//     }

//     if($('#mem_password').val().length === 0){
//         $('#mem_password').siblings('p').slideDown();
        
//     }else{
//         $('#mem_password').siblings('p').slideUp();
//     }

//      if( $('#mem_userid').val().length > 0 && $('#mem_password').val().length > 0)
//          document.flogin.submit();
        
// });


function form_submit(f){

    if( $('#mem_userid').val().length > 0 && $('#mem_password').val().length > 0)
         return true;
    else return false;
}

    
$(document).on('click', '#findId , #forgotPass', function() {
    $('.cover').fadeIn(500);
    $('#telnum').val(''); // 기존에 작성되어 있던 val 값 삭제
    $('.popup03').css('display' , 'block');

    if(this.id=='findId') {
        $('#span_text').html('Send your ID to your email.');
        $('#popupYes').data('popupid','findId');
        $('#findtype').val('findid');
        
    }
    else {
        $('#span_text').html('Send your encrypted password to your email');
        $('#popupYes').data('popupid','forgotPass');
        $('#findtype').val('findidpw');
    }
});

$(document).on('click', '#popupNo', function() {
    $('.cover').fadeOut(200);
    $('.popup03').css('display' , 'none');
    $('#telnum').siblings('p').slideUp();
});

$(document).on('click', '#popupYes', function() {
    var re_pw = /^[0-9]{3,16}$/;

    
    if(re_pw.test($('#telnum').val()) != true)
        $('#telnum').siblings('p').slideDown().text('Invalid phone number.');
    else document.findidpwform.submit();
});
//]]>
</script>

<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<article class="content02">
        <!-- change password -->
            
            
            <section class="sign_up change_password">
                <!-- 타이틀 -->
                    <h2>
                        CHANGE PASSWORD
                    </h2>
                    <?php
                    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
                    echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
                    echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
                    $attributes = array('class' => 'form-horizontal', 'name' => 'fchangepassword', 'id' => 'fchangepassword');
                    echo form_open(current_url(), $attributes);
                    ?>
                <!-- 패스워드 변경 입력 -->
                        <table>
                            <tr>
                                <td>
                                    <label>Current password</label>
                                    <input type="password" id="cur_password" name="cur_password" >
                                    
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>New Password</label>
                                    <input type="password" id="new_password" name="new_password">
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>New Password Confirmation</label>
                                    <input type="password" id="new_password_re" name="new_password_re" />
                                    
                                </td>
                            </tr>
                    </table>
                <!-- next cancel 버튼 영역 -->
                    <div class="sign_up_btn">
                        <button type="submit">
                            Complete
                        </button>

                        <button type="button" onClick="location.href='<?php echo site_url('mypage'); ?>';" >
                            Cancel
                        </button>
                    </div>
            </section>
            <?php echo form_close(); ?>
        <!-- 하단 광고 -->
            <section class="ad">
                <?php echo banner("product_details_banner") ?>
            </section>
    </article>
<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fchangepassword').validate({
        rules: {
            cur_password : { required:true },
            new_password : { required:true, minlength:<?php echo element('password_length', $view); ?> },
            new_password_re : { required:true, minlength:<?php echo element('password_length', $view); ?>, equalTo: '#new_password' }
        }
    });
});
//]]>
</script>

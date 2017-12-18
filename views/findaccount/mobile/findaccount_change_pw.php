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
                    echo show_alert_message(element('error_message', $view), '<div class="alert alert-dismissible alert-warning">', '</div>');
                    echo show_alert_message(element('success_message', $view), '<div class="alert alert-dismissible alert-info">', '</div>');
                    if ( ! element('error_message', $view) && ! element('success_message', $view)) {
                        echo show_alert_message(element('info', $view), '<div class="alert alert-info">', '</div>');
                        $attributes = array('class' => 'form-horizontal', 'name' => 'fresetpw', 'id' => 'fresetpw');
                        echo form_open(current_full_url(), $attributes);
                    ?>
                <!-- 패스워드 변경 입력 -->
                        <table>
                            <tr>
                                <td>
                                    <label>ID </label>
                                    <input type="text" readonly value="<?php echo element('mem_userid', $view); ?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>New Password</label>
                                    <input type="password" name="new_password" id="new_password" placeholder="Password" />
                                    
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>New Password Confirmation</label>
                                    <input type="password" name="new_password_re" id="new_password_re" placeholder="Password" />
                                    
                                </td>
                            </tr>
                    </table>
                <!-- next cancel 버튼 영역 -->
                    <div class="sign_up_btn">
                        <button type="submit">
                            Complete
                        </button>

                        <button type="button" onClick="location.href='<?php echo site_url('/'); ?>';" >
                            Cancel
                        </button>
                    </div>
            </section>
            <?php echo form_close(); 
             } else {
            ?>
            <div class="sign_up_btn">
                <button type="button" style="width:100%" onClick="location.href='<?php echo site_url('/'); ?>';" >
                    Go to main page
                </button>
            </div>
            <?php } ?>
        <!-- 하단 광고 -->
            <section class="ad">
                <?php echo banner("product_details_banner") ?>
            </section>
    </article>






<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fresetpw').validate({
        rules: {
            new_password : { required:true, minlength:<?php echo element('password_length', $view); ?> },
            new_password_re : { required:true, minlength:<?php echo element('password_length', $view); ?>, equalTo : '#new_password' }
        }
    });
});
//]]>
</script>

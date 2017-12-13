<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="provision">
    
        <div class="table-box">
            <article class="content02">
                <!-- 회원가입 01 -->
                <section class="sign_up sign_up01">
                    <!-- 타이틀 -->
                    <h2>
                        SIGN UP
                    </h2>
                
                <!-- step -->
                    <ol>
                        <li>
                            <a href="">
                                <figure>
                                    <img src="<?php echo base_url('assets/images/signup01.png');?>" alt="signup04"  style="border:2px solid #92191c;">
                                    <figcaption>
                                        <h3 style="color:#92191c">
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
                                    <img src="<?php echo base_url('assets/images/signup05.png');?>" alt="signup02">
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
                    <?php
                    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
                    echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
                    $attributes = array('class' => 'form-horizontal', 'name' => 'fregisterform', 'id' => 'fregisterform');
                    echo form_open(current_full_url(), $attributes);
                    ?>
                        <input type="hidden" name="register" value="1" />
                <!-- 약관내용 -->
                    <div class="terms">
                        <div>
                            <input type="checkbox" name="agree" id="agree" value="1" checked="checked"/> 
                            <label>Accept terms and conditions(necessary)</label>
                        </div>
                        <p>
                            <?php echo element('member_register_policy1', $view); ?>
                        </p>
                    </div>

                <!-- next, cancel 버튼 -->
                    <div class="sign_up_btn">
                        <button type="submit" >
                            Next
                        </button>

                        <button onclick="location.href='<?php echo site_url() ?>'">
                            Cancel
                        </button>
                    </div>
                </section>

            <!-- 하단 광고 -->
                <section class="ad">
                    <?php echo banner("product_details_banner") ?>
                </section>
            </article>
        </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fregisterform').validate({
        rules: {
            agree: {required :true}
        }
    });
});
//]]>
</script>

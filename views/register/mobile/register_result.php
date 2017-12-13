<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<article class="content02">
        <!-- 회원가입 03 -->
            <section class="sign_up sign_up03">
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
                                    <img src="<?php echo base_url('assets/images/signup05.png');?>" alt="signup05">
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
                                    <img src="<?php echo base_url('assets/images/signup03.png');?>" alt="signup03" style="border:2px solid #931b1e;">
                                    <figcaption>
                                        <h3 style="color:#931b1e;">
                                            03<br>
                                            Signed<br>
                                            Up
                                        </h3>
                                    </figcaption>
                                </figure>
                            </a>
                        </li>
                    </ol>
                <!-- 정보 영역 -->
                    <table>
                        <tr>
                            <td>
                                <h3>ID</h3>
                                <p><?php echo html_escape($this->session->flashdata('userid')); ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h3>E-mail</h3>
                                <p><?php echo html_escape($this->session->flashdata('email')); ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h3>Phone</h3>
                                <p><?php echo html_escape($this->session->flashdata('phone')); ?></p>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>
                                <h3>nickname</h3>
                                <p><?php echo html_escape($this->session->flashdata('nickname')); ?></p>
                            </td>
                        </tr> -->

                        <tr>
                            <td>
                                <h3>Adress</h3>
                                <p><?php echo html_escape($this->session->flashdata('address')); ?></p>
                            </td>
                        </tr>
                    </table>
                <!-- completed 버튼 영역 -->
                    <div class="sign_up_btn one_btn">
                        <button onClick="location.href='<?php echo site_url();?>';">
                            COMPLETE
                        </button>
                    </div>
            </section>
        <!-- 하단광고 -->
            <section class="ad">
                <?php echo banner("product_details_banner") ?>
            </section>
    </article>
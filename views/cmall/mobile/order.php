<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php $this->managelayout->add_js(base_url('assets/js/cmallitem.js')); ?>

<article class="content02">
    <!-- 결제정보 -->
        <section class="billing_information">
            <!-- 타이틀 -->
                <h2>
                    BILLING INFORMATION
                </h2>

            <!-- 상품이미지 + 상품명 + total payment amount -->
                <table >
                <?php
                $total_price_sum = 0;
                if (element('data', $view)) {
                    foreach (element('data', $view) as $result) {


                        $total_num = 0;
                        $total_price = 0;
                        $total_num = element('cct_count',element(0, element('detail', $result)));
                        $total_price = ((int) element('cit_price',  $result) + (int) element('cde_price',element(0, element('detail', $result)))) * element('cct_count',element(0, element('detail', $result)));
                        $total_price_sum +=$total_price;
                ?>
                    <tr>
                        <td style="background-color: #fff; padding-top:8%">
                            
                            <figure>
                                <h3>
                                    <?php if(element('cca_value', $result)) echo '['.html_escape(element('cca_value',$result)).']';?> <?php echo html_escape(element('cit_name', $result)); ?>
                                </h3>
                                <a href="<?php echo element('item_url', $result); ?>" title="<?php echo html_escape(element('cit_name', $result)); ?>"><img src="<?php echo thumb_url('cmallitem', element('cit_file_1', $result)); ?>" class="billing_information" style="margin:0;" alt="<?php echo html_escape(element('cit_name', $result)); ?>" title="<?php echo html_escape(element('cit_name', $result)); ?>" /></a>                                
                                </a>
                                <figcaption>
                                    
                                    <p>
                                        <?php echo element('cit_summary', $result) ?>
                                    </p>

                                    <div class="price_cancel">
                                        <del>₱ <?php echo number_format(element('display_price', $result) + 0); ?> PHP</del>
                                        <span>₱</span><b> <?php echo number_format(element('cit_price', $result) + 0); ?></b><span> PHP</span>
                                        
                                    </div>
                                </figcaption>
                            </figure>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Purchase quantity</p>
                            <strong><?php echo number_format($total_num) ?> Set</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Payment Amount</p>
                            <Strong>₱ <?php echo number_format($total_price) ?> PHP</strong>
                        </td>
                    </tr>
                    
                    
                    
                    <?php
                        }
                    }
                    if ( ! element('data', $view)) {
                    ?>
                        <tr>
                            <td class="nopost">Your order history is empty</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <?php
                if (element('data', $view)) {
                ?>
                <div class="well well-sm">
                        <h3>Amount Due</h3>
                        <div class="total_price price_cancel">
                        <span class="checked_price">₱ </span><b><?php echo number_format($total_price_sum); ?></b> <span> PHP</span></div>
                    </div>
                    <?php
                    $sform['view'] = $view;
                    if ($this->cbconfig->item('use_payment_pg') && element('use_pg', $view)) {
                        $this->load->view('paymentlib/' . $this->cbconfig->item('use_payment_pg') . '/' . element('form1name', $view), $sform);
                    }
                    $attributes = array('class' => 'form-horizontal', 'name' => 'fpayment', 'id' => 'fpayment', 'autocomplete' => 'off');
                    echo form_open(site_url('cmall/orderupdate'), $attributes);
                    if ($this->cbconfig->item('use_payment_pg') && element('use_pg', $view)) {
                        $this->load->view('paymentlib/' . $this->cbconfig->item('use_payment_pg') . '/' . element('form2name', $view), $sform);
                    }
                    ?>
                        <input type="hidden" name="unique_id" value="<?php echo element('unique_id', $view); ?>" />
                        <input type="hidden" name="total_price_sum" id="total_price_sum" value="<?php echo $total_price_sum; ?>" />
                        <input type="hidden" name="good_mny" value="0" />
                        <input type="hidden" name="pay_type" value="bank" id="pay_type_bank" />
                        <div class="market-order-person">
                            <h3 class="market-title">Purchase Information</h3>
                            <table class="sign_up sign_up02">
                                <tr>
                                    <td><label class="control-label">Your name</label>
                                    <div>
                                        <input type="text" name="mem_realname" class="input" value="<?php echo $this->member->item('mem_nickname'); ?>" />
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label class="control-label">E-mail</label>
                                    <div>
                                        <input type="email" name="mem_email" class="input" value="<?php echo $this->member->item('mem_email'); ?>" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <label class="control-label">Phone number</label>
                                <div>
                                    <input type="text" name="mem_phone" class="input" value="<?php echo $this->member->item('mem_phone'); ?>" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="control-label">Delivery address</label>
                                <div>
                                    <textarea name="cor_addr" class="input per90" ><?php echo $this->member->item('mem_address1'); ?></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="control-label">Memo</label>
                                <div>
                                    <textarea name="cor_content" class="input per90" cols="3"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            
                                <h3 class="col-lg-2 control-label">Total Order Amount</h3>
                                <div class="col-lg-9 price_cancel">
                                    <span>₱ <span> <b><?php echo number_format($total_price_sum); ?></b> <span> PHP<span></strong>
                                        <input type="hidden" name="order_deposit" id="order_deposit" class="input" value="0" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <!-- <h3 class="control-label">Account information</h3>
                            <strong><?php echo nl2br($this->cbconfig->item('payment_bank_info')); ?> </strong> -->

                             <!-- 결제 정보 이미지 -->
                                <figure class="account_information">
                                     <img src="<?php echo base_url('assets/images/account_information.png') ?>" alt="account_information.png">
                                 </figure>

                    <!-- confirm 버튼 -->

                                 <?php

                                 if ($this->cbconfig->item('use_payment_pg')) {
                                        $this->load->view('paymentlib/' . $this->cbconfig->item('use_payment_pg') . '/' . element('form3name', $view), $sform);
                                 }
                                 echo form_close();
                                 ?>
                    
                                 <?php }?>
                                        </td>
                                    </tr>
                                        </table>
                                    </div>

           
        </section>

    <!-- 하단 광고 -->
        <section class="ad">
            <?php echo banner("product_details_banner") ?>
        </section>
</article>


<script type="text/javascript">
//<![CDATA[
$(document).on('change', 'input[name= pay_type]', function() {
    if ($("input[name='pay_type']:checked").val() === 'bank') {
        $('.bank-info').show();
    } else {
        $('.bank-info').hide();
    }
});
//]]>
</script>

<script type="text/javascript">
var use_pg = '<?php echo element('use_pg', $view) ? '1' : ''; ?>';
var pg_type = '<?php echo $this->cbconfig->item('use_payment_pg'); ?>';
var payment_unique_id = '<?php echo element('unique_id', $view); ?>';
var good_name = '<?php echo html_escape(element('good_name', $view)); ?>';
var ptype = 'cmall';
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/payment.js'); ?>"></script>
<?php
if ($this->cbconfig->item('use_payment_pg') && element('use_pg', $view)) {
    $this->load->view('paymentlib/' . $this->cbconfig->item('use_payment_pg') . '/' . element('form4name', $view), $sform);
}

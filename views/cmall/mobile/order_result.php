<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<meta name="format-detection" content="telephone=no">
<article class="content02">
    <!-- 결제정보 -->
        <section class="billing_information billing_information02">
            <!-- 타이틀 -->
                <h2>
                    BILLING INFORMATION
                </h2>

            <!-- 상품이미지 + 상품명 + total payment amount -->
                <table>
                <?php
                $total_price_sum = 0;
                $total_price=0;
                if (element('orderdetail', $view)) {
                    foreach (element('orderdetail', $view) as $result) {
                        $total_price = ((int) element('cit_price', element('item', $result)) + (int) element('cde_price',element(0, element('itemdetail', $result)))) * element('cod_count',element(0, element('itemdetail', $result)));
                        $total_price_sum+=$total_price;
                ?>
                    <tr>
                        <td  style="padding:6% 4% 3%; background-color: #fff;">
                            <figure>
                                <h3>
                                    <?php if(element('cca_value', element(0,element('itemdetail', $result)))) echo '['.html_escape(element('cca_value',element(0, element('itemdetail', $result)))).']';?> <?php echo html_escape(element('cit_name', element('item', $result))); ?>
                                </h3>
                                <a href="<?php echo cmall_item_url(element('cit_key', element('item', $result))); ?>" title="<?php echo html_escape(element('cit_name', element('item', $result))); ?>">
                                    <img src="<?php echo thumb_url('cmallitem', element('cit_file_1', element('item', $result))); ?>" class="" style="margin:0;" alt="<?php echo html_escape(element('cit_name', element('item', $result))); ?>" title="<?php echo html_escape(element('cit_name', element('item', $result))); ?>" />
                                </a>
                                <figcaption>
                                    <p>
                                        <?php echo element('cit_summary', element('item', $result)) ?>
                                    </p>

                                    <div class="price_cancel">
                                        <del>₱ <?php echo number_format(element('display_price', element('item', $result)) + 0); ?> PHP</del>
                                        <span>₱ </span> <b><?php echo number_format(element('cit_price', element('item', $result)) + 0); ?></b> <span> PHP</span>
                                        
                                    </div>
                                </figcaption>
                            </figure>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Order Number</p>
                            <strong><?php echo element('cor_id', element('data', $view)); ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Name of depositor</p>
                            <strong><?php echo html_escape(element('mem_realname', element('data', $view))); ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Payment status</p>
                            <strong style="color:#92191c;">
                            <?php
                            if (element('cor_status', $result) === '1') {
                                echo 'Payment completed';
                            } elseif (element('cor_status', $result) === '2') {
                                echo 'Order Cancellation';
                            } elseif ( ! element('cor_status', $result)) {
                                echo 'Waiting for Payment';
                            }
                            ?> 
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3>Total payment amount</h3>
                            <div class="price_cancel">
                            <span>₱ </span> <b><?php echo number_format($total_price_sum) ?></b> <span> PHP</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3>Deposit account</h3>
                            <strong><?php echo nl2br(html_escape($this->cbconfig->item('payment_bank_info'))); ?></strong>

                            <!-- 결제 정보 이미지 -->
                                <figure class="account_information">
                                    <img src="<?php echo base_url('assets/images/account_information.png') ?>" alt="account_information.png">
                                </figure>

                            <!-- confirm 버튼 -->
                                <button onClick='location.href="<?php echo site_url('cmall/orderlist'); ?>"'>
                                    CONFIRM
                                </button>
                        </td>
                    </tr>
                        </section>
                        
                    
                    
                    <?php if (element('cor_approve_datetime', element('data', $view)) > '0000-00-00 00:00:00') { ?>
                        <tr>
                            <td class="text-center">Payment date
                            <?php echo element('cor_approve_datetime', element('data', $view)); ?></td>
                        </tr>
                    <?php } ?>
                    <?php
                        }
                    }
                    ?>
                </table>

            

    <!-- 하단 광고 -->
        <section class="ad">
            <?php echo banner("product_details_banner") ?>
        </section>
</article>



<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<article class="content02">
    <!-- 결제정보 -->
        <section class="billing_information">
            <!-- 타이틀 -->
                <h2>
                    Billing Information
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
                        <td>
                            <figure>
                                <a href="<?php echo cmall_item_url(element('cit_key', element('item', $result))); ?>" title="<?php echo html_escape(element('cit_name', element('item', $result))); ?>">
                                    <img src="<?php echo thumb_url('cmallitem', element('cit_file_1', element('item', $result))); ?>" class="" style="margin:0;" alt="<?php echo html_escape(element('cit_name', element('item', $result))); ?>" title="<?php echo html_escape(element('cit_name', element('item', $result))); ?>" />
                                </a>
                                <figcaption>
                                    <h3>
                                        <?php if(element('cca_value', element(0,element('itemdetail', $result)))) echo '['.html_escape(element('cca_value',element(0, element('itemdetail', $result)))).']';?> <?php echo html_escape(element('cit_name', element('item', $result))); ?>
                                        
                                    </h3>
                                    <p>
                                        <?php echo element('cit_summary', element('item', $result)) ?>
                                    </p>

                                    <div class="price_cancel">
                                        <del>₱ <?php echo number_format(element('display_price', element('item', $result)) + 0); ?> PHP</del>
                                        <b>₱ <?php echo number_format(element('cit_price', element('item', $result)) + 0); ?> PHP</b>
                                        
                                    </div>
                                </figcaption>
                            </figure>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Order Number</h3>
                            <b><?php echo element('cor_id', element('data', $view)); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Name of depositor</h3>
                            <b><?php echo html_escape(element('mem_realname', element('data', $view))); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Deposit account</h3>
                            <b><?php echo nl2br(html_escape($this->cbconfig->item('payment_bank_info'))); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Total payment amount</h3>
                            <b>₱ <?php echo number_format($total_price_sum) ?> PHP</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Payment status</h3>
                            <b>
                            <?php
                            if (element('cor_status', $result) === '1') {
                                echo 'Payment completed';
                            } elseif (element('cor_status', $result) === '2') {
                                echo 'Order Cancellation';
                            } elseif ( ! element('cor_status', $result)) {
                                echo 'Waiting for Payment';
                            }
                            ?> 
                            </b>
                        </td>
                    </tr>
                    
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

            <!-- 결제 정보 이미지 -->
                <figure class="account_information">
                    <img src="<?php echo base_url('assets/images/account_information.png') ?>" alt="account_information.png">
                </figure>

            <!-- confirm 버튼 -->
                <button onClick='location.href="<?php echo site_url('cmall/orderlist'); ?>"'>
                    
                    Confirm
                </button>
        </section>

    <!-- 하단 광고 -->
        <section class="ad">
            <?php echo banner("product_details_banner") ?>
        </section>
</article>



<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<article class="content02">
    <!-- 주문 내역 -->
    <section class="order_inquiry">
        <!-- title -->
        <h2>
            ORDER INQUIRY
        </h2>

        <!-- 기간 -->
        <div class="term">
            <h3>
                Term
            </h3>
            <table>
                <tr>
                    <td class="<?php echo $this->uri->segment(3)==='3' || empty($this->uri->segment(3)) ? 'active':'';?>" onClick="location.href='<?php echo site_url('cmall/orderlist/3')?>';">3 Moon</td>
                    <td class="<?php echo $this->uri->segment(3)==='6' ? 'active':'';?>" onClick="location.href='<?php echo site_url('cmall/orderlist/6')?>';">6 Moon</td>
                    <td class="<?php echo $this->uri->segment(3)==='12' ? 'active':'';?>" onClick="location.href='<?php echo site_url('cmall/orderlist/12')?>';">12 Moon</td>
                </tr>
            </table>

            <span>※ You can check the order completed goods 1 year ago</span>
        </div>

        <!-- 상품리스트 -->
        <ul>
        <?php
        if (element('list', element('data', $view))) {
            foreach (element('list', element('data', $view)) as $result) {

        ?>
            <li><a href="<?php echo site_url('cmall/orderresult/' . element('cor_id', $result)); ?>">
                    <figure>
                        <h3>
                            <?php if(element('cca_value', $result)) echo '['.html_escape(element('cca_value', $result)).']';?> <?php echo html_escape(element('cit_name', $result)); ?>
                        </h3>

                        <img src="<?php echo thumb_url('cmallitem', element('cit_file_1', $result)); ?>" alt="<?php echo html_escape(element('cit_name', $result)); ?>" title="<?php echo html_escape(element('cit_name', $result)); ?>" class="" />
                        <figcaption>
                            <p>
                                <?php echo element('cit_summary', $result) ?>
                            </p>
                            
                            <div class="price_cancel">
                                <span>₱ </span> <b><?php echo number_format(element('cor_total_money', $result) + 0); ?></b> <span> PHP</span>
                            </div>
                        </figcaption>
                    </figure>

                    <div class="payment">
                        <strong><?php
                        if (element('cor_status', $result) === '1') {
                            echo 'Payment completed';
                        } elseif (element('cor_status', $result) === '2') {
                            echo 'Order Cancellation';
                        } elseif ( ! element('cor_status', $result)) {
                            echo 'Waiting for Payment';
                        }
                        ?> </strong>
                        <span>Order Date : <?php echo display_datetime(element('cor_datetime', $result), 'full'); ?></span> 
                    </div>
                </a>
            </li>
        <?php
            }
        }
        if ( ! element('list', element('data', $view))) {
        ?>
            <li>
                <div class="nopost">You have no order history</div>
            </li>
        <?php
        }
        ?>
        </ul>
    </section>
    <nav><?php echo element('paging', $view); ?></nav>
    <!-- 하단 광고 -->
    <section class="ad">
        <?php echo banner("product_details_banner") ?>
    </section>
</article>


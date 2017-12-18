<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php $this->managelayout->add_js(base_url('assets/js/cmallitem.js')); ?>
<article class="content02">
    <!-- 장바구니 리스트 , total order amount -->
    <section class="shopping_basket">
        <!--장바구니 상품 리스트 -->
        
        <!-- 타이틀 -->
        <h2>
            SHOPPING BASKET
        </h2>
        <?php
        $attributes = array('class' => 'form-inline', 'name' => 'flist', 'id' => 'flist', 'onSubmit' => 'return flist_submit(this);');
        echo form_open(site_url('cmall/cart'), $attributes);
        
        $total_price_sum = 0;
        if (element('data', $view)) {
            echo '<ul>
                    <li>
                        <input type="checkbox" name="chkall" id="chkall" checked="checked" />
                        <label for="chkall">All Select</label>
                    </li>';
            foreach (element('data', $view) as $result) {
                $total_num = 0;
                $total_price = 0;
                $price = 0;
                $cde_id = 0;
                $cde_title = '';
                $cct_count=0;
                foreach (element('detail', $result) as $detail) { 
                    $cct_count = element('cct_count', $detail);
                    $cde_title = element('cde_title', $detail); 
                    $cde_id = element('cde_id', $detail);        
                    $price = element('cit_price', $result) + element('cde_price', $detail);
                    $total_num += element('cct_count', $detail);
                    $total_price += ((int) element('cit_price', $result) + (int) element('cde_price', $detail)) * element('cct_count', $detail);
                }
                $total_price_sum += $total_price;
                ?>

            

            <li>
                <input type="hidden" name="total_price[<?php echo element('cit_id', $result); ?>]" value="<?php echo $total_price; ?>" />
                <input type="checkbox" name="chk[]" class="list-chkbox" value="<?php echo element('cit_id', $result); ?>" checked="checked" />
                
                <img src="<?php echo base_url('assets/images/trashcan.png') ?>" onclick="location.href='<?php echo element('list_delete_url', $result) ?>';" alt="trashcan">
                <figure>
                    <h3>
                            <a href="<?php echo element('item_url', $result); ?>" title="<?php echo html_escape(element('cit_name', $result)); ?>" ><?php if(element('cca_value', $result)) echo '['.html_escape(element('cca_value', $result)).']';?> <?php echo html_escape(element('cit_name', $result)); ?></a>
                        </h3>
                <a href="<?php echo element('item_url', $result); ?>" title="<?php echo html_escape(element('cit_name', $result)); ?>" ><img src="<?php echo thumb_url('cmallitem', element('cit_file_1', $result)); ?>" class="" style="margin:0;" alt="<?php echo html_escape(element('cit_name', $result)); ?>" title="<?php echo html_escape(element('cit_name', $result)); ?>" /></a>
                    <figcaption>
                        
                        <p>
                           <?php echo element('cit_summary', $result) ?>
                        </p>
                        <div class="price_cancel">
                           <span>₱ </span> <b><?php echo number_format(element('cit_price', $result) + 0); ?></b> <span> PHP</span>
                        </div>
                    </figcaption>
                </figure>

                <!-- 수정 입니다. -->
                <div>
                    <input type="hidden" name="chk_detail[]" value="<?php echo $cde_id; ?>" />
                    <input type="hidden" name="cit_price[<?php echo $cde_id; ?>]" value="<?php echo $price; ?>" />
                    <p><?php echo html_escape($cde_title); ?></p>
                    <div class="quantity">
                        <span class="btn-change-qty" data-change-type="minus">-</span>
                        <input type="text"  data-cde_id="<?php echo $cde_id; ?>" name="detail_qty[<?php echo $cde_id; ?>]"  style="border:0px;" value="<?php echo $cct_count ? $cct_count : 1; ?>" />
                        <span class="btn-change-qty" data-change-type="plus">+</span>
                    </div>
                    
                </div>





            </li>
        </ul>
        <?php
            }

        echo '<div class="total_order">
            <h3>
                Total Order Amount
            </h3>
            <div class="price_cancel">
            <span>₱ </span> <b id="total_order_price">'.number_format($total_price_sum).'</b> <span>PHP</span>
            </div>
            <button type="submit">
                ORDER OPTIONAL ITEMS
            </button>
            </div>';
        }
        if ( ! element('data', $view)) {
        ?>
            <ul>
                <li class="empty">Your shopping cart is empty.</li>
            </ul>
        <?php
        }
        ?>
    
        <?php echo form_close(); ?>
    </section>

<!-- 하단 광고 -->
    <section class="ad">
        <?php echo banner("product_details_banner") ?>
    </section>
</article>
<script type="text/javascript">
//<![CDATA[




function flist_submit(f) {
        
     

    var $el_chk = jQuery('input[name^=chk]:checked');
    
    if ($el_chk.size() < 1) {
        alert('Please select one or more products.');
        return false;
    }

    return true;

    
}
//]]>
</script>

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

                
                foreach (element('detail', $result) as $detail) { 
        
        
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
                    <p>Change Quantity</p>
                    <div class="quantity">
                        <span>-</span>
                        <input value="1" style="border:0">
                        <span>+</span>
                    </div>
                </div>




<!--
                <div class="change_btn">    
                    <h3>
                        <td><?php echo number_format($total_num); ?></td> ITEM
                    </h3>
                    <button class="change_option" type="button" data-cit-id="<?php echo element('cit_id', $result); ?>">
                        Change quantity
                    </button>
                </div>
-->
               
            </li>
        </ul>
        <?php
            }

        echo '<div class="total_order">
            <h3>
                Total Order Amount
            </h3>
            <div class="price_cancel">
            <span>₱ </span> <b>'.number_format($total_price_sum).'</b> <span>PHP</span>
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
$(document).on('change', '.list-chkbox', function() {
    var sum = 0;
    $('.list-chkbox:checked').each(function () {
        sum += parseInt($("input[name='total_price[" + $(this).val() + "]']").val());
    });
    $('.checked_price').text(number_format(sum.toString()));
});

$(function() {
    var close_btn_idx;

    /* 선택사항수정*/
    $(document).on('click', '.change_option', function() {
        var cit_id = $(this).attr('data-cit-id');
        var $this = $(this);
        close_btn_idx = $('.change_option').index($(this));

        $.post(
            cb_url + '/cmall/cartoption',
            { cit_id: cit_id, csrf_test_name: cb_csrf_hash },
            function(data) {

                $('#cart_option_modify').remove();
                $($this).parents('.change_btn').after("<div id=\"cart_option_modify\"></div>");
                $('#cart_option_modify').html(data);
                $('#cart_option_modify').slideDown()
            }
        );
    });

    // 모두선택
    $(document).on('click', 'input[name=ct_all]', function() {
        if ($(this).is(':checked')) {
            $('input[name^=ct_chk]').attr('checked', true);
        } else {
            $('input[name^=ct_chk]').attr('checked', false);
        }
    });

    // 옵션수정 닫기
    $(document).on('click', '#mod_option_close', function() {
        $('#cart_option_modify').slideUp('nomal', function() {
            $('#cart_option_modify').remove();
        });
        
        $('.change_option').eq(close_btn_idx).focus();
    });

});

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

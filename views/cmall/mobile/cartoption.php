<!-- 장바구니 옵션 시작 { -->

<?php
$attributes = array('class' => 'form-inline', 'name' => 'foption', 'id' => 'foption', 'onsubmit' => 'return fcart_submit(this)');
echo form_open(site_url('cmallact/optionupdate'), $attributes);
?>
    <input type="hidden" name="cit_id" value="<?php echo element('cit_id', element('item', $view)); ?>" />
    <div class="change_quantity">
        <?php
        if (element('detail', $view)) {
            foreach (element('detail', $view) as $key => $value) {
                $price = element('cit_price', element('item', $view)) + element('cde_price', $value);
        ?>
            <input type="hidden" name="chk_detail[]" value="<?php echo element('cde_id', $value); ?>" />
            <input type="hidden" name="item_price[<?php echo element('cde_id', $value); ?>]" value="<?php echo $price; ?>" />
            <h3>
                <?php echo html_escape(element('cde_title', $value)); ?>
                <span>
                    <img id="mod_option_close" src="<?php echo base_url('assets/images/clear.png') ?>" alt="clear">
                </span>
            </h3>
            <div class="quantity">
                <span class="btn-change-qty" data-change-type="minus">-</span>
                <input type="text" name="detail_qty[<?php echo element('cde_id', $value); ?>]"  style="border:0px;" value="<?php echo element('cct_count', element('cart', $value)) ? element('cct_count', element('cart', $value)) : 1; ?>" />
                <span class="btn-change-qty" data-change-type="plus">+</span>
            </div>

                
            
        <?php
            }
        }
        ?>
    
        <button type="submit" class="">Change Completed</button>
    
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//<![CDATA[

// 구매금액 계산
item_price_calculate();

function fcart_submit(f)
{
    var $el_chk = $('input[name^=chk_detail]');

    if ($el_chk.size() < 1) {
        alert('상품의 옵션을 하나이상 선택해 주십시오.');
        return false;
    }

    // 수량체크
    var is_qty = true;
    var ct_qty = 0;
    $el_chk.each(function() {
        ct_qty = parseInt($(this).closest('tr').find('input[name^=ct_qty]').val().replace(/[^0-9]/g, ""));
        if (isNaN(ct_qty)) {
            ct_qty = 0;
        }

        if (ct_qty < 1) {
            is_qty = false;
            return false;
        }
    });

    if ( ! is_qty) {
        alert('수량을 1이상 입력해 주십시오.');
        return false;
    }

    return true;
}
//]]>
</script>
<!-- } 장바구니 옵션 끝 -->

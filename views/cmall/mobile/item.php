<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php $this->managelayout->add_js(base_url('assets/js/cmallitem.js')); ?>
<article class="content02">
<!-- 상품설명 -->
    <section class="product_details">
        <!-- 타이틀 -->
        <h2>
            PRODUCT DETAILS
        </h2>
        <?php if ($this->member->is_admin()) { ?>
            <a href="<?php echo admin_url('cmall/cmallitem/write/' . element('cit_id', element('data', $view))); ?>" target="_blank" class="btn-sm btn btn-danger pull-right">상품내용수정</a>
        <?php } ?>
        <?php if (element('header_content', element('data', $view))) { ?>
            <div class="product-detail"><?php echo element('header_content', element('data', $view)); ?></div>
        <?php } ?>
        <div class="product-box mb20">
            <div class="product-left mt10">
                <div class="item_slider">
                    <?php
                    for ($i =1; $i <=10; $i++) {
                        if ( ! element('cit_file_' . $i, element('data', $view))) {
                            continue;
                        }
                    ?>
                        <div><img src="<?php echo thumb_url('cmallitem', element('cit_file_' . $i, element('data', $view))); ?>" alt="<?php echo html_escape(element('cit_name', element('data', $view))); ?>" title="<?php echo html_escape(element('cit_name', element('data', $view))); ?>" style="width:100%;" onClick="window.open('<?php echo site_url('cmall/itemimage/' . html_escape(element('cit_key', element('data', $view)))); ?>', 'win_image', 'left=100,top=100,width=730,height=700,scrollbars=1');" /></div>
                    <?php } ?>
                </div>
                <span class="prev" id="slider-prev"></span>
                <span class="next" id="slider-next"></span>
            </div>
        </div>
        <?php
        if (element('detail', element('data', $view))) {
            $attributes = array('class' => 'form-horizontal', 'name' => 'fitem', 'id' => 'fitem', 'onSubmit' => 'return fitem_submit(this)');
            echo form_open(current_full_url(), $attributes);
        ?>
        <input type="hidden" name="stype" id="stype" value="" />
        <input type="hidden" name="chk_referer" id="chk_referer" value="" />
        <input type="hidden" name="cit_id" value="<?php echo element('cit_id', element('data', $view)); ?>" />
        <input type="hidden" name="cit_price" value="<?php echo element('cit_price', element('data', $view)); ?>" />
        <div class="product-right">
            
            <table class="product-no table table-bordered">
                <tbody>
                    <tr>
                        <td colspan=2>
                         <div class="product-title"><?php echo html_escape(element('cit_name', element('data', $view))); ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Price
                            </p>
                        </td>
                        <td>
                            <div class="price_cancel">
                                <del>₱ <?php echo number_format(element('display_price', element('data', $view)) + 0); ?> PHP</del>
                                <b>₱ <?php echo number_format(element('cit_price', element('data', $view)) + 0); ?> PHP</b>
                                
                            </div>
                        </td>
                    </tr>
                    <?php
                    foreach (element('detail', element('data', $view)) as $detail) {
                        $price = element('cit_price', element('data', $view));
                    ?>
                    <input type="hidden" name="chk_detail[]" value="<?php echo element('cde_id', $detail); ?>" />
                        <tr>
                            <td><p style="height: 30px; line-height: 30px;"><?php echo html_escape(element('cde_title', $detail)); ?></p></td>
                            <td class="text-right">
                                <div class="quantity">
                                    <span class="btn-change-qty" data-change-type="minus">-</span>
                                    <input type="text" name="detail_qty[<?php echo element('cde_id', $detail); ?>]"  style="border:0px;" value="1" />
                                    <span class="btn-change-qty" data-change-type="plus">+</span>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                       
                    <tr class="success">
                        <td>Total Amount</td>
                        <td class="text-right">₱ 
                        <span id="total_order_price"><?php echo number_format(element('cit_price', element('data', $view)) + 0); ?></span> PHP</td>
                    </tr>
                    <tr>
                        <td class="per50">

                                        
                                        
                                
                            <button type="submit" onClick="$('#stype').val('order');" style="width:100%">
                                Buy Now
                            </button>
                        </td>
                        <td>
                            <button id="cart" type="button"  style="width:100%">
                                Shopping Basket
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
            echo form_close();
        }
        ?>
    <div class="product-info mb10">
            
            <div class="product-detail"><?php echo element('content', element('data', $view)); ?></div>
    </div>
    </section>
    <section class="ad">
        <?php echo banner("product_details_banner") ?>
    </section>
</article>



<!-- 장바구니 카트 확인 팝업 -->
<article class="popup">
    <h2>
        *Notice*
        <span>Are you sure you want to go to the shopping cart item?</span>
    </h2>

    <div class="popup_btn">
        <button>Yes</button>
        <button>No</button>
    </div>
</article>

<!-- <div class="market">
    <h3>상품안내</h3>
    <?php if ($this->member->is_admin()) { ?>
        <a href="<?php echo admin_url('cmall/cmallitem/write/' . element('cit_id', element('data', $view))); ?>" target="_blank" class="btn-sm btn btn-danger pull-right">상품내용수정</a>
    <?php } ?>
    <?php if (element('header_content', element('data', $view))) { ?>
        <div class="product-detail"><?php echo element('header_content', element('data', $view)); ?></div>
    <?php } ?>
    <div class="market">
       

        <?php
        if (element('detail', element('data', $view))) {
            $attributes = array('class' => 'form-horizontal', 'name' => 'fitem', 'id' => 'fitem', 'onSubmit' => 'return fitem_submit(this)');
            echo form_open(current_full_url(), $attributes);
        ?>
            <input type="hidden" name="stype" id="stype" value="" />
            <input type="hidden" name="cit_id" value="<?php echo element('cit_id', element('data', $view)); ?>" />
            <div class="product-option">
                <table class="table table-bordered item_detail_table">
                    <tbody>
                        <tr class="danger">
                            <th>옵션</th>
                            <th><input type="checkbox" id="chk_all_item" /></th>
                            <th>수량</th>
                            <th>판매가</th>
                        </tr>
                        <?php
                        foreach (element('detail', element('data', $view)) as $detail) {
                            $price = element('cit_price', element('data', $view)) + element('cde_price', $detail);
                        ?>
                            <tr>
                                <td><?php echo html_escape(element('cde_title', $detail)); ?></td>
                                <td><input type="checkbox" name="chk_detail[]" value="<?php echo element('cde_id', $detail); ?>" /></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default btn-xs btn-change-qty" data-change-type="minus">-</button>
                                        <input type="text" name="detail_qty[<?php echo element('cde_id', $detail); ?>]" class="btn btn-default btn-xs detail_qty" value="1" />
                                        <button type="button" class="btn btn-default btn-xs btn-change-qty" data-change-type="plus">+</button>
                                    </div>
                                </td>
                                <td class="detail_price">
                                    <input type="hidden" name="item_price[<?php echo element('cde_id', $detail); ?>]" value="<?php echo $price; ?>" />
                                    <?php echo number_format($price); ?>원
                                </td>
                            </tr>
                        <?php } ?>
                        <tr class="success">
                            <td>총금액</td>
                            <td></td>
                            <td></td>
                            <td class="cart_total_price"><span id="total_order_price">0</span>원</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="pull-right mb20 mt20">
                <button type="submit" onClick="$('#stype').val('order');" class="btn btn-black">바로구매</button>
                <button type="submit" onClick="$('#stype').val('cart');"class="btn btn-black">장바구니</button>
                <button type="submit" onClick="$('#stype').val('wish');"class="btn btn-black">찜하기</button>
            </div>
        <?php
            echo form_close();
        }
        ?>
        <div class="product-info mb20">
            <ul class="product-info-top" id="itemtabmenu1">
                <li class="current"><a href="#itemtabmenu1">상품정보</a></li>
                <li><a href="#itemtabmenu2">사용후기 <span class="item_review_count"><?php echo number_format(element('cit_review_count', element('data', $view)));?></span></a></li>
                <li><a href="#itemtabmenu3">상품문의 <span class="item_qna_count"><?php echo number_format(element('cit_qna_count', element('data', $view)));?></span></a></li>
            </ul>
            <div class="product-detail"><?php echo element('content', element('data', $view)); ?></div>
        </div>
        <div class="product-info mb20">
            <ul class="product-info-top" id="itemtabmenu2">
                <li><a href="#itemtabmenu1">상품정보</a></li>
                <li class="current"><a href="#itemtabmenu2">사용후기 <span class="item_review_count"><?php echo number_format(element('cit_review_count', element('data', $view)));?></span></a></li>
                <li><a href="#itemtabmenu3">상품문의 <span class="item_qna_count"><?php echo number_format(element('cit_qna_count', element('data', $view)));?></span></a></li>
            </ul>
            <div id="viewitemreview"></div>
            <div class="pull-right mb20 mr20">
                <a href="javascript:;" class="btn btn-default btn-sm" onClick="window.open('<?php echo site_url('cmall/review_write/' . element('cit_id', element('data', $view))); ?>', 'review_popup', 'width=750,height=770,scrollbars=1'); return false;">사용후기 쓰기</a>
            </div>
        </div>
        <div class="product-info mb20">
            <ul class="product-info-top" id="itemtabmenu3">
                <li><a href="#itemtabmenu1">상품정보</a></li>
                <li><a href="#itemtabmenu2">사용후기 <span class="item_review_count"><?php echo number_format(element('cit_review_count', element('data', $view)));?></span></a></li>
                <li class="current"><a href="#itemtabmenu3">상품문의 <span class="item_qna_count"><?php echo number_format(element('cit_qna_count', element('data', $view)));?></span></a></li>
            </ul>
            <div id="viewitemqna"></div>
            <div class="pull-right mb20 mr20">
                <a href="javascript:;" class="btn btn-sm btn-default" onClick="window.open('<?php echo site_url('cmall/qna_write/' . element('cit_id', element('data', $view))); ?>', 'qna_popup', 'width=750,height=770,scrollbars=1'); return false;">상품문의 쓰기</a>
            </div>
        </div>
        <?php if (element('footer_content', element('data', $view))) { ?><div class="product-detail"><?php echo element('footer_content', element('data', $view)); ?></div><?php } ?>
    </div>
</div> -->

<script type="text/javascript" src="<?php echo base_url('assets/js/bxslider/jquery.bxslider.min.js'); ?>"></script>
<script type="text/javascript">
//<![CDATA[
$('.item_slider').bxSlider({
    pager : false,
    nextSelector: '#slider-next',
    prevSelector: '#slider-prev',
    nextText: '<img src="<?php echo element('view_skin_url', $layout); ?>/images/btn_next.png" alt="다음" title="다음" />',
    prevText: '<img src="<?php echo element('view_skin_url', $layout); ?>/images/btn_prev.png" alt="이전" title="이전" />'
});
$(document).ready(function($) {
    view_cmall_review('viewitemreview', '<?php echo element('cit_id', element('data', $view)); ?>', '', '');
    view_cmall_qna('viewitemqna', '<?php echo element('cit_id', element('data', $view)); ?>', '', '');
});


$('#cart').click(function(){
    $('.cover').css('display' , 'block');
    $('.cover').css('z-index' , '100');
    $('.cover').animate({'opacity' : '1'} , 1000);
    $('.popup').css('display' , 'block');
});

/*팝업창 no 클릭시 팝업창 사라짐*/
$('.popup_btn button:nth-child(2)').click(function(){
    $('.cover').css('display' , 'none');
    $('.popup').css('display' , 'none');
    $('.cover').css('opacity' , '0');
    $('#stype').val('cart');
    var f = document.fitem;
    f.submit();
});

/*팝업창 yes 클릭시 팝업창 사라짐 */
$('.popup_btn button:nth-child(1)').click(function(){
    $('#stype').val('cart');
    $('#chk_referer').val('cart');
    var f = document.fitem;
    f.submit();
});

//]]>
</script>

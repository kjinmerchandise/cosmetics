<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<article class="content02">
        <!-- notice -->
            <section class="notice service">
                <!-- title -->
                    <h2>FAQ</h2>
                    <ul>
                    <?php
                    $i = 0;
                    if (element('list', element('data', $view))) {
                    
                        foreach (element('list', element('data', $view)) as $result) {
                    ?>
                        <li class="table-service">
                            <h3 class="table-heading" id="heading_<?php echo $i; ?>" onclick="return faq_open(this);">
                                <?php echo element('title', $result); ?>
                            </h3>
                            <span>▼</span>
                            <p class="table-answer answer" id="answer_<?php echo $i; ?>">
                                <?php echo element('content', $result); ?>
                            </p>
                        </li>
                    <?php
                            $i++;
                        }
                    
                    }
                    if ( ! element('list', element('data', $view))) {
                    ?>
                        <li><div class="table-answer nopost">내용이 없습니다</div></li>
                    <?php
                    }
                    ?>
                    </ul>
                        <nav><?php echo element('paging', $view); ?></nav>
                    <?php
                    if ($this->member->is_admin() === 'super') {
                    ?>
                        <div class="text-center mb20">
                            <a href="<?php echo admin_url('page/faq'); ?>?fgr_id=<?php echo element('fgr_id', element('faqgroup', $view)); ?>" class="btn btn-black btn-sm" target="_blank" title="FAQ 수정">FAQ 수정</a>
                        </div>
                    <?php
                    }
                    ?>
                    
            </section>

        <!-- 하단광고 -->
            <section class="ad">
                <?php echo banner("product_details_banner") ?>
            </section>
    </article>

<script type="text/javascript">
//<![CDATA[
function faq_open(el)
{
    var $con = $(el).closest('.table-service').find('.answer');
    var $span = $(el).closest('.table-service').find('span');

    if ($con.is(':visible')) {
        $con.slideUp();
        $span.css('transform' , 'rotate(0deg)');
    } else {
        $('.answer:visible').css('display', 'none');
        $con.slideDown();
        $span.css('transform' , 'rotate(180deg)');
    }
    return false;
}
//]]>
</script>

<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="mypage">
    

    <h2>WITHDRAWAL</h2>
    <div>
        <p>Good Bye <span class="text-primary"><?php echo html_escape($this->member->item('mem_nickname')); ?></span><br/>
           Your withdrawal was successful.<br />
            Thank you for using our site.
        </p>
    </div>
    <section class="ad">
            <?php echo banner('product_details_banner'); ?>
            </section>
</div>

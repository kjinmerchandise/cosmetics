<article class="content02">
        <!-- 회원가입 01 -->
            <section class="sign_up sign_up01">
                <!-- 타이틀 -->
                    <h2>
                        <?php echo strtoupper(html_escape(element('doc_title', element('data', $view)))); ?>
                    </h2>

                <!-- 약관내용 -->
                    <div class="terms">
                        <p>
                            <?php echo element('content', element('data', $view)); ?>
                        </p>
                    </div>


            </section>

        <!-- 하단 광고 -->
            <section class="ad">
            <?php echo banner('product_details_banner'); ?>
            </section>
    </article>


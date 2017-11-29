<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php $this->managelayout->add_js(base_url('assets/js/bxslider/jquery.bxslider.min.js')); ?>
<?php $this->managelayout->add_js(base_url('assets/js/bxslider/plugins/jquery.fitvids.js')); ?>
<?php $this->managelayout->add_js(base_url('assets/js/cmallitem.js')); ?>
<script type="text/javascript">
        $(document).ready(function () {
          var slider = $('.bxslider').bxSlider({
                //work method
                speed: 500, // m/s ex > 1000 = 1s
                easing: 'ease-in-out', // 동작 가속도 css와 동일
                sliderMargin: 10, // img 와 img 사이 간격
                startSlide: 0, // 시작시 로드될 이미지 (0부터 시작)
                preloadImages: 'visible', // 'visible'은 보여질때 이미지를 로드,'all'로 설정 하게 되면 모든 이미지가 로드되어야만 slide가 작동
                sliderMargin: 10, // img 와 img 사이 간격
                startSlide: 0, // 시작시 로드될 이미지 (0부터 시작)
                randomStart: false, // 시작시 랜덤으로 이미지 로드 여부 (boolean)
                adaptiveHeight: true, //각 이미지의 높이에 따라 슬라이더 높이의 유동적 조절 여부
                adaptiveHeightSpeed: 500, //adaptiveHeight 동작속도,
                video: false,// slider에 video 사용여부, 사용할 시에 plugins/jquery.fitvids.js 파일 include 필요
                captions: false, // img 태그에 title속성값을 출력여부, 단 css .bx-wrapper .bx-caption 수정필요

        //responsive method
                responsive: true, // 반응형 지원 여부
                touchEnabled: true,// 터치스와이프 기능 사용여부
                swipeThreshold: 50, // 터치하여 스와이프 할때 변환 효과에 소모되는 시간 설정
                onoToOneTouch: true, // fade효과가 아닌 슬라이드는 손가락의 접지상태에 따라 슬라이드를 움직일수있다.
                preventDefaultSwipeX: true, //onoToOneTouch 에서 true일 경우, 손가락을따라 x축으로 움직일지에 대한 여부
                preventDefaultSwipeY: false, //onoToOneTouch 에서 true일 경우, 손가락을따라 y축으로 움직일지에 대한 여부

        //control method
                controls: false, //좌, 우 컨트롤 버튼 출력  여부
                auto: true, // 자동 재생 활성화.
                autoControls: false, //자동재생 제어버튼 활성화 단, auto모드 활성화필요
                autoControlsCombine: false, // 재생시 중지버튼 활성화(toggle)
                pause: 4000, // 자동 재생 시 각 슬라이드 별 노출 시간
                autoStart: true, // 페이지 로드가 되면, 슬라이드의 자동시작 여부
                autoDirection: 'next', // 자동 재생시에 정순, 역순(prev) 방식 설정
                autoHover: true, // 슬라이드 오버시 재생 중단 여부 (false : 오버무시)
                autoDelay: 0, // 자동 재생 전 대기 시간 설정.
                infiniteLoop: true, //마지막에 도달 했을시, 첫페이지로 갈 것인가 멈출것인가
                //pagerCustom: '#bx-pager' // pager

                onSliderLoad: function(){
                    $('section.slide').css('visibility','visible');
                }
            });  

            $(document).on('click','.bx-next, .bx-prev',function() {
                slider.stopAuto();
                slider.startAuto();
            });
            $(document).on('click','.bx-pager, #bx-pager1',function() {
                slider.stopAuto();
                slider.startAuto();
            });            

            $('.best_of_best li figure > img').click(function(){
                    $('.cover').css('display' , 'block');
                    $('.cover').css('z-index' , '100');
                    $('.cover').animate({'opacity' : '1'} , 500);
                    $('.popup').css('display' , 'block');
                    var f = document.fitem;
                    f.action=$(this).data('url');
                    f.cit_id.value=$(this).data('cit_id');
                    f.chk_detail.value=$(this).data('cde_id');
                    
                    
                });

            /*팝업창  스크롤바 따라다니기 */
                var currentPosition = parseInt($(".popup").css("top"));

                $(window).scroll(function() {
                    var position = $(window).scrollTop();
                    $(".popup").stop().animate({"top":position+currentPosition+"px"},500);
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

            /*팝업창 Yes 클릭시 팝업창 사라짐*/
                $('.popup_btn button:nth-child(1)').click(function(){
                    $('#stype').val('cart');
                    $('#chk_referer').val('cart');
                    var f = document.fitem;
                    f.submit();
                });
        });
</script>

<article class="content01">
    <!-- 이미지 슬라이드 -->
    <section class="slide" style="visibility: hidden;">
        <ul class="bxslider">
            <?php echo banner('index_bxslider','order',3,'<li>','</li>'); ?>
        </ul>
    </section>

    <section class="best_of_best">
        <h2>
            BEST OF BEST    
        </h2>
        <ul>
<?php
if (element('type1', $view)) {
    $attributes = array('class' => 'form-horizontal', 'name' => 'fitem', 'id' => 'fitem', 'onSubmit' => 'return fitem_submit(this)');
    echo form_open('', $attributes);
    echo '<input type="hidden" name="stype" id="stype" value="" />';
    echo '<input type="hidden" name="chk_referer" id="chk_referer" value="index" />';
    echo '<input type="hidden" name="cit_id" id="cit_id" value="" />';
    echo '<input type="hidden" name="chk_detail[]" id="chk_detail" value="" />';
    

    
foreach (element('type1', $view) as $item) {

?>          
            <input type="hidden" name="detail_qty[<?php echo element('cde_id', $item); ?>]" value="1" />
            <li>
                <figure>
                    <a href="<?php echo cmall_item_url(element('cit_key', $item)); ?>" title="<?php echo html_escape(element('cit_name', $item)); ?>">
                        <img src="<?php echo thumb_url('cmallitem', element('cit_file_1', $item)); ?>" alt="<?php echo html_escape(element('cit_name', $item)); ?>" title="<?php echo html_escape(element('cit_name', $item)); ?>" class="" />
                        <figcaption>
                            <p><?php echo element('cit_summary', $item) ?></p>
                            <h3>
                                <?php if(element('cca_value', $item)) echo '['.html_escape(element('cca_value', $item)).']';?> <?php echo html_escape(element('cit_name', $item)); ?>
                            </h3>
                        </figcaption>
                    </a>

                    <del>₱ <?php echo number_format(element('display_price', $item) + 0); ?> PHP</del>
                    <b>₱ <?php echo number_format(element('cit_price', $item) + 0); ?> PHP</b>
                    <img src="<?php echo base_url('assets/images/cart.png'); ?>" alt="cart" data-url="<?php echo cmall_item_url(element('cit_key', $item)); ?>" data-cit_id="<?php echo element('cit_id', $item); ?>" data-cde_id="<?php echo element('cde_id', $item); ?>">
                </figure>
            </li>
<?php
}
echo form_close();

}
?>  
        </ul>
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
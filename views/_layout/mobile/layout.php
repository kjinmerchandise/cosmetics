<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo html_escape(element('page_title', $layout)); ?></title>
<?php if (element('meta_description', $layout)) { ?><meta name="description" content="<?php echo html_escape(element('meta_description', $layout)); ?>"><?php } ?>
<?php if (element('meta_keywords', $layout)) { ?><meta name="keywords" content="<?php echo html_escape(element('meta_keywords', $layout)); ?>"><?php } ?>
<?php if (element('meta_author', $layout)) { ?><meta name="author" content="<?php echo html_escape(element('meta_author', $layout)); ?>"><?php } ?>
<?php if (element('favicon', $layout)) { ?><link rel="shortcut icon" type="image/x-icon" href="<?php echo element('favicon', $layout); ?>" /><?php } ?>
<?php if (element('canonical', $view)) { ?><link rel="canonical" href="<?php echo element('canonical', $view); ?>" /><?php } ?>

<link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/earlyaccess/nanumgothic.css" />
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/ui-lightness/jquery-ui.css" />
<?php echo $this->managelayout->display_css(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/import.css?'.$this->cbconfig->item('browser_cache_version')) ?>" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
// 자바스크립트에서 사용하는 전역변수 선언
var cb_url = "<?php echo trim(site_url(), '/'); ?>";
var cb_cookie_domain = "<?php echo config_item('cookie_domain'); ?>";
var cb_charset = "<?php echo config_item('charset'); ?>";
var cb_time_ymd = "<?php echo cdate('Y-m-d'); ?>";
var cb_time_ymdhis = "<?php echo cdate('Y-m-d H:i:s'); ?>";
var layout_skin_path = "<?php echo element('layout_skin_path', $layout); ?>";
var view_skin_path = "<?php echo element('view_skin_path', $layout); ?>";
var is_member = "<?php echo $this->member->is_member() ? '1' : ''; ?>";
var is_admin = "<?php echo $this->member->is_admin(); ?>";
var cb_admin_url = <?php echo $this->member->is_admin() === 'super' ? 'cb_url + "/' . config_item('uri_segment_admin') . '"' : '""'; ?>;
var cb_board = "<?php echo isset($view) ? element('board_key', $view) : ''; ?>";
var cb_board_url = <?php echo ( isset($view) && element('board_key', $view)) ? 'cb_url + "/' . config_item('uri_segment_board') . '/' . element('board_key', $view) . '"' : '""'; ?>;
var cb_device_type = "<?php echo $this->cbconfig->get_device_type() === 'mobile' ? 'mobile' : 'desktop' ?>";
var cb_csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
var cookie_prefix = "<?php echo config_item('cookie_prefix'); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.hoverIntent.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ba-outside-events.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/iscroll.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/mobile.sidemenu.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/js.cookie.js'); ?>"></script>
<?php echo $this->managelayout->display_js(); ?>
</head>
<body <?php echo isset($view) ? element('body_script', $view) : ''; ?>>

<!-- ham 클릭시 화면 -->
<article class="top">
    <div class="ham">
        <section class="ham_menu">
            <ul>
                <li>
                    <?php 
                    if ($this->member->is_member()) {
                        echo ' <button onclick="location.href=\''.site_url('login/logout?url=' . urlencode(current_full_url())).'\'">
                            hi '.$this->member->item('mem_userid') .' [LOGOUT]
                        </button>';
                    } else {
                        echo '<button onclick="location.href=\''.site_url('login?url=' . urlencode(current_full_url())).'\'">
                            LOGIN
                        </button>';
                    }    
                     ?>
                    
                    <a href="<?php echo site_url('/cmall/cart'); ?>">
                        <img src="<?php echo base_url('assets/images/cart.png'); ?>" alt="cart">
                    </a>
                </li>

                <li>
                    <h2>
                        <a href="<?php echo site_url('mypage'); ?>" title="mypage">
                            My Page
                        </a>
                    </h2>
                </li>

                <li>
                    <h2>
                        <a href="<?php echo site_url('cmall/orderlist'); ?>" title="Order Inquiry">
                            Order Inquiry
                        </a>
                    </h2>
                </li>

                <li>
                    <h2>SERVICE</h2>
                    <table>
                        <tr>
                            <td>
                            <a href="<?php echo site_url('faq/notice'); ?>" title="Notice">
                                Notice
                                    <span>
                                        ▶
                                    </span>
                            </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('faq/faq'); ?>" title="FAQ">
                                    FAQ
                                    <span>
                                        ▶
                                    </span>
                                </a>
                            </td>
                        </tr>
                    </table>
                </li>

                <li>
                    <h2>ABOUT ME</h2>
                    Call Center : 000.0000.0000

                </li>
            </ul>
        </section>
        <img src="<?php echo base_url('assets/images/clear.png'); ?>" alt="clear">
    </div>
</article>

<!-- 팝업창 배경 -->
<article class="cover">
</article>



<!-- header  -->
<header>
    <h1>
        <a href="<?php echo site_url(); ?>"  title="<?php echo html_escape($this->cbconfig->item('site_title'));?>"><?php echo $this->cbconfig->item('site_logo'); ?></a>
    </h1>
            
    <span><img src="<?php echo base_url('assets/images/ham.png'); ?>" alt="ham"></span>
    <span><a href="<?php echo base_url('cmall/cart') ?>"><img src="<?php echo base_url('assets/images/cart.png'); ?>" alt="cart"></a></span>
</header>

<!-- content -->
<?php $this->member->get_cart_num_in(); ?>
<div class="wrapper">
   

    <!-- main start -->
    <div>
        <!-- 본문 시작 -->
        <?php if (isset($yield))echo $yield; ?>
        <!-- 본문 끝 -->

        
    </div>
    <!-- main end -->

    <!-- footer start -->
    <!-- footer start -->
    <?php echo $this->managelayout->display_footer(); ?>
    <!-- footer end -->
    
</div>

<script type="text/javascript">
$(document).on('click', '.viewpcversion', function(){
    Cookies.set('device_view_type', 'desktop', { expires: 1 });
});
$(document).on('click', '.viewmobileversion', function(){
    Cookies.set('device_view_type', 'mobile', { expires: 1 });
});
</script>
<?php echo element('popup', $layout); ?>
<?php echo $this->cbconfig->item('footer_script'); ?>

<!--
Layout Directory : <?php echo element('layout_skin_path', $layout); ?>,
Layout URL : <?php echo element('layout_skin_url', $layout); ?>,
Skin Directory : <?php echo element('view_skin_path', $layout); ?>,
Skin URL : <?php echo element('view_skin_url', $layout); ?>,
-->

</body>
</html>
<script>
$(document).ready(function(){

/*로딩시 항상 맨 위로 이동*/
    $('html,body').animate({'scrollTop' : '0'}, 500);

/*header의 ham 클릭시 이동*/
    $('header span:nth-child(2)').click(function(){
        $('.top').css('z-index' , '300');
        $('.top').css('display' , 'block');
        $('.ham').animate({'left' : 0} , 500);
        $('header').css('z-index' , '50');
        $('.cover').fadeIn(500);
    });

/*ham 의 X 버튼 클릭시 이동*/
    $('.ham > img').click(function(){
        var ham_width = $('.ham').width();
        $('.ham').animate({'left' : -ham_width} , 500)
        

        setTimeout(function(){
            $('header').css('z-index' , '50');
            $('.top').css('z-index' , '0');
            $('.top').css('display' , 'none');
            $('.cover').fadeOut(200);
        },500);
    });

    $('.cover').css('height' , $('body').height());

    

/*하단 footer 영역 confirm terms of use 내용 펼치기*/
    $('footer ul li:nth-child(1)').click(function(){
            if($('footer ul li:nth-child(2)').css('display') == 'none'){
                $('footer ul li:nth-child(2)').slideDown();
                $('footer ul li:nth-child(2)').css('border-top' , '0');
            }else{
                $('footer ul li:nth-child(2)').slideUp();
            }

            $('html,body').animate({'scrollTop' : $(document).height()} , 1000);

        });
});


</script>
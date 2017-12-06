<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="mypage">
    

    <h3>회원 탈퇴</h3>
    <div class="mt20">
        <p style="padding:20px;">안녕하세요 <span class="text-primary"><?php echo html_escape($this->member->item('mem_nickname')); ?></span>님, <br />
            회원님의 탈퇴가 정상적으로 진행되었습니다.<br />
            그 동안 저희 사이트를 이용해주셔서 감사합니다.
        </p>
    </div>
</div>

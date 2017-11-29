<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="display_pay_button">
    <div class="text-center">
        <button type="button" onClick="fpayment_check();" >Order</button>
    </div>
</div>
<div id="display_pay_process" style="display:none">
    <img src="<?php echo site_url(VIEW_DIR . 'paymentlib/images/ajax-loader.gif'); ?>" alt="주문완료중" title="주문완료중" />
    <span>Your order is being completed. Please wait a moment.</span>
</div>

<script type="text/javascript">
$('#display_pay_button').show();
</script>
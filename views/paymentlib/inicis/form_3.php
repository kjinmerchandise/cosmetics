<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="display_pay_button">
    <div class="text-center">
        <button type="button" onClick="fpayment_check();" class="btn btn-order">ORDER</button>
    </div>
</div>
<div id="display_pay_process" style="display:none">
    <img src="<?php echo site_url(VIEW_DIR . 'paymentlib/images/ajax-loader.gif'); ?>" alt="Completing your order" title="Completing your order" />
    <span>Your order is being completed. Please wait a moment.</span>
</div>

<script type="text/javascript">
$('#display_pay_button').show();
</script>

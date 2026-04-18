
<?php

/**
 *  If you make this application for live payments then update following variable values:
 *  Change MODE from sandbox to live
 *  Update PayPal Client ID and Secret to match with your live paypal app details
 *  Change Base URL to https://api.paypal.com/v1/
 *  finally make sure that APP URL matcher to your application url
 */

define('MODE', 'sandbox');
define('CURRENCY', 'USD');
define('APP_URL', 'http://demos.itechempires.com/paypal-javascript-express-checkout-live-demo/'); 

define("PayPal_CLIENT_ID", "AdcFsYvHX2d1ljR8C3wQoIueH_DpAqy17a9mixJfvd8RwtNvIUk3GVvtFHpKgSRtRcBi7tEVGjW2dlpF");
define("PayPal_SECRET", "ENpAOFXaNWChDPceNW-haPLGjP6dqgjAXGME0DfjMYmBxI_4umCLKjjRsxutjmxid0C9rQzWFMlcQgY9");
define("PayPal_BASE_URL", "https://api.sandbox.paypal.com/v1/");

$total=10;

?>

<div id="paypal-button2"></div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        <?php if(MODE == 'live') { ?>
        env: 'production',
        <?php } else {?>
        env: 'sandbox',
        <?php } ?>

        commit: true,

        client: {
            sandbox: '<?php echo PayPal_CLIENT_ID; ?>',
            production: '<?php echo PayPal_CLIENT_ID; ?>'
        },

        payment: function (data, actions) {

            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: {
                                total: '<?php echo $total ?>',
                                currency: '<?php echo CURRENCY; ?>'
                            }
                        }
                    ]
                }
            });
        },

        onAuthorize: function (data, actions) {

            return actions.payment.execute().then(function () {
                window.location = "mes_souscriptions.php?payment_id=" + data.paymentID + "&payer_id=" + data.payerID + "&token=" + data.paymentToken;
            });
        }
    }, '#paypal-button2');
</script>
    
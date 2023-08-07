/**
 * When document ready.
 */
jQuery(document).ready(function(){

    // If the time for JS Cron greater than 0, run JS Cron.
    if (KDN_JS_Localize.js_cron > 0) KDN_RunJSCron();

});





/**
 * Run JS Cron.
 *
 * @since   2.3.3
 */
function KDN_RunJSCron(){

    // Send a request.
    jQuery.ajax({
        type        : "POST",
        dataType    : "JSON",
        url         : KDN_JS_Localize.ajax_url + '?kdn_jscron',
        data : {
            action  : "kdn_jscron"
        }
    });

    // Loop JS Cron.
    setTimeout(function(e){

        KDN_RunJSCron();

    }, KDN_JS_Localize.js_cron * 1000);

}
$(document).ready(function () {
    $("#btn_bell").click(function () {
        $("#records").load("load-updatecount.php");
    });

});

refresh_count();
refresh_notification();
refresh_comment();


function refresh_notification() {
    setTimeout(function () {
        $('#peso_wallet').load("load-wallet.php");
        // $('#wallet-abot').load("load-wallet-aBOT.php");
        // $('#pending-abot').load("load-pending-aBOT.php");
        // $('#active-abot').load("load-active-aBOT.php");
        // $('#manual').load("load-manual-aBOT.php");
        refresh_notification();
    }, 500);

}

function refresh_comment(){
    setTimeout(function () {
        // $('#wallet-abot').load("load-wallet-aBOT.php");
        // $('#pending-abot').load("load-pending-aBOT.php");
        // $('#active-abot').load("load-active-aBOT.php");
        // $('#manual').load("load-manual-aBOT.php");
          $('#records').load("load-comments.php");
        refresh_comment();
    }, 150);

}

function refresh_count() {
    setTimeout(function () {
        $('#notification_count').load("load-count.php");
        refresh_count();
    }, 500);

}
"use strict";

function showPackage(packageNo, amount) {
    document.getElementById('package').innerHTML = "Package " + packageNo;
    if (packageNo == 1) {
        document.getElementById('badge').innerHTML = "<span class=\"badge badge-primary\">Basic</span>";
    } else {
        document.getElementById('badge').innerHTML = "<span class=\"badge badge-warning\">Premium</span>";
    }
    document.getElementById('amount').innerHTML = currencyFormat(amount);
}

function currencyFormat(num) {
    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
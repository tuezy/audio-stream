function ready(callback){
    // in case the document is already rendered
    if (document.readyState!='loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function(){
            if (document.readyState=='complete') callback();
        });
}

function waitForElm(selector) {
    return new Promise(resolve => {
        if (document.querySelector(selector)) {
            return resolve(document.querySelector(selector));
        }

        const observer = new MutationObserver(mutations => {
            if (document.querySelector(selector)) {
                resolve(document.querySelector(selector));
                observer.disconnect();
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
}

waitForElm('.dataTable-checkbox').then((elm) => {
    var checkboxItems = document.querySelectorAll(".dataTable-checkbox");
    if(checkboxItems){
        Array.from(checkboxItems).forEach(function (item) {
            item.addEventListener('click', function (event) {
                if (event.target.checked == true) {
                    event.target.closest('tr').classList.add("table-active");
                } else {
                    event.target.closest('tr').classList.remove("table-active");
                }
            });
        });
    }
});

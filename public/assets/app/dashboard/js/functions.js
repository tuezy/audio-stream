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

function singleDelete(urlDelete, id){
    Swal.fire({
        title: "Bạn có chắc chắn muốn xóa?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
        cancelButtonClass: 'btn btn-danger w-xs mt-2',
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy",
        buttonsStyling: false,
        showCloseButton: true
    }).then(function (result) {
        if (result.value) {
            try {
                axios.delete(urlDelete, {
                    data: {
                        ids: id
                    }
                }).then(function (response) {
                    if(response.data.success){
                        location.reload();
                    }
                })
            } catch (error) {
                console.log(error)
            }
        }
    });
}

function showEditModal(urlEdit, id){
    try {
        axios.get(urlEdit, {
            data: {
                id: id
            }
        }).then(function (response) {
            document.getElementById('updateContentEdit').innerHTML = response.data;
            let myModal = new bootstrap.Modal(document.getElementById('showUpdateModal'), {
                keyboard: false
            });
            myModal.show();
        })
    } catch (error) {
        console.log(error)
    }
}

function deleteMultiple(urlDelete) {
    ids_array = [];
    var items = document.getElementsByName('chk_child');
    for (i = 0; i < items.length; i++) {
        if (items[i].checked == true) {
            ids_array.push(items[i].value);
        }
    }
    if (typeof ids_array !== 'undefined' && ids_array.length > 0) {
        singleDelete(urlDelete, ids_array);
    } else {
        Swal.fire({
            title: 'Hãy chọn ít nhất một đối tượng để xóa',
            confirmButtonClass: 'btn btn-info',
            buttonsStyling: false,
            showCloseButton: true
        });
    }
}
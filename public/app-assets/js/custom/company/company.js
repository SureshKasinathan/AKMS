/**
 * Building custom scripts.
 */

/**
 * Update the company with sweet confirm box.
 * @param {resource type} resource 
 * @param {POST, GET, PUT, DELETE} method 
 * @param {resource id} id 
 * @param {action url} target 
 * @param {token} csrf 
 */
function updateTheRequestedResources(id, target, csrf, item_name) {

    if (id > 0) {
        swal({
            title: item_name,
            text: "Are you sure you want to delete this company?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "No, cancel plx!",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Delete",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        }).then(isConfirm => {

            if (isConfirm) {
                $.ajax({
                    url: target,
                    method: method,
                    data: {},
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            swal("Deleted!", response.message, "success");
                            $('.' + resource + '_no').each(function(i) {
                                $(this).html((i+1));
                            });
                        } else {
                            swal("Deleted!", response.message, "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "It's safe.", "error");
            }
        });
    }
}

/**
 * Delete the resources/records with sweet alert confirm box.
 * @param {resource id} id 
 * @param {action url} target 
 * @param {token} csrf 
 */
function updateTheRequestedResources(id, target, csrf, item_name) {

    if (id > 0) {
        swal({
            title: item_name,
            text: "Are you sure you want to delete this company?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "No, cancel plx!",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Delete",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        }).then(isConfirm => {

            if (isConfirm) {
                $.ajax({
                    url: target,
                    method: method,
                    data: {},
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            swal("Updated", response.message, "success");
                            $('.' + resource + '_no').each(function(i) {
                                $(this).html((i+1));
                            });
                        } else {
                            swal("Failed!", response.message, "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "It's safe.", "error");
            }
        });
    }
}
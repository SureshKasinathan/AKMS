/**
 * Building custom scripts.
 */

/**
 * Update the resources/records with sweet alert confirm box.
 * @param {resource type eg company} resource 
 * @param {resource id} id 
 * @param {action url} target 
 * @param {token} csrf 
 */
function updateTheRequestedResources(resource, id, target, csrf, item_name, act_status) {

    if (id > 0) {
        swal({
            title: item_name,
            text: "Are you sure you want to change this " + resource + " status?",
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
                    text: "Change",
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
                    method: 'PATCH',
                    data: {
                        status: ($('#' + resource + '_status_' + id).hasClass('badge-success')) ? 1 : 0,
                        _method: "PATCH"
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            if ($('#' + resource + '_status_' + id).hasClass('badge-success')) {
                                $('#' + resource + '_status_' + id)
                                    .removeClass('badge-success')
                                    .addClass('badge-danger')
                                    .html('Deactive');
                            } else {
                                $('#' + resource + '_status_' + id)
                                    .removeClass('badge-danger')
                                    .addClass('badge-success')
                                    .html('Active');
                            }
                            swal("Updated", response.message, "success");
                        } else {
                            swal("Failed", response.message, "error");
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
 * @param {resource type eg company} resource 
 * @param {resource id} id 
 * @param {action url} target 
 * @param {token} csrf 
 */
function deleteTheRequestedResources(resource, id, target, csrf, item_name) {

    if (id > 0) {
        swal({
            title: item_name,
            text: "Are you sure you want to delete this " + resource + "?",
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
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            swal("Deleted", response.message, "success");
                            $('#' + resource + '_' + id).remove();// Removing table row form gui.
                            $('.' + resource + '_no').each(function (i) {
                                $(this).html((i + 1));
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
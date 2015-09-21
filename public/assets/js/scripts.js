jQuery(document).ready(function() {
    
    /*
        Fullscreen background
    */
    $.backstretch("/assets/img/backgrounds/login-bg.jpg");
    
    
});

/*
 * Delete Agent
 */
jQuery(document).on("click",".del-agent", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to delete this agent? You cannot undo this action.",
        title: "Delete Agent",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Delete",
                className: "btn-danger",
                callback: function () {
                    console.log("Deleted agent ");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Assign Agent
 */
jQuery(document).on("click",".assign-agent", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to assign this agent?",
        title: "Assign Agent",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Assign",
                className: "btn-success",
                callback: function () {
                    console.log("Assigned agent ");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Delete Group
 */
jQuery(document).on("click",".del-group", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to delete this group? You cannot undo this action.",
        title: "Delete Group",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Delete",
                className: "btn-danger",
                callback: function () {
                    console.log("Deleted group ");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Delete User
 */
jQuery(document).on("click",".del-user", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to delete this user? You cannot undo this action.",
        title: "Delete User",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Delete",
                className: "btn-danger",
                callback: function () {
                    console.log("Deleted user");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Delete User
 */
jQuery(document).on("click",".del-deptrep", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to delete this user? Once you delete this user, the department associated with this user will also be deleted. <br/><br/>You cannot undo this action.",
        title: "Delete User",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Delete",
                className: "btn-danger",
                callback: function () {
                    console.log("Deleted user");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Delete Department
 */
jQuery(document).on("click",".del-dept", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to delete this department? Once you delete a department, the users associated with this department will also be deleted. <br/><br/>You cannot undo this action.",
        title: "Delete User",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Delete",
                className: "btn-danger",
                callback: function () {
                    console.log("Deleted dept");
                    location.href = href;
                }
            }
        }
    });
});
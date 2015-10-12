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

/*
 * Escalate Ticket
 */
jQuery(document).on("click",".escalate", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to escalate this ticket to the representative of the department concerned?",
        title: "Escalate Ticket",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Escalate",
                className: "bg-purple",
                callback: function () {
                    console.log("Escalated");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Close Ticket
 */
jQuery(document).on("click",".close-ticket", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to close this ticket? Once it's done, you won't be able to reopen this anymore and the user who logged this ticket will be notified regarding this change.",
        title: "Close Ticket",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Continue Closing Ticket",
                className: "bg-navy",
                callback: function () {
                    console.log("Escalated");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Close Ticket
 */
jQuery(document).on("click",".cancel-ticket", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to cancel this ticket? You cannot undo this action and the user who logged this ticket will be notified regarding this change.",
        title: "Cancel Ticket",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Continue Cancelling Ticket",
                className: "btn-danger",
                callback: function () {
                    console.log("Cancelled Ticket");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Reopen Ticket
 */
jQuery(document).on("click",".reopen-ticket", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to reopen this ticket? You cannot undo this action and the user who logged this ticket will be notified regarding this change.",
        title: "Reopen Ticket",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Continue Reopening Ticket",
                className: "btn-info",
                callback: function () {
                    console.log("Reopened");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * Delete Announcement
 */
jQuery(document).on("click",".delete-announcement", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want to delete this post? You cannot undo this action",
        title: "Delete Post",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Continue Deleting Post",
                className: "btn-info",
                callback: function () {
                    console.log("Deleted");
                    location.href = href;
                }
            }
        }
    });
});

/*
 * waiting for agency Ticket
 */
jQuery(document).on("click",".wait", function (event) {
    event.preventDefault();
    var href = $(this).attr("href");

    bootbox.dialog({
        message: "Are you sure you want this ticket to wait for the concerned agency?",
        title: "Concerned Agency Ticket",
        buttons: {
            cancel: {
                label: "Cancel",
                className: "btn-default",
                callback: function () {
                    console.log("Cancelled");
                }
            },
            danger: {
                label: "Wait",
                className: "bg-purple",
                callback: function () {
                    console.log("Escalated");
                    location.href = href;
                }
            }
        }
    });
});
jQuery(document).ready(function() {
    
    /*
        Fullscreen background
    */
    $.backstretch("/assets/img/backgrounds/login-bg.jpg");
    
    
});

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

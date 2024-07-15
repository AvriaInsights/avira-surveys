$(document).ready(function () {
    tinyMCE.init({
        mode: "specific_textareas",
        editor_selector: "tinymce",
        height: 300,
        theme: 'modern',
        plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists textcolor wordcount  imagetools contextmenu colorpicker textpattern',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        content_css: [
            '//fonts.googleapis.com/css?family=Nunito:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        forced_root_block : "", 
        force_br_newlines : true,
        force_p_newlines : false,
        init_instance_callback: function (editor) {
            editor.on('Change', function (e) {
                tinymce.activeEditor.dom.setAttrib(tinymce.activeEditor.dom.select('table'), 'border', null);

            });
        }
    });
});
$(document).ready(function () {
    $('#side-menu').metisMenu();
});

$(document).ready(function () {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
$(function () {
    $('body').confirmation({
        selector: '[data-toggle="confirmation"]'
    });

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function () {
    $(window).bind("load resize", function () {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1)
            height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function () {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

$(document).ready(function () {
    $('#side-menu').metisMenu();

    $('#dataTables-example').DataTable({
        responsive: true
    });
});
$(function () {
    $('body').confirmation({
        selector: '[data-toggle="confirmation"]'
    });

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function () {
    $(window).bind("load resize", function () {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1)
            height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function () {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

function changeUserStatus(user_id, status) {
    /* changing the city status*/
    var obj_params = new Object();
    obj_params.user_id = user_id;
    obj_params.status = status;
    jQuery.post("change-user-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + user_id + ", #blocked" + user_id + ", #unblocked" + user_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + user_id + ", #blocked" + user_id + ", #unblocked" + user_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + user_id).css('display', 'none');
                $("#blocked" + user_id).css('display', 'inline-block');
                $("#unblocked" + user_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + user_id).css('display', 'none');
                $("#unblocked" + user_id).css('display', 'inline-block');
                $("#blocked" + user_id).css('display', 'none');
            }
        }
    }, "json");

}

function changePropertyStatus(property_id, status) {
    /* changing the city status*/
    var obj_params = new Object();
    obj_params.property_id = property_id;
    obj_params.status = status;
    jQuery.post("change-property-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + property_id + ", #blocked" + property_id + ", #unblocked" + property_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + property_id + ", #blocked" + property_id + ", #unblocked" + property_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + property_id).css('display', 'none');
                $("#blocked" + property_id).css('display', 'inline-block');
                $("#unblocked" + property_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + property_id).css('display', 'none');
                $("#unblocked" + property_id).css('display', 'inline-block');
                $("#blocked" + property_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeOwnerStatus(owner_id, status) {
    /* changing the city status*/
    var obj_params = new Object();
    obj_params.owner_id = owner_id;
    obj_params.status = status;
    jQuery.post("change-owner-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + owner_id + ", #blocked" + owner_id + ", #unblocked" + owner_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + owner_id + ", #blocked" + owner_id + ", #unblocked" + owner_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + owner_id).css('display', 'none');
                $("#blocked" + owner_id).css('display', 'inline-block');
                $("#unblocked" + owner_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + owner_id).css('display', 'none');
                $("#unblocked" + owner_id).css('display', 'inline-block');
                $("#blocked" + owner_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeLocationStatus(location_id, status) {
    /* changing the city status*/
    var obj_params = new Object();
    obj_params.location_id = location_id;
    obj_params.status = status;
    jQuery.post("change-location-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + location_id + ", #blocked" + location_id + ", #unblocked" + location_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + location_id + ", #blocked" + location_id + ", #unblocked" + location_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + location_id).css('display', 'none');
                $("#blocked" + location_id).css('display', 'inline-block');
                $("#unblocked" + location_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + location_id).css('display', 'none');
                $("#unblocked" + location_id).css('display', 'inline-block');
                $("#blocked" + location_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeServiceStatus(service_id, status) {
    /* changing the service status*/
    var obj_params = new Object();
    obj_params.service_id = service_id;
    obj_params.status = status;
    jQuery.post("change-service-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + service_id + ", #blocked" + service_id + ", #unblocked" + service_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + service_id + ", #blocked" + service_id + ", #unblocked" + service_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + service_id).css('display', 'none');
                $("#blocked" + service_id).css('display', 'inline-block');
                $("#unblocked" + service_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + service_id).css('display', 'none');
                $("#unblocked" + service_id).css('display', 'inline-block');
                $("#blocked" + service_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeAdminStatus(admin_id, status) {
    /* changing the admin status*/
    var obj_params = new Object();
    obj_params.admin_id = admin_id;
    obj_params.status = status;
    jQuery.post("change-admin-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + admin_id + ", #blocked" + admin_id + ", #unblocked" + admin_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + admin_id + ", #blocked" + admin_id + ", #unblocked" + admin_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + admin_id).css('display', 'none');
                $("#blocked" + admin_id).css('display', 'inline-block');
                $("#unblocked" + admin_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + admin_id).css('display', 'none');
                $("#unblocked" + admin_id).css('display', 'inline-block');
                $("#blocked" + admin_id).css('display', 'none');
            }
        }
    }, "json");

}


function changeTopicStatus(topic_id, status) {
    /* changing the topic status*/
    var obj_params = new Object();
    obj_params.topic_id = topic_id;
    obj_params.status = status;
    jQuery.post("change-topic-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + topic_id + ", #blocked" + topic_id + ", #unblocked" + topic_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + topic_id + ", #blocked" + topic_id + ", #unblocked" + topic_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + topic_id).css('display', 'none');
                $("#blocked" + topic_id).css('display', 'inline-block');
                $("#unblocked" + topic_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + topic_id).css('display', 'none');
                $("#unblocked" + topic_id).css('display', 'inline-block');
                $("#blocked" + topic_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeTestimonialStatus(testimonial_id, status) {
    /* changing the testimonial status*/
    var obj_params = new Object();
    obj_params.testimonial_id = testimonial_id;
    obj_params.status = status;
    jQuery.post("change-testimonial-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + testimonial_id + ", #blocked" + testimonial_id + ", #unblocked" + testimonial_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + testimonial_id + ", #blocked" + testimonial_id + ", #unblocked" + testimonial_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + testimonial_id).css('display', 'none');
                $("#blocked" + testimonial_id).css('display', 'inline-block');
                $("#unblocked" + testimonial_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + testimonial_id).css('display', 'none');
                $("#unblocked" + testimonial_id).css('display', 'inline-block');
                $("#blocked" + testimonial_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeCityStatus(city_id, status) {
    /* changing the city status*/
    var obj_params = new Object();
    obj_params.city_id = city_id;
    obj_params.status = status;
    jQuery.post("change-city-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + city_id + ", #blocked" + city_id + ", #unblocked" + city_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + city_id + ", #blocked" + city_id + ", #unblocked" + city_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + city_id).css('display', 'none');
                $("#blocked" + city_id).css('display', 'inline-block');
                $("#unblocked" + city_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + city_id).css('display', 'none');
                $("#unblocked" + city_id).css('display', 'inline-block');
                $("#blocked" + city_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeServiceStatus(service_id, status) {
    /* changing the service status*/
    var obj_params = new Object();
    obj_params.service_id = service_id;
    obj_params.status = status;
    jQuery.post("change-service-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + service_id + ", #blocked" + service_id + ", #unblocked" + service_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + service_id + ", #blocked" + service_id + ", #unblocked" + service_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + service_id).css('display', 'none');
                $("#blocked" + service_id).css('display', 'inline-block');
                $("#unblocked" + service_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + service_id).css('display', 'none');
                $("#unblocked" + service_id).css('display', 'inline-block');
                $("#blocked" + service_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeAdminStatus(admin_id, status) {
    /* changing the admin status*/
    var obj_params = new Object();
    obj_params.admin_id = admin_id;
    obj_params.status = status;
    jQuery.post("change-admin-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + admin_id + ", #blocked" + admin_id + ", #unblocked" + admin_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + admin_id + ", #blocked" + admin_id + ", #unblocked" + admin_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + admin_id).css('display', 'none');
                $("#blocked" + admin_id).css('display', 'inline-block');
                $("#unblocked" + admin_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + admin_id).css('display', 'none');
                $("#unblocked" + admin_id).css('display', 'inline-block');
                $("#blocked" + admin_id).css('display', 'none');
            }
        }
    }, "json");

}


function changeTopicStatus(topic_id, status) {
    /* changing the topic status*/
    var obj_params = new Object();
    obj_params.topic_id = topic_id;
    obj_params.status = status;
    jQuery.post("change-topic-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + topic_id + ", #blocked" + topic_id + ", #unblocked" + topic_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + topic_id + ", #blocked" + topic_id + ", #unblocked" + topic_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + topic_id).css('display', 'none');
                $("#blocked" + topic_id).css('display', 'inline-block');
                $("#unblocked" + topic_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + topic_id).css('display', 'none');
                $("#unblocked" + topic_id).css('display', 'inline-block');
                $("#blocked" + topic_id).css('display', 'none');
            }
        }
    }, "json");

}

function changeTestimonialStatus(testimonial_id, status) {
    /* changing the testimonial status*/
    var obj_params = new Object();
    obj_params.testimonial_id = testimonial_id;
    obj_params.status = status;
    jQuery.post("change-testimonial-status.php", obj_params, function (msg) {
        if (msg.error == "1") {
            alert(msg.error_message);
        } else {
            $("#pending" + testimonial_id + ", #blocked" + testimonial_id + ", #unblocked" + testimonial_id).html("<i class='fa fa-spin fa fa-circle-o-notch'></i> Changing...");
            window.setTimeout(function () {
                $("#pending" + testimonial_id + ", #blocked" + testimonial_id + ", #unblocked" + testimonial_id).html(status);
            }, 1000);
            if (status == "Inactive") {
                $("#pending" + testimonial_id).css('display', 'none');
                $("#blocked" + testimonial_id).css('display', 'inline-block');
                $("#unblocked" + testimonial_id).css('display', 'none');
            }
            if (status == "Active") {
                $("#pending" + testimonial_id).css('display', 'none');
                $("#unblocked" + testimonial_id).css('display', 'inline-block');
                $("#blocked" + testimonial_id).css('display', 'none');
            }
        }
    }, "json");

}


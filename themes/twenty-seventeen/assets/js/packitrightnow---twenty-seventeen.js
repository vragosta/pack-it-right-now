"use strict";

!function(o) {
    var e = {
        setupMenuToggle: function() {
            o(".drop-down").click(function() {
                o(this).fadeOut(), o("#mobile-menu").addClass("load");
            }), o(".fa-times").click(function() {
                o(".drop-down").fadeIn(), o("#mobile-menu").removeClass("load");
            });
        },
        productsToggle: function() {
            o("a[name=products]").click(function() {
                o(".sub-menu").hasClass("load") ? o(".sub-menu").removeClass("load") : o(".sub-menu").addClass("load");
            }), o(".dropdown").on("click", function() {
                o(".dropdown").hasClass("change-color") && (o(".dropdown").removeClass("change-color"), 
                o(".dropdown-toggle").removeClass("change-color")), o(this).find(".dropdown-toggle").hasClass("open") ? (o(this).find(".dropdown-toggle").removeClass("change-color"), 
                o(this).removeClass("change-color")) : (o(this).find(".dropdown-toggle").addClass("change-color"), 
                o(this).addClass("change-color"));
            }), o("html").on("click", function(e) {
                "dropdown-toggle change-color" !== e.srcElement.className && (o(".dropdown").removeClass("change-color"), 
                o(".dropdown-toggle").removeClass("change-color"));
            });
        },
        setCarouselSettings: function() {
            o(".carousel").slick({
                infinite: !0,
                slidesToShow: 1,
                autoplay: !0,
                autoplaySpeed: 3e3
            });
        },
        sendContactInformation: function() {
            o(".contact-btn").click(function() {
                var e = o("#firstname").val(), s = o("#lastname").val(), a = o("#email").val(), n = o("#subject").val(), t = o("#message").val(), l = {
                    firstname: e,
                    lastname: s,
                    email: a,
                    subject: n,
                    message: t
                };
                e && s && a && n && t ? o.ajax({
                    url: PackItRightNow.options.apiUrl + "/contact/",
                    type: "post",
                    headers: {
                        "X-WP-Nonce": PackItRightNow.options.nonce
                    },
                    data: JSON.stringify(l),
                    dataType: "json"
                }).then(function(e) {
                    o(".error").find(".alert-danger").removeClass("alert-danger").addClass("alert-success"), 
                    o(".error").find("p").html("You message was successfully sent!"), o(".error").addClass("show-message");
                }) : o(".error").addClass("show-message");
            });
        },
        scrollToProduct: function() {
            var e = this.getParameterByName("term");
            e && o("#" + e).length && o("html, body").animate({
                scrollTop: o("#" + e).offset().top
            }, 2e3);
        },
        getParameterByName: function(o, e) {
            e || (e = window.location.href), o = o.replace(/[\[\]]/g, "\\$&");
            var s = new RegExp("[?&]" + o + "(=([^&#]*)|&|#|$)").exec(e);
            return s ? s[2] ? decodeURIComponent(s[2].replace(/\+/g, " ")) : "" : null;
        },
        init: function() {
            this.setupMenuToggle(), this.productsToggle(), this.setCarouselSettings(), this.sendContactInformation(), 
            this.scrollToProduct();
        }
    };
    jQuery(document).ready(function() {
        e.init();
    });
}(jQuery);
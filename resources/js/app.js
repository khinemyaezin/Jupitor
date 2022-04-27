require("./bootstrap");
require("./quill");
window.Jarallax = require("jarallax").jarallax;
window.rxjs = require("rxjs");
window.$ = window.jQuery = require("jquery");
window.PhoneNumber = require("awesome-phonenumber");
window.Pretty = require("pretty");
window.Sortable = require("sortablejs").default;
window.QuillDeltaToHtmlConverter =
    require("quill-delta-to-html").QuillDeltaToHtmlConverter;
window.TxtType = require("./txtype").default;
window.Utility = new (require("./utility").default)();
window.Net = new (require("./Connection").default)();
window.ThemeBuilder = new (require("./ThemeBuilder").default)();
window.Theme = require("./Theme").default;
window.Flickity = require("flickity");
window.Aos = require("AOS");

/** ===== Aos ===== */
Aos.init();
/** ===== Jarallax Init ===== */
Jarallax(document.querySelectorAll(".jarallax"), {
    speed: 0.2,
});
/** ===== Nav Bar Animation ===== */
document.addEventListener("DOMContentLoaded", function (event) {
    document.addEventListener("scroll", function (e) {
        lastKnownScrollPosition = window.scrollY;
        if (document.documentElement.scrollTop == 0) {
            $(".header").removeClass("header-small header-shadow");
            console.log(document.documentElement.scrollTop);
        } else {
            $(".header").addClass("header-small header-shadow");
        }
    });
    
});

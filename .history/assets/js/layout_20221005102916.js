!(function () {
    "use strict";
    var t, a, e;
    sessionStorage.getItem("defaultAttribute") &&
        ((t = document.documentElement.attributes),
        (a = {}),
        Object.entries(t).forEach(function (t) {
            var e;
            t[1] && t[1].nodeName && "undefined" != t[1].nodeName && ((e = t[1].nodeName), (a[e] = t[1].nodeValue));
        }),
        sessionStorage.getItem("defaultAttribute") !== JSON.stringify(a)
            ? (sessionStorage.clear(), window.location.reload())
            : (((e = {})["data-layout"] = sessionStorage.getItem("data-layout")),
              (e["data-sidebar-size"] = sessionStorage.getItem("data-sidebar-size")),
              (e["data-layout-mode"] = sessionStorage.getItem("data-layout-mode")),
              (e["data-layout-width"] = sessionStorage.getItem("data-layout-width")),
              (e["data-sidebar"] = sessionStorage.getItem("data-sidebar")),
              (e["data-sidebar-image"] = sessionStorage.getItem("data-sidebar-image")),
              (e["data-layout-direction"] = sessionStorage.getItem("data-layout-direction")),
              (e["data-layout-position"] = sessionStorage.getItem("data-layout-position")),
              (e["data-layout-style"] = sessionStorage.getItem("data-layout-style")),
              (e["data-topbar"] = sessionStorage.getItem("data-topbar")),
              Object.keys(e).forEach(function (t) {
                  e[t] && e[t] && document.documentElement.setAttribute(t, e[t]);
              })));
})();

define([
    "dojo/_base/declare",
    "hc-backend/layout/main/content/package",
    "dojo/i18n!./nls/Package",
    "xstyle/css!./css/tag.css"
], function(declare, _Package, translation) {
    return declare("BlogTagPackage", [ _Package ], {
        title: translation['packageTitle']
    });
});

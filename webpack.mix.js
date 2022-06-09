let mix = require("laravel-mix");
let tailwindcss = require("tailwindcss");

require("./nova.mix");

mix.setPublicPath("dist")
    .js("resources/js/field.js", "js")
    .vue({ version: 3 })
    .postCss("resources/css/field.css", "css", [
        tailwindcss("tailwind.config.js"),
    ])
    .nova("idez/nova-checkboxes-field")
    .disableNotifications();

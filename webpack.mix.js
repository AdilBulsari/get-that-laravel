let mix = require("laravel-mix");
require("laravel-mix-purgecss");

mix.js("resources/js/app.js", "public/js").vue();

mix.styles(["resources/css/app.css",
"resources/css/grid.min.css"
], "public/css/all.css");

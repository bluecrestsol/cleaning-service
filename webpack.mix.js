const mix = require('laravel-mix');
const env = process.env.APP_ENV || 'local';
const slug = (env === 'staging') ? 'mister-shield-web' : '';

mix.webpackConfig({
    resolve: {
        alias: {
            '^public': path.resolve(__dirname, 'public/'),
            '^assets': path.resolve(__dirname, 'resources/assets'),
            '^resources': path.resolve(__dirname, 'resources/js/'),
            '^templates': path.resolve(__dirname, 'templates'),
            ziggy: path.resolve('vendor/tightenco/ziggy/dist/js/route.js')
        }
    },
    output: {
        publicPath: (slug) ? `/${slug}/` : '/'
    }
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setResourceRoot(`/${slug}`);

// main
mix.copyDirectory('resources/assets/admin', 'public/assets/admin');
mix.copyDirectory('resources/assets/customer/dist', 'public/assets/public');

// custom
mix.sass('resources/assets/customer/scss/app.scss', 'public/assets/public/css/app.min.css');
mix.scripts([
    'resources/assets/customer/js/moment.min.js',
    'resources/assets/customer/js/bulma-accordion.min.js',
    'resources/assets/customer/js/script.js'
], 'public/assets/public/js/script.js')
.js('resources/js/admin/app.js', 'public/js/admin');


var modules = {
    'admin': {
        'dashboard': [ 'index' ],
        'staff': [ 'index', 'crud', 'view'],
        'customers': [ 'index', 'crud', 'view'],
        'customers/notes': [ 'index', 'crud' ],
        'roles': [ 'index', 'crud', 'view'],
        'countries': [ 'index', 'crud', 'view'],
        'countries/languages': [ 'index', 'crud', 'view'],
        'countries/currencies': [ 'index', 'crud', 'view'],
        'states': [ 'index', 'crud', 'view'],
        'cities': [ 'index', 'crud', 'view'],
        'districts': [ 'index', 'crud', 'view'],
        'languages': [ 'index', 'crud', 'view'],
        'currencies': [ 'index', 'crud', 'view'],
        'companies': [ 'index', 'crud', 'view' ],
        'companies/countries': [ 'index', 'crud' ],
        'places': [ 'index', 'crud', 'view' ],
        'places/categories': [ 'index', 'crud', 'view' ],
        'crew-members': [ 'index', 'crud', 'view' ],
        'bookings': [ 'index', 'crud', 'view' ],
        'appointments': [ 'index', 'crud', 'view' ],
        'faqs': [ 'index', 'crud', 'view' ],
        'faqs/categories': [ 'index', 'crud', 'view' ],
        'faqs/categories/questions': [ 'index', 'crud', 'view' ],
        'contracts': [ 'index', 'crud', 'view' ],
        'agents': [ 'index', 'crud', 'view' ],
        'services': [ 'index', 'crud', 'view' ]
    },
    'customer': {
        'home': [ 'index' ],
        'about': [ 'index' ],
        'services': [ 'index' ],
        'contact': [ 'index' ],
        'bookings': [ 'index' ],
        'verify': [ 'index', 'results' ],
        'serviced-locations': [ 'index', 'view' ],
        'pricing': [ 'index' ],
        'faq': [ 'index' ],
        'completed-services': [ 'index' ],
    }
};

for (const category of Object.keys(modules)) {
    for (const name of Object.keys(modules[category])) {
        modules[category][name].forEach(function(type) {
            mix.js(`resources/js/${category}/${name}/${type}.js`, `public/js/${category}/${name}`);
        });
    }
}

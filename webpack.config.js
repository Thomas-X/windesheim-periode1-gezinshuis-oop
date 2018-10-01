const path = require('path');

// TODO change this path since we will be running our node instance from the project root.
const outputPath = path.join(__dirname, 'public', 'js');

module.exports = (env, argv) => {
    return {
        mode: argv.enviroment === 'production' ? 'production' : 'development',
        entry: {
            ['404']: './views/javascript/404/404.js',
            about: './views/javascript/About/about.js',
            contact: './views/javascript/Contact/contact.js',
            home: './views/javascript/Home/home.js',
            login: './views/javascript/Login/login.js',
            register: './views/javascript/Register/register.js',
            global: './views/javascript/global.js',
            // add extra files here as well (we need different entry points so javascript that shouldn't be on a page doesn't get executed)
            // cross-file imports should be:
            // Use optimization.splitChunks to create bundles of shared application code between each page.
            // Multi-page applications that reuse a lot of code/modules between entry points can greatly benefit
            // from these techniques, as the amount of entry points increase.
        },
        output: {
            path: outputPath,
            filename: '[name].js'
        },
        devtool: 'source-maps',
        module: {
            rules: [
                {
                    test: /views\/javascript\/\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: "babel-loader",
                        options: {
                            presets: [
                                "env"
                            ]
                        }
                    }
                },
                {
                    test: /public\/css\/\.css$/,
                    use: [
                        "style-loader",
                        "css-loader"
                    ]
                }
            ]
        }
    }
}
const path = require('path');

// TODO change this path since we will be running our node instance from the project root.
const outputPath = path.join(__dirname, 'public', 'js');
const dir = './resources/javascript'

const javascriptDirectoryHelper = (pages) => {
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    const obj = {};
    for (const page of pages) {
        obj[page] = `${dir}/${capitalizeFirstLetter(page)}/${page}.js`;
    }
    return obj
}

module.exports = (env, argv) => {
    const obj = {
        mode: argv.enviroment === 'production' ? 'production' : 'development',
        entry: {
            global: `${dir}/global.js`,
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
    
    obj.entry = Object.assign(obj.entry, javascriptDirectoryHelper([
                '404',
                'about',
                'contact',
                'home',
                'login',
                'register'
            ]));
    return obj;
}

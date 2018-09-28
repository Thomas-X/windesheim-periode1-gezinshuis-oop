const path = require('path');

// TODO change this path since we will be running our node instance from the project root.
const outputPath = path.join(__dirname, 'public', 'js');

module.exports = {
    mode: 'development',
    entry: './views/javascript/index.js',
    output: {
        path: outputPath,
        filename: 'bundle.js'
    },
    devtool: 'source-map',
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
};
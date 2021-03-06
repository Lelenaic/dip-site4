module.exports = {
    entry: './assets/app.js',

    devtool: 'source-map',

    output: {
        filename: './dist/bundle.js'
    },

    module: {
        loaders: [
            {
                test: /\.js$/,
                use: 'babel-loader'
            }
        ]
    }
};
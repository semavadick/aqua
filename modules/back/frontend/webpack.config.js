var webpack = require('webpack');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var path = require('path');

module.exports = {
    context: path.join(__dirname, 'src'),
    entry: {
        polyfills: './polyfills',
        vendor: './vendor',
        app: './main'
    },

    resolve: {
        extensions: ['', '.ts', '.js']
    },

    output: {
        path: __dirname + '/dist',
        filename: '[name].js'
    },

    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'source-map-loader',
                exclude: [
                    // these packages have problems with their sourcemaps
                    __dirname + 'node_modules/rxjs',
                    __dirname + 'node_modules/@angular',
                    __dirname + 'node_modules/@ngrx',
                    __dirname + 'node_modules/@angular2-material'
                ]
            },

            { test: /\.html$/, loader: 'html?-attrs&minimize=false' },
            { test: /\.css$/, loaders: ['to-string-loader', 'css-loader'] },
            {
                test: /\.ts$/,
                loaders: ['ts-loader', 'angular2-template-loader'],
                exclude: [/\.(spec|e2e)\.ts$/, /node_modules\/(?!(ng2-.+))/]
            }
        ]
    },

    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: ['polyfills', 'vendor'].reverse()
        }),

        new HtmlWebpackPlugin({
            template: './index.html',
            chunksSortMode: 'dependency'
        }),

        /*new webpack.optimize.UglifyJsPlugin({

        })*/
    ]
};
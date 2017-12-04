const path = require('path');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const autoPrefixer = require('autoprefixer');

const dev = process.env.WEBPACK_BUILD_MODE === 'dev';

const cssLoaders = [
    {
        loader: 'css-loader',
        options: {
            importLoaders: 1,
            minimize: !dev,
        },
    },
];

if (!dev) {
    cssLoaders.push({
        loader: 'postcss-loader',
        options: {
            plugins: () => [
                autoPrefixer({
                    browsers: ['last 2 versions', 'ie > 8'],
                }),
            ],
        },
    });
}

const config = {
    entry: {
        bundle: ['./static/js/index.js'],
    },
    output: {
        path: path.resolve(__dirname, './public/dist'),
        filename: dev ? '[name].js' : '[name].[chunkhash:8].js',
    },
    watch: dev,
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: 'babel-loader',
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: cssLoaders,
                }),
            },
            {
                test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
                loader: 'file-loader',
            },
            {
                test: /\.(png|jpe?g|gif|svg)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]'
                        }
                    },
                    {
                        loader: 'img-loader',
                        options: {
                            enabled: !dev,
                        },
                    },
                ],
            },
        ],
    },
    plugins: [
        new ExtractTextPlugin({
            filename: dev ? '[name].css' : '[name].[contenthash:8].css',
        }),
        new CleanWebpackPlugin(['public/dist'])
    ],
    devtool: dev ? 'cheap-module-eval-source-map' : false,
};

if (!dev) {
    config.plugins.push(new UglifyJsPlugin({
        sourceMap: false,
    }));
    config.plugins.push(new ManifestPlugin());
}

module.exports = config;
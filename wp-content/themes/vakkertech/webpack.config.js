/*
    Webpack 4 Config for WordPress Theme Development

    Loaders
      Out of the box, webpack only understands JavaScript and JSON files. 
      Loaders allow webpack to process other types of files and convert them into valid modules 
      that can be consumed by your application and added to the dependency graph.
      Note that the ability to import any type of module, e.g. .css files, 
      is a feature specific to webpack and may not be supported by other bundlers or task runners. 
      We feel this extension of the language is warranted as it allows developers to build a more accurate dependency graph.
*/

const path = require('path'); // core Node.js module that gets used to manipulate file paths.
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default
const CopyPlugin = require('copy-webpack-plugin');

module.exports = {
    // entry: which module webpack should use to begin building out its internal dependency graph. 
    // webpack will figure out which other modules and libraries that entry point depends on (directly and indirectly).
    entry: {
        app: './build/js/index.js',
        admin: './build/js/admin.js'
    },
    // The output property tells webpack where to emit the bundles it creates and how to name these files
    output: {
        filename: '[name].min.js',
        path: path.resolve(__dirname, 'dist/js',)
    },
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.(scss)$/,
                use: [
                    'style-loader', //Add exports of a module as style to DOM (creates style nodes from JS strings)
                    'css-loader', //Loads CSS file with resolved imports and returns CSS code (translates CSS into CommonJS)
                    'postcss-loader', //Loads and transforms a CSS/SSS file using PostCSS
                    'sass-loader' // Loads and compiles a SASS/SCSS file (compiles Sass to CSS)
                ]
            },
            {
                test: /\.(jpe?g|png|gif)$/,
                loader: 'url-loader',
                options: {
                    // Images larger than 10 KB won’t be inlined
                    limit: 10 * 1024
                }
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: 'fonts',
                    }
                }]
            }
        ]
    },
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                test: /\.js(\?.*)?$/i,
                cache: true,
                extractComments: false,
                parallel: true, //Enable/disable multi-process parallel running.
                sourceMap: true,
               
                minify(file, sourceMap) {
                    // https://github.com/mishoo/UglifyJS2#minify-options
                    const uglifyJsOptions = {
                        warnings: false,
                        parse: {},
                        compress: {},
                        mangle: true, // Note `mangle.properties` is `false` by default.
                        output: {
                            comments: false,
                        },
                        toplevel: false,
                        nameCache: null,
                        ie8: false,
                        keep_fnames: false
                    };
          
                    if (sourceMap) {
                      uglifyJsOptions.sourceMap = {
                        content: sourceMap,
                      };
                    }
          
                    return require('terser').minify(file, uglifyJsOptions);
                },
            })
        ],
    },
    plugins: [
        // Copy the images folder and optimize all the images from "build" to "dist"
        new CopyPlugin(
            [
                {
                    from: './build/images',
                    to: '../images',
                },
                {
                    from: './build/icons',
                    to: '../icons',
                },
            ]
        ),
        // Optimizes all images
        new ImageminPlugin(
            { 
                test: /\.(jpe?g|png|gif|svg)$/i 
            }
        )
    ]
};
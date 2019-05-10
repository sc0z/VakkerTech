/*
    Webpack 4 Config for WordPress Theme Development

    $ yarn build: src -> dist folder

    Loaders
      Out of the box, webpack only understands JavaScript and JSON files. 
      Loaders allow webpack to process other types of files and convert them into valid modules 
      that can be consumed by your application and added to the dependency graph.
      Note that the ability to import any type of module, e.g. .css files, 
      is a feature specific to webpack and may not be supported by other bundlers or task runners. 
      We feel this extension of the language is warranted as it allows developers to build a more accurate dependency graph.
*/

// Node.js lib used for resolving paths
const path = require('path');

// Webpack Plugins
const CleanWebpackPlugin = require('clean-webpack-plugin');
const GoogleFontsPlugin = require('google-fonts-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = {
    context: __dirname,
    // entry: which module webpack should use to begin building out its internal dependency graph. 
    // webpack will figure out which other modules and libraries that entry point depends on (directly and indirectly).
    entry: {
        app: './src/index.js', // bundle for frontend of website
        admin: './src/admin.js' // bundle for /wp-admin only
    },
    // The output property tells webpack where to emit the bundles it creates and how to name these files
    output: {
        filename: 'js/[name].min.js',
        path: path.resolve(__dirname, 'dist'),
        publicPath: 'dist/'
    },
    mode: 'production',
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                        plugins: ['@babel/plugin-proposal-object-rest-spread']
                    }
                }
            },
            {
                test: /\.(scss)$/,
                use: [
                    // Extracts CSS from bundles' JS into minified CSS files in dist/css
                    // alt: use 'style-loader' instead to load inline-css via the bundle JS
                    MiniCssExtractPlugin.loader, 
                    //Loads CSS file with resolved imports and returns CSS code (translates CSS into CommonJS)
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: false
                        }
                    },
                    //Loads and transforms a CSS/SSS file using PostCSS
                    {
                        loader: 'postcss-loader'
                    },
                    // Loads and compiles a SASS/SCSS file (compiles Sass to CSS)
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: false
                        }
                    },
                ]
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
        // Clean out /dist folder prior to every build (best practice)
        new CleanWebpackPlugin(
            { 
                verbose: true
            }
        ),
        // Extract Minified CSS from bundle JS to a css file (instead of using style-loader to inline the css into the page head)
        new MiniCssExtractPlugin(
            {
                filename: 'css/[name].min.css',
                chunkFilename: 'css/[id].min.css',
            }
        ),
        // Webpack plugin that downloads fonts from Google Fonts and encodes them to base64.
        // Supports various font formats, currently eot, ttf, woff and woff2.
        new GoogleFontsPlugin(
            {
                // Defines which fonts and it's variants and subsets to download
                fonts: [
                    {
                        // Sets the font family
                        family: 'Roboto Condensed',
                        // Sets the variants of the font family to download, note that not all fonts have the all the possible variants
                        variants: [
                            "300",
                            "300i",
                            "400",
                            "400i",
                            "700",
                            "700i"
                        ],
                        // Sets the subsets, note that not all fonts are available in all subsets
                        subsets: [
                            'latin-ext'
                        ]
                    }
                ],
                // Specifies which formats to download
                formats: [
                    'eot',
                    'ttf',
                    'woff',
                    'woff2'
                ],
                // Whether should encode to base64
                encode: true,
                // Whether FS caching should be checked before sending requests
                cache: true
            }
        ),
        // Minify CSS extracted from bundle
        new OptimizeCSSAssetsPlugin({
            assetNameRegExp: /\.css$/g,
            cssProcessor: require('cssnano'),
            cssProcessorPluginOptions: {
                preset: [
                    'default', 
                    { 
                        discardComments: { removeAll: true }
                    }
                ],
            },
            canPrint: true
        })
    ]
};
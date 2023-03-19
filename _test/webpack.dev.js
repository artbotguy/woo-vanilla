const path = require('path');
const common = require('./webpack.common.js');
const { merge } = require('webpack-merge');

module.exports = merge(common, {
  mode: 'development',  

  module: {
    rules: [
        // {
        //     test: /\.(png|svg|jpg|jpeg|gif)$/i,
        //     type: 'asset/resource',
        // },
        {
            test: /\.js$/,
            include: path.resolve(__dirname, '@'),
            exclude: /node_modules/,
            loader: "babel-loader"
        }, 
      //   {
      //       test: /\.css$/,
      //     use: [
      //       'style-loader',
      //           'css-loader'
      //       ]
      // },
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },

        // {
        //     test: /\.scss$/,
        //     use: [
        //       'css-loader',
        //       {
        //         loader: 'sass-loader',
        //         options: {
        //           additionalData: `@import "./src/sass/variables.scss";`
        //         }
        //       }
        //     ]
        // }
    ],
  },
  devServer: {
    static: path.join(__dirname, "assets/dist"),

  },
});
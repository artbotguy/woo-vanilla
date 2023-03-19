const path = require('path');
const common = require('./webpack.common.js');
const { merge } = require('webpack-merge');

module.exports = merge(common,  {
  mode: 'production',
  module: {
    rules: [
        // {
        //     test: /\.(png|svg|jpg|jpeg|gif)$/i,
        //     type: 'asset/resource',
        // },
        {
            test: /\.js$/,
            exclude: /node_modules/,
            include: path.resolve(__dirname, 'src'),
            loader: "babel-loader"
        }, 
        {
            test: /\.css$/,
            sideEffects: true,
            use: [
                // MiniCssExtractPlugin.loader,
                'css-loader'
            ]
        },
        {
            test: /\.scss$/,
            use: [
                // MiniCssExtractPlugin.loader,
              'css-loader',
              {
                loader: 'sass-loader',
                options: {
                  additionalData: `@import "./src/sass/variables.scss";`
                }
              }
            ]
        }
    ],
},
})
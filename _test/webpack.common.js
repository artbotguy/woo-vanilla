const path = require('path');

module.exports = {
  entry: {
    index: '@/scripts/index.js',
  },

  output: {
    path: path.resolve(__dirname, 'assets/dist'),
    filename: 'index.bundle.js',
    clean: {
        keep: /images/,
    },
  },
  resolve: {
    alias: {
        '@': path.resolve(__dirname, 'assets/src/'),
    },
  },
};
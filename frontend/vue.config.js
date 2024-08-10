const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    allowedHosts: 'all',
    https: false,
    client: {
      webSocketURL: {
        hostname: 'www-my-frontend.serveo.net',
        port: 443,
        protocol: 'wss',
      },
    }
  },
})

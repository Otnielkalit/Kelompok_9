const wdioConf = require('./wdio.conf.js').config;

wdioConf.capabilities = [{
    maxInstances: 1,
    browserName: '',
    acceptInsecureCerts: true
}];

wdioConf.services = [];

exports.config = wdioConf;

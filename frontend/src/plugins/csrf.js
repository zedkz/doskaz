const crypto = require('crypto');

export default function ({app, req}) {
    app.$cookies.set('XSRF-TOKEN', crypto.randomBytes(16).toString('hex'), {
        path: '/'
    });
}

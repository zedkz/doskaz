import toPairs from 'lodash/toPairs'

export default function (target, options) {
    const features = toPairs(options).map(option => option.join('=')).join(',');

    return new Promise((resolve, reject) => {
        try {
            const w = window.open(target, 'auth', features);
            w.onbeforeunload = function () {
                resolve();
            }
        } catch (e) {
            reject(e)
        }
    });
}
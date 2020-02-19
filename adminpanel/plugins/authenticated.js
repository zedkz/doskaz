export default async function ({store, redirect, app, $axios}) {
    try {
        await store.dispatch('authentication/loadUser');
    } catch (e) {
    }

    $axios.onError(function (error) {
        if (error.response.status === 401) {
            app.$cookies.set('redirect', app.context.route.fullPath, {
                maxAge: 60 * 5
            });
            return redirect({name: 'index-login'})
        }
    });
}

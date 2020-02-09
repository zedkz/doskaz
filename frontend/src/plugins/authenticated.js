export default async function ({store, redirect, app, $axios}) {
    try {
        await store.dispatch('authentication/loadUser');
    } catch (e) {
    }

    $axios.onError(function (error) {
        if (error.response.status === 401) {
            return redirect({name: 'index-login', query: {next: app.context.route.fullPath}})
        }
    });
}

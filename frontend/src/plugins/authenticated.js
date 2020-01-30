export default async function ({store, redirect, app, error: err, $axios}) {
    $axios.onError(function (error) {
        if (error.response.status === 401 && store.state.authentication.user) {
            return redirect({name: 'index-login', query: {next: app.context.route.fullPath}})
        }
    });

    try {
        await store.dispatch('authentication/loadUser')
    } catch (e) {
    }
}
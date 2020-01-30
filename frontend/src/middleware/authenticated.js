export default function ({ store, app, redirect }) {
    if (!store.state.authentication.user) {
        return redirect({name: 'index-login', query: {next: app.context.route.fullPath}})
    }
}
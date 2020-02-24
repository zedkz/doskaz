export default function ({store, app, redirect, error}) {
    if (!store.state.authentication.user) {
        app.$cookies.set('redirect', app.context.route.fullPath, {
            maxAge: 60 * 5
        });
        return redirect('/login')
    }
    if (!store.state.authentication.user.roles.includes('ROLE_ADMIN')) {
        return error({statusCode: 403, message: 'Access Denied'})
    }
}

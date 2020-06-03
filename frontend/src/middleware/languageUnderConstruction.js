export default function ({app, redirect, route}) {
    if (route.fullPath !== '/kz/underConstruction' && route.fullPath.startsWith('/kz')) {
        return redirect(app.localePath('/underConstruction', 'kz'))
    }
}
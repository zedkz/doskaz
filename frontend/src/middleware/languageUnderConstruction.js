export default function ({app, redirect, route}) {
    if (route.name.endsWith('kz') && route.fullPath !== '/kz/underConstruction') {
        return redirect(app.localePath('/underConstruction', 'kz'))
    }
}
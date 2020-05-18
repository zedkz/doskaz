<template>
    <div>
        <normal-object-view :object="object" v-if="!viModeEnabled"/>
        <vi-object-view :object="object" v-if="viModeEnabled"/>
    </div>
</template>

<script>
    import NormalObjectView from "~/components/objects/NormalObjectView";
    import {get} from 'vuex-pathify'
    import ViObjectView from "~/components/objects/ViObjectView";

    export default {
        name: "ObjectView",
        components: {ViObjectView, NormalObjectView},
        props: [
            'object'
        ],
        computed: {
            viModeEnabled: get('visualImpairedModeSettings/enabled')
        }
    }
</script>

<style scoped>

</style>
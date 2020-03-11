<template>
    <div>
        <popup-dialog
                v-if="!showPostRejectMessage"
                :object-name="objectName"
                @closed="close"
                @rejected="reject"
                @confirmed="confirm"
        />

        <post-rejection-dialog
                v-else
                @closed="close"
                @want-to-help="$router.push({name: 'objects-id-review', params: {id: $route.params.id}})"
        />
    </div>
</template>

<script>
    import PopupDialog from "../../../components/objects/verification/PopupDialog";
    import PostRejectionDialog from "../../../components/objects/verification/PostRejectionDialog";

    export default {
        components: {PostRejectionDialog, PopupDialog},
        middleware: ['authenticated'],
        props: [
            'objectName'
        ],
        data() {
            return {
                showPostRejectMessage: false
            }
        },
        methods: {
            close() {
                this.$router.push({name: 'objects-id', params: {id: this.$route.params.id}})
            },
            async confirm() {
                await this.$axios.post(`/api/objects/${this.$route.params.id}/verification/confirm`)
                this.$emit('verified')
                return this.$router.push({name: 'objects-id', params: {id: this.$route.params.id}})
            },
            async reject() {
                await this.$axios.post(`/api/objects/${this.$route.params.id}/verification/reject`);
                this.$emit('verified')
                this.showPostRejectMessage = true;
            }
        }
    }
</script>

<style scoped>

</style>
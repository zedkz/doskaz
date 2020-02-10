<template>
    <div>
        <div class="photo-input__wrapper">
            <div class="photo-input required" v-for="(slot, index) in slots" :key="index">
                <loading :active="slot.isLoading" :is-full-page="false" :style="{'z-index': 10}"/>
                <input type="file" accept="image/*" @change="onFileSelected($event, slot)"/>
                <span :style="{'background-image': `url(${slot.preview})`, 'background-size': 'cover'}"></span>
            </div>
        </div>
        <button type="button" class="add-link" @click.prevent="addSlot">Добавить еще фото</button>
    </div>
</template>

<script>
    import queue from 'async/queue';
    import Loading from "vue-loading-overlay";
    import "vue-loading-overlay/dist/vue-loading.css";

    export default {
        name: "PhotoUploader",
        components: {
            Loading
        },
        model: {
            prop: 'files',
            event: 'change'
        },
        props: [
            'files'
        ],
        data() {
            return {
                isLoading: false,
                slots: []
            }
        },
        mounted() {
            for (let i = 1; i < 6; i++) {
                this.addSlot()
            }
        },
        created() {
            this.queue = queue((task, cb) => this.$axios.post("/api/storage/upload", task.file)
                .then(({data: {path}}) => cb(null, path))
                .catch(cb), 2);
            this.queue.drain(() => this.$nextTick(() => this.$emit('is-uploading', false)))
        },
        destroyed() {
            this.queue.kill()
        },
        methods: {
            addSlot() {
                this.slots.push({
                    preview: null,
                    file: null,
                    uploadedFile: null,
                    isLoading: false
                })
            },
            onFileSelected(e, slot) {
                const [file] = e.target.files;
                const reader = new FileReader();

                reader.onload = e => {
                    slot.preview = e.target.result;
                };
                reader.readAsDataURL(file);
                slot.file = file;
                slot.isLoading = true;
                this.$emit('is-uploading', true);
                this.queue.push(slot, (e, res) => {
                    slot.isLoading = false;
                    slot.file = null;
                    slot.uploadedFile = res;
                });
            }
        },
        computed: {
            uploaded() {
                return this.slots.filter(slot => slot.uploadedFile)
                    .map(slot => slot.uploadedFile)
            }
        },
        watch: {
            uploaded(v) {
                this.$emit('change', v)
            }
        }
    }
</script>

<style>

</style>
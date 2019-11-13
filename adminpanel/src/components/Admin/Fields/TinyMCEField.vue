<template>
    <field :label="label" :property="property">
        <editor v-model="value" :init="tinymceConfig"
                plugins="link image imagetools table"
                toolbar="blocks image blockquote link table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | forecolor backcolor"/>

    </field>
</template>

<script>
    import Field from "@/components/Admin/Fields/Field";
    import Editor from '@tinymce/tinymce-vue';
    import api from '@/api'

    export default {
        name: "TinyMCEField",
        components: {Field, Editor},
        props: [
            'label',
            'property'
        ],
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            },
            value: {
                get() {
                    return this.$store.getters[`${this.resourceName}/edit/getItemProperty`](this.property);
                },
                set(val) {
                    this.$store.commit(`${this.resourceName}/edit/changeField`, {field: this.property, value: val});
                }
            },
            tinymceConfig() {
                return {
                    language: 'ru',
                    plugins: '',
                    toolbar: '',
                    height: 500,
                    language_url: '/tinymce/langs/ru.js',
                    images_upload_handler: function (blobInfo, success, failure) {
                        api.post('storage/upload', blobInfo.blob())
                            .then(({data: {path}}) => success(path))
                            .catch(e => failure(e));
                    }

                }
            },
        }
    }
</script>

<style scoped>

</style>
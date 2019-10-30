<template>
    <div class="container-fluid">
        <slot name="header"/>

        <div class="row" slot="content">
            <div class="col-md-12">
                <b-card>
                    <slot name="content"/>
                </b-card>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AdminPage"
    }
</script>

<style scoped>

</style>
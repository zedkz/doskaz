<template>
    <BlogInside :post="post" :similarPosts="similar"/>
</template>
<script>
    import BlogInside from "@/components/blog/BlogInside";

    export default {
        components: {BlogInside},
        layout: 'blog',
        async asyncData({$axios, params, query, error}) {
            try {
                const {data: {post, similar}} = await $axios.get(`/api/blogPosts/bySlug/${params.slug}`);
                return {post, similar}
            } catch (e) {
                if (e.response.status) {
                    return error({statusCode: e.response.status})
                }
                return error({statusCode: 500})
            }
        }
    }
</script>
<template>
    <div class="rounded border dark:border-gray-600 p-3">
        <div class="flex items-center mb-4">
            <router-link class="mr-3"
                :to="`/@${post.user.username}`">
                <img class="w-10 h-10 rounded-full" :src="post.user.gravatar" :alt="`Avatar of ${post.user.name}`">
            </router-link>
            <div class="text-sm">
                <router-link class="text-gray-900 dark:text-gray-100 leading-none"
                    :to="`/@${post.user.username}`">
                    {{ post.user.name }}
                </router-link>
                <router-link class="block text-gray-600 dark:text-gray-400"
                    :to="`/posts/${post.id}`">
                    {{ postDate }}
                </router-link>
            </div>
        </div>
        <div class="mb-2" v-text="post.content"></div>
    </div>
</template>

<script>
export default {
    props: {
        post: Object,
    },
    computed: {
        postDate() {
            const date = new Date(this.$props.post.created_at);
            return date.toLocaleString();
        },
    },
};
</script>

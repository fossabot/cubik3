<template>
    <div class="rounded border p-3">
        <div class="flex items-center mb-4">
            <router-link class="mr-3"
                :to="`/@${post.user.username}`">
                <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" :alt="`Avatar of ${post.user.name}`">
            </router-link>
            <div class="text-sm">
                <router-link class="text-gray-900 leading-none"
                    :to="`/@${post.user.username}`">
                    {{ post.user.name }}
                </router-link>
                <router-link class="block text-gray-600"
                    :to="`/posts/${post.id}`">
                    {{ postDate }}
                </router-link>
            </div>
        </div>
        <div v-text="post.content"></div>
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

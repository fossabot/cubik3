<template>
    <div class="container py-4 lg:py-6">
        <h1 class="text-3xl" v-if="user">
            {{ user.name }}
        </h1>
        <div v-if="loading">
            <post-card-placeholder class="my-4 lg:my-5 opacity-100" />
            <post-card-placeholder class="my-4 lg:my-5 opacity-75" />
            <post-card-placeholder class="my-4 lg:my-5 opacity-50" />
        </div>
        <div v-else>
            <post-card class="my-4 lg:my-5"
                v-for="post in posts"
                :key="post.id"
                :post="post" />
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        loading: true,
        user: null,
        posts: [],
        page: 0,
        lastPage: 0,
    }),
    methods: {
        async fetchUser() {
            this.user = null;
            const username = this.$route.params.user;
            // TODO: handle errors loading user
            const response = await axios.get(`/api/users/@${username}`);
            this.user = response.data;
            // TODO: handle errors loading posts
            const postResponse = await axios.get(`/api/users/@${username}/posts`);
            const { data } = postResponse;
            this.posts = data.data;
            this.page = data.page;
            this.lastPage = data.lastPage;
            this.loading = false;
        },
        async fetchPosts() {
            // TODO: fetch more posts when scrolling
        },
    },
    watch: {
        '$route': 'fetchUser',
    },
    created() {
        this.fetchUser();
    },
}
</script>

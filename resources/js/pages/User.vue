<template>
    <div class="container py-4 lg:py-6">
        <h1 class="text-3xl">User</h1>
        <div v-if="loading">
            Loading&hellip;
        </div>
        <div v-else>
            <p class="text-lg">ID: {{ user.id }}</p>
            <p class="text-lg">User: {{ user.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        loading: true,
        user: null,
    }),
    methods: {
        async fetchUser() {
            this.user = null;
            const username = this.$route.params.user;
            // TODO: handle errors loading user
            const response = await axios.get(`/api/user/${username}`);
            this.user = response.data;
            this.loading = false;
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

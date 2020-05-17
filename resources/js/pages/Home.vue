<template>
    <div class="container py-4 lg:py-6">
        <h1 class="text-3xl">Home</h1>
        <p class="text-lg">Hello, {{ user.name }}!</p>
    </div>
</template>

<script>
export default {
    computed: {
        user() {
            return this.$store.state.user;
        },
    },
    mounted() {
        //
    },
};
</script>

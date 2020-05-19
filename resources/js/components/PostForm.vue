<template>
    <form method="POST" ref="form" @submit.prevent="submit">
        <div class="mb-3">
            <textarea class="appearance-none block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 dark:placeholder-gray-400"
                aria-label="Write a post"
                name="content"
                id="content"
                rows="2"
                required
                ref="content"
                v-model="content"
                placeholder="What's up?"
                @keyup.ctrl.enter="submit"
                @keyup.meta.enter="submit"
            ></textarea>
        </div>
        <button type="submit" class="group py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
            Post
        </button>
    </form>
</template>

<script>
export default {
    data: () => ({
        content: '',
    }),
    methods: {
        submit() {
            axios.post('/api/posts', {
                content: this.content,
            }).then(response => {
                // TODO: reload posts if on a relevant page
                this.$refs.form.reset();
                this.$emit('newPost', response.data);
            }).catch(error => {
                console.error(error);
            });
        },
    },
};
</script>

<template>
    <div class="fixed top-0 inset-x-0 px-4 py-4 sm:inset-0 sm:flex sm:items-center sm:justify-center" v-show="showRoot" @keyup.esc="overlayClick">
        <transition
            enter-active-class="ease-out duration-300"
            enter-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="ease-in duration-200"
            leave-class="opacity-100"
            leave-to-class="opacity-0">
            <div class="fixed inset-0 transition-opacity"
                v-show="show"
                @click="overlayClick">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
        </transition>

        <transition
            enter-active-class="ease-out duration-300"
            enter-class="opacity-0 -translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to-class="opacity-100 translate-y-0 sm:scale-100"
            leave-active-class="ease-in duration-200"
            leave-class="opacity-100 translate-y-0 sm:scale-100"
            leave-to-class="opacity-0 -translate-y-4 sm:translate-y-0 sm:scale-95">
            <form class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline"
                v-show="show"
                ref="form"
                @submit.prevent="submit">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-start">
                        <img class="w-10 h-10 rounded-full mr-3" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" :alt="`Avatar of ${user.name}`">
                        <textarea class="appearance-none block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
                            aria-label="Write a post"
                            name="content"
                            id="content"
                            rows="2"
                            required
                            ref="content"
                            v-model="content"
                            placeholder="What's up?"
                        ></textarea>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 flex flex-row-reverse sm:px-6 sm:pb-4">
                    <span class="flex w-auto rounded-md shadow-sm ml-3">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Post
                        </button>
                    </span>
                    <span class="flex w-auto rounded-md shadow-sm">
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" @click="close">
                            Cancel
                        </button>
                    </span>
                </div>
            </form>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        show: Boolean,
        dismissable: Boolean,
    },
    data: () => ({
        showRoot: false,
        hideRootTimeout: null,
        content: '',
    }),
    computed: {
        user() {
            return this.$store.state.user;
        },
    },
    watch: {
        show(show) {
            if (this.hideRootTimeout) {
                window.clearTimeout(this.hideRootTimeout);
            }
            if (show) {
                this.showRoot = true;
                this.$nextTick(() => {
                    this.$refs.content.focus();
                })
            } else {
                this.hideRootTimeout = window.setTimeout(() => {
                    this.showRoot = false;
                }, 300);
            }
        },
    },
    methods: {
        close() {
            this.$emit('update:show', false);
        },
        overlayClick() {
            if (this.$props.dismissable) {
                this.close();
            }
        },
        submit() {
            axios.post('/api/posts', {
                content: this.content,
            }).then(response => {
                // TODO: reload posts if on a relevant page
                this.$refs.form.reset();
                this.close();
            }).catch(error => {
                console.error(error);
            });
        },
    },
};
</script>

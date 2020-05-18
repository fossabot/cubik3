<template>
    <div class="container py-4 lg:py-6">
        <div class="max-w-md w-full mx-auto">
            <div>
                <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                    Create Account
                </h2>
                <p class="mt-2 text-center text-sm leading-5 text-gray-600">
                    Or
                    <router-link to="/login" class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        sign in
                    </router-link>
                </p>
            </div>
            <form class="mt-8" method="POST" @submit.prevent="logIn">
                <input type="hidden" name="remember" value="true">
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Display Name
                    </label>
                    <input class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
                        id="name"
                        name="name"
                        type="text"
                        required
                        placeholder="Display Name"
                        autocomplete="name"
                        ref="name"
                        v-model="name">
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Username
                    </label>
                    <input class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
                        id="email"
                        name="email"
                        type="text"
                        required
                        placeholder="Username"
                        autocomplete="username"
                        v-model="username">
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email address
                    </label>
                    <input class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
                        id="email"
                        name="email"
                        type="email"
                        required
                        placeholder="Email address"
                        autocomplete="email"
                        v-model="email">
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
                        id="password"
                        name="password"
                        type="password"
                        required
                        placeholder="Password"
                        autocomplete="new-password"
                        v-model="password">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        Confirm password
                    </label>
                    <input class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        placeholder="Confirm password"
                        autocomplete="new-password"
                        v-model="passwordConfirmation">
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <button type="submit" class="group py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        name: '',
        username: '',
        email: '',
        password: '',
        passwordConfirmation: '',
    }),
    methods: {
        logIn() {
            axios.post('/api/register', {
                name: this.name,
                username: this.username,
                email: this.email,
                password: this.password,
                password_confirmation: this.passwordConfirmation,
            }).then(async response => {
                const user = response.data;
                this.$store.commit('setUser', user);
                let to = '/home';
                this.$router.push(to);
            }).catch(error => {
                // TODO: show error detail in form
                console.error(error);
            });
        },
    },
    mounted() {
        this.$refs.name.focus();
        axios.get('/sanctum/csrf-cookie');
    },
}
</script>

<script setup>
import { onMounted, reactive } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
const user = usePage().props.auth.user;
const state = reactive({
 user: {}
});
function fetchUser() {
 return axios.get('api/user')
 .then(response => state.user = response.data);
}
onMounted(fetchUser);
</script>
<template>
    <Head title="Demo" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Demo</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">My protected content</div>
                    <div class="p-6 text-gray-900">
                        <div>Id: {{ state.user.id }}</div>
                        <div>Name: {{ state.user.name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
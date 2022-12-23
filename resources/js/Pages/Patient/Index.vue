<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';

const props = defineProps({
    patients: Array,
})
</script>

<template>
    <Head title="Patients" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline" >Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>
                <Link :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" >Register</Link >
            </template>
        </div>


        <div class="bg-white mt-6 overflow-hidden px-6 py-4 shadow-md sm:max-w-xl sm:rounded-lg w-full">
            <div>
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Blood Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="patient in patients">
                        <td>{{ patient.name }}</td>
                        <td>{{ patient.age }}</td>
                        <td>{{ patient.blood_type }}</td>
                        <td>
                            <Link :href="route('patient.show', patient.id)" class="text-sm text-gray-700 dark:text-gray-500 underline">Edit</Link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

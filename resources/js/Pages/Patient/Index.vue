<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    patients: Array,
})
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Patients"/>

        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="bg-white mt-6 overflow-hidden px-6 py-4 shadow-md sm:max-w-2xl sm:rounded-lg w-full">
                <div>
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Blood Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="patient in patients">
                            <td class="pr-4 pl-4">
                                <Link :href="route('patient.show', patient.id)" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ patient.name }}</Link>
                            </td>
                            <td class="pr-4 pl-4">{{ patient.age }}</td>
                            <td class="pr-4 pl-4">{{ patient.blood_type }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

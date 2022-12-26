<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import {ref} from "vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const nameInput = ref(null);
const ageInput = ref(null);
const bloodTypeInput = ref(null);

const props = defineProps({
    patient: Object,
});

const form = useForm({
    name: props.patient.name,
    age: props.patient.age,
    blood_type: props.patient.blood_type,
});

const savePatient = () => {
    form.put(route('patient.update', {patient: props.patient.id ?? null}), {
        preserveScroll: true,
        // onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.name) {
                form.reset('name');
                nameInput.value.focus();
            }
            if (form.errors.age) {
                form.reset('age');
                ageInput.value.focus();
            }
            if (form.errors.blood_type) {
                form.reset('blood_type');
                bloodTypeInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="'Edit ' + props.patient.name"/>
        <div class="flex justify-center mt-2">
            <Link :href="route('patient.index')" class="text-sm text-gray-700 dark:text-gray-500 underline">Back to list</Link>
        </div>
        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="bg-white mt-6 overflow-hidden px-6 py-4 shadow-md sm:max-w-2xl sm:rounded-lg w-full">
                <form @submit.prevent="savePatient" class=" space-y-6 w-md">
                    <div>
                        <InputLabel for="name" value="Name"/>
                        <TextInput id="name" type="text" ref="nameInput" class="mt-1 block w-full" v-model="form.name" required/>
                        <InputError class="mt-2" :message="form.errors.name"/>

                        <InputLabel class="mt-4" for="age" value="Age"/>
                        <TextInput id="age" type="text" ref="ageInput" class="mt-1 block w-full" v-model="form.age" required/>
                        <InputError class="mt-2" :message="form.errors.age"/>


                        <InputLabel class="mt-4" for="blood_type" value="Blood type"/>
                        <TextInput id="blood_type" type="text" ref="bloodTypeInput" class="mt-1 block w-full" v-model="form.blood_type" required/>
                        <InputError class="mt-2" :message="form.errors.blood_type"/>
                    </div>

                    <div>
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>


            <div v-if="!!props.patient?.id" class="bg-white mt-6 overflow-hidden ml-4 px-6 py-4 shadow-md sm:max-w-2xl sm:rounded-lg w-full">
                <Link :href="route('practice.create', props.patient.id)" class="text-sm text-gray-700 dark:text-gray-500 underline">Add new practice</Link>
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="practice in props.patient.practices">
                        <td class="pr-4 pl-4">{{ practice.id }}</td>
                        <td class="pr-4 pl-4">
                            {{ practice.name }}

                        </td>
                        <td class="pr-4 pl-4">{{ practice.duration }}</td>
                        <td class="pr-4 pl-4">{{ practice.date }}</td>
                        <td class="pr-4 pl-4">
                            <Link :href="route('practice.show', {patient: patient.id, practice: practice.id})" class="text-sm text-gray-700 dark:text-gray-500 underline">edit</Link>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>

</style>

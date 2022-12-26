<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";

const nameInput = ref(null);
const durationInput= ref(null);
const dateInput = ref(null);

const props = defineProps({
    practice: Object,
    patient: Object,
});

const form = useForm({
    name: props.practice.name,
    duration: props.practice.duration,
    date: props.practice.date,
});


const savePractice = () => {
    form.put(route('practice.update', {patient: props.patient.id, practice: props.practice.id}), {
        preserveScroll: true,
        onError: () => {
            if (form.errors.name) {
                form.reset('name');
                nameInput.value.focus();
            }
            if (form.errors.duration) {
                form.reset('duration');
                durationInput.value.focus();
            }
            if (form.errors.date) {
                form.reset('date');
                dateInput.value.focus();
            }
        },
    });
};

</script>


<template>
    <AuthenticatedLayout>
        <Head :title="'Edit ' + props.practice.name"/>
        <div class="flex justify-center mt-2">
            <Link :href="route('patient.show', props.patient.id)" class="text-sm text-gray-700 dark:text-gray-500 underline">Back to {{ props.patient.name }} profile</Link>
        </div>
        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="bg-white mt-6 overflow-hidden px-6 py-4 shadow-md sm:max-w-2xl sm:rounded-lg w-full">
                <form @submit.prevent="savePractice" class=" space-y-6 w-md">
                    <div>
                        <InputLabel for="name" value="Name"/>
                        <TextInput id="name" type="text" ref="nameInput" class="mt-1 block w-full" v-model="form.name" required/>
                        <InputError class="mt-2" :message="form.errors.name"/>

                        <InputLabel class="mt-4" for="age" value="Duration (in hours)"/>
                        <TextInput id="age" type="text" ref="durationInput" class="mt-1 block w-full" v-model="form.duration" required/>
                        <InputError class="mt-2" :message="form.errors.duration"/>


                        <InputLabel class="mt-4" for="blood_type" value="Date of realization"/>
                        <TextInput id="blood_type" type="datetime-local" ref="dateInput" step="1" class="mt-1 block w-full" v-model="form.date" required/>
                        <InputError class="mt-2" :message="form.errors.date"/>
                    </div>

                    <div>
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

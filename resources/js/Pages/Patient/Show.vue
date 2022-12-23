<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
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
    form.put(route('patient.update', props.patient.id), {
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

        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="bg-white mt-6 overflow-hidden px-6 py-4 shadow-md sm:max-w-2xl sm:rounded-lg w-full">
                <form @submit.prevent="savePatient" class=" space-y-6 w-md">
                    <div>
                        <InputLabel for="name" value="Name"/>
                        <TextInput id="name" type="text" ref="nameInput" class="mt-1 block w-full" v-model="form.name" required/>
                        <InputError class="mt-2" :message="form.errors.name"/>

                        <InputLabel for="age" value="Age"/>
                        <TextInput id="age" type="text" ref="ageInput" class="mt-1 block w-full" v-model="form.age" required/>
                        <InputError class="mt-2" :message="form.errors.age"/>


                        <InputLabel for="blood_type" value="Blood type"/>
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


            <div class="bg-white mt-6 overflow-hidden ml-4 px-6 py-4 shadow-md sm:max-w-2xl sm:rounded-lg w-full">
                Practices TODO

            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>

</style>

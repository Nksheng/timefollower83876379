<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AppLayout.vue';
import Mood from '@/Components/Mood.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import FeelingButton from '@/Components/FeelingButton.vue'
import { useForm, Head } from '@inertiajs/vue3';
import feelingListJson from '@/EmotionWheel-min.json';

const feelingList = feelingListJson.list[0].emotion;
// const feelingColors = feelingListJson.colors[0];

const firstLayerClass = "bg-neutral-900 text-neutral-50 hover:bg-neutral-900 dark:bg-white dark:text-gray-700 dark:hover:bg-white"

defineProps(['moods']);

const confirmingFeeling = ref(false);

const form = useForm({
    datetime: '',
    moodtitle: '',
    message: '',
});

const confirmFeeling = () => {
    confirmingFeeling.value = true;
};

const closeModal = () => {
    confirmingFeeling.value = false;
};

const setFeeling = (mood) => {
    form.moodtitle = mood;
    closeModal();
};
</script>
 
<template>
    <Head title="Moods" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('moods.store'), { onSuccess: () => form.reset() })">
                <input 
                    type="datetime-local" 
                    v-model="form.datetime"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                />
                <InputError :message="form.errors.datetime" class="mt-2" />
                <input 
                    type="text"
                    v-model="form.moodtitle"
                    placeholder="What do you feel now?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-4"
                />
                <InputError :message="form.errors.moodtitle" class="mt-2" />
                <SecondaryButton @click="confirmFeeling" class="mt-2">Select Feeling</SecondaryButton>
                <DialogModal :show="confirmingFeeling" @close="closeModal">
                    <template #title>
                        Select Feeling
                    </template>

                    <template #content>
                        <FeelingButton
                            :feelingList=feelingList
                            :feelingButtonClass=firstLayerClass
                            :setFeeling=setFeeling
                        />

                        <!-- <FeelingButton
                            :feelingList=feelingList
                            :feelingColors=feelingColors
                            :setFeeling=setFeeling
                        /> -->
                    </template>

                    <template #footer>
                        <SecondaryButton @click="closeModal">
                            Cancel
                        </SecondaryButton>
                    </template>
                </DialogModal>
                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-4"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Add</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Mood
                    v-for="mood in moods"
                    :key="mood.id"
                    :mood="mood"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import Welcome from '@/Components/Welcome.vue';
// import Mood from '@/Components/Mood.vue';

// const props = defineProps(['moods']);

// console.log(props.moods);
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template> -->

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div> -->

        <!-- <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <Mood
                v-for="mood in moods"
                :key="mood.id"
                :mood="mood"
            />
        </div> -->
    </AppLayout>
</template>

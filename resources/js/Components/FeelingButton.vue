<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import FeelingButton from '@/Components/FeelingButton.vue'

const props = defineProps({
  feelingList: {
    type: Array,
  },
  setFeeling: {
    type: Function,
  },
  feelingButtonClass: {
    type: String,
  },
  // feelingColors: {
  //   type: Object,
  // },
});

// console.log(props.feelingColors);
</script>

<template>
  <div>
    <div
        v-for="(emotion, index) in props.feelingList"
        :key="index"
    >
      <SecondaryButton
          @click="props.setFeeling($event.target.textContent)"
          class="mt-2 w-full"
          :class=props.feelingButtonClass
      >{{ emotion.en }} {{ emotion.zh }}</SecondaryButton>

      <!-- <SecondaryButton
          @click="props.setFeeling($event.target.textContent)"
          class="mt-2 w-full"
          :class=props.feelingColors.colorEmotionJoy
      >{{ emotion.en }} {{ emotion.zh }}</SecondaryButton> -->

      <FeelingButton
          v-if="emotion.emotion"
          :feelingList=emotion.emotion
          :setFeeling=props.setFeeling
          class="ml-5"
      />

      <!-- <FeelingButton
          v-if="emotion.emotion"
          :feelingList=emotion.emotion
          :setFeeling=props.setFeeling
          :feelingColors=props.feelingColors
          class="ml-5"
      /> -->
    </div>
  </div>
</template>
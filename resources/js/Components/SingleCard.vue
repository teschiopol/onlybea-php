<script setup lang="ts">
import { ref } from 'vue';

  const props = defineProps({
    title: String,
    counter: Number,
    icon: String,
    iconColor: String
  })

  const blue = ref(false);
  const red = ref(false);
  const orange = ref(false);
  const purple = ref(false);

  if (props.iconColor === 'blue') {
    blue.value = true;
  }
  if (props.iconColor === 'orange') {
    orange.value = true;
  }
  if (props.iconColor === 'purple') {
    purple.value = true;
  }
  if (props.iconColor === 'red') {
    red.value = true;
  }
</script>

<template>
  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
      <div class="flex justify-between mb-3">
        <div>
          <span class="block font-semibold mb-3">{{title}}</span>
          <div class="text-gray-900 dark:text-gray-100 font-medium text-xl">{{counter}}</div>
        </div>
        <div class="flex items-center justify-center rounded-md" :class="{ 'bg-blue-100': blue, 'bg-purple-100': purple, 'bg-orange-100': orange, 'bg-red-100': red }" style="width:2.5rem;height:2.5rem">
          <font-awesome-icon v-if="blue" icon="fa-solid fa-folder-open" class="text-xl text-blue-500" />
          <font-awesome-icon v-if="purple" icon="fa-solid fa-jet-fighter" class="text-xl text-purple-500" />
          <font-awesome-icon v-if="orange" icon="fa-solid fa-clipboard-question" class="text-xl text-orange-500" />
          <font-awesome-icon v-if="red" icon="fa-solid fa-x" class="text-xl text-red-500" />
        </div>
      </div>
    </div>
  </div>
</template>

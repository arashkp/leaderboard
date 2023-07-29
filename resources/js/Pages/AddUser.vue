<template>
  <div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gray-800 bg-opacity-90 absolute inset-0" @click="closeModalOutside"></div>
    <div class="bg-gray-900 rounded-lg p-6 max-w-sm w-full relative z-10">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Add User</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">Name:</label>
            <input v-model="user.name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
          </div>
          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="age">Age:</label>
            <input v-model="user.age" type="number" id="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
          </div>
          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="address">Address:</label>
            <textarea v-model="user.address" type="textarea" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
          </div>
          <div v-if="error" class="text-red-500 mt-2 mb-2">
            {{ error }}
          </div>
          <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add User</button>
            <button @click="closeModal" class="bg-red-500 text-white px-4 py-2 rounded-lg ml-4">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  
  export default {
  props: {
    error: {
      type: String,
      default: null,
    },
  },
  emits: ['add-user', 'close-modal'],

  setup(_, { emit }) {
    const user = ref({
      name: '',
      age: '',
      point: 0,
      address: '',
    });

  const submitForm = () => {
    emit('add-user', user.value);
  };

  const closeModal = () => {
    emit('close-modal');
  };

  const closeModalOutside = (event) => {
    // Check if the click is on the overlay element (the gray background)
    if (event.target === event.currentTarget) {
      closeModal();
    }
  };

  return {
    user,
    submitForm,
    closeModal,
    closeModalOutside,
  };
},
};
  </script>
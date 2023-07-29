<template>
    <div class="fixed inset-0 flex items-center justify-center z-50" @click="closeModalOutside">
      <div class="bg-gray-800 bg-opacity-90 absolute inset-0"></div>
      <div class="bg-gray-900 rounded-lg p-6 max-w-sm w-full relative z-10">
        <h2 class="text-white text-xl font-bold mb-4">User Details</h2>
        <hr class="mb-4" />
        <div class="text-white">
          <p class="mb-2"><strong>Name:</strong> {{ user.name }}</p>
          <p class="mb-2"><strong>Age:</strong> {{ user.age }}</p>
          <p class="mb-2"><strong>Points:</strong> {{ user.points }}</p>
          <p class="mb-2"><strong>Address:</strong> {{ user.address }}</p>
        </div>
        <div class="flex justify-end mt-4">
          <button @click="closeModal" class="text-gray-300 hover:text-white">Close</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      user: {
        type: Object,
        required: true,
      },
    },
    methods: {
      closeModal() {
        this.$emit('close-modal');
      },
      closeModalOutside(event) {
        if (event.target === event.currentTarget.firstElementChild) {
        this.closeModal();
      }
    },
    },
  };
  </script>
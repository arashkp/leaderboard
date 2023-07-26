<template>
  <div class="dark p-6">
    <div class="grid grid-cols-6 gap-4 mb-4">
    <div class="col-span-5"><h2 class="text-5xl dark:text-white font-bold">Leaderboard</h2></div>
    <div><button @click="addUser" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded float-right">+ Add User</button></div>
  </div>
    <table class="w-full dark:bg-gray-800">
      <thead>
        <tr>
          <th class="dark:text-white">Action</th>
          <th class="dark:text-white p-5">Name</th>
          <th class="dark:text-white">Points</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr v-for="(user, index) in sortedUsers" :key="index" :class="index % 2 === 0 ? 'bg-gray-100 dark:bg-gray-700' : ''">
          <td>
            <button @click="deleteUser(index)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">X</button>
          </td>
          <td class="dark:text-white p-5">{{ user.name }}</td>
          <td class="dark:text-white">
            <button @click="incrementPoints(index)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">+</button>
            <span class="ml-3 mr-3">{{ user.points }}</span>
            <button @click="decrementPoints(index)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">-</button>
          </td>
        </tr>
      </tbody>
    </table>
    
  </div>
</template>


<script>
import { router } from '@inertiajs/vue3'

export default {
  props: {
    users: {
      type: Object,
      required: true,
    },
  },
  computed: {
    sortedUsers() {
      return this.sortUsersByPoints();
    },
  },
  methods: {
    sortUsersByPoints() {
      const usersArray = Object.values(this.users);
      return usersArray.sort((a, b) => b.points - a.points);
    },
    async incrementPoints(index) {
      const user = this.sortedUsers[index];
      user.points++;
      router.post('/update', {
        userId: user.id,
        points: user.points,
      });
    },
    async decrementPoints(index) {
      const user = this.sortedUsers[index];
      user.points--;
      router.post('/update', {
        userId: user.id,
        points: user.points,
      });
    },
    deleteUser(index) {
      const user = this.sortedUsers[index];
      this.$delete(this.users, user.id);
    },
    addUser() {
      const newUser = {
        name: 'New User',
        age: 0,
        points: 0,
        address: 'New Address',
      };
      // Generate a unique ID for the new user (you can use a UUID library here)
      const newUserId = Math.random().toString(36).substr(2, 9);
      this.$set(this.users, newUserId, newUser);
    },
  },
};
</script>
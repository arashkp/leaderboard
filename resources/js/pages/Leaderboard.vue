<template>
  <div class="dark p-6">
    <div class="grid grid-cols-6 gap-4 mb-4">
    <div class="col-span-5"><h2 class="text-5xl dark:text-white font-bold">Leaderboard</h2></div>
    <div><button @click="showAddUserModal = true" class="bg-green-600 hover:bg-green-400 text-white font-bold py-2 px-4 rounded float-right">+ Add User</button></div>
    <AddUser v-if="showAddUserModal" @add-user="handleAddUser" @close-modal="closeAddUserModal"
    :error="error" />
    <div class="col-span-3"><input type="text" v-model="searchTerm" @input="filterByName" placeholder="Search by Name" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white">
    </div>
  </div>
    <table class="w-full dark:bg-gray-800">
      <thead>
        <tr>
          <th class="dark:text-white w-20 p-4">#</th>
          <th @click="sortByName" class="cursor-pointer dark:text-white">
          Name
          <span v-if="sortField === 'name' && sortOrder === 'asc'" class="dark:text-white">↑</span>
          <span v-if="sortField === 'name' && sortOrder === 'desc'" class="dark:text-white">↓</span>
        </th>
        <th @click="sortByPoints" class="cursor-pointer dark:text-white">
      Points
      <span v-if="sortField === 'points' && sortOrder === 'asc'" class="dark:text-white">↑</span>
      <span v-if="sortField === 'points' && sortOrder === 'desc'" class="dark:text-white">↓</span>
    </th>
          <th class="dark:text-white">Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr v-for="(user, index) in sortedUsers" :key="index" :class="index % 2 === 0 ? 'bg-gray-100 dark:bg-gray-700' : ''">
          <td class="dark:text-white">{{ index + 1 }}</td>
          <td class="dark:text-white p-5 cursor-pointer" @click="showUserDetails(user)">{{ user.name }}</td>
          <td class="dark:text-white">
            <button @click="updatePoints(index, +1)" class="bg-green-700 hover:bg-green-400 text-white font-bold py-1 px-2 rounded">+</button>
            <span class="ml-3 mr-3">{{ user.points }}</span>
            <button @click="updatePoints(index, -1)" class="bg-rose-700 hover:bg-rose-400 text-white font-bold py-1 px-2 rounded">-</button>
          </td>
          <td>
            <button @click="deleteUser(user)" class="bg-rose-500 hover:bg-rose-300 text-white font-bold py-1 px-2 rounded">X</button>
          </td>
        </tr>
      </tbody>
    </table>
    <UserDetails v-if="showUserDetailsModal" :user="selectedUser" @close-modal="showUserDetailsModal = false" />
  </div>
</template>


<script>
import { router } from '@inertiajs/vue3';
import UserDetails from './UserDetails.vue';
import AddUser from './AddUser.vue';

export default {
  props: {
    users: {
      type: Object,
      required: true,
    },
  },

  components: {
    AddUser,
    UserDetails,
  },
  
  data() {
    return {
      showModal: false,
      showUserDetailsModal: false,
      selectedUser: null,
      showAddUserModal: false,
      error: null,
      sortField: 'points',
      sortOrder: 'desc',
      searchTerm: '',
    };
  },

  computed: {
    sortedUsers() {
      return this.sortFilteredUsers();
    }
  },

  methods: {

    sortByName() {
      this.sortField = 'name';
      this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
    },

    sortByPoints() {
      this.sortField = 'points';
      this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
    },

    sortFilteredUsers() {
      const searchTerm = this.searchTerm.toLowerCase();
      let filteredUsers = [...this.users];
      if (searchTerm != '') {
         filteredUsers = filteredUsers.filter((user) => user.name.toLowerCase().includes(searchTerm));
      } 
      const order = this.sortOrder === 'asc' ? 1 : -1;
      return filteredUsers.sort((a, b) => (a[this.sortField] > b[this.sortField] ? order : -order));
    },

    async updatePoints(index, point) {
      const user = this.sortedUsers[index];
      user.points += point;
      router.put('/api/update', {
        userId: user.id,
        points: user.points,
      });
    },

    async deleteUser (user) {
      let userId = user.id;
      if (confirm('Are you sure you want to delete user "' + user.name + '"?')) {
        router.delete(`/api/delete/${userId}`, {
          onSuccess: () => {
            const index = this.users.findIndex((user) => user.id === userId);
            if (index !== -1) {
              this.users.splice(index, 1);
            }
          },
          onError: (errors) => {
            error.value = errors;
          },
        });
      }
    },

    showUserDetails(user) {
      this.selectedUser = user;
      this.showUserDetailsModal = true;
    },

    openModal() {
      this.showModal = true;
    },

    async handleAddUser(newUser) {
      try {
        router.post('/api/user', newUser, {
          onSuccess: () => {
            this.showAddUserModal = false;
	        },
          onError: (errors) => {
            this.error = this.convertErrorMesssageToText(errors);
          }
        });
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.error = error.response.data.errors.name[0];
        } else {
          this.error = 'An error occurred while creating the user.';
        }
      }
    },

    convertErrorMesssageToText (errors) {
      let errorMessage = '';
      for (const key in errors) {
        errorMessage += 'Issue in `' + key + '`: ' + errors[key] + ' ';
      }
      return errorMessage;
    },

    closeAddUserModal() {
      this.showAddUserModal = false;
    },

  },
};
</script>

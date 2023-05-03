<template>
  <div class="container d-flex justify-content-center mt-5 bg-white w-50 flex-column">
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Completado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks" :key="task.id">
            <td class="text-secondary">{{ task.todo }}</td>
            <td>
              <input type="checkbox" :checked="task.completed" @click="completeTask(task)">
            </td>
            <td>
              <router-link :to="'/edit/' + task.id">Editar</router-link>
              <button type="button" @click="deleteTask(task.id)">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div>
      <paginacion :current-page="currentPage" :total-pages="totalPages" @pageChanged="pageChanged"></paginacion>
    </div>

  </div>
</template>


<script>

import axios from 'axios';
import Paginacion from './Paginacion.vue';

export default {
  components: {
    Paginacion,
  },
  data() {
    return {
      tasks: [],
      currentPage: 1,
      totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
      // url: process.env.MIX_APP_URL,
    }
  },
  methods: {

    pageChanged(page) {
      this.getTasks(page);
    },


    getTasks(page = 1) {
      const apiUrl = window.location.origin + '/proyectofinal/public/';

      
      axios.get(apiUrl + 'tasks?page=' + page)
      // axios.get(this.url + 'tasks?page=' + page)
        .then(response => {
          this.tasks = response.data.tasks;
          this.currentPage = response.data.currentPage;
          this.totalPages = response.data.lastPage;
        })
        .catch(error => {
          console.error(error);
        });
    },

    deleteTask(id) {
      const apiUrl = window.location.origin + '/proyectofinal/public/';


      axios.delete(apiUrl + 'tasks/' + id, {
      // axios.delete(this.url + 'tasks/' + id, {
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
      })
        .then(response => {
          console.log(response);
          this.getTasks();
        })
        .catch(error => {
          console.log(error);
        });
    },

    completeTask(task) {
      if (task.completed === 0) {
        var complete = 1;
      } else {
        var complete = 0;
      }

      const apiUrl = window.location.origin + '/proyectofinal/public/';
    
      axios.put(apiUrl + 'tasks/' + task.id, {
      // axios.put(this.url + 'tasks/' + task.id, {
        todo: task.todo,
        completed: complete
      })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error.response);
        });
    },


    checkCompleted(param) {

      if (param === 1) {
        return true;
      } else {
        return false;
      }

    },

  },

  created() {

    this.getTasks();
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
      this.csrfToken = token.content;
    }

  }
}
</script>

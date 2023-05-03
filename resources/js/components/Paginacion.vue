<template>
  <div class="pagination">
    <button :disabled="currentPage <= 1" @click="$emit('pageChanged', currentPage - 1)">
      Anterior
    </button>

    <button v-for="page in pageRange" :key="page" @click="$emit('pageChanged', page)"
      :class="{ active: page === currentPage }">
      {{ page }}
    </button>

    <button :disabled="currentPage >= totalPages" @click="$emit('pageChanged', currentPage + 1)">
      Siguiente
    </button>
  </div>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    totalPages: {
      type: Number,
      required: true
    },
    maxPageLinks: {
      type: Number,
      default: 5
    }
  },
  computed: {
    pageRange() {
      const maxPageLinks = this.maxPageLinks;
      let startPage = Math.max(this.currentPage - Math.floor(maxPageLinks / 2), 1);
      let endPage = Math.min(startPage + maxPageLinks - 1, this.totalPages);
      startPage = Math.max(endPage - maxPageLinks + 1, 1);
      return Array(endPage - startPage + 1).fill().map((_, idx) => startPage + idx);
    }
  }
};
</script>

<style>
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 20px 0;
}

.pagination button {
  margin: 0 5px;
  border: none;
  background-color: #f5f5f5;
  color: #555;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
  transition: all 0.2s;
}

.pagination button:hover {
  background-color: #ddd;
}

.pagination button:disabled {
  color: #ccc;
  cursor: not-allowed;
  opacity: 0.5; /* opcional para aplicar un efecto de opacidad a los botones deshabilitados */
}

.pagination .active {
  background-color: #007bff;
  color: #fff;
}
</style>

<template>

    <div class="input-group">
      <input ref="search" type="text" class="form-control" v-model="filterText" @keyup.enter="doFilter">
      <div class="input-group-append">
        <button class="btn btn-outline-success" type="button" @click="doFilter">Search</button>
        <button class="btn btn-outline-danger" type="button" @click="resetFilter">Clear</button>
        <button class="btn btn-primary" type="button"
          @mouseover="hintShow"
          @mouseleave="hintHide"
          ><i class="fas fa-info-circle"></i></button>
      </div>
    </div>
  </template>

  <script>
  export default {
    data () {
      return {
        filterText: ''
      }
    },
    methods: {
      doFilter () {
        this.$emit('filter-set', this.filterText);
      },
      resetFilter () {
        this.filterText = ''
        this.$emit('filter-reset');
      },
      hintShow()
      {
        this.$emit('show-hint');
      },
      hintHide()
      {
        this.$emit('hide-hint');
      },
    },
    mounted () {
      this.$refs.search.focus();
    }
  }
</script>
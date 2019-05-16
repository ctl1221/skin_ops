<template>
  <div class="ui container">

    <filter-bar 
      @filter-set="onFilterSet($event)"
      @filter-reset="onFilterReset()"
      ></filter-bar>
    <vuetable ref="vuetable"
      :api-url="api_url"
      :fields="fields"
      :append-params="moreParams"
      pagination-path=""
      @vuetable:pagination-data="onPaginationData"
      
    ></vuetable>


    <div class="vuetable-pagination ui basic segment grid">
      <vuetable-pagination-info 
      ref="paginationInfo">    
    </vuetable-pagination-info>

    <vuetable-pagination 
    ref="pagination"
    @vuetable-pagination:change-page="onChangePage">        
  </vuetable-pagination>

</div>
</div>
</template>

<script>
  import Vuetable from 'vuetable-2/src/components/Vuetable';
  import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
  import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
  import FilterBar from './FilterBar.vue'

  export default {
    components: {
      Vuetable,
      VuetablePagination,
      VuetablePaginationInfo,
      FilterBar,
    },
    props: ['index_url', 'api_url','fields'],
    data () {
      return {
        moreParams: {},
      }
    },
    methods: {
      allcap (value) {
        return value.toUpperCase();
      },

      linkify (value) {
        return '<a href="' + this.index_url + '/' + value + '">' + 'View' + '</a>';
      },

      onPaginationData (paginationData) {
        this.$refs.pagination.setPaginationData(paginationData);
        this.$refs.paginationInfo.setPaginationData(paginationData);
    },

    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },

    onFilterSet (filterText) {
      this.moreParams = {
        'filter': filterText
      }
      Vue.nextTick( () => this.$refs.vuetable.refresh())
    },

    onFilterReset () {
      this.moreParams = {}
      Vue.nextTick( () => this.$refs.vuetable.refresh())
    }
  },
}
</script>
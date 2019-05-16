<template>
  <div class="container">
      <div class="row mb-3">
        <div class="col">
           <filter-bar 
           @filter-set="onFilterSet($event)"
           @filter-reset="onFilterReset()"
           ></filter-bar>
        </div>

       <div class="col">
          <vuetable-pagination 
            ref="pagination"
            :css="css.pagination"
            @vuetable-pagination:change-page="onChangePage">        
          </vuetable-pagination>
      </div>
    </div>


      <vuetable ref="vuetable"
      :api-url="api_url"
      :fields="fields"
      :append-params="moreParams"
      :css="css.table"
      pagination-path=""
      @vuetable:pagination-data="onPaginationData"

      ></vuetable>

      <vuetable-pagination-info 
        ref="paginationInfo"
        info-class="pagination-info">    
      </vuetable-pagination-info>
</div>
</template>

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
import FilterBar from './FilterBar.vue'
import CssConfig from './VuetableCssConfig.js'

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
      css: CssConfig,
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

<style>
.pagination {
  margin: 0;
  float: right;
}
.pagination a.page {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.page.active {
  color: white;
  background-color: #337ab7;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.btn-nav {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
  cursor: not-allowed;
}
.pagination-info {
  float: left;
}
</style>
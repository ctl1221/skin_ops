<template>
  <div>
      <div class="row">
        <div class="col-4">
           <filter-bar 
           @filter-set="onFilterSet($event)"
           @filter-reset="onFilterReset()"
           @show-hint="showHint = true"
           @hide-hint="showHint = false"
           ></filter-bar>
        </div>

        <div class="col-8">
          <vuetable-pagination-bootstrap 
            ref="pagination"
            class="float-right"
            @vuetable-pagination:change-page="onChangePage">        
          </vuetable-pagination-bootstrap>
        </div>
    </div>


      <vuetable ref="vuetable"
      :api-url="api_url"
      :fields="fields"
      :append-params="moreParams"
      :css="css.table"
      :per-page="parseInt(per_page)"
      pagination-path=""
      @vuetable:pagination-data="onPaginationData"
      ></vuetable>

      <vuetable-pagination-info 
        ref="paginationInfo"
        info-class="pagination-info">    
      </vuetable-pagination-info>

      <div class="alert alert-light" role="alert" v-if="showHint && hints">
        {{ hints | br }}
      </div>
</div>
</template>

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable';
import VuetablePaginationBootstrap from './VuetablePaginationBootstrap';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
import FilterBar from './FilterBar.vue'
import CssConfig from './VuetableCssConfig.js'

export default {
  components: {
    Vuetable,
    VuetablePaginationBootstrap,
    VuetablePaginationInfo,
    FilterBar,
  },
  props: ['index_url', 'api_url','per_page','fields','hints'],
  data () {
    return {
      moreParams: {},
      css: CssConfig,
      showHint:false,
    }
  },
  methods: {
    allcap (value) {
      return value.toUpperCase();
    },

    currency (value) {
      return value.toLocaleString('en-PH',{minimumFractionDigits: 2, maximumFractionDigits: 2});
    },

    linkify (value) {
      return '<a href="' + this.index_url + '/' + value + '">' + 'View' + '</a>';
    },

    badgify (value) {
      return value == 1
        ? '<span class="badge badge-success">Active</span>'
        : '<span class="badge badge-danger">Inactive</span>'
    },

    edify (value) {
      return value == 1
        ? '<span class="badge badge-primary">Enabled</span>'
        : '<span class="badge badge-success">Disabled</span>'
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
    },
  },
};

</script>

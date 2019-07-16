<template>
  <vue-circle
    :progress="70"
    :size="100"
    :reverse="false"
    line-cap="butt"
    empty-fill="rgba(0, 0, 0, .1)"
    :animation-start-value="0.0"
    :start-angle="-Math.PI/2"
    insert-mode="append"
    :thickness="25"
    :show-percent="true"
    @vue-circle-progress="progress"
    @vue-circle-end="progress_end">
    <slot></slot>
  </vue-circle>
</template>
 
<script>
  import VueCircle from 'vue2-circle-progress'
  export default {
    components: {
      VueCircle
    },
    data(){
      return{
        fill : { gradient: ["red", "green", "blue"] },
      }
    },
    methods:{
      progress(event,progress,stepValue){
        console.log(stepValue);
      },
      progress_end(event){
        console.log("Circle progress end");
      }
    }
  }
</script>
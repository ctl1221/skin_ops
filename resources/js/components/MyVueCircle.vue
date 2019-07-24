<template>
    <vue-circle
      :progress="prog"
      :size="100"
      :reverse="false"
      line-cap="butt"
      :fill="fill"
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
    props: ['prog','fill'],
    data(){
      return{
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
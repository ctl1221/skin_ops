export default {
  table: {
    tableClass: 'table table-striped table-bordered table-sm',
    ascendingIcon: 'glyphicon glyphicon-chevron-up',
    descendingIcon: 'glyphicon glyphicon-chevron-down',
    handleIcon: 'glyphicon glyphicon-menu-hamburger',
    renderIcon: function(classes, options) {
      return `<span class="${classes.join(' ')}"></span>`
    }
  },
  // pagination: {
  //   wrapperClass: "pagination pull-right",
  //   activeClass: "page-link active",
  //   disabledClass: "disabled",
  //   pageClass: "page-link",
  //   linkClass: "page-item",
  //   icons: {
  //     first: "",
  //     prev: "",
  //     next: "",
  //     last: ""
  //   }
  // }
}
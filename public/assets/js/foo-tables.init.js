$(window).on("load", function () {
  $("#demo-foo-row-toggler").footable(),
    $("#demo-foo-accordion")
      .footable()
      .on("footable_row_expanded", function (o) {
        $("#demo-foo-accordion tbody tr.footable-detail-show")
          .not(o.row)
          .each(function () {
            $("#demo-foo-accordion").data("footable").toggleDetail(this);
          });
      }),
    $("#demo-foo-pagination").footable(),
    $("#demo-show-entries").change(function (o) {
      o.preventDefault();
      var t = $(this).val();
      $("#demo-foo-pagination").data("page-size", t),
        $("#demo-foo-pagination").trigger("footable_initialized");
    });
  //Create more than one table by just changing the id of the tables, searchbar and status can also be changed with just adding the new id's to the table
  // Order Table Starts here
  var t = $("#demo-foo-filtering");
  t.footable().on("footable_filtering", function (o) {
    var t = $("#demo-foo-filter-status").find(":selected").val();
    (o.filter += o.filter && 0 < o.filter.length ? " " + t : t),
      (o.clear = !o.filter);
  }),
    $("#demo-foo-filter-status").change(function (o) {
      o.preventDefault(),
        t.trigger("footable_filter", { filter: $(this).val() });
    }),
    $("#demo-foo-search").on("input", function (o) {
      o.preventDefault(),
        t.trigger("footable_filter", { filter: $(this).val() });
    });

  // Order Table ends here

  // Customer History Table Starts here
  var z = $("#customer-history-tbl");
  z.footable().on("footable_filtering", function (o) {
    var z = $("#cs-history-filter").find(":selected").val();
    (o.filter += o.filter && 0 < o.filter.length ? " " + z : z),
      (o.clear = !o.filter);
  }),
    $("#cs-history-filter").change(function (o) {
      o.preventDefault(),
        z.trigger("footable_filter", { filter: $(this).val() });
    }),
    $("#customer-history-search").on("input", function (o) {
      o.preventDefault(),
        z.trigger("footable_filter", { filter: $(this).val() });
    });
  // Customer History Table ends here

  // Reseller History Table Starts here
  var y = $("#reseller-history-tbl");
  z.footable().on("footable_filtering", function (o) {
    var z = $("#reseller-history-filter").find(":selected").val();
    (o.filter += o.filter && 0 < o.filter.length ? " " + z : z),
      (o.clear = !o.filter);
  }),
    $("#reseller-history-filter").change(function (o) {
      o.preventDefault(),
        z.trigger("footable_filter", { filter: $(this).val() });
    }),
    $("#reseller-history-search").on("input", function (o) {
      o.preventDefault(),
        z.trigger("footable_filter", { filter: $(this).val() });
    });
  // Reseller History Table ends here

  var e = $("#demo-foo-addrow");
  e.footable().on("click", ".demo-delete-row", function () {
    var o = e.data("footable"),
      t = $(this).parents("tr:first");
    o.removeRow(t);
  }),
    $("#demo-input-search2").on("input", function (o) {
      o.preventDefault(),
        e.trigger("footable_filter", { filter: $(this).val() });
    }),
    $("#demo-btn-addrow").click(function () {
      e.data("footable").appendRow(
        '<tr><td style="text-align: center;"><button class="demo-delete-row btn btn-danger btn-xs btn-icon"><i class="fa fa-times"></i></button></td><td>Adam</td><td>Doe</td><td>Traffic Court Referee</td><td>22 Jun 1972</td><td><span class="badge label-table badge-success   ">Active</span></td></tr>'
      );
    });
});

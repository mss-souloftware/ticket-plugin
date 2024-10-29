(function ($) {
  // Toggle accordion content
  $(".accordion-header .column-primary button").on("click", function () {
    var index = $(this).parents(".accordion-header").data("index");
    $("#accordion-content-" + index).slideToggle();
  });

  // Select all checkboxes
  $("#select-all").on("click", function () {
    $('input[name="ticket[]"]').prop("checked", this.checked);
  });

  // Delete Specific row

  $("#deletThisTicket").on("click", function () {
    var rowId = $(this).attr("row-id");

    if (confirm("Are you sure you want to delete this ticket?")) {
      $.post(
        ajax_variables.ajax_url,
        {
          action: "delete_single_ticket",
          ticket_id: rowId,
          nonce: ajax_variables.nonce,
        },
        function (response) {
          if (response.success) {
            alert(response.data.message);
            location.reload(); // Reload the page to refresh the list
          } else {
            alert(response.data.message);
          }
        }
      );
    }
  });
})(jQuery);

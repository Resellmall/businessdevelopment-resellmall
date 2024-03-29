!(function (t) {
  "use strict";
  function e() {}
  (e.prototype.init = function () {
    t("#sa-basic").on("click", function () {
      Swal.fire({
        title: "Any fool can use a computer!",
        confirmButtonClass: "btn btn-confirm mt-2",
      });
    }),
      t("#sa-title").click(function () {
        Swal.fire({
          title: "The Internet?",
          text: "That thing is still around?",
          type: "question",
          confirmButtonClass: "btn btn-confirm mt-2",
        });
      }),
      t("#sa-success").click(function () {
        Swal.fire({
          title: "Good job!",
          text: "You clicked the button!",
          type: "success",
          confirmButtonClass: "btn btn-confirm mt-2",
        });
      }),
      t("#sa-error").click(function () {
        Swal.fire({
          type: "error",
          title: "Oops...",
          text: "Something went wrong!",
          confirmButtonClass: "btn btn-confirm mt-2",
          footer: '<a href="">Why do I have this issue?</a>',
        });
      }),
      t("#sa-long-content").click(function () {
        Swal.fire({
          imageUrl: "https://placeholder.pics/svg/300x1500",
          imageHeight: 1500,
          imageAlt: "A tall image",
          confirmButtonClass: "btn btn-confirm mt-2",
        });
      }),
      t("#sa-custom-position").click(function () {
        Swal.fire({
          position: "top-end",
          type: "success",
          title: "Your work has been saved",
          showConfirmButton: !1,
          timer: 1500,
        });
      }),
      t("#sa-warning").click(function () {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: !0,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then(function (t) {
          t.value &&
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        });
      }),
      t("#sa-params").click(function () {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "Your imaginary file is safe :)",
                type: "error",
              });
        });
      }),
      t("#out-stock").click(function () {
        Swal.fire({
          title: "Are you sure?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Products Out Of Stock Updated!",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#in-stock").click(function () {
        Swal.fire({
          title: "Are you sure?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Products In Stock Updated",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#dump").click(function () {
        Swal.fire({
          title: "Are you sure?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Products Moved to Dump",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#reject").click(function () {
        Swal.fire({
          title: "Are you sure want to reject the products?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Products has been rejected",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#approve-order").click(function () {
        Swal.fire({
          title: "Are you sure want to approve this order?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Order has been approved",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Order approval has been rejected",
                text: "",
                type: "error",
              });
        });
      }),
      t("#approve").click(function () {
        Swal.fire({
          title: "Are you sure to approve?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Products has been approved",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#place-order").click(function () {
        Swal.fire({
          title: "Are you sure to place this order?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Order has been placed successfully",
                text: "Your Order Referrence Number is RMOD-5FD6F266E8B10",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#send-notification").click(function () {
        Swal.fire({
          title: "Are you sure to send the notification?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Users will be notified sortly...",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#user-approve").click(function () {
        Swal.fire({
          title: "Are you sure want to approve the user",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "User profile has been approved",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "User approval has been cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#user-delete").click(function () {
        Swal.fire({
          title: "Are you sure want to delete the user?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "User profile has been deleted",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "User deletion cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#category-deactivate").click(function () {
        Swal.fire({
          title: "Are you sure want to deactivate the category?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Category has been deactivated",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#category-delete").click(function () {
        Swal.fire({
          title: "Are you sure want to delete the category?",
          text: "",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          confirmButtonClass: "btn btn-success mt-2",
          cancelButtonClass: "btn btn-danger ml-2 mt-2",
          buttonsStyling: !1,
        }).then(function (t) {
          t.value
            ? Swal.fire({
                title: "Category has been deleted",
                text: "",
                type: "success",
              })
            : t.dismiss === Swal.DismissReason.cancel &&
              Swal.fire({
                title: "Cancelled",
                text: "",
                type: "error",
              });
        });
      }),
      t("#sa-image").click(function () {
        Swal.fire({
          title: "UBold",
          text: "Responsive Bootstrap 4 Admin Dashboard",
          imageUrl: "../assets/images/logo-sm.png",
          imageHeight: 50,
          animation: !1,
          confirmButtonClass: "btn btn-confirm mt-2",
        });
      }),
      t("#sa-close").click(function () {
        var t;
        Swal.fire({
          title: "Auto close alert!",
          html: "I will close in <strong></strong> seconds.",
          timer: 2e3,
          onBeforeOpen: function () {
            Swal.showLoading(),
              (t = setInterval(function () {
                Swal.getContent().querySelector(
                  "strong"
                ).textContent = Swal.getTimerLeft();
              }, 100));
          },
          onClose: function () {
            clearInterval(t);
          },
        }).then(function (t) {
          t.dismiss === Swal.DismissReason.timer &&
            console.log("I was closed by the timer");
        });
      }),
      t("#custom-html-alert").click(function () {
        Swal.fire({
          title: "<i>HTML</i> <u>example</u>",
          type: "info",
          html:
            'You can use <b>bold text</b>, <a href="//coderthemes.com/">links</a> and other HTML tags',
          showCloseButton: !0,
          showCancelButton: !0,
          confirmButtonClass: "btn btn-confirm mt-2",
          cancelButtonClass: "btn btn-cancel ml-2 mt-2",
          confirmButtonText: '<i class="mdi mdi-thumb-up-outline"></i> Great!',
          cancelButtonText: '<i class="mdi mdi-thumb-down-outline"></i>',
        });
      }),
      t("#custom-padding-width-alert").click(function () {
        Swal.fire({
          title: "Custom width, padding, background.",
          width: 600,
          padding: 100,
          confirmButtonClass: "btn btn-confirm mt-2",
          background:
            "#fff url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/geometry.png)",
        });
      }),
      t("#ajax-alert").click(function () {
        Swal.fire({
          title: "Submit your Github username",
          input: "text",
          inputAttributes: { autocapitalize: "off" },
          showCancelButton: !0,
          confirmButtonText: "Look up",
          showLoaderOnConfirm: !0,
          preConfirm: function (t) {
            return fetch("//api.github.com/users/" + t)
              .then(function (t) {
                if (!t.ok) throw new Error(t.statusText);
                return t.json();
              })
              .catch(function (t) {
                Swal.showValidationMessage("Request failed: " + t);
              });
          },
          allowOutsideClick: function () {
            Swal.isLoading();
          },
        }).then(function (t) {
          t.value &&
            Swal.fire({
              title: t.value.login + "'s avatar",
              imageUrl: t.value.avatar_url,
            });
        });
      }),
      t("#chaining-alert").click(function () {
        Swal.mixin({
          input: "text",
          confirmButtonText: "Next &rarr;",
          showCancelButton: !0,
          progressSteps: ["1", "2", "3"],
        })
          .queue([
            { title: "Question 1", text: "Chaining swal2 modals is easy" },
            "Question 2",
            "Question 3",
          ])
          .then(function (t) {
            t.value &&
              Swal.fire({
                title: "All done!",
                html:
                  "Your answers: <pre><code>" +
                  JSON.stringify(t.value) +
                  "</code></pre>",
                confirmButtonText: "Lovely!",
              });
          });
      }),
      t("#dynamic-alert").click(function () {
        swal.queue([
          {
            title: "Your public IP",
            confirmButtonText: "Show my public IP",
            confirmButtonClass: "btn btn-confirm mt-2",
            text: "Your public IP will be received via AJAX request",
            showLoaderOnConfirm: !0,
            preConfirm: function () {
              return new Promise(function (e) {
                t.get("https://api.ipify.org/?format=json").done(function (t) {
                  swal.insertQueueStep(t.ip), e();
                });
              });
            },
          },
        ]);
      });
  }),
    (t.SweetAlert = new e()),
    (t.SweetAlert.Constructor = e);
})(window.jQuery),
  (function () {
    "use strict";
    window.jQuery.SweetAlert.init();
  })();

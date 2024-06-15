"use strict";
var KTSigninGeneral = (function () {
  var t, e, i;
  return {
    init: function () {
      (t = document.querySelector("#kt_sign_in_form")),
        (e = document.querySelector("#kt_sign_in_submit")),
        (i = FormValidation.formValidation(t, {
          fields: {
            usuario: {
              validators: {
                notEmpty: { message: "Nombre de usuario requerido" },
              },
            },
            password: {
              validators: { notEmpty: { message: "Necesitas escribir la contraseña" } },
            },
          },
          plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
              rowSelector: ".fv-row",
            }),
          },
        })),
        e.addEventListener("click", function (n) {
          n.preventDefault(),
            i.validate().then(function (i) {
              "Valid" == i
                ? (e.setAttribute("data-kt-indicator", "on"),
                  (e.disabled = !0),
                  setTimeout(function () {
                    e.removeAttribute("data-kt-indicator"),
                      (e.disabled = !1),
                      Swal.fire({
                        text: "Iniciaste sesión correctamente!",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Confirmar",
                        customClass: { confirmButton: "btn btn-primary" },
                      }).then(function (e) {
                        if (e.isConfirmed) {
                        (t.querySelector('[name="usuario"]').value = ""),
                        (t.querySelector('[name="password"]').value = "");
                        }
                      });
                  }, 2e3))
                : Swal.fire({
                    text: "Hubo un error al iniciar sesion, contacta con administración.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Entendido",
                    customClass: { confirmButton: "btn btn-primary" },
                  });
            });
        });
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  KTSigninGeneral.init();
});

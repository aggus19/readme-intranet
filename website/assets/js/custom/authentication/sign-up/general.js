"use strict";
var KTSignupGeneral = (function () {
  var e,
    t,
    a,
    s,
    r = function () {
      return 100 === s.getScore();
    };
  return {
    init: function () {
      (e = document.querySelector("#kt_sign_up_form")),
        (t = document.querySelector("#kt_sign_up_submit")),
        (s = KTPasswordMeter.getInstance(
          e.querySelector('[data-kt-password-meter="true"]')
        )),
        (a = FormValidation.formValidation(e, {
          fields: {
            nombre: {
              validators: { notEmpty: { message: "Falta nombre" } },
            },
            apellido: {
              validators: { notEmpty: { message: "Falta apellido" } },
            },
            telefono: {
              validators: { notEmpty: { message: "Falta telefono" } },
            },
            nomusuario: {
              validators: { notEmpty: { message: "Falta nombre de usuario" } },
            },
            cedula: {
              validators: { notEmpty: { message: "Falta cedula" } },
            },
            email: {
              validators: {
                notEmpty: { message: "Falta correo electronico" },
                emailAddress: {
                  message: "El correo electronico no es correcto",
                },
              },
            },
            toc: {
              validators: {
                notEmpty: {
                  message: "Falta aceptar teminos y condiciones",
                },
              },
            },
          },
          plugins: {
            trigger: new FormValidation.plugins.Trigger({
              event: { password: !1 },
            }),
            bootstrap: new FormValidation.plugins.Bootstrap5({
              rowSelector: ".fv-row",
              eleInvalidClass: "",
              eleValidClass: "",
            }),
          },
        })),
        t.addEventListener("click", function (r) {
          r.preventDefault(),
            a.validate().then(function (a) {
              "Valid" == a
                ? (t.setAttribute("data-kt-indicator", "on"),
                  (t.disabled = !0),
                  setTimeout(function () {
                    t.removeAttribute("data-kt-indicator"),
                      (t.disabled = !1),
                      Swal.fire({
                        text: "Registro exitoso!",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Continuar!",
                        customClass: { confirmButton: "btn btn-primary" },
                      }).then(function (t) {
                        t.isConfirmed && (e.reset(), s.reset());
                      });
                  }, 1500))
                : Swal.fire({
                  text: "Se detecto un error, contacta con Administracion.",
                  icon: "error",
                  buttonsStyling: !1,
                  confirmButtonText: "Continuar",
                  customClass: { confirmButton: "btn btn-lg btn-primary" },
                });
            });
        }),
        e;
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  KTSignupGeneral.init();
});

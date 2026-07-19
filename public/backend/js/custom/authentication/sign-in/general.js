"use strict";

const sleep = (ms) => new Promise((res) => setTimeout(res, ms));

var KTModalAdd = function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            r = document.querySelector("#kt_sign_in_form"),
            t = r.querySelector("#kt_sign_in_submit"),
            n = FormValidation.formValidation(r, {
                fields: {
                    login: {
                        validators: {
                            notEmpty: {
                                message: "Login Id is required"
                            },
                            regexp: {
                                // regexp: /(^[^\s@]+@[^\s@]+\.[^\s@]+$)|(^[0-9]{10}$)/,
                                regexp: /(^[^\s@]+@[^\s@]+\.[^\s@]+$)|(^[0-9]{10}$)|(^[a-zA-Z0-9._]{10,}$)/,
                                message: "Please enter a valid login id"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Password is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }),
            
            t.addEventListener("click", function (n) {
                n.preventDefault();
                n.stopPropagation();
                var loginn = document.getElementById("Login").value;
                var passwordd = document.getElementById("Password").value;
                $.ajax({
                    type: "POST",
                    url: "auth",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        login: loginn,
                        password: passwordd
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.code == 200) {
                            alert("Login");
                            swal.fire({
                                text: "Your credentials matches our record",
                                icon: "success",
                                showConfirmButton: false
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                            const work = async () => {
                                await sleep(1000);
                                swal.close();
                                // if(response.data.otp_verified == 0) {
                                //     $('#otpModal').modal('show');
                                //     $('#loggedInUserId').val(response.data.user_id);
                                // }
                                window.location.href = "admin/dashboard";
                            };
                            work();
                        } else if (response.code == 401) {
                            swal.fire({
                                text: "Password is incorrect",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Try Again",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        } else if (response.code == 403) {
                            swal.fire({
                                text: "You have been deactivated from logging into the panel. Kindly contact the admin to reinstate your privileges",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Try Again",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        } else if (response.code == 404) {
                            swal.fire({
                                text: "Login details not found.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Try Again",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                KTUtil.scrollTop();
                            });
                        } else {
                            swal.fire({
                                text: "Please enter a valid login id and password",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Try Again",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        }
                    },
                    error: function(xhr) {
                        let response = xhr.responseJSON;
                        swal.fire({
                            text: response.message,
                            icon: "error"
                        });
                    }
                });
            });
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTModalAdd.init();
});



function verifyOtp() {
    let otp = document.getElementById('otpCode').value;
    let userId = document.getElementById('loggedInUserId').value;
    let verifyOtpUrl = window.verifyOtpUrl || 'verify-otp'; 
    $.ajax({
        url: verifyOtpUrl,
        method: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            otp: otp,
            user_id: userId
        },
        success: function(res) {
            if(res.success) {
                Swal.fire({
                    text: "OTP Verified Successfully!",
                    icon: "success",
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "/admin/dashboard";
                });
            } else {
                Swal.fire({
                    text: res.message,
                    icon: "error",
                    showConfirmButton: true
                });
            }
        }
    });
}




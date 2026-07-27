"use strict";
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});

// let addMoreRows=2;


// When click on add button than redirect create page without page load Start
    function loadPage(url, addHistory = true) {
        $.ajax({
            url: url,
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response){
                $('#kt_content_container').html(response);
                $('#loaderContainer').hide(); // Loader hide karein
                if(addHistory){
                    history.pushState({url: url}, '', url);
                } 
            },
            error: function() {
                $('#loaderContainer').hide();
            }
        });
    }


    // Global click listeners jo naye dynamically loaded buttons par bhi kaam karein
    $(document).on('click', '#addCustomer', function(e){
        e.preventDefault();
        let url = $(this).data('url');
        loadPage(url);
        
    });

    // Global click listeners jye supplier ke liye hai
    $(document).on('click', '#addPharmacyCustomer', function(e){
        e.preventDefault();
        let url = $(this).data('url');
        loadPage(url);
        
    });
    $(document).on('click', '#addSupplier', function(e){
        e.preventDefault();
        let url = $(this).data('url');
        loadPage(url);
        
    });
    $(document).on('click', '#addPharmacyVendor', function(e){
        e.preventDefault();
        let url = $(this).data('url');
        loadPage(url);
        
    });
    $(document).on('click', '#addMadicine', function(e){
        e.preventDefault();
        let url = $(this).data('url');
        loadPage(url);
        
    });
    $(document).on('click', '#addBatchMadicine', function(e){
        e.preventDefault();
        let url = $(this).data('url');
        loadPage(url);
        
    });
    

    window.onpopstate = function(){
        loadPage(location.pathname, false);
    };

    $(document).off('click', '#backCustomerList').on('click', '#backCustomerList', function(e){
        e.preventDefault();
        loadPage(window.CustomerListUrl);
    });


    $(document).off('click', '#backSupplierList').on('click', '#backSupplierList', function(e){
        e.preventDefault();
        loadPage(window.SupplierListUrl);
    });


    $(document).off('click', '#backPharmacyCustomerList').on('click', '#backPharmacyCustomerList', function(e){
        e.preventDefault();
        loadPage(window.PharmacyCustomerListUrl);
    });


    $(document).off('click', '#backPharmacyVendorList').on('click', '#backPharmacyVendorList', function(e){
        e.preventDefault();
        loadPage(window.PharmacyVendorListUrl);
    });

    $(document).off('click', '#backPharmacyMadicineList').on('click', '#backPharmacyMadicineList', function(e){
        e.preventDefault();
        loadPage(window.PharmacyMadicineListUrl);
    });

    $(document).off('click', '#backPharmacyBatchMadicineList').on('click', '#backPharmacyBatchMadicineList', function(e){
        e.preventDefault();
        loadPage(window.PharmacyMadicineListUrl);
    });
// When click on add button than redirect create page without page load End



// Field Validation Start
    function validateEmail(email) {
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(email.value.trim() != '' && !regex.test(email.value)) {
            document.getElementById('emailError').style.display = "block"
        } else {
            document.getElementById('emailError').style.display = "none"
        }
    }

    function validateGstNumber(gst) {
        const regex = /^[0-9]{2}[aA-zZ]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[aA-zZ]{1}[0-9A-Z]{1}$/;
        if(gst.value.trim() != '' && !regex.test(gst.value)) {
            document.getElementById('gstError').style.display = "block"
        } else {
            document.getElementById('gstError').style.display = "none"
        }
    }

    function validatePanNumber(pan) {
        const regex = /^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/;
        if(pan.value.trim() != '' && !regex.test(pan.value)) {
            document.getElementById('panError').style.display = "block"
        } else {
            document.getElementById('panError').style.display = "none"
        }
    }

    function validateDrugLicence(drug) {
        const dlRegex = /^[A-Z]{2}[-/\s]?[A-Z0-9]{2,5}[-/\s]?(20|20B|20F|20G|21|21B)[-/\s]?[0-9]{4,8}$/i;
        if(drug.value.trim() != '' && !dlRegex.test(drug.value)) {
            document.getElementById('drugError').style.display = "block"
        } else {
            document.getElementById('drugError').style.display = "none"
        }
    }

    function validationNumber(elem) {
        elem.value = elem.value.replace(/\D/g, '');
        if (elem.value.length !== 10) {
            document.getElementById("mobileError").style.display = "block";
        } else {
            document.getElementById("mobileError").style.display = "none";
        }
    }

    function validationAlternateNumber(elem) {
        elem.value = elem.value.replace(/\D/g, '');
        if (elem.value.length !== 10) {
            document.getElementById("alternateMobileError").style.display = "block";
        } else {
            document.getElementById("alternateMobileError").style.display = "none";
        }
    }

    function validationWebsite(elem) {
        const urlPattern = /^(https?:\/\/)?(www\.)?[a-zA-Z0-9-]+(\.[a-zA-Z]{2,})+(\/[a-zA-Z0-9-._~:/?#[\]@!$&'()*+,;=]*)?$/;
        if (elem.value.trim() !== "" && !urlPattern.test(elem.value)) {
            document.getElementById("websiteError").style.display = "block";
        } else {
            document.getElementById("websiteError").style.display = "none";
        }
    }
// Field Validation End




// Role and Permission & Role Permission & User Role List Function with CRUD Functionality
    function saveRole(e) {
        e.preventDefault();
        $('.roleBtn').prop('disabled', true);
        let roleName = $("#roleName").val();
        let hospital_id = $("#hospital_id").val();
        let firm_id = $("#firm_id").val();
        let role_priority = $("#role_priority").val();

        if (roleName === '') {
            validationAlert('Missing role name', 'Please enter a role name.', 'error', 2000, 'OK');
            $('.roleBtn').prop('disabled', false);
            return false;
        }
        if (role_priority === '') {
            validationAlert('Missing role priority', 'Please enter role priority.', 'error', 2000, 'OK');
            $('.roleBtn').prop('disabled', false);
            return false;
        }

        submitRole(roleName, hospital_id, firm_id, role_priority)
    }

    function submitRole(roleName, hospital_id, firm_id, role_priority) {
        let url = 'admin/authentication/save';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: roleName,
                hospital_id: hospital_id,
                firm_id: firm_id,
                role_priority: role_priority
            },
            success: function(res) {
                if(res.success) {
                    $('.roleBtn').prop('disabled', false);
                    $('#addRole').modal('hide');
                    $("#roleName").val('');
                    $("#hospital_id").val('');
                    $("#firm_id").val('');
                    $("#role_priority").val('');
                    validationAlert('Role created', res.message, 'success', 2000, 'OK');
                    loadData("role", '/admin/authentication/list/');
                }
            },
            error: function(xhr) {
                $('.roleBtn').prop('disabled', false);
                $('#addRole').modal('show');
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                        
                    }
                }
            }
        });
    }
    
    function editRole(role) {
        $('#roleId').val(role.id);
        $('#updateRoleName').val(role.name);
        $('#email').val(role.email);
        $('#phone').val(role.phone);
        $('#editRole').modal('show');
    }

    function editRoleBtn(e) {
        e.preventDefault();
        $('#updateRoleBtnId').prop('disabled', true);
        let id = $("#roleId").val();
        let roleName = $("#updateRoleName").val();
        if (roleName === '') {
            validationAlert('Missing role name', 'Please enter a role name.', 'error', 2000, 'OK');
            $('#updateRoleBtnId').prop('disabled', false);
            return false;
        }
        // alert('abhishek mishra' + '\n' + roleName + '\n' + id);
        updateRole(id, roleName)
    }

    function updateRole(){
        let id = $('#roleId').val();
        let role = $.trim($('#updateRoleName').val());
        if(role == ''){
            validationAlert( 'Missing role name', 'Please enter a role name.', 'error', 2000, false );
            return;
        }
        $('#updateRoleBtnId').prop('disabled', true);

        $.ajax({
            url:'/admin/role/update',
            type:'POST',
            data:{
                _token:$('meta[name="csrf-token"]').attr('content'),
                id:id,
                role:role
            },

            success:function(res){
                $('#updateRoleBtnId').prop('disabled', false);
                if(res.success){
                    $('#editRole').modal('hide');
                    $('#updateRoleName').val('');
                    validationAlert( 'Role Updated', 'Successfully updated the role.', 'success', 2000, false );
                    loadData('role', '/admin/authentication/list/');
                }
            },

            error:function(xhr){
                $('#updateRoleBtnId').prop('disabled', false);
                let message='Something went wrong.';
                if(xhr.responseJSON){
                    message = xhr.responseJSON.message.role ?? xhr.responseJSON.message ?? message;

                }

                validationAlert( 'Error', message, 'error', 3000, false );
            }
        });
    }
    


    function savePermission(e) {
        e.preventDefault();
        $('.permissionBtn').prop('disabled', true);
        let parent = $("#parent_permission_module_id").val();
        let child = $("#child_permission_module_id").val();
        // let action = $("#action").val();
        let permissionName = $("#permissionName").val();

        if(parent === '') {
            validationAlert('Missing module field', 'Please select valid module.', 'error', 2000, 'OK');
            $('.permissionBtn').prop('disabled', false);
            return false;
        } else {
            // if(child === '') {
            //     validationAlert('Missing child module field', 'Please select valid child module.', 'error', 2000, 'OK');
            //     $('.permissionBtn').prop('disabled', false);
            //     return false;
            // }
        }
        if(permissionName === '') {
            validationAlert('Missing name field', 'Please enter name field.', 'error', 2000, 'OK');
            $('.permissionBtn').prop('disabled', false);
            return false;
        }
        submitPermission(parent, child, permissionName);
    }

    function submitPermission(parent, child, permissionName) {
        let url = '/admin/authentication/permission/save';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                parent : parent, 
                child : child,
                permission : permissionName
            },
            success: function(res) {
                if(res.success == true && res.code == 200) {
                    console.log(res);
                    $('.permissionBtn').prop('disabled', false);
                    $('#addPermission').modal('hide');
                    $("#parent_permission_module_id").val('');
                    $("#child_permission_module_id").val('');
                    $("#permissionName").val('');
                    validationAlert('Premission Module', res.data, 'success', 2000, 'OK');
                    loadData("permission", '/admin/authentication/list/');
                }
            },
            error: function(xhr) {
                $('.permissionBtn').prop('disabled', false);
                let response = xhr.responseJSON.data;
                if(response) {
                    console.log(response);
                    for(let key in response) {
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } 
            }
        })

    }

    $(document).ready(function() {
        loadData('permission', '/admin/authentication/list')
        let parentSelect = $('.parent_permission_module_id');
        let childSelect = $('#child_permission_module_id');

        // 1. Page load hote hi Parent Dropdown fill karein (Click event hata diya)
        function loadParentModules() {
            parentSelect.html('<option value="">Loading...</option>').trigger('change');
            $.ajax({
                url: '/admin/authentication/module/', // Added leading slash for absolute path
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    parentSelect.html('<option value="" selected disabled>Select Parent Module</option>');
                    $.each(data, function(id, name) {
                        parentSelect.append('<option value="' + id + '">' + name + '</option>');
                    });
                    parentSelect.trigger('change'); // Select2 ko update karne ke liye
                },
                error: function() {
                    parentSelect.html('<option value="">Error loading modules</option>').trigger('change');
                }
            });
        }

        loadParentModules(); // Call function to load parents immediately
        // 2. Parent Change hone par Child Dropdown update hoga
        $(document).on('change', '#parent_permission_module_id', function() {
            let parentId = $(this).val();
            if (!parentId) { // Agar koi parent selected nahi hai toh child ko khali rakhein
                childSelect.html('<option value="" selected disabled>Select Child Module</option>').trigger('change');
                return;
            }
            childSelect.html('<option value="">Loading...</option>').trigger('change');
            $.ajax({
                url: '/admin/authentication/child/' + parentId, // Added leading slash
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    childSelect.html('<option value="" selected disabled>Select Child Module</option>');
                    if($.isEmptyObject(data)) { // Agar koi child nahi mila
                        childSelect.html('<option value="">No Child Module Found</option>');
                    } else {
                        $.each(data, function(id, name) {
                            childSelect.append('<option value="' + id + '">' + name + '</option>');
                        });
                    }
                    childSelect.trigger('change'); // Select2 refresh
                },
                error: function() {
                    childSelect.html('<option value="">Error loading child module</option>').trigger('change');
                }
            });
        });
    });

    // $(document).on('change', '#parent_permission_module_id', function() {
    //     let parentId = $(this).val();
    //     let childModuleSelect = $('#child_permission_module_id');
    //     childModuleSelect.html('<option value="">Loading...</option>');
    //     if (parentId) {
    //         let url = 'admin/authentication/child/' + parentId;
    //         $.ajax({
    //             url: url,
    //             type: 'GET',
    //             dataType: 'json',
    //             success: function(data) {
    //                 childModuleSelect.html('<option value="">Select Child Module Name</option>');
    //                 // Response loop chalakar dropdown fill karein
    //                 $.each(data, function(id, name) {
    //                     childModuleSelect.append('<option value="' + id + '">' + name + '</option>');
    //                 });

    //                 if (childModuleSelect.hasClass("select2-hidden-accessible")) {
    //                     childModuleSelect.trigger('change');
    //                 }
    //             },
    //             error: function() {
    //                 childModuleSelect.html('<option value="">Error loading child module</option>');
    //             }
    //         });
    //     } else {
    //         childModuleSelect.html('<option value="">Select Child Module Name</option>');
    //     }
    // });

    function editPermission(button) {
        let permissionId = button.getAttribute('data-id');
        let permissionName = button.getAttribute('data-name');
        let appUrl = button.getAttribute('data-app-url');
        let moduleName = button.getAttribute('data-module-id') || '';
        let $moduleSelect = $('#updateModuleName');
        if ($moduleSelect.is('select')) {
            if ($moduleSelect.find('option[value="' + moduleName + '"]').length > 0) {
                $moduleSelect.val(moduleName).trigger('change');
            } else {
                $moduleSelect.val('').trigger('change');
            }
        } else {
            document.getElementById('updateModuleName').value = moduleName;
        }
        document.getElementById('hiddenPremissionId').value = permissionId;
        document.getElementById('updatePermissionName').value = permissionName;
        document.getElementById('updateAppUrl').value = appUrl;
    }

    function updatePermission(e) {
        e.preventDefault();
        $('#updatePermissionBtn').prop('disabled', true);
        let permissionId = $("#hiddenPremissionId").val();
        let permissionName = $("#updatePermissionName").val();
        let updateAppUrl = $("#updateAppUrl").val();
        let moduleName = $("#updateModuleName").val();
        if (permissionName === '') {
            validationAlert('Missing permission name', 'Please enter a permission name.', 'error', 2000, 'OK');
            $('#updatePermissionBtn').prop('disabled', false);
            return false;
        }

        if (updateAppUrl === '') {
            validationAlert('Missing application url', 'Please enter a valid application url related to current permission.', 'error', 2000, 'OK');
            $('#updatePermissionBtn').prop('disabled', false);
            return false;
        }

        if (moduleName === '') {
            validationAlert('Missing module name', 'Please enter a route name.', 'error', 2000, 'OK');
            $('#updatePermissionBtn').prop('disabled', false);
            return false;
        }
        updatePermissionAjax(permissionId, permissionName, updateAppUrl, moduleName);
    }

    function updatePermissionAjax(permissionId, permissionName, updateAppUrl, moduleName) {
        let url = '/admin/permission/update';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                permission: permissionName,
                app_url: updateAppUrl,
                module: moduleName,
                id: permissionId
            },
            success: function(res) {
                if(res.success) {
                    $('#updatePermissionBtn').prop('disabled', false);
                    $('#editPermission').modal('hide');
                    $('#updatePermissionName').val('');
                    $('#updateModuleName').val('');
                    $('#updateAppUrl').val('');
                    validationAlert('Permission updated', 'Successfully updated the permission.', 'success', 2000, 'OK');
                }
            },
            error: function(xhr) {
                $('#updatePermissionBtn').prop('disabled', false);
                let response = xhr.responseJSON;
                console.log(xhr.responseJSON.message.permission);
                if(response) {
                    switch (response.error) {
                        case 1:
                            if(xhr.responseJSON.message != '') {
                                for(let key in xhr.responseJSON.message) {
                                    if(xhr.responseJSON.message.hasOwnProperty(key)) {
                                        if(xhr.responseJSON.message[key][0] != '') {
                                            validationAlert('Validation Error', xhr.responseJSON.message[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                                        } else if(xhr.responseJSON.message[key][1] != '') {
                                            validationAlert('Validation Error', xhr.responseJSON.message[key][1] || 'Validation failed', 'error', 5000, "OOP's");
                                        } else {
                                            validationAlert('Validation Error', xhr.responseJSON.message[key][2] || 'Validation failed', 'error', 5000, "OOP's");
                                        }
                                    }
                                }
                            } else if(xhr.responseJSON.message.permission != '') {
                                validationAlert('Already exist', xhr.responseJSON.message.permission || 'Already exist', 'error', 5000, "OOP's");
                            }
                            break;
                        case 2:
                            validationAlert('Error', 'Invalid module name selected.', 'error', 5000, "OOP's");
                            break;
                        default:
                            validationAlert('Error', response.message || 'Something went wrong.', 'error', 5000, "OOP's");
                            break;
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }



    function saveRolePermissionMapping(event) {
        event.preventDefault();
        let permissionIds = [];
        let roleId = document.getElementById('roleMappingId').value;
        $('#createRolePermissionMappingBtn').prop('disabled', true);

        document.querySelectorAll('input[name="permission_id[]"]:checked').forEach(function(checkbox) {
            permissionIds.push(checkbox.value);
        });

        if (roleId === '') {
            validationAlert('Missing role', 'Please select a role.', 'error', 2000, 'OK');
            $('#createRolePermissionMappingBtn').prop('disabled', false);
            return false;
        }

        if (permissionIds.length === 0) {
            validationAlert('Missing permission', 'Please select at least one permission.', 'error', 2000, 'OK');
            $('#createRolePermissionMappingBtn').prop('disabled', false);
            return false;
        }

        submitRolePermission(roleId, permissionIds);
    }

    function submitRolePermission(roleId, permissionIds) {
        $('#createRolePermissionMappingBtn').prop('disabled', false);
        let url = 'admin/authentication/role-permission/save';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                role_id: roleId,
                permission_id: permissionIds
            },
            success: function(res) {
                if(res.success == true && res.code == 200) {
                    $('#createRolePermissionMappingBtn').prop('disabled', false);
                    $('#roleId').val('');
                    document.querySelectorAll('input[name="permission_id[]"]').forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                    validationAlert('Role permission created', res.message, 'success', 5000, 'OK');
                    $('#addRolePermissionMapping').modal('hide');
                    loadData("rolePermission", '/admin/authentication/list/');
                }
            },
            error: function(xhr) {
                $('#createRolePermissionMappingBtn').prop('disabled', false);
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }
// Role permission mapping js end --


// Plan, Feature and Plan Feature Mapping Start
    function savePlan(e) { 
        e.preventDefault(); 
        $('.planBtn').prop('disabled', true); 
        const intPattern = /^\d+$/;
        
        let data = { 
            'plan_name'    : $("#plan_name").val().trim(), 
            'price'        : $("#price").val().trim(), 
            'duration_days': $("#duration_days").val().trim(), 
            'max_hospitals': $("#max_hospitals").val().trim(), 
            'max_firms'    : $("#max_firms").val().trim(), 
            'max_users'    : $("#max_users").val().trim(), 
        }; 

        // 2. Validation Rules Configuration Array
        const validationRules = [
            { key: 'plan_name',     type: 'required', label: 'plan name',     msg: 'Please enter a plan name.' },
            { key: 'price',         type: 'decimal',  label: 'price',         msg: 'Please enter a valid price (numbers only).' },
            { key: 'duration_days', type: 'integer',  label: 'duration days',  msg: 'Duration days must be a whole positive number.' },
            { key: 'max_hospitals', type: 'integer',  label: 'max hospitals',  msg: 'Max hospitals must be a whole positive number.' },
            { key: 'max_firms',     type: 'integer',  label: 'max firm location', msg: 'Max firms must be a whole positive number.' },
            { key: 'max_users',     type: 'integer',  label: 'max users',      msg: 'Max users must be a whole positive number.' }
        ];

        for (let rule of validationRules) {
            let value = data[rule.key];
            if (value === '') {
                validationAlert(`Missing ${rule.label}`, `Please enter ${rule.label}.`, 'error', 5000, 'OK');
                $('.planBtn').prop('disabled', false);
                return false;
            }

            // Price Type Check (Decimal/Positive Number)
            if (rule.type === 'decimal' && (isNaN(value) || Number(value) < 0)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.planBtn').prop('disabled', false);
                return false;
            }

            // Integer Count Check (Bina decimal wale number)
            if (rule.type === 'integer' && !intPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.planBtn').prop('disabled', false);
                return false;
            }
        }

        // 4. Submit Plan (Agar saari validation pass ho jayein)
        submitPlan(data.plan_name, data.price, data.duration_days, data.max_hospitals, data.max_firms, data.max_users);
    }


    function submitPlan(plan_name, price, duration_days, max_hospitals, max_firms, max_users) {
        let url = 'admin/plans/save';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                plan_name: plan_name,
                price: price,
                duration_days: duration_days,
                max_hospitals: max_hospitals,
                max_firms: max_firms,
                max_users: max_users
            },
            success: function(res) {
                if(res.success) {
                    $('.planBtn').prop('disabled', false);
                    $('#addPlan').modal('hide');
                    $("#plan_name").val(''), 
                    $("#price").val(''), 
                    $("#duration_days").val(''), 
                    $("#max_hospitals").val(''), 
                    $("#max_firms").val(''), 
                    $("#max_users").val(''), 
                    validationAlert('Plan created', res.message, 'success', 2000, 'OK');
                    loadData("plan", '/admin/plans/list/');
                }
            },
            error: function(xhr) {
                $('.planBtn').prop('disabled', false);
                $('#addPlan').modal('show');
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                }
            }
        });
    }


    function saveFeature(e) { 
        e.preventDefault(); 
        $('.featureBtn').prop('disabled', true); 
        let description = $("#description").val().trim(); 
        let data = { 
            'feature_name' : $("#feature_name").val().trim(), 
            'module_name'  : $("#module_name").val().trim(), 
        }; 

        const validationRules = [ 
            { key: 'feature_name', type: 'required', label: 'feature name', msg: 'Please enter a feature name.' }, 
            { key: 'feature_name', type: 'string',   label: 'feature name', msg: 'Feature name must contain characters only.' }, 
            { key: 'module_name',  type: 'required', label: 'module name',  msg: 'Please enter a module name.' }, 
            { key: 'module_name',  type: 'string',   label: 'module name',  msg: 'Module name must contain characters only.' }, 
        ]; 

        const strPattern = /^[a-zA-Z\s]+$/;
        for (let rule of validationRules) { 
            let value = data[rule.key]; 

            if (rule.type === 'required' && value === '') { 
                validationAlert(`Missing ${rule.label}`, rule.msg, 'error', 5000, 'OK'); 
                $('.featureBtn').prop('disabled', false); 
                return false; 
            } 

            if (rule.type === 'string' && value !== '' && !strPattern.test(value)) { 
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK'); 
                $('.featureBtn').prop('disabled', false); 
                return false; 
            } 
        } 
        submitPlan(data.feature_name, data.module_name, description); 
    }

    function submitPlan(feature_name, module_name, description) {
        let url = 'admin/plans/feature/save';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                feature_name: feature_name,
                module_name: module_name,
                description: description
            },
            success: function(res) {
                if(res.success) {
                    $('.featureBtn').prop('disabled', false);
                    $('#addFeature').modal('hide');
                    $("#feature_name").val('');
                    $("#module_name").val('');
                    $("#description").val('');
                    validationAlert('Feature created', res.message, 'success', 2000, 'OK');
                    loadData("feature", '/admin/plans/list/');
                }
            },
            error: function(xhr) {
                $('.featureBtn').prop('disabled', false);
                $('#addFeature').modal('show');
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                }
            }
        });
    }
    

    function savePlanFeatureMapping(event) {
        event.preventDefault();
        let featureIds = [];
        let planId = document.getElementById('plan_id').value;
        $('#createPlanFeatureMappingBtn').prop('disabled', true);

        document.querySelectorAll('input[name="feature_id[]"]:checked').forEach(function(checkbox) {
            featureIds.push(checkbox.value);
        });

        if (planId === '') {
            validationAlert('Missing plan', 'Please select a plan.', 'error', 2000, 'OK');
            $('#createPlanFeatureMappingBtn').prop('disabled', false);
            return false;
        }

        if(featureIds.length === 0) {
            validationAlert('Missing feature', 'Please select at least one feature.', 'error', 2000, 'OK');
            $('#createPlanFeatureMappingBtn').prop('disabled', false);
            return false;
        }
        // console.log(planId, featureIds);
        submitPlanFeatureMapping(planId, featureIds);
    }

    function submitPlanFeatureMapping(planId, featureIds) {
        $('#createPlanFeatureMappingBtn').prop('disabled', false);
        let url = 'admin/plans/plan-feature/save';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                plan_id: planId,
                feature_id: featureIds
            },
            success: function(res) {
                if(res.success == true && res.code == 200) {
                    $('#createPlanFeatureMappingBtn').prop('disabled', false);
                    $('#plan_id').val('');
                    document.querySelectorAll('input[name="permission_id[]"]').forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                    validationAlert('Feature plan created', res.message, 'success', 5000, 'OK');
                    $('#addPlanFeatureMapping').modal('hide');
                    loadData("planFeature", '/admin/plans/list/');
                }
            },
            error: function(xhr) {
                $('#createPlanFeatureMappingBtn').prop('disabled', false);
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }
// Plan, Feature and Plan Feature Mapping End


// Module JS Start --
    function saveModule(e) {
        e.preventDefault();
        $('.moduleBtn').prop('disabled', true);
        let module = $('#module_id').val();
        let module_icon = $('#parent_module_icon').val();
        if(module === '') {
            validationAlert('Missing module name', 'Please enter a module name.', 'error', 2000, 'OK');
            $('.moduleBtn').prop('disabled', false);
            return false;
        }
        submitModule(module, module_icon)
    }

    function submitModule(module, module_icon) {
        $('.moduleBtn').prop('disabled', false);
        let url = 'admin/authentication/module/save';
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: module,
                icon: module_icon,
            },
            success: function(res) {
                if(res.code == 200) {
                    $('.moduleBtn').prop('disabled', false);
                    $('#addModule').modal('hide');
                    $('#module_id').val('');
                    $('#parent_module_icon').val('');
                    validationAlert('Module created', 'Successfully created a new module.', 'success', 5000, 'OK');
                    loadData('module', '/admin/authentication/list/')
                }
            },
            error: function(xhr) {
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }

    function saveChildModule(e) {
        e.preventDefault();
        $('.childModuleBtn').prop('disabled', true);
        let parent_module_id = $('select#parent_module_id').val();
        let child_module_id = $('#child_module_id').val();
        let child_module_icon = $('#child_module_icon').val();
        if(parent_module_id === '') {
            validationAlert('Missing parent module name', 'Please enter a parent module name.', 'error', 2000, 'OK');
            $('.childModuleBtn').prop('disabled', false);
            return false;
        }
        if(child_module_id === '') {
            validationAlert('Missing module name', 'Please enter a module name.', 'error', 2000, 'OK');
            $('.childModuleBtn').prop('disabled', false);
            return false;
        }
        submitChildModule(parent_module_id, child_module_id, child_module_icon)
    }

    function submitChildModule(parent_module_id, child_module_id, child_module_icon) {
        $('.childModuleBtn').prop('disabled', false);
        let url = 'admin/authentication/child/module/save';
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                parent_id: parent_module_id,
                name: child_module_id,
                icon: child_module_icon,
            },
            success: function(res) {
                if(res.code == 200) {
                    $('.childModuleBtn').prop('disabled', false);
                    $('#addChildModule').modal('hide');
                    $('select#parent_module_id').val('');
                    $('#child_module_id').val('');
                    $('#child_module_icon').val('');
                    validationAlert('Child module created', 'Successfully created a new child module.', 'success', 5000, 'OK');
                    loadData('child-module', '/admin/authentication/list/')
                }
            },
            error: function(xhr) {
                $('.childModuleBtn').prop('disabled', false);
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }
// Module JS End --



// Customer Creation Start
    // Country change hone par states load karne ke liye
        $(document).on('change', '#country_name', function() {
            let countryId = $(this).val();
            let stateSelect = $('#state_name');
            stateSelect.html('<option value="">Loading...</option>'); // State dropdown ko khali karein aur placeholder lagayein
            if (countryId) {
                let url = 'admin/customer/state/' + countryId; // Laravel route URL generate karne ke liye string replace ka use karenge
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        stateSelect.html('<option value="">Select State Name</option>');
                        // Response loop chalakar dropdown fill karein
                        $.each(data, function(id, name) {
                            stateSelect.append('<option value="' + id + '">' + name + '</option>');
                        });

                        if (stateSelect.hasClass("select2-hidden-accessible")) {  // select2 ko refresh karna
                            stateSelect.trigger('change');
                        }
                    },
                    error: function() {
                        stateSelect.html('<option value="">Error loading states</option>');
                    }
                });
            } else {
                stateSelect.html('<option value="">Select State Name</option>');
            }
        });

        // state change hone par cities set hoga dropdown me
        $(document).on('change', '#state_name', function() {
            let stateId = $(this).val();
            let citySelect = $('#city_name');
            citySelect.html('<option value="">Loading...</option>'); // City dropdown ko khali karein aur placeholder lagayein
            if (stateId) {
                let url = 'admin/customer/city/' + stateId; // Laravel route URL generate karne ke liye string replace ka use karenge
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        citySelect.html('<option value="">Select City Name</option>');
                        // Response loop chalakar dropdown fill karein
                        $.each(data, function(id, name) {
                            citySelect.append('<option value="' + id + '">' + name + '</option>');
                        });

                        if (citySelect.hasClass("select2-hidden-accessible")) { // select2 ko refresh karna
                            citySelect.trigger('change');
                        }
                    },
                    error: function() {
                        citySelect.html('<option value="">Error loading cities</option>');
                    }
                });
            } else {
                citySelect.html('<option value="">Select City Name</option>');
            }
        });
    // Country change hone par states load karne ke liye


    function saveCustomer(e) { 
        e.preventDefault(); 
        $('.saveCustomerBtn').prop('disabled', true); 
        // Regex Patterns
        const intPattern = /^\d+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        let data = { 
            'customer_name'     : $("#customer_name").val().trim(), 
            'mobile_no'         : $("#mobile_no").val().trim(), 
            'alternate_mobile'  : $("#alternate_mobile").val().trim(), 
            'email'             : $("#emailDetails").val().trim(), 
            'website'           : $("#website").val().trim(), 
            'plan_name'         : $("#plan_name").val().trim(), 
            'is_hospital_clinic': $("#is_hospital_clinic").val().trim(), 
            'country_name'      : $("#country_name").val().trim(), 
            'state_name'        : $("#state_name").val().trim(), 
            'city_name'         : $("#city_name").val().trim(), 
            'address'           : $("#address").val().trim(), 
        }; 

        // Configuration rules
        const validationRules = [
            { key: 'customer_name',     type: 'string',  label: 'customer name' },
            { key: 'mobile_no',         type: 'integer', label: 'mobile number',            msg: 'Please enter a valid mobile (numbers only).' },
            { key: 'alternate_mobile',  type: 'integer', label: 'alternate mobile',         msg: 'Please enter a valid alternate mobile (numbers only).' },
            { key: 'email',             type: 'email',   label: 'email',                    msg: 'Please enter a valid email address.' },
            { key: 'website',           type: 'string',  label: 'website' },
            { key: 'plan_name',         type: 'integer', label: 'plan name',                msg: 'Please enter a valid mobile.' },
            { key: 'is_hospital_clinic',type: 'integer', label: 'hospital/clinic field',    msg: 'Please enter a valid mobile.' },
            { key: 'country_name',      type: 'integer', label: 'country name',             msg: 'Please enter a valid country name.' },
            { key: 'state_name',        type: 'integer', label: 'state name',               msg: 'Please enter a valid state name.' },
            { key: 'city_name',         type: 'integer', label: 'city name',                msg: 'Please enter a valid city name.' },
            { key: 'address',           type: 'string',  label: 'address' },
        ];

        for (let rule of validationRules) {
            let value = data[rule.key];
            if (value === '') {
                validationAlert(`Missing ${rule.label}`, `Please enter ${rule.label}.`, 'error', 5000, 'OK');
                $('.saveCustomerBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'integer' && !intPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.saveCustomerBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'email' && !emailPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.saveCustomerBtn').prop('disabled', false);
                return false;
            }
        }
        submitCustomer(data);
    }

    function submitCustomer(data) {
        let url = window.CustomerSubmitUrl; 
        data._token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token ko data object me add kar dein
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            success: function(res) {
                $('.saveCustomerBtn').prop('disabled', false);
                if(res.code == 200) {
                    validationAlert('Customer created', res.message, 'success', 2000, 'OK');
                    loadPage(window.CustomerListUrl);
                }
            },
            error: function(xhr) {
                $('.saveCustomerBtn').prop('disabled', false);
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }
// Customer Creation End





// Document Js Start --
    function addRow() {
        let html = `
        <div class="row documentRow">
            <div class="col-md-5 mb-3">
                <select name="file_type[]" class="form-control">
                    <option value="">Select</option>
                    <option value="marksheet">Marksheet</option>
                    <option value="aadhar">Aadhar</option>
                    <option value="pan_card">Pan Card</option>
                    <option value="bank_details">Bank Details</option>
                    <option value="address_proof">Address Proof</option>
                    <option value="licence">Licence</option>
                </select>
            </div>
            <div class="col-md-5 mb-3">
                <input type="file" name="document[]" class="form-control">
            </div>
            <div class="col-md-2 mt-2">
                <button type="button" class="btn btn-danger removeRow">Remove</button>
            </div>
        </div>
        `;
        $('#documentContainer').append(html);
    }

    $(document).on('click', '.removeRow', function () {
        $(this).closest('.documentRow').remove();
    });

    function saveAllDocuments(event) {
        event.preventDefault();

        let formData = new FormData(document.getElementById("documentForm"));

        $.ajax({
            url: '{{ route("your.route.name") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                validationAlert('Success', 'Documents uploaded successfully', 'success', 2000, false);
            },
            error: function (xhr) {
                validationAlert('Error', 'Failed to upload documents', 'error', 5000, false);
            }
        });
    }
// Document Js End --




// Pharmacy Management JS Start here
    function savePharmacyCustomer(e) { 
        e.preventDefault(); 
        $('.savePharmacyCustomerBtn').prop('disabled', true); 
        // Regex Patterns
        const intPattern = /^\d+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let data = { 
            'hospital_id'       : $("#hospital_id").val().trim(), 
            'firm_id'           : $("#firm_id").val().trim(), 
            'company_name'      : $("#company_name").val().trim(), 
            'name'              : $("#name").val().trim(), 
            'email'             : $("#email").val().trim(), 
            'contact'           : $("#contact").val().trim(), 
            'gst_no'            : $("#gst_no").val().trim(), 
            'pan_no'            : $("#pan_no").val().trim(), 
            'doctor_name'       : $("#doctor_name").val().trim(), 
            'doctor_address'    : $("#doctor_address").val().trim(), 
            'balance_type'      : $("#balance_type").val().trim(), 
            'party_type'        : $("#party_type").val().trim(), 
            'opening_balance'   : $("#opening_balance").val().trim(),
            'credit_limit'      : $("#credit_limit").val().trim(),
        }; 

        // Configuration rules
        const validationRules = [
            { key: 'company_name',    type: 'string',  label: 'company name' },
            { key: 'name',            type: 'string',  label: 'name' },
            { key: 'email',           type: 'email',   label: 'email' },
            { key: 'contact',         type: 'integer', label: 'contact number', msg: 'Please enter a valid contact (numbers only).' },
            { key: 'gst_no',          type: 'string',  label: 'gst no' },
            { key: 'pan_no',          type: 'string',  label: 'pan no' },
            { key: 'doctor_name',     type: 'string',  label: 'doctor name' },
            { key: 'doctor_address',  type: 'string',  label: 'doctor address' },
            { key: 'balance_type',    type: 'integer', label: 'balance type', msg: 'Please enter a valid balance type.' },
            { key: 'party_type',      type: 'integer', label: 'party type',    msg: 'Please enter a valid party type.' },
            { key: 'opening_balance', type: 'string',  label: 'opening balance' },
            { key: 'credit_limit',    type: 'string',  label: 'credit limit' },
        ];

        for (let rule of validationRules) {
            let value = data[rule.key];
            if (value === '') {
                validationAlert(`Missing ${rule.label}`, `Please enter ${rule.label}.`, 'error', 5000, 'OK');
                $('.savePharmacyCustomerBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'integer' && !intPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyCustomerBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'email' && !emailPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyCustomerBtn').prop('disabled', false);
                return false;
            }
        }
        submitPharmacyCustomer(data);
    }

    function submitPharmacyCustomer(data) {
        let url = window.PharmacyCustomerSubmitUrl; 
        data._token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token ko data object me add kar dein
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            success: function(res) {
                $('.savePharmacyCustomerBtn').prop('disabled', false);
                if(res.code == 200) {
                    validationAlert('Pharmacy customer created', res.message, 'success', 2000, 'OK');
                    loadPage(window.PharmacyCustomerListUrl);
                }
            },
            error: function(xhr) {
                $('.savePharmacyCustomerBtn').prop('disabled', false);
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }




    function savePharmacySupplier(e) { 
        e.preventDefault(); 
        $('.savePharmacySupplierBtn').prop('disabled', true); 
        // Regex Patterns
        const intPattern = /^\d+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let data = { 
            'hospital_id'       : $("#hospital_id").val().trim(), 
            'firm_id'           : $("#firm_id").val().trim(), 
            'company_name'      : $("#company_name").val().trim(), 
            'name'              : $("#name").val().trim(), 
            'email'             : $("#email").val().trim(), 
            'contact'           : $("#contact").val().trim(), 
            'gst_no'            : $("#gst_no").val().trim(), 
            'pan_no'            : $("#pan_no").val().trim(), 
            'doctor_name'       : $("#doctor_name").val().trim(), 
            'doctor_address'    : $("#doctor_address").val().trim(), 
            'balance_type'      : $("#balance_type").val().trim(), 
            'party_type'        : $("#party_type").val().trim(), 
            'opening_balance'   : $("#opening_balance").val().trim(), 
            'credit_days'       : $("#credit_days").val().trim(),
            'contact_person'    : $("#contact_person").val().trim(), 
            'drug_license_no'   : $("#drug_license_no").val().trim(), 
        }; 

        // Configuration rules
        const validationRules = [
            { key: 'company_name',    type: 'string',  label: 'company name' },
            { key: 'name',            type: 'string',  label: 'name' },
            { key: 'email',           type: 'email',   label: 'email' },
            { key: 'contact',         type: 'integer', label: 'contact number', msg: 'Please enter a valid contact (numbers only).' },
            { key: 'gst_no',          type: 'string',  label: 'gst no' },
            { key: 'pan_no',          type: 'string',  label: 'pan no' },
            { key: 'doctor_name',     type: 'string',  label: 'doctor name' },
            { key: 'doctor_address',  type: 'string',  label: 'doctor address' },
            { key: 'balance_type',    type: 'integer', label: 'balance type', msg: 'Please enter a valid balance type.' },
            { key: 'party_type',      type: 'integer', label: 'party type',    msg: 'Please enter a valid party type.' },
            { key: 'opening_balance', type: 'string',  label: 'opening balance' },
            { key: 'credit_days',     type: 'string',  label: 'credit days' },
            { key: 'contact_person',  type: 'string',  label: 'contact person' },
            { key: 'drug_license_no', type: 'string',  label: 'drug license no' },
        ];

        for (let rule of validationRules) {
            let value = data[rule.key];
            if (value === '') {
                validationAlert(`Missing ${rule.label}`, `Please enter ${rule.label}.`, 'error', 5000, 'OK');
                $('.savePharmacySupplierBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'integer' && !intPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacySupplierBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'email' && !emailPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacySupplierBtn').prop('disabled', false);
                return false;
            }
        }
        submitPharmacySupplier(data);
    }

    function submitPharmacySupplier(data) {
        let url = window.SupplierSubmitUrl; 
        data._token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token ko data object me add kar dein
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            success: function(res) {
                $('.savePharmacySupplierBtn').prop('disabled', false);
                if(res.code == 200) {
                    validationAlert('Supplier created', res.message, 'success', 2000, 'OK');
                    loadPage(window.SupplierListUrl);
                }
            },
            error: function(xhr) {
                $('.savePharmacySupplierBtn').prop('disabled', false);
                let response = xhr.responseJSON.data;
                if(response) {
                    for(let key in response) {
                        console.log(response[key][0]);
                        validationAlert('Validation Error', response[key][0] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }



    function savePharmacyVendor(e) {
        e.preventDefault(); 
        $('.savePharmacyVendorBtn').prop('disabled', true); 
        // Regex Patterns
        const intPattern = /^\d+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let data = { 
            'hospital_id'       : $("#hospital_id").val().trim(), 
            'firm_id'           : $("#firm_id").val().trim(), 
            'company_name'      : $("#company_name").val().trim(), 
            'name'              : $("#name").val().trim(), 
            'email'             : $("#email").val().trim(), 
            'contact'           : $("#contact").val().trim(), 
            'gst_no'            : $("#gst_no").val().trim(), 
            'pan_no'            : $("#pan_no").val().trim(), 
            'doctor_name'       : $("#doctor_name").val().trim(), 
            'doctor_address'    : $("#doctor_address").val().trim(),
            'drug_license_no'   : $("#drug_license_no").val().trim(), 
        }; 

        // Configuration rules
        const validationRules = [
            { key: 'company_name',    type: 'string',  label: 'company name' },
            { key: 'name',            type: 'string',  label: 'name' },
            { key: 'email',           type: 'email',   label: 'email' },
            { key: 'contact',         type: 'integer', label: 'contact number', msg: 'Please enter a valid contact (numbers only).' },
            { key: 'gst_no',          type: 'string',  label: 'gst no' },
            { key: 'pan_no',          type: 'string',  label: 'pan no' },
            { key: 'doctor_name',     type: 'string',  label: 'doctor name' },
            { key: 'doctor_address',  type: 'string',  label: 'doctor address' },
        ];

        for (let rule of validationRules) {
            let value = data[rule.key];
            if (value === '') {
                validationAlert(`Missing ${rule.label}`, `Please enter ${rule.label}.`, 'error', 5000, 'OK');
                $('.savePharmacyVendorBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'integer' && !intPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyVendorBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'email' && !emailPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyVendorBtn').prop('disabled', false);
                return false;
            }
        }
        submitPharmacyVendor(data);
    }

    function submitPharmacyVendor(data) {
        let url = window.PharmacyVendorSubmitUrl; 
        data._token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token ko data object me add kar dein
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            success: function(res) {
                $('.savePharmacyVendorBtn').prop('disabled', false);
                if(res.code == 200) {
                    validationAlert('Pharmacy vendor created', res.message, 'success', 2000, 'OK');
                    loadPage(window.PharmacyVendorListUrl);
                }
            },
            error: function(xhr) {
                $('.savePharmacyVendorBtn').prop('disabled', false);
                let response = xhr.responseJSON;
                if(response) {
                    for(let key in response) {
                        console.log(response[key]);
                        validationAlert('Validation Error', response[key] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }


    function savePharmacyMadicine(e) {
        e.preventDefault(); 
        $('.savePharmacyMadicineBtn').prop('disabled', true); 
        // Regex Patterns
        const intPattern = /^\d+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let data = { 
            'hospital_id'       : $("#hospital_id").val().trim(), 
            'firm_id'           : $("#firm_id").val().trim(), 
            'company_name'      : $("#company_name").val().trim(), 
            'name'              : $("#name").val().trim(), 
            'email'             : $("#email").val().trim(), 
            'contact'           : $("#contact").val().trim(), 
            'gst_no'            : $("#gst_no").val().trim(), 
            'pan_no'            : $("#pan_no").val().trim(), 
            'doctor_name'       : $("#doctor_name").val().trim(), 
            'doctor_address'    : $("#doctor_address").val().trim(),
            'drug_license_no'   : $("#drug_license_no").val().trim(), 
        }; 

        // Configuration rules
        const validationRules = [
            { key: 'company_name',    type: 'string',  label: 'company name' },
            { key: 'name',            type: 'string',  label: 'name' },
            { key: 'email',           type: 'email',   label: 'email' },
            { key: 'contact',         type: 'integer', label: 'contact number', msg: 'Please enter a valid contact (numbers only).' },
            { key: 'gst_no',          type: 'string',  label: 'gst no' },
            { key: 'pan_no',          type: 'string',  label: 'pan no' },
            { key: 'doctor_name',     type: 'string',  label: 'doctor name' },
            { key: 'doctor_address',  type: 'string',  label: 'doctor address' },
        ];

        for (let rule of validationRules) {
            let value = data[rule.key];
            if (value === '') {
                validationAlert(`Missing ${rule.label}`, `Please enter ${rule.label}.`, 'error', 5000, 'OK');
                $('.savePharmacyMadicineBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'integer' && !intPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyMadicineBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'email' && !emailPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyMadicineBtn').prop('disabled', false);
                return false;
            }
        }
        submitPharmacyMadicine(data);
    }

    function submitPharmacyMadicine(data) {
        let url = window.PharmacyMadicineSubmitUrl; 
        data._token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token ko data object me add kar dein
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            success: function(res) {
                $('.savePharmacyMadicineBtn').prop('disabled', false);
                if(res.code == 200) {
                    validationAlert('Pharmacy Madicine created', res.message, 'success', 2000, 'OK');
                    loadPage(window.PharmacyMadicineListUrl);
                }
            },
            error: function(xhr) {
                $('.savePharmacyMadicineBtn').prop('disabled', false);
                let response = xhr.responseJSON;
                if(response) {
                    for(let key in response) {
                        console.log(response[key]);
                        validationAlert('Validation Error', response[key] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }


    function savePharmacyBatchMadicine(e) {
        e.preventDefault(); 
        $('.savePharmacyBatchMadicineBtn').prop('disabled', true); 
        // Regex Patterns
        const intPattern = /^\d+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let data = { 
            'hospital_id'       : $("#hospital_id").val().trim(), 
            'firm_id'           : $("#firm_id").val().trim(), 
            'company_name'      : $("#company_name").val().trim(), 
            'name'              : $("#name").val().trim(), 
            'email'             : $("#email").val().trim(), 
            'contact'           : $("#contact").val().trim(), 
            'gst_no'            : $("#gst_no").val().trim(), 
            'pan_no'            : $("#pan_no").val().trim(), 
            'doctor_name'       : $("#doctor_name").val().trim(), 
            'doctor_address'    : $("#doctor_address").val().trim(),
            'drug_license_no'   : $("#drug_license_no").val().trim(), 
        }; 

        // Configuration rules
        const validationRules = [
            { key: 'company_name',    type: 'string',  label: 'company name' },
            { key: 'name',            type: 'string',  label: 'name' },
            { key: 'email',           type: 'email',   label: 'email' },
            { key: 'contact',         type: 'integer', label: 'contact number', msg: 'Please enter a valid contact (numbers only).' },
            { key: 'gst_no',          type: 'string',  label: 'gst no' },
            { key: 'pan_no',          type: 'string',  label: 'pan no' },
            { key: 'doctor_name',     type: 'string',  label: 'doctor name' },
            { key: 'doctor_address',  type: 'string',  label: 'doctor address' },
        ];

        for (let rule of validationRules) {
            let value = data[rule.key];
            if (value === '') {
                validationAlert(`Missing ${rule.label}`, `Please enter ${rule.label}.`, 'error', 5000, 'OK');
                $('.savePharmacyBatchMadicineBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'integer' && !intPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyBatchMadicineBtn').prop('disabled', false);
                return false;
            }
            
            if (rule.type === 'email' && !emailPattern.test(value)) {
                validationAlert(`Invalid ${rule.label}`, rule.msg, 'error', 5000, 'OK');
                $('.savePharmacyBatchMadicineBtn').prop('disabled', false);
                return false;
            }
        }
        submitPharmacyBatchMadicine(data);
    }

    function submitPharmacyBatchMadicine(data) {
        let url = window.PharmacyBatchMadicineSubmitUrl; 
        data._token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token ko data object me add kar dein
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            success: function(res) {
                $('.savePharmacyBatchMadicineBtn').prop('disabled', false);
                if(res.code == 200) {
                    validationAlert('Pharmacy batch madicine created', res.message, 'success', 2000, 'OK');
                    loadPage(window.PharmacyMadicineListUrl);
                }
            },
            error: function(xhr) {
                $('.savePharmacyBatchMadicineBtn').prop('disabled', false);
                let response = xhr.responseJSON;
                if(response) {
                    for(let key in response) {
                        console.log(response[key]);
                        validationAlert('Validation Error', response[key] || 'Validation failed', 'error', 5000, "OOP's");
                    }
                } else {
                    validationAlert('Error', 'Unexpected server error', 'error', 5000, "OOP's");
                }
            }
        });
    }
// Pharmacy Management JS end 




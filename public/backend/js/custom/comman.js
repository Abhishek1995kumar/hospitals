"use strict";
// let csrf = document.querySelector('meta[name="csrf-token"]');
// if(csrf) {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': csrf.getAttribute('content')
//         }
//     });
// }

// Common function to load records in a table with action buttons
    // function loadDatabaseRecord(url, type, columns, tableId, editFn, deleteFn, showFn, editModalId = '', showModalId = '', emptyMsg = 'No records found', responseKey='data') {
    function loadDatabaseRecord(url, type, columns, tableId, editFn, deleteFn, showFn, editModalId = '', showModalId = '', emptyMsg = 'No records found') {
        $.ajax({
            url: url,
            method: 'GET',
            success: function(res) {
                let records = [];
                let tbody = '';
                if (Array.isArray(res.data)) {
                    records = res.data;
                    $.each(records, function(index, record) {
                        tbody += '<tr>';
                        columns.forEach(function(column) {
                            if (column.data === 'no') {
                                tbody += `<td class="text-center">${index + 1}</td>`;

                            } else if (column.data === 'action') {
                                tbody += `
                                    <td class="text-center">
                                        <button type="button" 
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 editBtn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="${editModalId}" 
                                            data-id="${record.id}"
                                            data-modal="${editModalId}">
                                            ✏️
                                        </button>
                                        <button type="button" 
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 deleteBtn" 
                                            data-id="${record.id}">
                                            🗑️
                                        </button>
                                        <button type="button" 
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 showBtn" 
                                            data-id="${record.id}"
                                            data-modal="${showModalId}">
                                            👁️
                                        </button>

                                    </td>
                                `;

                            } else {
                                tbody += `<td class="text-center">${record[column.data] ?? ''}</td>`;
                            }

                        });

                        tbody += '</tr>';

                    });

                } 
                // else if(res.data && res.data[responseKey]) {
                //     alert("fshkjfhjk");
                //     records = res.data[responseKey];
                //     $.each(records, function(index, record) {
                //         tbody += '<tr>';
                //         columns.forEach(function(column) {
                //             if (column.data === 'no') {
                //                 tbody += `<td class="text-center">${index + 1}</td>`;

                //             } else if (column.data === 'action') {
                //                 tbody += `
                //                     <td class="text-center">
                //                         <button type="button" 
                //                             class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 editBtn" 
                //                             data-bs-toggle="modal" 
                //                             data-bs-target="${editModalId}" 
                //                             data-id="${record.id}"
                //                             data-modal="${editModalId}">
                //                             ✏️
                //                         </button>
                //                         <button type="button" 
                //                             class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 deleteBtn" 
                //                             data-id="${record.id}">
                //                             🗑️
                //                         </button>
                //                         <button type="button" 
                //                             class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 showBtn" 
                //                             data-id="${record.id}"
                //                             data-modal="${showModalId}">
                //                             👁️
                //                         </button>

                //                     </td>
                //                 `;

                //             } else {
                //                 tbody += `<td class="text-center">${record[column.data] ?? ''}</td>`;
                //             }

                //         });

                //         tbody += '</tr>';

                //     });

                // }
                else {
                    tbody = `<tr>
                                <td colspan="${columns.length}" class="text-center py-5">
                                    <img src="/backend/images/5.png"
                                        alt="No Record Found"
                                        width="400"
                                        height="200"
                                        class="mb-3">
                                    <p class="text-muted">${emptyMsg}</p>
                                </td>
                            </tr>`;
                }

                $(`${tableId} tbody`).html(tbody);

            }
        });

    }

    function editRecord(btn){
        let recordId = $(btn).data('id');
        let recordName = $(btn).data('name');
        let modal = $(btn).data('modal');
        $(modal).modal('show');
    }

    function deleteRecord(e, btn){

    }

    function showRecord(e, btn){

    }


// sweetalert 
    function validationAlert(title, text, icon, timer, confirmButtonText, showConfirmButton) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            timer: timer,
            confirmButtonText: confirmButtonText,
            showConfirmButton: showConfirmButton === undefined ? true : showConfirmButton,
        });
    }


// Accept Only Number function start 
    const acceptOnlyNumber = (event) => {
        const input = event.target;
        const value = input.value;
        input.value = value.replace(/\D/g, '');
        if (input.value.length >= 10) {
            input.value = input.value.substring(0, 10);
            event.preventDefault();
        } else {
            validationAlert('Invalid Input', "Please enter a valid " + (input.placeholder || input.name) + "\nonly numbers are allowed.", 'error', 2000, 'OK');
        }
    };


// Accept Only String function start
    const stringValidation = (event) => {
        const input = event.target;
        // console.log(`Input field: ${input.placeholder || input.name}`, `Value: ${input.value}`);
        const value = input.value;
        const regex = /^[a-zA-Z][a-zA-Z0-9\s.,-]*$/;
        if (!regex.test(value)) {
            input.value = '';
            Swal.fire({
                title: 'Invalid Input',
                text: "Please enter a valid " + (input.placeholder || input.name) + "\nonly alphanumeric characters, spaces, commas, periods, and hyphens are allowed.",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            // console.log(`Valid input for ${input.placeholder || input.name}: ${input.value}`);
        }
    };   


// flatpickr calendar function start
    const openFlatpickr = (event) => {
        let input = event.target;
        // Agar user ne flatpickr dwara banaye gaye visual input par click kiya hai, toh hum log uske original input ko target karenge:
        if (input._flatpickr) {
            input._flatpickr.open();
            return;
        }

        // Arrays for restrictions
        let blockNextDateArrays = ['mfg_date']; // Past-only
        let blockBackDateArrays = ['expiry_date']; // Future-only
        let fromDateArray = ['leave_start_date', 'perchase_date', 'previous_doj_1', 'holiday_start_date']; // fromDateArray ka date indexing aur toDateArray ka date indexing same hona chahiye tab hi work karega
        let toDateArray = ['leave_end_date', 'assigned_date', 'previous_doe_1', 'holiday_end_date'];
        let options = {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: "d F Y",
            allowInput: true
        };

        if (input.id === "leave_date") {
            // Normal leave date
        } else if (fromDateArray.includes(input.id)) {
            options.onChange = function (selectedDates) {
                if (selectedDates.length > 0) {
                    let fromDate = selectedDates[0];
                    let fromIndex = fromDateArray.indexOf(input.id);
                    let toFieldId = toDateArray[fromIndex];
                    let toDateInput = document.getElementById(toFieldId);

                    if (toDateInput) {
                        toDateInput.removeAttribute("disabled");

                        if (toDateInput._flatpickr) {
                            toDateInput._flatpickr.destroy();
                        }
                        toDateInput._flatpickr = flatpickr(toDateInput, {
                            dateFormat: 'Y-m-d',
                            altInput: true,
                            altFormat: "d F Y",
                            allowInput: true,
                            minDate: fromDate
                        });
                    }
                }
            };
        } else if (blockNextDateArrays.includes(input.id)) {
            options.maxDate = 'today';

        } else if (blockBackDateArrays.includes(input.id)) {
            options.minDate = 'today';

        } else { // Agar koi unknown field id aati hai toh initialize na karein
            return;
        }

        let fpInstance = flatpickr(input, options); // Flatpickr ko properly assign karke open karein
        
        
        if (fpInstance) { // Auto-open calendar
            fpInstance.open();
        }
    };


// Show Three Month Befrore From Crruent Month And One Month After function start
    const showThreeMonthBefroreFromCrruentMonthAndOneMonthAfter = (event) => {
        const input = event.target;
        if (input.type !== 'text') {
            console.warn(`Input field with ID ${input.id} is not a text date input.`);
            return;
        }
        if (!input._flatpickr) {
            const today = new Date();
            const threeMonthsBefore = new Date(today.getFullYear(), today.getMonth() - 3, 1);
            const oneMonthAfter = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            input._flatpickr = flatpickr(input, {
                dateFormat: 'Y-m-d',
                allowInput: true,
                minDate: threeMonthsBefore,
                maxDate: oneMonthAfter,
                onChange: function (selectedDates, dateStr) {
                    input.value = dateStr;
                }
            }); 
        }
        input._flatpickr.open();
    }


// Time Picker function start
    const timePicker = (event) => {
        const input = event.target;
        if (input.type !== 'text') {
            console.warn(`Input field with ID ${input.id} is not a text time input.`);
            return;
        }
        if (!input._flatpickr) {
            input._flatpickr = flatpickr(input, {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
                time_24hr: false,
                allowInput: true,
                defaultDate: "01:45 PM",
                onChange: function (selectedDates, dateStr) {
                    input.value = dateStr;
                }
            });
        }
        input._flatpickr.open();
    }



// Automatically calculate hours from the date input
    // document.addEventListener('DOMContentLoaded', function() {
        function calculateTotalHour() {
            let inTime = document.getElementById('in_time_outdoor').value;
            let outTime = document.getElementById('out_time_outdoor').value;
            inTime = inTime.split(' ')[0];
            outTime = outTime.split(' ')[0];
            const totalHourInput = document.getElementById('total_hour_outdoor');
            if (inTime && outTime) {
                const [inHour, inMin] = inTime.split(':').map(Number);
                const [outHour, outMin] = outTime.split(':').map(Number);
                let start = new Date();
                let end = new Date();
                start.setHours(inHour, inMin, 0, 0);
                end.setHours(outHour, outMin, 0, 0);
                let diff = (end - start) / 1000 / 60 / 60;
                if (diff < 0) diff += 24;
                totalHourInput.value = diff.toFixed(2);
            } else {
                totalHourInput.value = '';
            }
        }
    //     document.getElementById('in_time_outdoor').addEventListener('change', calculateTotalHour);
    //     document.getElementById('out_time_outdoor').addEventListener('change', calculateTotalHour);
// });


// Multi Select Flatpickr Calendar function start
    const multiSelectFlatpickrCalendar = (event) => {
        const input = event.target;
        if (input.type !== 'text') {
            console.warn(`Input field with ID ${input.id} is not a text date input.`);
            return;
        }
        if (!input._flatpickr) {
            // Calculate current year last date (December 31)
            const today = new Date();
            const lastDate = new Date(today.getFullYear(), 11, 31); // month is 0-indexed

            input._flatpickr = flatpickr(input, {
                mode: "multiple",
                dateFormat: 'Y-m-d',
                allowInput: true,
                minDate: today,
                maxDate: lastDate,
                conjunction: " , ",
                onChange: function (selectedDates, dateStr) {
                input.value = dateStr;
                }
            });
        }
        input._flatpickr.open();
    };



// agar date picker automatically open hi rakhna hai tab onclick ki jagah onfocus use karein
    const initFlatpickrCalendar = (event) => {
        const input = document.getElementById('apply_leave');
        if (!input._flatpickr) {
            input._flatpickr = flatpickr(input, {
                inline: true,
                mode: "multiple",
                dateFormat: 'Y-m-d',
                allowInput: true,
                minDate: "today",
                conjunction: " , ",
                maxDate: new Date().fp_incr(365),
                onChange: function (selectedDates, dateStr) {
                    input.value = dateStr;
                }
            });
        }
        input._flatpickr.open();
    };


// Handle Checkbox Selection and Show/Hide Divs
    function handleTypeCheckbox(type) {
        let fixedCheckbox = document.getElementById('select_fixed_type');
        let percentageCheckbox = document.getElementById('select_percentage_type');
        if (type === 'fixed_amount_div') {
            if (fixedCheckbox.checked) {
                percentageCheckbox.checked = false;
                ifcheckThanShowDiv(fixedCheckbox, 'fixed_amount_div');
                ifcheckThanShowDiv(percentageCheckbox, 'percentage_amount_div');
            }
        } else if (type === 'percentage_amount_div') {
            if (percentageCheckbox.checked) {
                fixedCheckbox.checked = false;
                ifcheckThanShowDiv(percentageCheckbox, 'percentage_amount_div');
                ifcheckThanShowDiv(fixedCheckbox, 'fixed_amount_div');
            }
        }


        let singleLeaveTypeCheckbox = document.getElementById('single_leave_type');
        let multipleLeaveTypeCheckbox = document.getElementById('multiple_leave_type');
        if (type === 'single_leave_type_div') {
            if (singleLeaveTypeCheckbox.checked) {
                multipleLeaveTypeCheckbox.checked = false;
                ifcheckThanShowDiv(singleLeaveTypeCheckbox, 'single_leave_type_div');
                ifcheckThanShowDiv(multipleLeaveTypeCheckbox, 'multiple_leave_type_div');
            }
        } else if (type === 'multiple_leave_type_div') {
            if (multipleLeaveTypeCheckbox.checked) {
                singleLeaveTypeCheckbox.checked = false;
                ifcheckThanShowDiv(multipleLeaveTypeCheckbox, 'multiple_leave_type_div');
                ifcheckThanShowDiv(singleLeaveTypeCheckbox, 'single_leave_type_div');
            }
        }

        // Handle fixed time checkboxes start --
            let yesFixed = [], noFixed = [];
            for (let i = 1; i <= 8; i++) {
                yesFixed.push(document.getElementById('fixed_time_yes_' + i));
                noFixed.push(document.getElementById('fixed_time_no_' + i));
            }
            // YES case
            if (type.startsWith('fixed_time_div')) {
                let index = type.split('_').pop();
                if (yesFixed[index - 1].checked) {
                    noFixed[index - 1].checked = false;
                    document.getElementById('fixed_time_div_' + index).style.display = 'block';
                } else {
                    document.getElementById('fixed_time_div_' + index).style.display = 'none';
                }
            }
            // NO case
            if (type.startsWith('no_fixed_time_div')) {
                for (let i = 1; i <= 8; i++) {
                    yesFixed[i - 1].checked = false;
                    document.getElementById('fixed_time_div_' + i).style.display = 'none';
                }
            }
        // Handle fixed time checkboxes end --


        // Handle late applicable checkboxes start --
            let yesLate = document.getElementById('yes_late_applicable');
            let noLate = document.getElementById('no_late_applicable');
            if (type === 'yes_late_woking_applicable_div') {
                noLate.checked = false;
                ifcheckThanShowDiv(yesLate, 'yes_late_woking_applicable_div');
                ifcheckThanShowDiv(noLate, 'no_late_woking_applicable_div');

            } else if (type === 'no_late_woking_applicable_div') {
                yesLate.checked = false;
                ifcheckThanShowDiv(noLate, 'no_late_woking_applicable_div');
                ifcheckThanShowDiv(yesLate, 'yes_late_woking_applicable_div');
            }
        // Handle late applicable checkboxes end --
        

        // Handle leave applicable checkboxes start --
            let yesLeave = document.getElementById('yes_accrued_period');
            let noLeave = document.getElementById('no_accrued_period');
            if (type === 'yes_accrued_period_div') {
                noLeave.checked = false;
                ifcheckThanShowDiv(yesLeave, 'yes_accrued_period_div');
                ifcheckThanShowDiv(noLeave, 'no_accrued_period_div');

            } else if (type === 'no_accrued_period_div') {
                yesLeave.checked = false;
                ifcheckThanShowDiv(noLeave, 'no_accrued_period_div');
                ifcheckThanShowDiv(yesLeave, 'yes_accrued_period_div');
            }
        // Handle leave applicable checkboxes end --

        // Handle Leaves Carry Forward checkboxes start --
            for (let i = 1; i <= 8; i++) {
                if (type === 'yes_carry_forward_' + i) {
                    alert('yes_carry_forward_' + i);
                    document.getElementById('no_carry_forward_' + i).checked = false;
                }
                if (type === 'no_carry_forward_' + i) {
                    document.getElementById('yes_carry_forward_' + i).checked = false;
                }
            }
        // Handle Leaves Carry Forward checkboxes end --
    }


// Show/Hide Div based on checkbox state
    const ifcheckThanShowDiv = (checkboxElement, divId) => {
        let targetDiv = document.getElementById(divId);
        if (checkboxElement.checked) {
            targetDiv.style.display = 'block';
        } else {
            targetDiv.style.display = 'none';
        }
    };



// when user submit form tab check validation 
    function checkRequiredFields(formId, saveButtonId) {
        const form = document.getElementById(formId);
        const saveButton = document.getElementById(saveButtonId);
        let allFilled = true;
        let missingFields = [];

        form.querySelectorAll("[required]").forEach(input => {
            if (!input.value.trim()) {
                allFilled = false;
                // Label > placeholder > name > id
                let label = "";
                if (input.labels && input.labels.length > 0) {
                    label = input.labels[0].innerText;
                } else {
                    label = input.getAttribute("placeholder") || input.getAttribute("name") || input.id || "Unnamed field";
                }

                missingFields.push(label);
            }
        });

        if (allFilled) {
            saveButton.style.display = "block";
            saveButton.disabled = false;

        } else {
            saveButton.style.display = "none";
            if (missingFields.length > 0) {
                let message = "<b>Please fill the following fields:</b><ul style='text-align:left;'>";
                missingFields.forEach(f => {
                    message += `<li>${f}</li>`;
                });
                message += "</ul>";
                validationAlert("Missing Fields", message, "warning");
            }
        }
    }

    function validateBeforeSubmit(formId, saveButtonId) {
        const form = document.getElementById(formId);
        const saveButton = document.getElementById(saveButtonId);
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            let allFilled = true;
            let missingFields = [];
            form.querySelectorAll("[required]").forEach(input => {
                if (!input.value.trim()) {
                    allFilled = false;
                    let label = "";
                    if (input.labels && input.labels.length > 0) {
                        label = input.labels[0].innerText;
                    } else {
                        label = input.getAttribute("placeholder") || input.getAttribute("name") || input.id || "Unnamed field";
                    }
                    missingFields.push(label);
                }
            });

            if (!allFilled) {
                let message = "<b>Please fill the following fields:</b><ul style='text-align:left;'>";
                missingFields.forEach(f => {
                    message += `<li>${f}</li>`;
                });
                message += "</ul>";

                validationAlert("Missing Fields", message, "warning");
                return false;
            }

            // Disable save button to prevent multiple submits
            saveButton.disabled = true;
            saveButton.innerText = "Saving...";
            // Finally submit form
            form.submit();
        });
    }
// when user submit form tab check validation 


// Excel download and upload button hide show start --
    $('#userUploadBtnId').show();
    const excelSampleDownload = (event, url, uploadBtnId) => {
        event.preventDefault();
        let anchorTagId;
        if (event.target.tagName === 'A') {
            anchorTagId = event.target.id;
        } else {
            // In case clicked element is inside <a> (like <span> or <i>)
            anchorTagId = $(event.target).closest('a').attr('id');
        }

        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                if (response.success === true && response.code === 0) {
                    validationAlert('Excel generate', 'Successfully generated sample excel sheet.', 'success', 2000, 'OK');
                    $('#' + anchorTagId).hide(); // Hide current download button
                    if (uploadBtnId) {
                        $('#' + uploadBtnId).show(); // Show the related upload button (passed dynamically)
                    }
                    
                    window.location.href = response.download_url; // Trigger actual download
                } else {
                    validationAlert('Error', response.message || 'Failed to generate excel.', 'error', 2000, 'OK');
                    $('#' + anchorTagId).show(); // Show current download button
                }
            },
            error: function () {
                validationAlert('Error', 'Something went wrong during excel generation.', 'error', 2000, 'OK');
                $('#' + anchorTagId).show(); // Show current download button
            }
        });
    };


    // Jab file select ho jaye
    const triggerUserCreateExcelFile = (event, url, id, fileId) => {
        event.preventDefault();
        let uploadBtnId;
        if (event.target.tagName === 'BUTTON') {
            uploadBtnId = event.target.id;
        } else {
            uploadBtnId = $(event.target).closest('button').attr('id');
        }

        const fileInput = $('#' + fileId);
        fileInput.click();

        fileInput.off('change').on('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            let formData = new FormData();
            formData.append('file', file); // use same key as backend expects

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success === true && response.code === 0) {
                        validationAlert('Excel generate', 'Successfully uploaded sample excel sheet.', 'success', 2000, 'OK');
                        $('#' + uploadBtnId).hide();
                        if (id) $('#' + id).show();
                        window.location.href = response.download_url;
                    } else {
                        validationAlert('Error', response.message || 'Failed to upload excel.', 'error', 2000, 'OK');
                        $('#' + uploadBtnId).show();
                    }
                },
                error: function () {
                    validationAlert('Error', 'Something went wrong during excel upload.', 'error', 2000, 'OK');
                    $('#' + uploadBtnId).show();
                }
            });
        });
    };

// Excel download and upload button hide show end --



// Comman Delete Function Start --
    function deleteDetails(event, url) {
        event.preventDefault();
        let button = $(event.currentTarget);
        let id = button.data('id');
        let module = button.data('module') || 'record';
        if (!id) {
            alert('Missing record ID.');
            return;
        } else {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: `Are you sure you want to delete this ${module}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id
                        },
                        success: function(res) {
                            if(res.success === true) {
                                validationAlert('Deleted', `Successfully deleted the ${module}.`, 'success', 2000, 'OK');
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                validationAlert('Error', res.message || `Failed to delete the ${module}.`, 'error', 2000, 'OK');
                            }
                        }
                    });
                } else if ( result.dismiss === Swal.DismissReason.cancel) {
                    validationAlert('Error', res.message || `Failed to delete the ${module}.`, 'error', 2000, 'OK');
                };
            });
        }
    }
// Comman Delete Function End -- 




// data list Start --
    function loadData(type, url) {
        $.ajax({
            url: url,
            data: {
                type: type
            },
            success:function(response){
                let data = typeof response.data === 'string' ? JSON.parse(response.data) : response.data;
                let html = '';
                if(type == 'customer'){
                    data.forEach(function(customer) {
                        html += `<tr>
                                <td class="text-center"> + ${customer.id} + </td>
                                <td class="text-center"> + ${customer.name} + </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" onclick="editCustomer(' + ${customer.id} + ')">Edit</button>
                                    <button class="btn btn-sm btn-primary" onclick="deleteCustomer(' + ${customer.id} + ')">Delete</button>
                                </td>
                            </tr>`;
                    });
                    $('#customerTable tbody').html(html);
                }

                if(type == 'permissions'){
                    response.forEach(function(permission) {
                        html += '<tr>';
                        html += '<td class="text-center">' + permission.id + '</td>';
                        html += '<td class="text-center">' + permission.name + '</td>';
                        html += '</tr>';
                    });
                    $('#permissionTable tbody').html(html);
                }

                if(type == 'rolePermission'){
                    response.forEach(function(rolePermission) {
                        html += '<tr>';
                        html += '<td class="text-center">' + rolePermission.role.id + '</td>';
                        html += '<td class="text-center">' + rolePermission.role.name + '</td>';
                        html += '<td class="text-center">' + rolePermission.permission.id + '</td>';
                        html += '<td class="text-center">' + rolePermission.permission.name + '</td>';
                        html += '</tr>';
                    });
                    $('#rolePermissionTable tbody').html(html);
                }
            }
        });
    }
// data list End --



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

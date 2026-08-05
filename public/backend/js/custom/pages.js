
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


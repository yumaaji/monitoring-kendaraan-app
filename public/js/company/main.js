$(document).ready(function() {
    $('.show-details-btn').on('click', function() {
        var companyId = $(this).data('id');
        
        // Menentukan perusahaan yang ditampilkankan
        $.ajax({
            url: '/company/' + companyId,
            method: 'GET',
            success: function(data) {
                // Populate the modal with the company data
                $('#modalCompanyName').val(data.name);
                $('#modalCompanyRole').val(data.role_company);
                $('#modalCompanyAddress').val(data.address);
            },
            error: function() {
                alert('Failed to fetch company details.');
            }
        });
    });
});

$(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var companyId = $(this).data('id');

        // Set the action attribute of the form
        $('#editCompanyForm').attr('action', '/company/' + companyId);

        // Make an AJAX request to get the company data
        $.ajax({
            url: '/company/' + companyId,
            method: 'GET',
            success: function(data) {
                // Populate the modal with the company data
                $('#editCompanyName').val(data.name);
                $('#editCompanyAddress').val(data.address);
                $('#editCompanyRole').val(data.role_company);
            },
            error: function() {
                alert('Failed to fetch company details.');
            }
        });
    });
});
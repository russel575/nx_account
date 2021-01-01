(function($) {

    // Insert nx entry Goal using ajax
    $('#addNewEntry').on('click', function(e) {
        e.preventDefault();
        
        var postDate = $('#addNewEntryForm').serialize() + "&action=nx_account_manager_ajax_request&param=insert_new_entry";
        $.post(nx_account_manager_ajax_url, postDate, function(response) {

            var data = $.parseJSON(response);
            if(data.status == 1){
                alertify.success(data.message, 'success');
                setTimeout(function()  {
                    location.reload();
                    }, 1000);
            }else{
                alertify.error(data.message);
            }
           
            
        });
    }); // End Insert data using ajax     
    

    // Delete nx entry data
    $('#nx_entry_list_table').on('click', '#nx_entry_delete', function(e){
        e.preventDefault();
        var con = confirm('Are you sure want to delete data?');
        if (con) {
            var dataId = $(this).attr('data-id');
            var postDate = "action=nx_account_manager_ajax_request&param=delete_new_entry&id=" + dataId;
            $.post(nx_account_manager_ajax_url, postDate, function(response) {

                var data = $.parseJSON(response);

                if(data.status == 1){
                    alertify.success(data.message, 'success');
                }else{
                    alertify.error(data.message);
                }
            });

            var tr = $(this).closest("tr");
            tr.css("background-color", "#FF3700");
            tr.fadeOut(1000, function() {
                tr.remove();
            });
        }
        return false;
    });
   
       /* ============ update nx entry data ============== */
       $('.nx-edit-icon').on('click', function() {
        var id = $(this).attr('data-id');
        var postdata = "action=nx_account_manager_ajax_request&param=show_nx_entry_data&id=" + id;
        $.post(nx_account_manager_ajax_url, postdata, function(response) {
            var data = $.parseJSON(response);
            var ID = $('#en_id').val(data.en_id);
            var member_id = $('#loan_member_id').val(data.en_loan_member_id);
            $('#en_date').val(data.en_date);
            
            if(data.en_earn_cost == 'earn'){

                $('#en_earn').prop('checked',true);

            }else if(data.en_earn_cost == 'cost'){

                $('#en_cost').prop('checked',true);

            }

            $('#en_purpose').val(data.en_purpose);
            $('#loan_member_name').val(data.member_name);
            
            if(data.en_currency == 'dollar'){

                $('#en_dollar').prop('checked',true);

            }else if(data.en_currency == 'taka'){

                $('#en_taka').prop('checked',true);
            }

            $('#en_amount_taka').val(data.en_amount_taka);
            $('#en_amount_dollar').val(data.en_amount_dollar);

            $('#update_modal').modal('show');

        });
    });
    

    $('#UpdateEntry').on('click', function(e) {
        e.preventDefault();
        var id = $('#en_id').val();
        var postDate = $('#UpdateEntryForm').serialize() + "&action=nx_account_manager_ajax_request&param=edit_entry&id=" + id;
        $.post(nx_account_manager_ajax_url, postDate, function(response) {
            var data = $.parseJSON(response);
            if(data.status == 1){
                alertify.success(data.message, 'success');
            }else{
                alertify.error(data.message);
            }
            setTimeout(function() 
            {
              location.reload();
            
            }, 1000);
        })
    });

    // Search date wise
    $('#date_search_btn').on('click', function() {
        //e.preventDefault();
        //$('.loader-icon').show();
        var postDate = $('#dateSearchForm').serialize() + "&action=nx_account_manager_ajax_request&param=search_date_wise";
        $.post(nx_account_manager_ajax_url, postDate, function(response) {
        

        });
    }); // End Search date wise


    // Insert add new member using ajax
    $('#addNewMember').on('click', function(e) {
        e.preventDefault();
        //$('.loader-icon').show();
        var postDate = $('#addNewMemberForm').serialize() + "&action=nx_account_manager_ajax_request&param=insert_new_member";
        $.post(nx_account_manager_ajax_url, postDate, function(response) {
            var data = $.parseJSON(response);
            if(data.status == 1){
                alertify.success(data.message,'success');
            }else{
                alertify.error(data.message);
            }
            setTimeout(function() 
            {
              location.reload();  //Refresh page
            }, 1000);

            
        });
    }); // End add new member using ajax

    $('.member_edit_icon').on('click', function(){
        var id = $(this).attr('data-id');
        var postdata = "action=nx_account_manager_ajax_request&param=show_member_data&id=" + id;
        $.post(nx_account_manager_ajax_url, postdata, function(response) {
            var data = $.parseJSON(response);
            $('#u_member_id').val(data.member_id)
            $('#u_member_name').val(data.member_name);
            $('#u_member_join_date').val(data.member_join_date);

            $('#edit_member_modal').modal('show');

        });
    });

    $('#editMember').on('click', function(e) {
        e.preventDefault();
        var id = $('#u_member_id').val();
        var postDate = $('#editMemberForm').serialize() + "&action=nx_account_manager_ajax_request&param=edit_member&id=" + id;
        $.post(nx_account_manager_ajax_url, postDate, function(response) {

            var data = $.parseJSON(response);

            if(data.status == 1){
                alertify.success(data.message, 'success');
            }else{
                alertify.error(data.message);
            }

            setTimeout(function() 
            {
              location.reload();
            
            }, 1000);
            
        })
    });

    // Delete member data
    $('.membertable').on('click', '#member-delete-icon', function(e){
        e.preventDefault();
        var con = confirm('Are you sure want to delete data?');
        if (con) {
            var dataId = $(this).attr('data-id');
            var postDate = "action=nx_account_manager_ajax_request&param=delete_member&id=" + dataId;
            $.post(nx_account_manager_ajax_url, postDate, function(response) {
                var data = $.parseJSON(response);

                if(data.status == 1){
                    alertify.success(data.message, 'success');
                }else{
                    alertify.error(data.message);
                }
            });

            var tr = $(this).closest("tr");
            tr.css("background-color", "#FF3700");
            tr.fadeOut(1000, function() {
                tr.remove();
            });
        }
        return false;
    });

    // Signle member show entry data

    $('.nx-edit-icon').on('click', function() {
        var id = $(this).attr('data-id');
        var postdata = "action=nx_account_manager_ajax_request&param=show_single_member_entry_data&id=" + id;
        $.post(nx_account_manager_ajax_url, postdata, function(response) {
            
            var data = $.parseJSON(response);
            var ID = $('#single_member_entry_id').val(data.en_id);
            
            $('#single_member_entry_date').val(data.en_date);
            
            if(data.en_earn_cost == 'earn'){

                $('#single_member_entry_earn').prop('checked',true);

            }else if(data.en_earn_cost == 'cost'){

                $('#single_member_entry_cost').prop('checked',true);

            }

            $('#single_member_entry_purpose').val(data.en_purpose);
            $('#single_member_entry_amount_taka').val(data.en_amount_taka);
            if(data.en_currency == 'taka'){
                $('#single_member_entry_currency_taka').prop('checked',true);
            }
            
            $('#updateSingleMemberModal').modal('show');

        });
    });

    $('#UpdateSinglememberEntry').on('click', function(e) {
        e.preventDefault();
        var id = $('#single_member_entry_id').val();
        var postDate = $('#UpdateSingleMemberForm').serialize() + "&action=nx_account_manager_ajax_request&param=single_member_edit_entry&id=" + id;
        $.post(nx_account_manager_ajax_url, postDate, function(response) {

            var data = $.parseJSON(response);

            if(data.status == 1){
                alertify.success(data.message, 'success');
            }else{
                alertify.error(data.message);
            }

            setTimeout(function() 
            {
              location.reload();
            
            }, 1000);
            
        })
    });

     

    



})(jQuery);

<?php
    $page = 'members';

    $show_member = Nx_Account_Manager_Controller::show_member();
   
?>
<!-- include header and sidebar -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/header.php'; ?>
<!--/ include header and sidebar -->


<div class="container-fluid" id="dvContents">
 
    <div class="row t mt-4">
        <button class="btn btn-primary nx-add-new-btn add-new-member" data-toggle="modal" data-target=".add_new_member_modal">Add Member</button>
    </div>

    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-md-12">
                    <table class="display table membertable" id="nx_entry_list_table" width="100%">
                        <thead>
                            <tr>
                                <th>Members Name</th>
                                <th>Join Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                foreach($show_member as $data):
                                    //print_r($data);die;
                            ?>
                            <tr>
                                <td><?php echo esc_attr($data['member_name']); ?></td>
                                <td><?php echo esc_attr($data['member_join_date']); ?></td>
                                <td></td>
                                <td>
                                    <a href="<?php admin_url()?>admin.php?page=nx_single_member&member_id=<?php echo $data['member_id']?>" target="_blank"><span class="dashicons dashicons-visibility nx-view-icon"></span></a> ||

                                    <a href="javascrip:void(0)"><span data-id="<?php echo esc_attr($data['member_id']); ?>" id="member_edit_icon" class="dashicons dashicons-edit-large nx-edit-icon member_edit_icon"></span></a> ||

                                    <a href="javascrip:void(0)"><span data-id="<?php echo esc_attr($data['member_id']); ?>" id="member-delete-icon" class="dashicons dashicons-trash nx-delete-icon"></span></a>
                                </td>
                 
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>


<!-- include footer -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/footer.php'; ?>
<!--/ include footer -->

<!-- Insert member Modal -->
<div class="modal fade add_new_member_modal" id="add_new_member_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="" method="post" id="addNewMemberForm">
            <table id="addNewEntrytable" class="table table-borderless modal-entry-table">

                <tr>
                    <td>Member Name</td>
                    <td> <input required name="member_name" autocomplete="off" class="form-control" type="text"> </td>
                </tr>
                
                <tr>
                    <td>Join Date</td>
                    <td> <input required name="member_join_date" autocomplete="off" class="form-control nx-datepicker" type="text"> </td>
                </tr>

            </table>
        
      </div>

      <div class="modal-footer">
        <button type="submit" id="addNewMember" class="btn btn-primary">Add Member</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit member Modal -->
<div class="modal fade edit_member_modal" id="edit_member_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Existing Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="" method="post" id="editMemberForm">
            <table id="addNewEntrytable" class="table table-borderless modal-entry-table">
                <input type="hidden" id="u_member_id">
                <tr>
                    <td>Member Name</td>
                    <td> <input required name="member_name" id="u_member_name" autocomplete="off" class="form-control" type="text"> </td>
                </tr>
                
                <tr>
                    <td>Join Date</td>
                    <td> <input required name="member_join_date" id="u_member_join_date" autocomplete="off" class="form-control nx-datepicker" type="text"> </td>
                </tr>

            </table>
        
      </div>

      <div class="modal-footer">
        <button type="submit" id="editMember" class="btn btn-primary">Update Member</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  $show_member = Nx_Account_Manager_Controller::show_member();
?>
<div class="wrap">
    <div class="d-flex" id="nx_wrapper"> 
    <!-- Sidebar -->
        <div class="bg-light border-right" id="nx-sidebar-wrapper">
        <div class="sidebar-heading"> Account Manager</div>
        <div class="list-group list-group-flush">
            <a href="<?php echo admin_url();?>admin.php?page=nx_account_manager" class="<?php if($page == 'dashboard'){ echo 'nx-active';} ?> list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="<?php echo admin_url();?>admin.php?page=nx_account" class="<?php if($page == 'account'){ echo 'nx-active';} ?> list-group-item list-group-item-action bg-light">Accounts</a>
            <a href="<?php echo admin_url();?>admin.php?page=nx_members" class="<?php if($page == 'members'){ echo 'nx-active';} ?> list-group-item list-group-item-action bg-light">Members</a>
            
        </div>
        </div>
        <!-- /#nx-sidebar-wrapper -->

        <!-- Page Content -->
        <div id="nx-page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <span id="menu_toggle" class="dashicons dashicons-editor-code"></span>
      <button class="btn btn-primary nx-add-new-btn" data-toggle="modal" data-target=".add-new-modal">New Entry</button>
      
      
      

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
       
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item search">
              <form action="<?php echo admin_url();?>admin.php?page=nx_single" method="post" id="dateSearchForm">
                <div class="input-group">
                  <input type="text" class="form-control nx-datepicker" autocomplete="off" name="search_date" placeholder="Select date">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" name="search" type="submit" id="date_search_btn">Search</button>
                  </div>
                </div>
              </form>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li> -->
          </ul>
        </div>
      </nav>


      <!-- Insert Modal -->
<div class="modal fade add-new-modal" id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="" method="post" id="addNewEntryForm">
            <table id="addNewEntrytable" class="table table-borderless modal-entry-table">
                <tr>
                    <td>Date</td>
                    <td> <input required name="en_date" autocomplete="off" class="form-control nx-datepicker" type="text"> </td>
                </tr>

                <tr>
                  <td>Is loan</td>
                  <td><input type="checkbox" name="en_loan" value="loan" class="loan"></td>
                </tr>

                <tr class="loan-member" style="display:none">
                  <td>Member</td>
                  <td>
                      <select name="en_loan_member_id" id="">
                          <option value=""> Select Member </option>

                          <?php foreach($show_member as $data): ?>
                          <option value="<?php echo esc_attr($data['member_id']); ?>"> <?php echo esc_attr($data['member_name']); ?> </option>
                          <?php endforeach; ?>

                      </select>
                  </td>
                </tr>

                <tr>
                    <td>Earn / Cost</td>
                    <td> 
                        <input class="form-control" required type="radio" id="earn" value="earn" name="en_earn_cost"> <label for="earn">Earn</label>
                        <input class="form-control" required type="radio" id="cost" value="cost" name="en_earn_cost"> <label for="cost">Cost</label>
                    </td>
                </tr>
               
                <tr>
                    <td>Purpose</td>
                    <td> <textarea name="en_purpose" required class="form-control" id="" cols="" rows=""></textarea> </td>
                </tr>

                <tr>
                    <td>Currency</td>
                    <td> 
                        <input class="form-control" required type="radio" id="Taka" value="taka" name="en_currency"> <label for="Taka">Taka</label>
                        <input class="form-control dollar" required type="radio" id="Dollar" value="dollar" name="en_currency"> <label class="dollar" for="Dollar">Dollar</label>
                    </td>
                </tr>

                <tr>
                    <td>Amount</td>
                    <td> 
                    
                        <!-- <input class="form-control" required name="en_amount" type="number">  -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">৳</span>
                            </div>
                            <input type="number" step="any" name="en_amount_taka" class="form-control" placeholder="Taka">
                            <div class="input-group-prepend">
                                <span class="input-group-text dollar-input" id="basic-addon1">$</span>
                            </div>
                            <input type="number" step="any" name="en_amount_dollar" class="form-control dollar-input" placeholder="Dollar">
                        </div>
                    
                    </td>
                </tr>

            </table>
        
      </div>

      <div class="modal-footer">
        <button type="submit" id="addNewEntry" class="btn btn-primary">Add Entry</button>
      </div>
      </form>
    </div>
  </div>
</div>
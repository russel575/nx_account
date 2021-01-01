<?php
    $page = 'dashboard';
    $get_nx_entry_data = Nx_Account_Manager_Controller::get_nx_entry_data();

    $get_earn_cost_buy_taka = Nx_Account_Manager_Controller::get_earn_cost_buy_taka();
    $available_taka = $get_earn_cost_buy_taka['t_earn'] - ($get_earn_cost_buy_taka['t_cost'] + $get_earn_cost_buy_taka['t_buy']);

    $get_earn_cost_sold_dollar = Nx_Account_Manager_Controller::get_earn_cost_sold_dollar();

    $available_dollar = ($get_earn_cost_sold_dollar['t_earn'] + $get_earn_cost_sold_dollar['t_buy']) - ($get_earn_cost_sold_dollar['t_sold'] + $get_earn_cost_sold_dollar['t_cost']);
   
?>

<!-- include header and sidebar -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/header.php'; ?>
<!--/ include header and sidebar -->


<div class="container-fluid">

    <div class="row">
        <div class="col-md-3">
            <div class="nx-amount-box">
                <p>Available Taka</p>
                <h3><?php echo esc_attr($available_taka) . " " . "৳";?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="nx-amount-box">
                <p>Available Dollar</p>
                <h3><?php echo esc_attr( number_format( $available_dollar, 2)) . " " . "$";?></h3>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <div class="nx-amount-box">
                        <p>Total Earn</p>
                        <h3><?php echo esc_attr($get_earn_cost_buy_taka['t_earn']) ." ". "৳";?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="nx-amount-box">
                        <p>Total Cost</p>
                        <h3><?php echo esc_attr($get_earn_cost_buy_taka['t_cost']) ." ". "৳";?></h3>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="nx-amount-box">
                        <p>Loan Due</p>
                        <h3><?php echo esc_attr($get_earn_cost_buy_taka['due_loan']) ." ". "৳";?></h3>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="row mt-4">
      
        <div class="col-md-12 mt-2">
            <table id="nx_entry_list_table" class="display table" style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Purpose</th>
                        <th>Earn / Cost</th>
                        <th>Taka</th>
                        <th>Dollar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($get_nx_entry_data as $data): ?>
                    <tr>
                        <td>
                            <?php echo esc_attr( $data->en_date );?>
                        </td>
                        <td>
                            <?php echo esc_attr( $data->en_purpose );?>
                            <?php if($data->en_loan){ echo "by ( " . $data->member_name . " )" ;} ?> 
                        </td>
                        <td>
                            <?php echo $data->en_earn_cost;?>
                        </td>
                        <td>
                            <?php echo "<span style='font-size: 15px;'>৳</span>" . " " . $data->en_amount_taka;?>
                        </td>
                        <td>
                            <?php echo "<span style='font-size: 15px;'>$</span>" . " " . $data->en_amount_dollar;?>
                        </td>
                        <td> 
                            <?php if(!empty( $data->en_loan_member_id )){ ?>
                                <a href="<?php echo admin_url() . "admin.php?page=nx_single_member&member_id=$data->en_loan_member_id&id=$data->en_id" ?>" target="_blank"><span class="dashicons dashicons-visibility nx-view-icon"></span></a> || 
                                <span data-id="<?php echo $data->en_id; ?>" id="nx_entry_delete" class="dashicons dashicons-trash nx-delete-icon"></span>
                            <?php }else{ ?>
                                <span data-id="<?php echo $data->en_id; ?>" data-toggle="modal" data-target=".update-modal" class="dashicons dashicons-edit-large nx-edit-icon"></span> || 
                                <span data-id="<?php echo $data->en_id; ?>" id="nx_entry_delete" class="dashicons dashicons-trash nx-delete-icon"></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>


<!-- include footer -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/footer.php'; ?>
<!--/ include footer -->







<!-- Update Modal -->
<div class="modal fade update-modal" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="" method="post" id="UpdateEntryForm">

            <table id="updateEntrytable" class="table table-borderless modal-entry-table">
                <input type="hidden" id="en_id">
                <input type="hidden" id="loan_member_id">
                <tr>
                    <td>Date</td>
                    <td> <input required name="en_date" id="en_date" autocomplete="off" class="form-control nx-datepicker" type="text"> </td>
                </tr>

                <tr>
                    <td>Earn / Cost</td>
                    <td> 
                        <input class="form-control" required type="radio" id="en_earn" value="earn" name="en_earn_cost"> <label for="earn">Earn</label>
                        <input class="form-control" required type="radio" id="en_cost" value="cost" name="en_earn_cost"> <label for="cost">Cost</label>
                    </td>
                </tr>

                <tr>
                    <td>Purpose</td>
                    <td> <textarea name="en_purpose" id="en_purpose" required class="form-control" id="" cols="" rows=""></textarea> </td>
                </tr>
               
                <tr>
                    <td>Currency</td>
                    <td> 
                        <input class="form-control" required type="radio" id="en_taka" value="taka" name="en_currency"> <label for="Taka">Taka</label>
                        <input class="form-control" required type="radio" id="en_dollar" value="dollar" name="en_currency"> <label for="Dollar">Dollar</label>
                    </td>
                </tr>

                <tr>
                    <td>Amount</td>
                    <td> 
                        <!-- <input class="form-control" required id="en_amount" name="en_amount" type="number">  -->

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">৳</span>
                            </div>
                            <input type="number" step="any" id="en_amount_taka" name="en_amount_taka" class="form-control" placeholder="Taka">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">$</span>
                            </div>
                            <input type="number" step="any" id="en_amount_dollar" name="en_amount_dollar" class="form-control" placeholder="Dollar">
                        </div>
                    </td>
                </tr>

            </table>
        
      </div>

      <div class="modal-footer">
        <button type="submit" id="UpdateEntry" class="btn btn-primary">Update Entry</button>
      </div>
      </form>
    </div>
  </div>
</div>



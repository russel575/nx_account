<?php
    $page = 'members';
    if(isset($_GET['member_id'])){
        $member_id = $_GET['member_id']; 
    }
    if(isset($_GET['id'])){
        $id = $_GET['id']; 
    }


    $get_single_member_data = Nx_Account_Manager_Controller::get_single_member_data($member_id);
    $calculate_loan = Nx_Account_Manager_Controller::calculate_loan_single_member( $member_id );
    
   
?>

<!-- include header and sidebar -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/header.php'; ?>
<!--/ include header and sidebar -->


<div class="container-fluid">

    <div class="row">
        <div class="col-md-4">
            <div class="nx-amount-box">
                <p>Total Loan Amount</p>
                <h3><?php echo esc_attr( $calculate_loan['cost'] ) . " " . "৳"; ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="nx-amount-box">
                <p>Loan Repayment</p>
                <h3><?php echo esc_attr( $calculate_loan['earn'] ) . " " . "৳"; ?></h3>
                
            </div>
        </div> 
        <div class="col-md-4">
            <div class="nx-amount-box">
                <p>Due Loan Amount</p>
                <h3><?php echo esc_attr( $calculate_loan['cost'] - $calculate_loan['earn'] ) . " " . "৳"; ?></h3>
                
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
                        <th>Given / Taken</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($get_single_member_data as $data):
                    ?>
                    <tr style="<?php if($data['en_id'] === $id){echo 'background: #007bff' . ';'. 'color: #fff'; }?>" >
                        <td>
                            <?php echo esc_attr( $data['en_date'] );?>
                        </td>
                        <td>
                            <?php echo esc_attr( $data['en_purpose'] );?>
                        </td>
                        <td>
                            <?php 
                                if( $data['en_earn_cost'] == 'earn' ){
                                    _e( 'Given' );
                                }elseif( $data['en_earn_cost'] == 'cost' ){
                                    _e( 'Taken' );
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo "<span style='font-size: 15px;'>৳</span>" . " " . esc_attr( $data['en_amount_taka'] );?>
                        </td>
                        <td>
                            <span data-id="<?php echo $data['en_id']; ?>" class="dashicons dashicons-edit-large nx-edit-icon"></span> || 
                            <span data-id="<?php echo $data['en_id']; ?>" id="nx_entry_delete" class="dashicons dashicons-trash nx-delete-icon"></span></td>
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
<div class="modal fade update-modal" id="updateSingleMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="" method="post" id="UpdateSingleMemberForm">

            <table id="updateSingleMembertable" class="table table-borderless modal-entry-table">
                <input type="hidden" id="single_member_entry_id">
                <tr>
                    <td>Date</td>
                    <td> <input required name="en_date" id="single_member_entry_date" autocomplete="off" class="form-control nx-datepicker" type="text"> </td>
                </tr>

                <tr>
                    <td>Earn / Cost</td>
                    <td> 
                        <input class="form-control" required type="radio" id="single_member_entry_earn" value="earn" name="en_earn_cost"> <label for="earn">Earn</label>
                        <input class="form-control" required type="radio" id="single_member_entry_cost" value="cost" name="en_earn_cost"> <label for="cost">Cost</label>
                    </td>
                </tr>

                <tr>
                    <td>Purpose</td>
                    <td> <textarea name="en_purpose" id="single_member_entry_purpose" required class="form-control" id="" cols="" rows=""></textarea> </td>
                </tr>
               
                <tr>
                    <td>Currency</td>
                    <td> 
                        <input class="form-control" required type="radio" id="single_member_entry_currency_taka" value="taka" name="en_currency"> <label for="Taka">Taka</label>
                    </td>
                </tr>

                <tr>
                    <td>Amount</td>
                    <td>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">৳</span>
                            </div>
                            <input type="number" step="any" id="single_member_entry_amount_taka" name="en_amount_taka" class="form-control" placeholder="Taka">
                            
                        </div>
                    </td>
                </tr>

            </table>
        
      </div>

      <div class="modal-footer">
        <button type="submit" id="UpdateSinglememberEntry" class="btn btn-primary">Update Entry</button>
      </div>
      </form>
    </div>
  </div>
</div>




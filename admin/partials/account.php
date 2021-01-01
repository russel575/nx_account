<?php
    $page = 'account';
    
    $get_earn_cost_buy_taka_month = Nx_Account_Manager_Controller::get_earn_cost_buy_taka_month();
    $available_taka = $get_earn_cost_buy_taka_month['t_earn'] - ($get_earn_cost_buy_taka_month['t_cost'] + $get_earn_cost_buy_taka_month['t_buy']);

    $get_earn_cost_sold_dollar_month = Nx_Account_Manager_Controller::get_earn_cost_sold_dollar_month();
    $available_dollar = ($get_earn_cost_sold_dollar_month['t_earn'] + $get_earn_cost_sold_dollar_month['t_buy']) - ($get_earn_cost_sold_dollar_month['t_sold'] + $get_earn_cost_sold_dollar_month['t_cost']);
?>
<!-- include header and sidebar -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/header.php'; ?>
<!--/ include header and sidebar -->


<div class="container-fluid">
 
    <div class="row">
        <div class="col-md-2">
            <div class="nx-amount-box">
                <p>Current Month</p>
                <h4><?php echo date('M-Y'); ?></h4>
            </div>
        </div>
        <div class="col-md-2">
            <div class="nx-amount-box">
                <p>Available Taka</p>
                <h3><?php echo esc_attr($available_taka) . " " . "৳";?></h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="nx-amount-box">
                <p>Available Dollar</p>
                <h3><?php echo esc_attr( number_format( $available_dollar, 2)) . " " . "$";?></h3>
                
            </div>
        </div>
        <div class="col-md-2">
            <div class="nx-amount-box">
                <p>Total Earn</p>
                <h3><?php echo esc_attr($get_earn_cost_buy_taka_month['t_earn']) ." ". "৳";?></h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="nx-amount-box">
                <p>Total Cost</p>
                <h3><?php echo esc_attr($get_earn_cost_buy_taka_month['t_cost']) ." ". "৳";?></h3>
            </div>
        </div>      
        <div class="col-md-2">
            <div class="nx-amount-box">
                <p>Due Loan</p>
                <h3><?php echo esc_attr($get_earn_cost_buy_taka_month['t_cost']) ." ". "৳";?></h3>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <table id="nx_entry_list_table" class="display table" style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Pourpose</th>
                        <th>Earn / Cost</th>
                        <th>Taka</th>
                        <th>Dollar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $datas = Nx_Account_Manager_Controller::get_data_month_wise();
                        foreach($datas as $data):
                    ?>
                    <tr>
                        <td><?php echo esc_attr($data->en_date); ?></td>
                        <td><?php echo esc_attr($data->en_purpose); ?></td>
                        <td><?php echo esc_attr($data->en_earn_cost); ?></td>
                        <td>
                            <?php echo "<span style='font-size: 15px;'>৳</span>" . " " .$data->en_amount_taka;?>
                        </td>
                        <td>
                            <?php echo "<span style='font-size: 15px;'>$</span>" . " " . $data->en_amount_dollar;?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    .


</div>


<!-- include footer -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/footer.php'; ?>
<!--/ include footer -->
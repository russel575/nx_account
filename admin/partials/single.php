
<?php
    
    if(isset($_POST['search'])){
        $search_date = $_POST['search_date'];

        $date_wise_search_query = Nx_Account_Manager_Controller::date_wise_search_query($search_date);
        $taka_month_wise_search = Nx_Account_Manager_Controller::taka_month_wise_search($search_date);
        $dollar_month_wise_search = Nx_Account_Manager_Controller::dollar_month_wise_search($search_date);
    }

    $available_taka = $taka_month_wise_search['earn'] - ($taka_month_wise_search['sold'] + $taka_month_wise_search['cost']);
    $available_dollar = ($dollar_month_wise_search['earn'] + $dollar_month_wise_search['buy']) - ($dollar_month_wise_search['sold'] + $dollar_month_wise_search['cost']);
    //print_r($month_wise);die;

?>
<!-- include header and sidebar -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/header.php'; ?>
<!--/ include header and sidebar -->


<div class="container-fluid" id="dvContents">
 
    <div class="row t">
        <div class="col-md-4 print">
            <div class="nx-amount-box">
                <p>Search Month & Year</p>
                <h3><?php echo $search_date; ?></h3>
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
                <h3><?php echo esc_attr($taka_month_wise_search['earn']) ." ". "৳";?></h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="nx-amount-box">
                <p>Total Cost</p>
                <h3><?php echo esc_attr($taka_month_wise_search['cost']) ." ". "৳";?></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-md-12">
                    <table id="" class="display table" style="width:100%">
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
                                $datas = $date_wise_search_query;
                                $datas = is_array($datas)? $datas: [];
                                foreach($datas as $data):
                                    //print_r($data);die;
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
                    <button id="printbtn" onclick="print_specific_div_content();">Print</button>
                </div>
                
                <!-- <div class="col-md-3">
                    <div id="nx_accordion">
                        <h3>Section 1</h3>
                        <div>
                            <p>
                            Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
                            ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
                            amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
                            odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                            </p>
                        </div>
                        <h3>Section 2</h3>
                        <div>
                            <p>
                            Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
                            purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
                            velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
                            suscipit faucibus urna.
                            </p>
                        </div>
                        <h3>Section 3</h3>
                        <div>
                            <p>
                            Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                            Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                            ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                            lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                            </p>
                            <ul>
                            <li>List item one</li>
                            <li>List item two</li>
                            <li>List item three</li>
                            </ul>
                        </div>
                        <h3>Section 4</h3>
                        <div>
                            <p>
                            Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                            et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                            mauris vel est.
                            </p>
                            <p>
                            Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                            inceptos himenaeos.
                            </p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

    </div>


</div>


<!-- include footer -->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/part/footer.php'; ?>
<!--/ include footer -->


<script type="text/javascript">

    function print_specific_div_content(){
      jQuery('div#adminmenumain, #wpfooter, #nx-sidebar-wrapper, #printbtn').css({ "display" : "none" });
      jQuery('#nx-page-content-wrapper').css({ "width" : "80%", 'margin':'0 auto' });
      jQuery('#wpcontent').css({ "margin-left" : "0px" });
      
       window.print();

       jQuery('div#adminmenumain, #wpfooter, #nx-sidebar-wrapper, #printbtn').css({ "display" : "block" });
       jQuery('#nx-page-content-wrapper').css({ "width" : "100%" });
       jQuery('#wpcontent').css({ "margin-left" : "160px" });
       
    }

    

</script>
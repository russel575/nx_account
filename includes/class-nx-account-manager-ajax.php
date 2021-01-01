<?php

class Nx_Accout_Manager_Ajax{

    public function enqueue_ajax(){
        /* Golobal WP database */
		global $wpdb;
		/* Declar All table name */
		
		$nx_entry = $wpdb->prefix . "nx_entry";
		$nx_members = $wpdb->prefix . "nx_members";
        

		$param = isset($_REQUEST['param'])? $_REQUEST['param'] : "";
		$id = isset($_REQUEST['id'])? $_REQUEST['id'] : "";

		/* Insert nx entry data */
		if(!empty($param) && $param == "insert_new_entry"){

            $en_date = $_POST['en_date'];
            $en_purpose = $_POST['en_purpose'];
            $en_earn_cost = $_POST['en_earn_cost'];
            $en_amount_taka = $_POST['en_amount_taka'];
            $en_amount_dollar = $_POST['en_amount_dollar'];
            $en_currency = $_POST['en_currency'];
            $en_loan = $_POST['en_loan'];

            if( $en_loan == 'loan' ){
                $en_loan_member_id = $_POST['en_loan_member_id'];
            }else{
                $en_loan_member_id = '';
            }

            if(empty($en_date) || empty($en_purpose) || empty($en_earn_cost) || empty($en_currency)){
                $error = "Fields are required";
            }else {
                $sql = "INSERT INTO $nx_entry( en_date, en_purpose, en_earn_cost, en_amount_taka, en_amount_dollar, en_currency, en_loan_member_id, en_loan) VALUES ('$en_date','$en_purpose','$en_earn_cost','$en_amount_taka','$en_amount_dollar','$en_currency', '$en_loan_member_id','$en_loan')";
                $wpdb->query($sql);

                if($wpdb->insert_id > 0){
                    echo json_encode(array(
                        "status"	=>	1,
                        "message"	=>	"Entry has been added"
                    ));
                }else{
                    echo json_encode(array(
                        "status"	=>	0,
                        "message"	=>	"Entry has been added fail! Try again"
                    ));
                }
            }

        }

        elseif( !empty($param) && $param == "delete_new_entry"){

			$sql = "DELETE FROM $nx_entry WHERE en_id='$id'";
            $wpdb->query($sql);
            
            if($id > 0){
                echo json_encode(array(
                    "status"	=>	1,
                    "message"	=>	"Entry has been deleted"
                ));
            }else{
                echo json_encode(array(
                    "status"	=>	0,
                    "message"	=>	"Entry has been deleted fail! Try again"
                ));
            }
        }
        
        elseif( !empty($param) && $param == "show_nx_entry_data" ){

            $sql = $wpdb->get_results( "SELECT * FROM $nx_entry WHERE en_id='$id'");
			foreach($sql as $key=> $data);
			 echo json_encode($data);
        }   

        elseif( !empty($param) && $param == "edit_entry" ){

            $en_date = $_REQUEST['en_date'];
            $en_purpose = $_REQUEST['en_purpose'];
            $en_earn_cost = $_REQUEST['en_earn_cost'];
            $en_currency = $_REQUEST['en_currency'];
            $en_amount_taka = $_REQUEST['en_amount_taka'];
            $en_amount_dollar = $_REQUEST['en_amount_dollar'];

			$sql = "UPDATE $nx_entry SET
            en_date = '$en_date',
            en_purpose = '$en_purpose',
            en_earn_cost = '$en_earn_cost',
            en_amount_taka = '$en_amount_taka',
            en_amount_dollar = '$en_amount_dollar',
            en_currency = '$en_currency'
            WHERE en_id='$id'";
            $wpdb->query($sql);
            
            if($id > 0){
                echo json_encode(array(
                    "status"	=>	1,
                    "message"	=>	"Entry has been updated"
                ));
            }else{
                echo json_encode(array(
                    "status"	=>	0,
                    "message"	=>	"Entry has been updated fail! Try again"
                ));
            }
        }

        // Add new member
        elseif( !empty($param) && $param == "insert_new_member"){

            $member_name        =   sanitize_text_field( $_POST['member_name'] );
            $member_join_date   =   sanitize_text_field( $_POST['member_join_date'] );

            if(empty($member_name) || empty($member_join_date)){
                printf( '<div class="notice notice-error is-dismissible"><p> Please fillup required fields </p></div>' );
            }else {
                $sql = "INSERT INTO $nx_members( member_name, member_join_date ) VALUES ( '$member_name','$member_join_date' )";
                $wpdb->query($sql);

				if($wpdb->insert_id > 0){
					echo json_encode(array(
						"status"	=>	1,
						"message"	=>	"Member has been added"
					));
				}else{
					echo json_encode(array(
						"status"	=>	0,
						"message"	=>	"Member has been added failed! Try again"
					));
				}

            }
        }
        elseif( !empty( $param) && $param == "show_member_data" ){

            $sql = $wpdb->get_results( "SELECT * FROM $nx_members WHERE member_id='$id'");
			foreach($sql as $key=> $data);
			 echo json_encode($data);
        }
        
        elseif( !empty( $param) && $param == "edit_member" ){

            $member_name = sanitize_text_field( $_REQUEST['member_name'] );
            $member_join_date = sanitize_text_field( $_REQUEST['member_join_date'] );

            $sql = "UPDATE $nx_members SET
            member_name = '$member_name',
            member_join_date = '$member_join_date'
            WHERE member_id='$id'";

            $wpdb->query($sql);

            if($id > 0){
                echo json_encode(array(
                    "status"	=>	1,
                    "message"	=>	"Member has been Update"
                ));
            }else{
                echo json_encode(array(
                    "status"	=>	0,
                    "message"	=>	"Member has been Update failed! Try again"
                ));
            }
        }
        
        elseif( !empty($param) && $param == "delete_member"){

			$sql = "DELETE FROM $nx_members WHERE member_id='$id'";
            $wpdb->query($sql);
            
            if($id > 0){
                echo json_encode(array(
                    "status"	=>	1,
                    "message"	=>	"Member has been Deleted"
                ));
            }else{
                echo json_encode(array(
                    "status"	=>	0,
                    "message"	=>	"Member has been Deleted fail! Try again"
                ));
            }
        }
        elseif( !empty( $param) && $param == "show_single_member_entry_data" ){

            $sql = $wpdb->get_results( "SELECT * FROM $nx_entry WHERE en_id='$id'");
			foreach($sql as $key=> $data);
			 echo json_encode($data);
        }
        elseif( !empty( $param) && $param == "single_member_edit_entry" ){

            $en_date = sanitize_text_field( $_REQUEST['en_date'] );
            $en_earn_cost = sanitize_text_field( $_REQUEST['en_earn_cost'] );
            $en_purpose = sanitize_text_field( $_REQUEST['en_purpose'] );
            $en_currency = sanitize_text_field( $_REQUEST['en_currency'] );
            $en_amount_taka = sanitize_text_field( $_REQUEST['en_amount_taka'] );
            

            $sql = "UPDATE $nx_entry SET
            en_date = '$en_date',
            en_earn_cost = '$en_earn_cost',
            en_purpose = '$en_purpose',
            en_currency = '$en_currency',
            en_amount_taka = '$en_amount_taka'
            WHERE en_id='$id'";

            $wpdb->query($sql);

            if($id > 0){
                echo json_encode(array(
                    "status"	=>	1,
                    "message"	=>	"Entry has been Updated"
                ));
            }else{
                echo json_encode(array(
                    "status"	=>	0,
                    "message"	=>	"Entry has been Updated fail! Try again"
                ));
            }
        }

        wp_die();
    }



}
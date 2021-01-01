<?php

class Nx_Account_Manager_Controller{

    public static function date(){
        $date = array(
            'date'      =>  date('Y-m-d'),
            'month'     =>  date('m'),
            'daay'      =>  date('d')
        );

        return $date;
    }


    public static function get_nx_entry_data(){

        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $nx_members = $wpdb->prefix . "nx_members";
        $data = $query = $wpdb->get_results( "SELECT * FROM $nx_entry
        LEFT JOIN $nx_members ON $nx_entry.en_loan_member_id = $nx_members.member_id  ORDER BY en_id DESC");
        return $data;
    } 
    
    public static function get_data_month_wise(){

        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $month = date('m');
        $data = $query = $wpdb->get_results( "SELECT * FROM $nx_entry WHERE MONTH(en_date)='$month' ORDER BY en_id DESC");
        return $data; 
    }

    public static function get_earn_cost_buy_taka(){
        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $earn  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='taka'");
        $cost  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='taka'");
        $buy  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='dollar'");
        $due_loan  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='taka' && en_loan='loan'");

        return array('t_earn' => $earn, 't_cost' => $cost, 't_buy' => $buy, 'due_loan' => $due_loan);
    }

    public static function get_earn_cost_sold_dollar(){
        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $earn  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='dollar'");

        $cost  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='dollar'");

        $sold  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='taka'");

        $buy  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='taka'");

        return array('t_earn' => $earn, 't_cost' => $cost, 't_sold' => $sold, 't_buy' => $buy);
    }


    public static function get_total_earn(){
        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $slq  = $wpdb->get_var("SELECT SUM(en_amount) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='taka'");
        return $slq;
    } 

    public static function get_earn_cost_buy_taka_month(){
        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $month = date('m');
        $earn  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='taka' && MONTH(en_date)='$month'");
        $cost  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='taka' && MONTH(en_date)='$month' ");
        $buy  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='dollar' && MONTH(en_date)='$month' ");

        return array('t_earn' => $earn, 't_cost' => $cost, 't_buy' => $buy);
    }

    public static function get_earn_cost_sold_dollar_month(){
        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $month = date('m');

        $earn  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='dollar' && MONTH(en_date)='$month' ");
        $cost  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='dollar' && MONTH(en_date)='$month' ");
        $sold  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='taka' && MONTH(en_date)='$month' ");
        $buy  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='taka' && MONTH(en_date)='$month' ");

        return array('t_earn' => $earn, 't_cost' => $cost, 't_sold' => $sold, 't_buy' => $buy);
    }

    public static function date_wise_search_query($search_date){
        
        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $year = date('Y', strtotime($search_date));
        $month = date('m', strtotime($search_date));

        $data = $wpdb->get_results( "SELECT * FROM $nx_entry WHERE YEAR(en_date) = '$year' && MONTH(en_date) = '$month' ORDER BY en_date DESC" );

        return $data;
    }

    public static function taka_month_wise_search($search_date){

        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $year = date('Y', strtotime($search_date));
        $month = date('m', strtotime($search_date));

        $earn  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='taka' && MONTH(en_date)='$month' && YEAR(en_date)='$year' ");
        $cost  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='taka' && MONTH(en_date)='$month' && YEAR(en_date)='$year' ");
        $sold  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='dollar' && MONTH(en_date)='$month' && YEAR(en_date)='$year' ");

        return array('earn' => $earn, 'cost' => $cost, 'sold' => $sold);

    }    
    
    public static function dollar_month_wise_search($search_date){

        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";
        $year = date('Y', strtotime($search_date));
        $month = date('m', strtotime($search_date));

        $earn  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='dollar' && MONTH(en_date)='$month' && YEAR(en_date)='$year' ");
        $cost  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='dollar' && MONTH(en_date)='$month' && YEAR(en_date)='$year' ");
        $sold  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='earn' && en_currency='taka' && MONTH(en_date)='$month' && YEAR(en_date)='$year' ");
        $buy  = $wpdb->get_var("SELECT SUM(en_amount_dollar) FROM $nx_entry WHERE en_earn_cost='cost' && en_currency='taka' && MONTH(en_date)='$month' && YEAR(en_date)='$year' ");

        return array('earn' => $earn, 'cost' => $cost, 'sold' => $sold ,'buy' => $buy);

    }

    // member table query
    public function show_member(){
        global $wpdb;
        $nx_members = $wpdb->prefix . "nx_members";
        $data = $query = $wpdb->get_results( "SELECT * FROM $nx_members ORDER BY member_id DESC", ARRAY_A);
        return $data;
    }

    public function get_single_member_data( $member_id ){
        global $wpdb;
        $nx_members = $wpdb->prefix . "nx_members";
        $nx_entry = $wpdb->prefix . "nx_entry";

        $data = $query = $wpdb->get_results( "SELECT * FROM $nx_entry
        LEFT JOIN $nx_members ON $nx_entry.en_loan_member_id = $nx_members.member_id 
        WHERE $nx_entry.en_loan_member_id = '$member_id'
        ORDER BY $nx_entry.en_id DESC", ARRAY_A);

        return $data;
    }

    public static function calculate_loan_single_member( $member_id ){

        global $wpdb;
        $nx_entry = $wpdb->prefix . "nx_entry";

        $earn  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='earn' && en_loan_member_id = '$member_id' ");
        $cost  = $wpdb->get_var("SELECT SUM(en_amount_taka) FROM $nx_entry WHERE en_earn_cost='cost' && en_loan_member_id = '$member_id' ");

        return array('earn' => $earn, 'cost' => $cost );

    }






}
<?php 
require_once("classes/cls-company.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_company = new Company();
$obj_category = new Category();
$conn = $obj_company->getConnectionObj();

/*Array for industry*/
$indusarray=array();
$newindusarray=array();
$allindusarray=array();
/********************/

/*Array for main industry*/
$mainindusarray=array();
$newmainindusarray=array();
$allmainindusarray=array();
/************************/

/*Array for secondary industry*/
$secondaryindusarray=array();
$newsecondaryindusarray=array();
$allsecondaryindusarray=array();
/************************/

$insertmainindusid=array();
$insertsubindusid=array();


if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
                
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
           $line= fgetcsv($csvFile);
            //print_r($line);
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                 // Get row data
                 
                $company_name = $line[1];
                $exp=preg_match('/[?]/', $company_name);
                if($exp)
                { 
                    $remove_question_cmp_name=str_replace('?', '', $company_name);
                    $remove_bracket_cmp_name=trim($remove_question_cmp_name,'( ( -');
                    $trim_cmp_name_brackets=trim($remove_bracket_cmp_name);
                    $trim_cmp_name=addslashes($trim_cmp_name_brackets);
                } 
                else
                {
                    $trim_cmp_name_white_space=trim($company_name);
                    $trim_cmp_name=addslashes($trim_cmp_name_white_space);
                }
                $trim_cmp_name1=mysqli_real_escape_string($conn, $trim_cmp_name);
                $condition_check_company_name = "`tbl_company`.`company`='$trim_cmp_name1'";
                $fields_check_company_name = "`tbl_company`.*";
                $check_company_name = $obj_company->getspecCompanydetails($fields_check_company_name, $condition_check_company_name, '', '', '', 0);
                if(count($check_company_name)==0)
                {
                    $country  = $line[0];
                    $condition = "`tbl_country_region`.`status` = 'Active' and `country` = '$country'";
                    $fields = "`tbl_country_region`.`region`";
                    $region_details = $obj_company->getCountryRegion($fields, $condition, '', '', 0);
                    foreach ($region_details as $region_detail) 
                    {
                        $region=$region_detail['region'];
                    }
                    
                    
                    $allindustry=str_replace(";",",",$line[2]);
                    $industry=$line[2];
                    if($industry!="")
                    {
                        $indusarray=explode(";",$industry);
                        if(empty($indusarray))
                        {
                            $indusarray=$industry;
                        }
                        for($i=0;$i<count($indusarray);$i++)
                        {
                             $singleindname=trim($indusarray[$i]);
                             $newindusarray=explode("(",$singleindname);
                             
                             for($j=0;$j<count($newindusarray);$j++)
                             {
                                 $removeclose=trim($newindusarray[$j],")");
                                 if(is_numeric($removeclose) && strlen($removeclose)>=2)
                                 {
                                     $allindusarray[]=$removeclose;
                                     if($removeclose<=2)
                                     {
                                         $condition_main = "`tbl_broad_main_industry`.`status` = 'Active' and `tbl_broad_main_industry`.`main_ind_code` = '$removeclose'";
                                         $fields_main = "`tbl_broad_main_industry`.*";
                                         $specific_main_industry_details = $obj_company->getBroadMainIndustry($fields_main,$condition_main, '', '', 0);
                                         $maincnt=count($specific_main_industry_details);
                                         if($maincnt>0)
                                         {
                                             foreach ($specific_main_industry_details as $specific_main_industry_detail) {
                                                    $insertmainindusid[]=$specific_main_industry_detail['main_ind_id'];
                                             }
                                            //$main_industry_id=
                                         } 
                                     }
                                     else
                                     {
                                         $condition_sub = "`tbl_broad_sub_industry`.`status` = 'Active' and `tbl_broad_sub_industry`.`sub_ind_code` = '$removeclose'";
                                         $fields_sub = "`tbl_broad_sub_industry`.*";
                                         $specific_sec_industry_details = $obj_company->getBroadSubIndustry($fields_sub,$condition_sub, '', '', 0);
                                         $submaincnt=count($specific_sec_industry_details);
                                         if($submaincnt>0)
                                         {
                                            foreach ($specific_sec_industry_details as $specific_sec_industry_detail) {
                                                    $insertmainindusid[]=$specific_sec_industry_detail['main_ind_id'];
                                                    $insertsubindusid[]=$specific_sec_industry_detail['sub_ind_id'];
                                             }
                                         } 
                                     }
                                 }
                             }
                             //$allindusarray[]=trim($newindusarray[1],")");
                        }
                        
                        $allinduscode=implode(",",$allindusarray);
                        $allmainindid=implode(",",$insertmainindusid);
                        $allsubindid=implode(",",$insertsubindusid);
                        
                        unset($insertmainindusid);
                        unset($insertsubindusid);
                        unset($allindusarray);
                        unset($indusarray);
                        unset($newindusarray);
                    }
                    else
                    {
                        $allinduscode="";
                    }
                    
                    $mainindustry=str_replace(";",",",$line[3]);
                    $secondaryindustry=str_replace(";",",",$line[4]);
                    
                    $business_description_products  = trim($line[6]);
                    $city=trim($line[7]);
                    $state_country  = trim($line[8]);
                    $postal_code  = trim($line[9]);
                    if($postal_code=="")
                    {
                        $postal_code="";
                    }
                    $address = trim($line[10]);
                    $phone  = trim($line[11]);
                    $fax  = trim($line[12]);
                    $email  = trim($line[13]);
                    $website  = trim($line[14]);
                    $address_type = trim($line[15]);
                    $key_executives = trim($line[16]);
                    $import=trim($line[17]);
                    $export=trim($line[18]);
                    $incorporation_date  = trim($line[19]);
                    $currentyear=date("Y");
                    if($incorporation_date!="")
                    {
                        $diffyear=$currentyear-$incorporation_date;
                        //echo "<br>";
                        //$condition5 = "`tbl_company_age`.`status` = 'Active'";
                        $fields5 = "`tbl_company_age`.*";
                        $comp_age_details = $obj_company->getCompanyAge($fields5, '', '', '', 0);
                        
                        foreach ($comp_age_details as $comp_age_detail)
                        {
                            $min_age = $comp_age_detail['min_age'];
                            $max_age = $comp_age_detail['max_age'];
                            $cmp_age = $comp_age_detail['cmp_age'];
                            if($diffyear>=$min_age && $diffyear<=$max_age)
                            {
                                $company_age_type=$cmp_age;
                                break;
                            }
                        }
                        //echo $cmp_age_type;
                        
                    }
                    else
                    {
                        $company_age_type="";
                    }
                    
                    $noofemployees  = trim($line[20]);
                    if($noofemployees!="")
                    {
                        $var = explode("(",$noofemployees);
                        $no_of_employees=trim($var[0]);
                        $no_of_employee_year=trim($var[1],")");
                    }
                    else
                    {
                        $no_of_employees="";
                        $no_of_employee_year="";
                    }
                    $shareholder  = trim($line[25]);
                    $subsidiaries = trim($line[26]);
                    $main_products  = trim($line[27]);
                    
                    // Insert company data in the database
                    $insert_data4['region'] = mysqli_real_escape_string($conn, $region);
                    $insert_data4['country'] = mysqli_real_escape_string($conn, $country);
                    $insert_data4['company'] = mysqli_real_escape_string($conn, $trim_cmp_name);
                    $insert_data4['industry'] = mysqli_real_escape_string($conn, trim($allindustry));
                    $insert_data4['main_industry'] = mysqli_real_escape_string($conn, trim($mainindustry));
                    $insert_data4['secondary_industry'] = mysqli_real_escape_string($conn, trim($secondaryindustry));
                    $insert_data4['all_industry_code'] = mysqli_real_escape_string($conn, $allinduscode);
                    $insert_data4['main_ind_id'] = mysqli_real_escape_string($conn, $allmainindid);
                    $insert_data4['sub_ind_id'] = mysqli_real_escape_string($conn, $allsubindid);
                    $insert_data4['state_country'] = mysqli_real_escape_string($conn, $state_country);
                    $insert_data4['city'] = mysqli_real_escape_string($conn, $city);
                    $insert_data4['postal_code'] = mysqli_real_escape_string($conn, $postal_code);
                    $insert_data4['address'] = mysqli_real_escape_string($conn, $address);
                    $insert_data4['phone'] = mysqli_real_escape_string($conn, $phone);
                    $insert_data4['fax'] = mysqli_real_escape_string($conn, $fax);
                    $insert_data4['email'] = mysqli_real_escape_string($conn, $email);
                    $insert_data4['website'] = mysqli_real_escape_string($conn, $website);
                    $insert_data4['address_type'] = mysqli_real_escape_string($conn, $address_type);
                    $insert_data4['key_executives'] = mysqli_real_escape_string($conn, $key_executives);
                    $insert_data4['business_description_products'] = mysqli_real_escape_string($conn, $business_description_products);
                    $insert_data4['no_of_employees'] = mysqli_real_escape_string($conn, $no_of_employees);
                    $insert_data4['no_of_employee_year'] = mysqli_real_escape_string($conn, $no_of_employee_year);
                    $insert_data4['shareholder'] = mysqli_real_escape_string($conn, $shareholder);
                    $insert_data4['subsidiaries'] = mysqli_real_escape_string($conn, $subsidiaries);
                    $insert_data4['main_products'] = mysqli_real_escape_string($conn, $main_products);
                    $insert_data4['import'] = mysqli_real_escape_string($conn, $import);
                    $insert_data4['export'] = mysqli_real_escape_string($conn, $export);
                    $insert_data4['incorporation_date'] = mysqli_real_escape_string($conn, $incorporation_date);
                    $insert_data4['company_age_type'] = mysqli_real_escape_string($conn, $company_age_type);
                    $insert_data4['status'] = "Active";
                    $insert_data4['created_at'] = date("Y-m-d H:i:s");
                    $insert_data4['updated_at'] = date("Y-m-d H:i:s");
                    //print_r($insert_data4);
                    $last_insert_id=$obj_company->insertCompany($insert_data4, 0);
                    
                    
                    //End company data    
                    
                    //Financial Fields
                    $cmp_id = $last_insert_id;
                    $total_operating_revenue = trim($line[5]);
                    $financial_auditors  = trim($line[21]);
                    $legal_form  = trim($line[22]);
                    $listed_unlisted  = trim($line[23]);
                    $operational_status = trim($line[24]);
                    $operating_profit_EBIT = trim($line[28]);   
                    $profit_before_income_tax = trim($line[29]);
                    $income_tax = trim($line[30]);
                    $tax_difference_due_to_consolidation = trim($line[31]);
                    $profit_after_income_tax = trim($line[32]);
                    $profit_loss_from_discontinued_operations = trim($line[33]);
                    $net_profit_loss_for_the_period = trim($line[34]);
                    $other_comprehensive_result_for_the_period_net_of_tax = trim($line[35]);
                    $comprehensive_income = trim($line[36]);
                    $comprehensive_profit_loss_attributable_to_minority_interests = trim($line[37]);
                    $total_assets = trim($line[38]);
                    $property_plant_and_equipment = trim($line[39]);
                    $intangible_assets_and_goodwill = trim($line[40]);
                    $cash_and_cash_equivalents = trim($line[41]);
                    $total_equity = trim($line[42]);
                    $equity_attributable_to_owners_of_the_parent = trim($line[43]);
                    $issued_capital = trim($line[44]);
                    $ordinary_shares = trim($line[45]);
                    $preferred_shares = trim($line[46]);
                    $share_premium = trim($line[47]);
                    $treasury_shares = trim($line[48]);
                    $revaluation_reserve = trim($line[49]);
                    $foreign_currency_translation_reserve = trim($line[50]);
                    $retained_earnings = trim($line[51]);
                    $profit_loss_for_the_period = trim($line[52]);
                    $minority_interest = trim($line[53]);
                    $total_liabilities = trim($line[54]);
                    $net_cash_flow_usedin_operating_activities = trim($line[55]);
                    $net_cash_flow_usedin_investing_activities = trim($line[56]);
                    $net_cash_flow_usedin_financial_activities = trim($line[57]);
                    $net_increase_decrease_in_cash_and_cash_equivalents = trim($line[58]);
                    $cash_at_the_beginning_of_the_period = trim($line[59]);
                    $exchange_gain_loss_on_cash_and_cash_equivalent = trim($line[60]);
                    $cash_at_the_end_of_the_period = trim($line[61]);
                    $free_cash_flow = trim($line[62]);
                    $capital_expenditure = trim($line[63]);
                    $return_on_assets = trim($line[64]);
                    $annualised_return_on_assets = trim($line[65]);
                    $return_on_equity = trim($line[66]);
                    $annualised_return_on_equity = trim($line[67]);
                    $return_on_capital_employed = trim($line[68]);
                    $net_profit_margin = trim($line[69]);
                    $gross_profit_margin = trim($line[70]);
                    $operating_profit_margin = trim($line[71]);
                    $EBITDA_margin = trim($line[72]);
                    $operating_ROA = trim($line[73]);
                    $inventory_turnover_x = trim($line[74]);
                    $trade_receivable_turnover_x = trim($line[75]);
                    $current_assets_turnover_x = trim($line[76]);
                    $non_current_assets_turnover_x = trim($line[77]);
                    $total_assets_turnover_x = trim($line[78]);
                    $trade_payables_turnover_x = trim($line[79]);
                    $working_capital_turnover_x = trim($line[80]);
                    $bookvalue = trim($line[81]);
                    $enterprise_value = trim($line[82]);
                    $net_cash = trim($line[83]);
                    $debt = trim($line[84]);
                    $long_term_debt = trim($line[85]);
                    $short_term_debt = trim($line[86]);
                    $net_debt = trim($line[87]);
                    $working_capital = trim($line[88]);
                    $capital_employed = trim($line[89]);
                    $current_ratio_x = trim($line[90]);
                    $quick_ratio_x = trim($line[91]);
                    $dooms_day_ratio_x = trim($line[92]);
                    $cash_ratio_x = trim($line[93]);
                    $operating_cash_flow_ratio_x = trim($line[94]);
                    $debt_to_total_assets_ratio = trim($line[95]);
                    $debt_to_equity_ratio = trim($line[96]);
                    $long_term_debt_to_capital_employed = trim($line[97]);
                    $debt_to_EBITDA_x = trim($line[98]);
                    $debt_to_enterprise_value = trim($line[99]);
                    $net_cash_flow_to_debt = trim($line[100]);
                    $assets_to_equity_ratio = trim($line[101]);
                    $net_sale_revenue_trend = trim($line[102]);
                    $total_operating_revenue_trend = trim($line[103]);
                    $gross_profit_trend = trim($line[104]);
                    $EBITDA_trend = trim($line[105]);
                    $operating_profit_trend = trim($line[106]);
                    $net_profit_trend = trim($line[107]);
                    $accounts_recievables_trend = trim($line[108]);
                    $inventory_trend = trim($line[109]);
                    $net_property_plant_and_equipment_trend = trim($line[110]);
                    $total_assets_trend = trim($line[111]);
                    $bookvalue_trend = trim($line[112]);
                    $shareholders_equity_trend = trim($line[113]);
                    $operating_cash_flow_trend = trim($line[114]);
                    $capital_expenditure_trend = trim($line[115]);
                    $interest_coverage_ratio = trim($line[116]);
                    $operating_cash_flow_to_debt = trim($line[117]);
                    $operating_cash_flow_to_revenue = trim($line[118]);
                    $operating_cash_flow_to_assets = trim($line[119]);
                    $operating_cash_flow_to_equity = trim($line[120]);
                    $operating_cash_flow_to_ebit = trim($line[121]);
                    $cash_to_total_assets = trim($line[122]);
                    $trade_receivables_to_total_assets = trim($line[123]);
                    $inventories_to_total_assets = trim($line[124]);
                    $fixed_assets_to_total_assets = trim($line[125]);
                    $current_liabilities_to_total_liabilities = trim($line[126]);
                    $export_proportion = trim($line[127]);
                    $salaries_and_employee_benefits_net_sale = trim($line[128]);
                    $administrative_expenses_net_sale = trim($line[129]);
                    $depreciation_and_amortization_net_sale = trim($line[130]);
                    $interest_paid_net_sale = trim($line[131]);
                    $income_tax_net_sale = trim($line[132]);
                    $operating_cash_flow_to_total_cash_flow = trim($line[133]);
                    $investing_cash_flow_to_total_cash_flow = trim($line[134]);
                    $financial_cash_flow_to_total_cash_flow = trim($line[135]);
                    $cost_to_income_ratio = trim($line[136]);
                    $bank_efficiency_ratio = trim($line[137]);
                    $loans_to_deposits_ratio = trim($line[138]);
                    $loans_to_customers_to_deposits_from_customers = trim($line[139]);
                    $liquid_assets_to_deposit_ratio = trim($line[140]);
                    $liquid_assets_to_deposit_from_customers_ratio = trim($line[141]);
                    $loans_to_asset_ratio = trim($line[142]);
                    $loans_to_customer_to_asset_ratio = trim($line[143]);
                    $net_interest_income_trend = trim($line[144]);
                    $net_fee_and_commission_income_trend = trim($line[145]);
                    $loans_and_advances_to_customers_trend = trim($line[146]);
                    $loans_and_advances_trend = trim($line[147]);
                    $deposits_from_customers_trend = trim($line[148]);
                    $deposits_trend = trim($line[149]);
                    $earning_assets = trim($line[150]);
                    $yield_on_earning_assets = trim($line[151]);
                    $net_interest_margin = trim($line[152]);
                    $loss_ratio = trim($line[153]);
                    $underwriting_expenses_ratio = trim($line[154]);
                    $ceded_premium_ratio = trim($line[155]);
                    $net_premium_earned_trend = trim($line[156]);
                    $fees_and_commissions_trend = trim($line[157]);
                    $net_investment_income_trend = trim($line[158]);
                    $recievables_arising_out_direct_insurance_operations_trend = trim($line[159]);
                    $earning_per_share = trim($line[160]);
                    $price_to_earnings_x = trim($line[161]);
                    $market_capitalization_net_sales_price_sales_ratio_x = trim($line[162]);
                    $market_capitalization_to_gross_profit_x = trim($line[163]);
                    $market_capitalization_to_EBITDA = trim($line[164]);
                    $market_capitalization_to_EBIT_x = trim($line[165]);
                    $market_capitalization_to_total_assets_x = trim($line[166]);
                    $market_capitalization_to_shareholders_equity = trim($line[167]);
                    $market_capitalization_to_book_value = trim($line[168]);
                    $market_capitalization_to_capital_employed_x = trim($line[169]);
                    $market_capitalization_to_operating_cashflow_x = trim($line[170]);
                    $enterprise_value_net_sales_x = trim($line[171]);
                    $enterprise_value_to_gross_profit_x = trim($line[172]);
                    $enterprise_value_to_EBITDA_x = trim($line[173]);
                    $enterprise_value_to_ebit_x = trim($line[174]);
                    $enterprise_value_to_total_assets_x = trim($line[175]);
                    $enterprise_value_to_capital_employed_x = trim($line[176]);
                    $enterprise_value_to_operating_cashflow_x = trim($line[177]);
                    $stock_exchange = trim($line[178]);
                    $indices = trim($line[179]);
                    $yearly_dividend = trim($line[180]);
                    $close_price = trim($line[181]);
                    $volume_piece = trim($line[182]);
                    $calculated_turnover = trim($line[183]);
                    $outstanding_shares = trim($line[184]);
                    $market_capitalization = trim($line[185]);
                    $reference_date = trim($line[186]);
                    $close_price_1_year_high = trim($line[187]);
                    $close_price_3_year_high = trim($line[188]);
                    $close_price_5_year_high = trim($line[189]);
                    $close_price_1_year_low = trim($line[190]);
                    $close_price_3_year_low = trim($line[191]);
                    $close_price_5_year_low = trim($line[192]);
                    $percent_change_from_1_year_low = trim($line[193]);
                    $percent_change_from_3_year_low = trim($line[194]);
                    $percent_change_from_5_year_low = trim($line[195]);
                    $fiscal_year = trim($line[196]);
    
                     //End financial fields
                    
                    // Insert financial company data in the database
                    $insert_data5['cmp_id'] = mysqli_real_escape_string($conn, $cmp_id);
                    $insert_data5['total_operating_revenue'] = mysqli_real_escape_string($conn, $total_operating_revenue);
                    $insert_data5['financial_auditors'] = mysqli_real_escape_string($conn, $financial_auditors);
                    $insert_data5['legal_form'] = mysqli_real_escape_string($conn, $legal_form);
                    $insert_data5['listed_unlisted'] = mysqli_real_escape_string($conn, $listed_unlisted);
                    $insert_data5['operational_status'] = mysqli_real_escape_string($conn, $operational_status);
                    $insert_data5['operating_profit_EBIT'] = mysqli_real_escape_string($conn, $operating_profit_EBIT);
                    $insert_data5['profit_before_income_tax'] = mysqli_real_escape_string($conn, $profit_before_income_tax);
                    $insert_data5['income_tax'] = mysqli_real_escape_string($conn, $income_tax);
                    $insert_data5['tax_difference_due_to_consolidation'] = mysqli_real_escape_string($conn, $tax_difference_due_to_consolidation);
                    $insert_data5['profit_after_income_tax'] = mysqli_real_escape_string($conn, $profit_after_income_tax);
                    $insert_data5['profit_loss_from_discontinued_operations'] = mysqli_real_escape_string($conn, $profit_loss_from_discontinued_operations);
                    $insert_data5['net_profit_loss_for_the_period'] = mysqli_real_escape_string($conn, $net_profit_loss_for_the_period);
                    $insert_data5['other_comprehensive_result_for_the_period_net_of_tax'] = mysqli_real_escape_string($conn, $other_comprehensive_result_for_the_period_net_of_tax);
                    $insert_data5['comprehensive_income'] = mysqli_real_escape_string($conn, $comprehensive_income);
                    $insert_data5['comprehensive_profit_loss_attributable_to_minority_interests'] = mysqli_real_escape_string($conn, $comprehensive_profit_loss_attributable_to_minority_interests);
                    $insert_data5['total_assets'] = mysqli_real_escape_string($conn, $total_assets);
                    $insert_data5['property_plant_and_equipment'] = mysqli_real_escape_string($conn, $property_plant_and_equipment);
                    $insert_data5['intangible_assets_and_goodwill'] = mysqli_real_escape_string($conn, $intangible_assets_and_goodwill);
                    $insert_data5['cash_and_cash_equivalents'] = mysqli_real_escape_string($conn, $cash_and_cash_equivalents);
                    $insert_data5['total_equity'] = mysqli_real_escape_string($conn, $total_equity);
                    $insert_data5['equity_attributable_to_owners_of_the_parent'] = mysqli_real_escape_string($conn, $equity_attributable_to_owners_of_the_parent);
                    $insert_data5['issued_capital'] = mysqli_real_escape_string($conn, $issued_capital);
                    $insert_data5['ordinary_shares'] = mysqli_real_escape_string($conn, $ordinary_shares);
                    $insert_data5['preferred_shares'] = mysqli_real_escape_string($conn, $preferred_shares);
                    $insert_data5['share_premium'] = mysqli_real_escape_string($conn, $share_premium);
                    $insert_data5['treasury_shares'] = mysqli_real_escape_string($conn, $treasury_shares);
                    $insert_data5['revaluation_reserve'] = mysqli_real_escape_string($conn, $revaluation_reserve);
                    $insert_data5['foreign_currency_translation_reserve'] = mysqli_real_escape_string($conn, $foreign_currency_translation_reserve);
                    $insert_data5['retained_earnings'] = mysqli_real_escape_string($conn, $retained_earnings);
                    $insert_data5['profit_loss_for_the_period'] = mysqli_real_escape_string($conn, $profit_loss_for_the_period);
                    $insert_data5['minority_interest'] = mysqli_real_escape_string($conn, $minority_interest);
                    $insert_data5['total_liabilities'] = mysqli_real_escape_string($conn, $total_liabilities);
                    $insert_data5['net_cash_flow_usedin_operating_activities'] = mysqli_real_escape_string($conn, $net_cash_flow_usedin_operating_activities);
                    $insert_data5['net_cash_flow_usedin_investing_activities'] = mysqli_real_escape_string($conn, $net_cash_flow_usedin_investing_activities);
                    $insert_data5['net_cash_flow_usedin_financial_activities'] = mysqli_real_escape_string($conn, $net_cash_flow_usedin_financial_activities);
                    $insert_data5['net_increase_decrease_in_cash_and_cash_equivalents'] = mysqli_real_escape_string($conn, $net_increase_decrease_in_cash_and_cash_equivalents);
                    $insert_data5['cash_at_the_beginning_of_the_period'] = mysqli_real_escape_string($conn, $cash_at_the_beginning_of_the_period);
                    $insert_data5['exchange_gain_loss_on_cash_and_cash_equivalent'] = mysqli_real_escape_string($conn, $exchange_gain_loss_on_cash_and_cash_equivalent);
                    $insert_data5['cash_at_the_end_of_the_period'] = mysqli_real_escape_string($conn, $cash_at_the_end_of_the_period);
                    $insert_data5['free_cash_flow'] = mysqli_real_escape_string($conn, $free_cash_flow);
                    $insert_data5['capital_expenditure'] = mysqli_real_escape_string($conn, $capital_expenditure);
                    $insert_data5['return_on_assets'] = mysqli_real_escape_string($conn, $return_on_assets);
                    $insert_data5['annualised_return_on_assets'] = mysqli_real_escape_string($conn, $annualised_return_on_assets);
                    $insert_data5['return_on_equity'] = mysqli_real_escape_string($conn, $return_on_equity);
                    $insert_data5['annualised_return_on_equity'] = mysqli_real_escape_string($conn, $annualised_return_on_equity);
                    $insert_data5['return_on_capital_employed'] = mysqli_real_escape_string($conn, $return_on_capital_employed);
                    $insert_data5['net_profit_margin'] = mysqli_real_escape_string($conn, $net_profit_margin);
                    $insert_data5['gross_profit_margin'] = mysqli_real_escape_string($conn, $gross_profit_margin);
                    $insert_data5['operating_profit_margin'] = mysqli_real_escape_string($conn, $operating_profit_margin);
                    $insert_data5['EBITDA_margin'] = mysqli_real_escape_string($conn, $EBITDA_margin);
                    $insert_data5['operating_ROA'] = mysqli_real_escape_string($conn, $operating_ROA);
                    $insert_data5['inventory_turnover_x'] = mysqli_real_escape_string($conn, $inventory_turnover_x);
                    $insert_data5['trade_receivable_turnover_x'] = mysqli_real_escape_string($conn, $trade_receivable_turnover_x);
                    $insert_data5['current_assets_turnover_x'] = mysqli_real_escape_string($conn, $current_assets_turnover_x);
                    $insert_data5['non_current_assets_turnover_x'] = mysqli_real_escape_string($conn, $non_current_assets_turnover_x);
                    $insert_data5['total_assets_turnover_x'] = mysqli_real_escape_string($conn, $total_assets_turnover_x);
                    $insert_data5['trade_payables_turnover_x'] = mysqli_real_escape_string($conn, $trade_payables_turnover_x);
                    $insert_data5['working_capital_turnover_x'] = mysqli_real_escape_string($conn, $working_capital_turnover_x);
                    $insert_data5['bookvalue'] = mysqli_real_escape_string($conn, $bookvalue);
                    $insert_data5['enterprise_value'] = mysqli_real_escape_string($conn, $enterprise_value);
                    $insert_data5['net_cash'] = mysqli_real_escape_string($conn, $net_cash);
                    $insert_data5['debt'] = mysqli_real_escape_string($conn, $debt);
                    $insert_data5['long_term_debt'] = mysqli_real_escape_string($conn, $long_term_debt);
                    $insert_data5['short_term_debt'] = mysqli_real_escape_string($conn, $short_term_debt);
                    $insert_data5['net_debt'] = mysqli_real_escape_string($conn, $net_debt);
                    $insert_data5['working_capital'] = mysqli_real_escape_string($conn, $working_capital);
                    $insert_data5['capital_employed'] = mysqli_real_escape_string($conn, $capital_employed);
                    $insert_data5['current_ratio_x'] = mysqli_real_escape_string($conn, $current_ratio_x);
                    $insert_data5['quick_ratio_x'] = mysqli_real_escape_string($conn, $quick_ratio_x);
                    $insert_data5['dooms_day_ratio_x'] = mysqli_real_escape_string($conn, $dooms_day_ratio_x);
                    $insert_data5['cash_ratio_x'] = mysqli_real_escape_string($conn, $cash_ratio_x);
                    $insert_data5['operating_cash_flow_ratio_x'] = mysqli_real_escape_string($conn, $operating_cash_flow_ratio_x);
                    $insert_data5['debt_to_total_assets_ratio'] = mysqli_real_escape_string($conn, $debt_to_total_assets_ratio);
                    $insert_data5['debt_to_equity_ratio'] = mysqli_real_escape_string($conn, $debt_to_equity_ratio);
                    $insert_data5['long_term_debt_to_capital_employed'] = mysqli_real_escape_string($conn, $long_term_debt_to_capital_employed);
                    $insert_data5['debt_to_EBITDA_x'] = mysqli_real_escape_string($conn, $debt_to_EBITDA_x);
                    $insert_data5['debt_to_enterprise_value'] = mysqli_real_escape_string($conn, $debt_to_enterprise_value);
                    $insert_data5['net_cash_flow_to_debt'] = mysqli_real_escape_string($conn, $net_cash_flow_to_debt);
                    $insert_data5['assets_to_equity_ratio'] = mysqli_real_escape_string($conn, $assets_to_equity_ratio);
                    $insert_data5['net_sale_revenue_trend'] = mysqli_real_escape_string($conn, $net_sale_revenue_trend);
                    $insert_data5['total_operating_revenue_trend'] = mysqli_real_escape_string($conn, $total_operating_revenue_trend);
                    $insert_data5['gross_profit_trend'] = mysqli_real_escape_string($conn, $gross_profit_trend);
                    $insert_data5['EBITDA_trend'] = mysqli_real_escape_string($conn, $EBITDA_trend);
                    $insert_data5['operating_profit_trend'] = mysqli_real_escape_string($conn, $operating_profit_trend);
                    $insert_data5['net_profit_trend'] = mysqli_real_escape_string($conn, $net_profit_trend);
                    $insert_data5['accounts_recievables_trend'] = mysqli_real_escape_string($conn, $accounts_recievables_trend);
                    $insert_data5['inventory_trend'] = mysqli_real_escape_string($conn, $inventory_trend);
                    $insert_data5['net_property_plant_and_equipment_trend'] = mysqli_real_escape_string($conn, $net_property_plant_and_equipment_trend);
                    $insert_data5['total_assets_trend'] = mysqli_real_escape_string($conn, $total_assets_trend);
                    $insert_data5['bookvalue_trend'] = mysqli_real_escape_string($conn, $bookvalue_trend);
                    $insert_data5['shareholders_equity_trend'] = mysqli_real_escape_string($conn, $shareholders_equity_trend);
                    $insert_data5['operating_cash_flow_trend'] = mysqli_real_escape_string($conn, $operating_cash_flow_trend);
                    $insert_data5['capital_expenditure_trend'] = mysqli_real_escape_string($conn, $capital_expenditure_trend);
                    $insert_data5['interest_coverage_ratio'] = mysqli_real_escape_string($conn, $interest_coverage_ratio);
                    $insert_data5['operating_cash_flow_to_debt'] = mysqli_real_escape_string($conn, $operating_cash_flow_to_debt);
                    $insert_data5['operating_cash_flow_to_revenue'] = mysqli_real_escape_string($conn, $operating_cash_flow_to_revenue);
                    $insert_data5['operating_cash_flow_to_assets'] = mysqli_real_escape_string($conn, $operating_cash_flow_to_assets);
                    $insert_data5['operating_cash_flow_to_equity'] = mysqli_real_escape_string($conn, $operating_cash_flow_to_equity);
                    $insert_data5['operating_cash_flow_to_ebit'] = mysqli_real_escape_string($conn, $operating_cash_flow_to_ebit);
                    $insert_data5['cash_to_total_assets'] = mysqli_real_escape_string($conn, $cash_to_total_assets);
                    $insert_data5['trade_receivables_to_total_assets'] = mysqli_real_escape_string($conn, $trade_receivables_to_total_assets);
                    $insert_data5['inventories_to_total_assets'] = mysqli_real_escape_string($conn, $inventories_to_total_assets);
                    $insert_data5['fixed_assets_to_total_assets'] = mysqli_real_escape_string($conn, $fixed_assets_to_total_assets);
                    $insert_data5['current_liabilities_to_total_liabilities'] = mysqli_real_escape_string($conn, $current_liabilities_to_total_liabilities);
                    $insert_data5['export_proportion'] = mysqli_real_escape_string($conn, $export_proportion);
                    $insert_data5['salaries_and_employee_benefits_net_sale'] = mysqli_real_escape_string($conn, $salaries_and_employee_benefits_net_sale);
                    $insert_data5['administrative_expenses_net_sale'] = mysqli_real_escape_string($conn, $administrative_expenses_net_sale);
                    $insert_data5['depreciation_and_amortization_net_sale'] = mysqli_real_escape_string($conn, $depreciation_and_amortization_net_sale);
                    $insert_data5['interest_paid_net_sale'] = mysqli_real_escape_string($conn, $interest_paid_net_sale);
                    $insert_data5['income_tax_net_sale'] = mysqli_real_escape_string($conn, $income_tax_net_sale);
                    $insert_data5['operating_cash_flow_to_total_cash_flow'] = mysqli_real_escape_string($conn, $operating_cash_flow_to_total_cash_flow);
                    $insert_data5['investing_cash_flow_to_total_cash_flow'] = mysqli_real_escape_string($conn, $investing_cash_flow_to_total_cash_flow);
                    $insert_data5['financial_cash_flow_to_total_cash_flow'] = mysqli_real_escape_string($conn, $financial_cash_flow_to_total_cash_flow);
                    $insert_data5['cost_to_income_ratio'] = mysqli_real_escape_string($conn, $cost_to_income_ratio);
                    $insert_data5['bank_efficiency_ratio'] = mysqli_real_escape_string($conn, $bank_efficiency_ratio);
                    $insert_data5['loans_to_deposits_ratio'] = mysqli_real_escape_string($conn, $loans_to_deposits_ratio);
                    $insert_data5['loans_to_customers_to_deposits_from_customers'] = mysqli_real_escape_string($conn, $loans_to_customers_to_deposits_from_customers);
                    $insert_data5['liquid_assets_to_deposit_ratio'] = mysqli_real_escape_string($conn, $liquid_assets_to_deposit_ratio);
                    $insert_data5['liquid_assets_to_deposit_from_customers_ratio'] = mysqli_real_escape_string($conn, $liquid_assets_to_deposit_from_customers_ratio);
                    $insert_data5['loans_to_asset_ratio'] = mysqli_real_escape_string($conn, $loans_to_asset_ratio);
                    $insert_data5['loans_to_customer_to_asset_ratio'] = mysqli_real_escape_string($conn, $loans_to_customer_to_asset_ratio);
                    $insert_data5['net_interest_income_trend'] = mysqli_real_escape_string($conn, $net_interest_income_trend);
                    $insert_data5['net_fee_and_commission_income_trend'] = mysqli_real_escape_string($conn, $net_fee_and_commission_income_trend);
                    $insert_data5['loans_and_advances_to_customers_trend'] = mysqli_real_escape_string($conn, $loans_and_advances_to_customers_trend);
                    $insert_data5['loans_and_advances_trend'] = mysqli_real_escape_string($conn, $loans_and_advances_trend);
                    $insert_data5['deposits_from_customers_trend'] = mysqli_real_escape_string($conn, $deposits_from_customers_trend);
                    $insert_data5['deposits_trend'] = mysqli_real_escape_string($conn, $deposits_trend);
                    $insert_data5['earning_assets'] = mysqli_real_escape_string($conn, $earning_assets);
                    $insert_data5['yield_on_earning_assets'] = mysqli_real_escape_string($conn, $yield_on_earning_assets);
                    $insert_data5['net_interest_margin'] = mysqli_real_escape_string($conn, $net_interest_margin);
                    $insert_data5['loss_ratio'] = mysqli_real_escape_string($conn, $loss_ratio);
                    $insert_data5['underwriting_expenses_ratio'] = mysqli_real_escape_string($conn, $underwriting_expenses_ratio);
                    $insert_data5['ceded_premium_ratio'] = mysqli_real_escape_string($conn, $ceded_premium_ratio);
                    $insert_data5['net_premium_earned_trend'] = mysqli_real_escape_string($conn, $net_premium_earned_trend);
                    $insert_data5['fees_and_commissions_trend'] = mysqli_real_escape_string($conn, $fees_and_commissions_trend);
                    $insert_data5['net_investment_income_trend'] = mysqli_real_escape_string($conn, $net_investment_income_trend);
                    $insert_data5['recievables_arising_out_direct_insurance_operations_trend'] = mysqli_real_escape_string($conn, $recievables_arising_out_direct_insurance_operations_trend);
                    $insert_data5['earning_per_share'] = mysqli_real_escape_string($conn, $earning_per_share);
                    $insert_data5['price_to_earnings_x'] = mysqli_real_escape_string($conn, $price_to_earnings_x);
                    $insert_data5['market_capitalization_net_sales_price_sales_ratio_x'] = mysqli_real_escape_string($conn, $market_capitalization_net_sales_price_sales_ratio_x);
                    $insert_data5['market_capitalization_to_gross_profit_x'] = mysqli_real_escape_string($conn, $market_capitalization_to_gross_profit_x);
                    $insert_data5['market_capitalization_to_EBITDA'] = mysqli_real_escape_string($conn, $market_capitalization_to_EBITDA);
                    $insert_data5['market_capitalization_to_EBIT_x'] = mysqli_real_escape_string($conn, $market_capitalization_to_EBIT_x);
                    $insert_data5['market_capitalization_to_total_assets_x'] = mysqli_real_escape_string($conn, $market_capitalization_to_total_assets_x);
                    $insert_data5['market_capitalization_to_shareholders_equity'] = mysqli_real_escape_string($conn, $market_capitalization_to_shareholders_equity);
                    $insert_data5['market_capitalization_to_book_value'] = mysqli_real_escape_string($conn, $market_capitalization_to_book_value);
                    $insert_data5['market_capitalization_to_capital_employed_x'] = mysqli_real_escape_string($conn, $market_capitalization_to_capital_employed_x);
                    $insert_data5['market_capitalization_to_operating_cashflow_x'] = mysqli_real_escape_string($conn, $market_capitalization_to_operating_cashflow_x);
                    $insert_data5['enterprise_value_net_sales_x'] = mysqli_real_escape_string($conn, $enterprise_value_net_sales_x);
                    $insert_data5['enterprise_value_to_gross_profit_x'] = mysqli_real_escape_string($conn, $enterprise_value_to_gross_profit_x);
                    $insert_data5['enterprise_value_to_EBITDA_x'] = mysqli_real_escape_string($conn, $enterprise_value_to_EBITDA_x);
                    $insert_data5['enterprise_value_to_ebit_x'] = mysqli_real_escape_string($conn, $enterprise_value_to_ebit_x);
                    $insert_data5['enterprise_value_to_total_assets_x'] = mysqli_real_escape_string($conn, $enterprise_value_to_total_assets_x);
                    $insert_data5['enterprise_value_to_capital_employed_x'] = mysqli_real_escape_string($conn, $enterprise_value_to_capital_employed_x);
                    $insert_data5['enterprise_value_to_operating_cashflow_x'] = mysqli_real_escape_string($conn, $enterprise_value_to_operating_cashflow_x);
                    $insert_data5['stock_exchange'] = mysqli_real_escape_string($conn, $stock_exchange);
                    $insert_data5['indices'] = mysqli_real_escape_string($conn, $indices);
                    $insert_data5['yearly_dividend'] = mysqli_real_escape_string($conn, $yearly_dividend);
                    $insert_data5['close_price'] = mysqli_real_escape_string($conn, $close_price);
                    $insert_data5['volume_piece'] = mysqli_real_escape_string($conn, $volume_piece);
                    $insert_data5['calculated_turnover'] = mysqli_real_escape_string($conn, $calculated_turnover);
                    $insert_data5['outstanding_shares'] = mysqli_real_escape_string($conn, $outstanding_shares);
                    $insert_data5['market_capitalization'] = mysqli_real_escape_string($conn, $market_capitalization);
                    $insert_data5['reference_date'] = mysqli_real_escape_string($conn, $reference_date);
                    $insert_data5['close_price_1_year_high'] = mysqli_real_escape_string($conn, $close_price_1_year_high);
                    $insert_data5['close_price_3_year_high'] = mysqli_real_escape_string($conn, $close_price_3_year_high);
                    $insert_data5['close_price_5_year_high'] = mysqli_real_escape_string($conn, $close_price_5_year_high);
                    $insert_data5['close_price_1_year_low'] = mysqli_real_escape_string($conn, $close_price_1_year_low);
                    $insert_data5['close_price_3_year_low'] = mysqli_real_escape_string($conn, $close_price_3_year_low);
                    $insert_data5['close_price_5_year_low'] = mysqli_real_escape_string($conn, $close_price_5_year_low);
                    $insert_data5['percent_change_from_1_year_low'] = mysqli_real_escape_string($conn, $percent_change_from_1_year_low);
                    $insert_data5['percent_change_from_3_year_low'] = mysqli_real_escape_string($conn, $percent_change_from_3_year_low);
                    $insert_data5['percent_change_from_5_year_low'] = mysqli_real_escape_string($conn, $percent_change_from_5_year_low);
                    $insert_data5['fiscal_year'] = mysqli_real_escape_string($conn, $fiscal_year);
                    
                    $insert_data5['status'] = "Active";
                    $insert_data5['created_at'] = date("Y-m-d H:i:s");
                    $insert_data5['updated_at'] = date("Y-m-d H:i:s");
                    //print_r($insert_data5);
                    $obj_company->insertfinancialdetailofcompany($insert_data5, 0);
                    //End financial company data
                }


               
 
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            echo "<script> alert('Record Added succesfully....'); </script>";
    }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page

header("Location:manage-company.php");


?>
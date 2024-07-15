<?php
require_once("classes/cls-company.php");


$obj_company = new Company();

#Get Request Parameters
# shortcode/date_range/price_range/sort/limit/page

$cmp_id = $_POST["cmpid"];

if($cmp_id!="")
{
    $condition = "`tbl_financial`.`cmp_id`='$cmp_id'";
    $fields = "`tbl_financial`.*";
    $company_detail_views = $obj_company->getFinancialCompanyDetails($fields, $condition, '', '', '', 0);
}


?>
<style>
    .table-bg-blue{
        font-size: 14px;
        background-color: #B21515;
        color: #fff;
        font-weight:600;
    }
    
    .table th{
        font-size:14px;
        font-weight:700;
    }
    .mt-4{
        margin-top:40px;
    }
    .data{
        font-size:13px;
        font-weight:500;
    }
    .bg-light{
        background-color:#a5a5a5;
    }
    .b-shadow{
        webkit-box-shadow: 3px 2px 10px 0px #a7a7a75c;
    box-shadow: 3px 2px 10px 0px #a7a7a75c;
    border-radius:7px;
    }
    .data > td{
        max-width:100px;
    }
    .text-right{
        text-align:right;
    }
    .sticky{
        webkit-box-shadow:1px 1px 50px #0202020f;
            box-shadow:1px 1px 50px #0202020f;
    }
</style>

           <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <div class="">
                                            
                                        <hr>
                                        <div>
                                            <table class="table cn1 table-bordered b-shadow table-responsive" style="width:60%">
                                            <?php foreach($company_detail_views as $company_detail_view) {?>
                                            <tr class="table-bg-blue">
                                                <td colspan="2">Financial Summary</td>
                                            </tr>
                                            <?php if($company_detail_view['financial_auditors']!=""){?>
                                            <tr class="data">
                                                <td>Financial Auditors</td>
                                                <td><?php echo $company_detail_view['financial_auditors'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['legal_form']!=""){?>
                                            <tr class="data">
                                                <td>Legal Form</td>
                                                <td><?php echo $company_detail_view['legal_form'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['listed_unlisted']!=""){?>
                                            <tr class="data">
                                                <td>Listed/Unlisted</td>
                                                <td><?php echo $company_detail_view['listed_unlisted'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['total_operating_revenue']!=""){?>
                                            <tr class="data">
                                                <td>Total operating revenue</td>
                                                <td class="text-right"><?php echo $company_detail_view['total_operating_revenue'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['total_assets']!=""){?>
                                            <tr class="data">
                                                <td>Total assets</td>
                                                <td class="text-right"><?php echo $company_detail_view['total_assets'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['current_assets']!=""){?>
                                            <tr class="data">
                                                <td>Current assets</td>
                                                <td class="text-right"><?php echo $company_detail_view['current_assets'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['inventories']!=""){?>
                                            <tr class="data">
                                                <td>Inventories</td>
                                                <td class="text-right"><?php echo $company_detail_view['inventories'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['trade_and_other_receivables']!=""){?>
                                            <tr class="data">
                                                <td>Trade and other receivables</td>
                                                <td class="text-right"><?php echo $company_detail_view['trade_and_other_receivables'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['cash_and_cash_equivalents']!=""){?>
                                            <tr class="data">
                                                <td>Cash and Cash Equivalents</td>
                                                <td class="text-right"><?php echo $company_detail_view['cash_and_cash_equivalents'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['short_term_financial_assets']!=""){?>
                                            <tr class="data">
                                                <td>Short term financial assets</td>
                                                <td class="text-right"><?php echo $company_detail_view['short_term_financial_assets'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['non_current_assets']!=""){?>
                                            <tr class="data">
                                                <td>Non-current assets</td>
                                                <td class="text-right"><?php echo $company_detail_view['non_current_assets'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['total_equity']!=""){?>
                                            <tr class="data">
                                                <td>Total equity</td>
                                                <td class="text-right"><?php echo $company_detail_view['total_equity'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['total_liabilities']!=""){?>
                                            <tr class="data">
                                                <td>
                                                   Total liabilities 
                                                </td>
                                                <td class="text-right"><?php echo $company_detail_view['total_liabilities'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['non_current_liabilities']!=""){?>
                                            <tr class="data">
                                                <td>Non-current liabilities</td>
                                                <td class="text-right"><?php echo $company_detail_view['non_current_liabilities'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['current_liabilities']!=""){?>
                                            <tr class="data">
                                                <td>Current liabilities</td>
                                                <td class="text-right"><?php echo $company_detail_view['current_liabilities'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['current_loans_and_borrowings']!=""){?>
                                            <tr class="data">
                                                <td>Current loans and borrowings</td>
                                                <td class="text-right"><?php echo $company_detail_view['current_loans_and_borrowings'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['trade_and_other_payables']!=""){?>
                                            <tr class="data">
                                                <td>Trade and other payables</td>
                                                <td class="text-right"><?php echo $company_detail_view['trade_and_other_payables'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['net_cash']!=""){?>
                                            <tr class="data">
                                                <td>Net Cash</td>
                                                <td class="text-right"><?php echo $company_detail_view['net_cash'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['net_debt']!=""){?>
                                            <tr class="data">
                                                <td>Net Debt</td>
                                                <td class="text-right"><?php echo $company_detail_view['net_debt'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['raw_materials_and_consumables_used']!=""){?>
                                            <tr class="data">
                                                <td>Raw materials and consumables used</td>
                                                <td class="text-right"><?php echo $company_detail_view['raw_materials_and_consumables_used'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['employee_benefit_expense']!=""){?>
                                            <tr class="data">
                                                <td>Employee benefit expense</td>
                                                <td class="text-right"><?php echo $company_detail_view['employee_benefit_expense'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['ebitda']!=""){?>
                                            <tr class="data">
                                                <td>EBITDA</td>
                                                <td class="text-right"><?php echo $company_detail_view['ebitda'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['net_sales_revenue']!=""){?>
                                            <tr class="data">
                                                <td>Net sales revenue</td>
                                                <td class="text-right"><?php echo $company_detail_view['net_sales_revenue'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['depreciation_amortization_and_impairment_charges']!=""){?>
                                            <tr class="data">
                                                <td>Depreciation, amortization and impairment charges</td>
                                                <td class="text-right"><?php echo $company_detail_view['depreciation_amortization_and_impairment_charges'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['operating_profit_EBIT']!=""){?>
                                            <tr class="data">
                                                <td>Operating profit (EBIT)</td>
                                                <td class="text-right"><?php echo $company_detail_view['operating_profit_EBIT'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['profit_before_income_tax']!=""){?>
                                            <tr class="data">
                                                <td>Profit before income tax</td>
                                                <td class="text-right"><?php echo $company_detail_view['profit_before_income_tax'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['net_profit_loss_for_the_period']!=""){?>
                                            <tr class="data">
                                                <td>Net Profit (Loss) for the Period</td>
                                                <td class="text-right"><?php echo $company_detail_view['net_profit_loss_for_the_period'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['price_per_earning_x']!=""){?>
                                            <tr class="data">
                                                <td>Price per Earning (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['price_per_earning_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['earning_per_share']!=""){?>
                                            <tr class="data">
                                                <td>Earning per Share</td>
                                                <td class="text-right"><?php echo $company_detail_view['earning_per_share'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['stock_exchange']!=""){?>
                                            <tr class="data">
                                                <td>Stock Exchange</td>
                                                <td><?php echo $company_detail_view['stock_exchange'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['outstanding_shares']!=""){?>
                                            <tr class="data">
                                                <td>Outstanding Shares</td>
                                                <td><?php echo $company_detail_view['outstanding_shares'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['fiscal_year']!=""){?>
                                            <tr class="data">
                                                <td>Fiscal Year</td>
                                                <td><?php echo $company_detail_view['fiscal_year'];?></td>
                                            </tr>
                                            <?php }?>
                                            
                                            <tr class="table-bg-blue">
                                                <td colspan="2">Key Ratios</td>
                                            </tr>
                                            
                                            <?php if($company_detail_view['market_capitalization']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_net_sales_price_sales_ratio_x']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization/Net Sales (Price Sales Ratio) (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_net_sales_price_sales_ratio_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_gross_profit_x']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to Gross Profit (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_gross_profit_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_EBITDA']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to EBITDA</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_EBITDA'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_EBIT_x']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to EBIT (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_EBIT_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_total_assets_x']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to Total Assets (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_total_assets_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_shareholders_equity']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to Shareholder's Equity</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_shareholders_equity'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_book_value']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to Book Value</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_book_value'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_capital_employed_x']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to Capital Employed (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_capital_employed_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['market_capitalization_to_operating_cashflow_x']!=""){?>
                                            <tr class="data">
                                                <td>Market Capitalization to Operating Cashflow (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['market_capitalization_to_operating_cashflow_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value_net_sales_x']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise value/Net Sales (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value_net_sales_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value_to_gross_profit_x']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value to Gross Profit (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value_to_gross_profit_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value_to_EBITDA_x']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value to EBITDA (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value_to_EBITDA_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value_to_ebit_x']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value to EBIT (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value_to_ebit_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value_to_total_assets_x']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value to Total Assets (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value_to_total_assets_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value_to_capital_employed_x']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value to Capital Employed (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value_to_capital_employed_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['enterprise_value_to_operating_cashflow_x']!=""){?>
                                            <tr class="data">
                                                <td>Enterprise Value to Operating Cashflow (x)</td>
                                                <td class="text-right"><?php echo $company_detail_view['enterprise_value_to_operating_cashflow_x'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php }?>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        
         
        
        
        

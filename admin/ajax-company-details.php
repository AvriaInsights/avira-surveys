<?php
require_once("classes/cls-company.php");


$obj_company = new Company();

#Get Request Parameters
# shortcode/date_range/price_range/sort/limit/page

$cmp_id = $_POST["cmpid"];

if($cmp_id!="")
{
    $condition = "`tbl_company`.`cmp_id`='$cmp_id'";
    $fields = "`tbl_company`.*";
    $company_detail_views = $obj_company->getspecCompanydetails($fields, $condition, '', '', '', 0);
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
                                        <table class="table cn1 table-bordered b-shadow table-responsive">
                                        <?php foreach($company_detail_views as $company_detail_view) {?>
                                        <tr class="table-bg-blue">
                                            <td colspan="2">Company Basics</td>
                                        </tr>
                                        <thead>
                                            <tr>
                                              <th>Company Name</th>
                                              <th><?php echo stripslashes($company_detail_view['company']);?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                   
                                            
                                            <tr class="data">
                                                <td>Country</td>
                                                <td><?php echo $company_detail_view['country'];?></td>
                                            </tr>
                                            <?php if($company_detail_view['region']!=""){?>
                                            <tr class="data">
                                                <td>Region</td>
                                                <td><?php echo $company_detail_view['region'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['main_industry']!=""){?>
                                            <tr class="data">
                                                <td>Main Activity Industries</td>
                                                <td><?php echo $company_detail_view['main_industry'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['secondary_industry']!=""){?>
                                            <tr class="data">
                                                <td>Seconday Activity Industries</td>
                                                <td><?php echo $company_detail_view['secondary_industry'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['state_country']!=""){?>
                                            <tr class="data">
                                                <td>State/County</td>
                                                <td><?php echo $company_detail_view['state_country'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['city']!=""){?>
                                            <tr class="data">
                                                <td>City</td>
                                                <td><?php echo $company_detail_view['city'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['postal_code']!=""){?>
                                            <tr class="data">
                                                <td>Postal Code</td>
                                                <td><?php echo $company_detail_view['postal_code'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['address']!=""){?>
                                            <tr class="data">
                                                <td>Address</td>
                                                <td><?php echo $company_detail_view['address'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['address_type']!=""){?>
                                            <tr class="data">
                                                <td>Address Type</td>
                                                <td><?php echo $company_detail_view['address_type'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['phone']!=""){?>
                                            <tr class="data">
                                                <td>Phone</td>
                                                <td><?php echo $company_detail_view['phone'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['fax']!=""){?>
                                            <tr class="data">
                                                <td>Fax</td>
                                                <td><?php echo $company_detail_view['fax'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['email']!=""){?>
                                            <tr class="data">
                                                <td>Email</td>
                                                <td><?php echo $company_detail_view['email'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['website']!=""){?>
                                            <tr class="data">
                                                <td>Website</td>
                                                <td><?php echo $company_detail_view['website'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['business_description_products']!=""){?>
                                            <tr class="data">
                                                <td>Business Description/Products</td>
                                                <td style="text-align:justify;"><?php echo $company_detail_view['business_description_products'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['no_of_employees']!=""){?>
                                            <tr class="data">
                                                <td>Number of Employees</td>
                                                <td><?php echo $company_detail_view['no_of_employees']." (".$company_detail_view['no_of_employee_year'].")";?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['subsidiaries']!=""){?>
                                            <tr class="data">
                                                <td>Subsidiaries</td>
                                                <td><?php echo $company_detail_view['subsidiaries'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['main_products']!=""){?>
                                            <tr class="data">
                                                <td>Main Products</td>
                                                <td><?php echo $company_detail_view['main_products'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['incorporation_date']!=""){?>
                                            <tr class="data">
                                                <td>Incorporation Date</td>
                                                <td><?php echo $company_detail_view['incorporation_date'];?></td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['company_age_type']!=""){?>
                                            <tr class="data">
                                                <td>Company Age</td>
                                                <td><?php echo $company_detail_view['company_age_type'];?></td>
                                            </tr>
                                            <?php }?>
                                            <tr class="table-bg-blue">
                                                <td colspan="2">Key People</td>
                                            </tr>
                                            <tr class="data">
                                            <td>Key Executives</td>
                                            <td>
                                                <tr class="data"><th style="align:center;">Name</th> <th style="align:center;">Designation</th></tr>
                                            <?php if($company_detail_view['key_executives']!=""){ 
                                              $keyexe=$company_detail_view['key_executives'];
                                              $keyexarray=explode(",",$keyexe);
                                              //echo count($keyexarray);
                                              for($kk=0;$kk<count($keyexarray);$kk++)
                                              {
                                                  $mainvalue=explode("(",$keyexarray[$kk]);
                                                  //echo $mainvalue[0];
                                                  //echo trim($mainvalue[1],")");
                                                  //echo "<br>";
                                            ?>
                                             <tr class="data"><td><?php echo $mainvalue[0];?></td> <td><?php echo trim($mainvalue[1],")");?></td></tr>
                                             <?php }?>
                                             </td>
                                            </tr>
                                            <?php }?>
                                            <?php if($company_detail_view['shareholder']!=""){?>
                                            <tr class="data">
                                                <td>Shareholders</td>
                                                <td><?php echo $company_detail_view['shareholder'];?></td>
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
                        
         
        
        
        

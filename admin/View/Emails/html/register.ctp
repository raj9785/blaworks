<?php

//pr($arr_var); 
?>

<div style="width:100% !important;overflow-y:none">
    <table width="100%" style="font-family: Arial, Helvetica, sans-serif">
        <tr>
            <td style="font-size: 13px; padding: 10px 0px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>

                        <td width="70%" valign="top" style="padding:0px 0 15px 0; ">
                            <h3 style="margin-bottom:0px;">Welcome</h3> 
                        </td> 
                        <td width="30%" align="right" valign="middle" style="padding-top:2px;">
                            <img src="<?php echo WEBSITE_URL . 'img/main-logo.jpg'; ?>" width="158" height="40" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding:0px 0px 0px">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">                                        
                    <tr>                     
                        <td align="left" style="font-size: 14px; padding: 0px 0px 10px;">                                
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="50%" align="left"  style="border-top: solid 1px #ccc; border-bottom: solid 1px #ccc; font-size:11px; color:#505050; padding: 5px 0;">
                                        Hello <?php echo ucfirst($arr_var['User']['vendor_name']); ?>
                                    </td>
                                    <td align="right" style="border-top: solid 1px #ccc; border-bottom: solid 1px #ccc; font-size:11px; color:#505050; padding: 5px 0;">Mobile Number : <?php echo $arr_var['User']['vendor_phone']; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>			   


        <tr style="background:#FDCBA5; font-size:13px; color: #505050; font-family: arial;">
            <td style="padding: 10px 10px 10px;">
               <table cellspacing="0" width="100%">

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td valign="top" width="18%"><img src="<?php echo WEBSITE_URL; ?>img/arrow_invoice.png" width="34" height="13" style="display:block; vertical-align:top; margin-top: -14px;margin-left:30px" /></td>
                    </tr>

                    <tr>
                        <td align="left" colspan="3">
                            <p style="padding:0px; margin-bottom:0; font-size:12px;">
                                Welcome to Super Cabz, India&#39;s safest Inter-City cab provider.  
                            </p>											
                        </td>
                    </tr>

                    <tr >
                        <td align="left" style="" colspan="3">
                            <p style="padding:0px; font-size:12px; margin-bottom:0;">
                                It gives us immense pleasure to have you on board as our partner in our journey to revolutionize intercity travel in India. We have designed a very simple & easy to use platform for you to accept bookings in just 4 easy steps and to keep track of your invoices and receipts.  
                            </p>											
                        </td>
                    </tr>

                    <tr>
                        <td align="left" style="" colspan="3">
                            <p style="padding:0px; margin-bottom:0; font-size:12px; ">

                                Please find below your username and password to log in to our vendor panel i.e. <a href="http://www.supercabz.com/business" target="_blank">www.supercabz.com/business</a>.
                                We strongly recommend you to change this password after your first log in for security purposes and not to share this username & password with anyone else.

                            </p>											
                        </td>
                    </tr>

                    <tr>
                        <td align="left" style="font-size:12px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="left" valign="top" width="10%" style="font-size:12px;">Username:</td>
                                    <td align="left" valign="top" width="90%" style="font-size:12px;"><?php echo $arr_var['User']['email']; ?> / <?php echo $arr_var['User']['vendor_phone']; ?></td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" width="10%" style="font-size:12px;">Password:</td>
                                    <td align="left" valign="top" width="90%" style="font-size:12px;"><?php echo $arr_var['User']['pass']; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td align="left" style="" colspan="3">
                            <p style="padding:0px; margin-top:7px; font-size:12px;">
                                
                                <?php 
                                $unique_id_vendor=base64_encode($arr_var['User']['unique_id_vendor']);
                                ?> 
                                
Please <a href="http://www.supercabz.com/download-agreement/<?php echo $unique_id_vendor; ?>" target="_blank">click here</a> to download the Vendor Partner Agreement. This link will be active for 24 hours only. Please take a printout and fill in complete details.
                                
                            </p>											
                        </td>
                    </tr>



                </table>
            </td>
        </tr>


        <tr>
            <td style="padding: 10px 0px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" style="padding:5px 0; border-top: solid 1px #ccc; border-bottom: solid 1px #ccc; font-size: 12px; font-weight: bold; color:#333;">We look forward to a long and fruitful association with you! Team Super Cabz</td>
                    </tr>

                    <tr>
                        <td align="center" style="font-size: 11px; padding:0px; color:#999;">
                            <p style=" color:#999;">This is an auto generated e-mail, please do not reply to the sender.<br />
                                For any queries kindly mail at contact@supercabz.com
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding:0 0 10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <td align="center" style="padding:0px 0; font-size: 11px; color:#999;"><div><?php echo SITE_ADDRESS_LINE1; ?> | <?php echo SITE_ADDRESS_LINE2; ?>, <?php echo SITE_ADDRESS_LINE3; ?>, <?php echo SITE_ADDRESS_LINE4; ?> </div>
                        <div>CIN No. - U63040HR12PTC046453 | PAN No. - AARCS7527A | Service Tax No. - AARCS7527ASD002</div>
                        <div>Service Tax Category - Rent a Cab Scheme Operator</div>
                        <div style=" color:#999;"><i class="fa fa-phone"></i> +91 9310 456789 | www.supercabz.com</div>
                    </td>

                </table>							
            </td>
        </tr>


    </table>

</div>
<?php //exit; ?>
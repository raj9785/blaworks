<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bio Data</title>
        <style>
            @media(max-width:600px){
                table{
                    width: 100% !important;
                } 
                table table table td{
                    width: 100% !important;
                    display: block !important;
                } 
            }

            @font-face {
                font-family: aks;
                src: url(<?php echo WEBSITE_URL ?>admin/fonts/Akshar.ttf) format("truetype");
            }



        </style>

    </head>
    <body>
        <table style="width: 600px;margin: 0 auto;background: url(<?php echo WEBSITE_URL ?>admin/img/bg.jpg) no-repeat center;" id="print_div">
            <tr>
                <td>
                    <table style="width: 520px;margin: 0 auto;">
                        <tr>
                            <td>
                           <?php 
                           if($detail['Applicant']['profile_image']){
                               ?>
                                <img height="150" width="120" src="<?php echo WEBSITE_URL ?>admin/uploads/profilepic/<?php echo $detail['Applicant']['profile_image']; ?>">
                               <?php
                           }else{
                           ?>
                                <img height="150" width="120" src="<?php echo WEBSITE_URL ?>admin/img/candidatepic.jpg">
                           <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3 style="font-family: aks,calibri,DejaVu Sans,arial;font-size: 24px;font-weight: 400px; "><?php echo $detail['Applicant']['first_name']." ".$detail['Applicant']['middle_name']." ".$detail['Applicant']['last_name']; ?></h3>
                                <p style="font-family: aks,calibri, DejaVu Sans,arial;font-size: 14px;line-height: 24px;margin: 0px;">Date of Birth: <?php echo $detail['Applicant']['date_of_birth']?date("d-m-Y",strtotime($detail['Applicant']['date_of_birth'])):"N.A"; ?></p>
                                <p style="font-family: aks,calibri, DejaVu Sans,arial;font-size: 14px;line-height: 24px;margin: 0px;">Gender: <?php echo $detail['Applicant']['gender']==1?"Male":"Female"; ?></p>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">Aadhar Number: <?php echo $detail['Applicant']['aadhar_number']?substr($detail['Applicant']['aadhar_number'], 0, 4)."********":"N.A";?></p>
                                <p style="font-family: aks,calibri, DejaVu Sans,arial;font-size: 14px;line-height: 24px;margin: 0px;">Father's Name: <?php echo $detail['ApplicantExtendedProfile']['father_name']?$detail['ApplicantExtendedProfile']['father_name']:"N.A";?></p>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">Educational Qualification: <?php echo $detail['Education']['name']?$detail['Education']['name']:"N.A";?></p>
                                <?php 
                                if($detail['TechnicalCourse']['name']){
                                ?>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">Technical Course: <?php echo $detail['TechnicalCourse']['name']?$detail['TechnicalCourse']['name']:"N.A";?></p>
                                <?php } ?>
                       <?php 
                       $exp=$detail['ApplicantExtendedProfile']['work_experience'];
                       if($exp){
                           $experience=$detail['Applicant']['exp_name'];
                       }else{
                           $experience="N.A";//$experience="0 Years 0 Months";
                       }
                       
//                       if($exp){
//                           $exps=explode(".", $exp);
//                           if(!empty($exps)){
//                              $years= @$exps[0]?@$exps[0]:0;
//                              $months=@$exps[1]?@$exps[1]:0;
//                              $experience= $years." Years ".$months." Months";
//                           }
//                       }
                       $known_language="";
                       $ApplicantLanguage=$detail['ApplicantLanguage'];
                       if(!empty($ApplicantLanguage)){
                           $languages=array();
                           foreach($ApplicantLanguage as $ldata){
                               if($ldata['language_id']==1){
                                   $languages['ENGLISH']="ENGLISH";
                               }
                               if($ldata['language_id']==2){
                                   $languages['HINDI']="HINDI";
                               }
                           }
                           $known_language=implode(", ", $languages);
                       }else{
                           $known_language="N.A";
                       }
                       
                   ?>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">Work Experience: <?php echo $experience; ?> </p>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">Languages Knowns: <?php echo $known_language; ?> </p>
                                <?php 
                                if($detail['ApplicantExtendedProfile']['house_number']){
                                ?> 
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">House Number: <?php echo $detail['ApplicantExtendedProfile']['house_number'];  ?>  </p>
                                <?php } ?>

                                 <?php 
                                if($detail['ApplicantExtendedProfile']['village_name']){
                                ?> 
                                <p style="font-family: aks,calibri, DejaVu Sans,arial;font-size: 14px;line-height: 24px;margin: 0px;">Village: <?php echo $detail['ApplicantExtendedProfile']['village_name'];  ?>  </p>
                                <?php } ?>

                                 <?php 
                                if($detail['Panchayat']['name']){
                                ?> 
                                <p style="font-family: aks,calibri, DejaVu Sans,arial;font-size: 14px;line-height: 24px;margin: 0px;">Panchayat: <?php echo $detail['Panchayat']['name'];  ?>  </p>
                                <?php } ?>

                                <?php 
                                if($detail['Block']['name']){
                                ?> 
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">Block: <?php echo $detail['Block']['name'];  ?>  </p>
                                <?php } ?>

                                <?php 
                                if($detail['District']['name']){
                                ?> 
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">District: <?php echo $detail['District']['name'];  ?>  </p>
                                <?php } ?>

                                 <?php 
                                if($detail['ApplicantExtendedProfile']['pin_code']){
                                ?> 
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">Pincode: <?php echo $detail['ApplicantExtendedProfile']['pin_code'];  ?>  </p>
                                <?php } ?>

                                 <?php 
                                if($detail['State']['name']){
                                ?> 
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 24px;margin: 0px;">State: <?php echo $detail['State']['name'];  ?>  </p>
                                <?php } ?>



                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 14px;margin: 0px;">Mobile No: <?php echo $detail['Applicant']['registered_mobile']; ?></p> 
                            </td> 
                        </tr>

                        <tr>
                            <td style="text-align: right;">
                                <img src="<?php echo WEBSITE_URL ?>admin/img/logo.jpg" style="margin-top: 20px;">
                            </td> 
                        </tr>    
                        <tr >
                            <td style="text-align: right;">
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 18px;line-height: 18px;margin: 0px; text-align: right;">Powered By</p>    
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 18px;margin: 0px; text-align: right;">Website:www.skillshaat.com</p>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 18px;margin: 0px; text-align: right;">YouTube Video:http://bit.ly/2EZaE6C</p>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 18px;margin: 0px; text-align: right;">Download the app:https://bit.ly/2I0EvJX</p>
                                <p style="font-family: aks,calibri,DejaVu Sans, arial;font-size: 14px;line-height: 18px;margin: 0px; text-align: right;">Queries:+919650188330</p>
                            </td> 
                        </tr>






                    </table>
                </td>
            </tr>

        </table>
    </body>
</html>


<?php 
//exit;
?>
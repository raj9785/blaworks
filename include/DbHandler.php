<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        require_once dirname(__FILE__) . '/class.phpmailer.php';

        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    function language_list() {
        $q1 = "SELECT * FROM languages where is_active=1";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            $return[$i]['id'] = 0;
            $return[$i]['name'] = "Select";
            $i = 1;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['name'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    public function mobile_authenticate($mobile) {
        $mobpattrn = "/^[789][0-9]{9}$/";
        if (preg_match($mobpattrn, $mobile)) {
            $q1 = "SELECT id FROM applicants where registered_mobile='$mobile'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                return "ALREADY_REGISTERED";
            }


            $q1 = "delete from otps where mobile_number='$mobile'";
            $re1 = mysqli_query($this->conn, $q1);
            $ctime = date("Y-m-d H:i:s ", time());
            $expire_time = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime(date("Y-m-d H:i:s ", time()))));
            $otp = rand(1000, 9999);
            //$otp="123456";		
            $q2 = "INSERT INTO otps (mobile_number, otp, created_on, expired_on, is_verified)";
            $q2 .= "values ('$mobile','$otp', '$ctime', '$expire_time', 0)";
            if (mysqli_query($this->conn, $q2)) {
                $inserted_id = mysqli_insert_id($this->conn);
                $phone_no = $mobile;
                $msg = "Your Verification Code is " . $otp . ". This code is applicable for 15 minutes only";
                $this->send_msg($phone_no, $msg, 1);
                return "SUCCESS";
            } else {
                return 'UNABLE_TO_PROCEED';
            }
        } else {
            return 'INVALID';
        }
    }

    public function mobile_verification($mobile, $otp) {
        $mobpattrn = "/^[789][0-9]{9}$/";
        if (preg_match($mobpattrn, $mobile)) {
            $q1 = "SELECT id FROM applicants where registered_mobile='$mobile'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                return "ALREADY_REGISTERED";
            }

            $q1 = "SELECT id,is_verified,expired_on FROM otps where mobile_number='$mobile' and otp='$otp'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                $array = mysqli_fetch_assoc($re1);
                if ($array['is_verified'] == 1) {
                    return 'ALREADY_VERIFIED';
                } else {
                    $ctime = date("Y-m-d H:i:s ", time());
                    if (strtotime($ctime) <= strtotime($array['expired_on'])) {
                        $q2 = "UPDATE otps set is_verified = 1 where mobile_number='$mobile' and otp='$otp'";
                        if ($res = mysqli_query($this->conn, $q2)) {
                            return 'SUCCESS';
                        } else {
                            return 'UNABLE_TO_PROCEED';
                        }
                    } else {
                        return 'EXPIRED';
                    }
                }
            } else {
                return 'NORECORD';
            }
        } else {
            return 'INVALID';
        }
    }

    /* applicant Registeration */

    //Method will create a new applicant
    public function applicant_registration($first_name, $registered_mobile, $gender, $date_of_birth, $language_id, $middle_name = "", $last_name = "", $state_id = '') {
        $mobpattrn = "/^[789][0-9]{9}$/";
        if (preg_match($mobpattrn, $registered_mobile)) {
            $q1 = "SELECT id,is_verified,expired_on FROM otps where mobile_number='$registered_mobile' and is_verified=1";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                $q1 = "SELECT id FROM applicants where registered_mobile='$registered_mobile'";
                $re1 = mysqli_query($this->conn, $q1);
                if (mysqli_num_rows($re1) > 0) {
                    return "ALREADY_REGISTERED";
                }
                $password_md5 = md5($registered_mobile);
                $created_on = date("Y-m-d H:i:s");
                $date_of_birth = $date_of_birth ? date("Y-m-d", strtotime($date_of_birth)) : "";
                $sql = "INSERT INTO applicants (first_name,created_on,registered_mobile, gender, date_of_birth, language_id, middle_name, last_name,state_id,password)";
                $sql .= "values ('$first_name','$created_on','$registered_mobile', '$gender', '$date_of_birth', '$language_id', '$middle_name', '$last_name','$state_id','$password_md5')";
                //execute statement
                $result = mysqli_query($this->conn, $sql);
                //If statment executed successfully
                if ($result) {
                    $return['appliicant_id'] = mysqli_insert_id($this->conn);
                    $applicant_id = $return['appliicant_id'];
                    $return['first_name'] = $first_name;
                    $return['registered_mobile'] = $registered_mobile;
                    $return['gender'] = $gender;
                    $return['date_of_birth'] = $date_of_birth;
                    $return['language_id'] = $language_id ? $language_id : 1;
                    $return['middle_name'] = $middle_name;
                    $return['last_name'] = $last_name;
                    $return['password'] = $registered_mobile;
                    //insert into applicant_job_locations///
                    /* $sql2 = "INSERT INTO applicant_job_locations (applicant_id,state_id)";
                      $sql2 .= " values ('$applicant_id', '$state_id')";
                      mysqli_query($this->conn, $sql2); */

                    return $return;
                } else {
                    //Returning 1 means failed to create student
                    return 'UNABLE_TO_PROCEED';
                }
            } else {
                return 'UNAUTH_NUMBER';
            }
        } else {
            return 'INVALID';
        }
    }

    function education_list($language_id) {
        $q1 = "SELECT le.name,ed.id FROM educations as ed inner join language_map_educations as le on le.education_id=ed.id where ed.is_active=1";
        $q1 .= " and le.language_id=$language_id and le.is_active=1 order by orders desc";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['name'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function applicant_st_ids($user_id) {
        $q1 = "SELECT state_id FROM applicant_job_locations ";
        $q1 .= " where applicant_id=$user_id";
        $rets = array();
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $rets[] = $array['state_id'];
            }
        }
        if (!empty($rets)) {
            return implode(",", $rets);
        } else {
            return "";
        }
    }

    function get_job_category($education_id, $user_id) {
        $return = array();
        $q1 = "SELECT jobs.job_category_id FROM jobs ";
        $q1 .= " inner join job_educations on job_educations.job_id=jobs.id";
        $q1 .= " where job_educations.education_id <=$education_id and jobs.is_active=1";
        $ids = $this->applicant_st_ids($user_id);
        //echo $ids ;exit;

        if ($ids) {
            $q1 .= " and jobs.state_id in (" . $ids . ")";
        }


        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['job_category_id'];
            }
        }
        $rt = "";
        if (!empty($return)) {
            $rt = implode(",", $return);
        }
        return $rt;
    }

    function job_category_list($language_id, $user_id, $education_id) {
        /* $cond = "";
          if ($stids = $this->get_ap_states($user_id)) {
          $cond .= " and jobs.state_id in (" . $stids . ")";
          }
          $cond .= " and job_educations.education_id<=$education_id ";
          $qins = "(select count(jobs.id) from jobs inner join job_educations on job_educations.job_id = jobs.id";
          $qins .= " where jobs.job_category_id=job_categories.id " . $cond . ") as total_jobs";
         */
        $q1 = "select job_categories.id,job_categories.icon,language_map_job_categories.title ";
        // $q1 .= " " . $qins;
        $q1 .= " from job_categories inner join language_map_job_categories on job_categories.id = language_map_job_categories.job_category_id";
        $q1 .= " where job_categories.is_active=1 and language_map_job_categories.language_id=$language_id"; // and job_categories.education_id=$education_id


        /* if ($ids = $this->get_job_category($education_id, $user_id)) {
          $q1 .= " and job_categories.id in (" . $ids . ")";
          } */

        //echo $q1; exit;


        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {

                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['title'];
                $return[$i]['total_jobs'] = 0; //$array['total_jobs'];
                $return[$i]['icon'] = ICON_URL . $array['icon'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function get_tr_category($education_id, $user_id) {
        $return = array();
        $q1 = "SELECT trainings.training_category_id FROM trainings ";
        $q1 .= " inner join training_educations on training_educations.training_id=trainings.id";
        $q1 .= " where training_educations.education_id <=$education_id and trainings.is_active=1";
        $ids = $this->applicant_st_ids($user_id);
        //echo $ids ;exit;

        if ($ids) {
            $q1 .= " and trainings.state_id in (" . $ids . ")";
        }


        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['training_category_id'];
            }
        }
        $rt = "";
        if (!empty($return)) {
            $rt = implode(",", $return);
        }
        return $rt;
    }

    function training_category_list($user_id, $language_id, $education_id) {
        $cond = "";
        /* if ($stids = $this->get_ap_states($user_id)) {
          $cond .= " and trainings.state_id in (" . $stids . ")";
          }
          $cond .= " and training_educations.education_id<=$education_id ";
          $qins = "(select count(trainings.id) from trainings inner join training_educations on training_educations.training_id = trainings.id";
          $qins .= " where trainings.training_category_id=training_categories.id " . $cond . ") as total_trainings";

         */
        $q1 = "select training_categories.icon,training_categories.id,language_map_training_categories.title ";
        ///$q1 .= ", " . $qins;
        $q1 .= " from training_categories inner join language_map_training_categories on training_categories.id = language_map_training_categories.training_category_id and language_map_training_categories.language_id=$language_id";

        $q1 .= " where training_categories.is_active=1 and language_map_training_categories.language_id=$language_id"; //and training_categories.education_id=$education_id

        /* if ($ids = $this->get_tr_category($education_id, $user_id)) {
          $q1 .= " and training_categories.id in (" . $ids . ")";
          } */
        // echo $q1;exit;

        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['title'];
                $return[$i]['total_jobs'] = 0; //$array['total_trainings'];
                $return[$i]['icon'] = ICON_URL . $array['icon'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function save_interest($user_id, $education_id) {
        $q = "UPDATE applicants set education_id = '$education_id' where id='$user_id'";
        mysqli_query($this->conn, $q);
        /*
          $q1 = "SELECT id FROM applicant_job_categories where applicant_id='$user_id' and job_category_id='$job_category_id1'";
          $re1 = mysqli_query($this->conn, $q1);
          if (mysqli_num_rows($re1) == 0) {
          if ($job_category_id1) {
          $q2 = "INSERT INTO applicant_job_categories (applicant_id, job_category_id)";
          $q2 .= "values ('$user_id','$job_category_id1')";
          mysqli_query($this->conn, $q2);
          }
          }

          $q1 = "SELECT id FROM applicant_job_categories where applicant_id='$user_id' and job_category_id='$job_category_id2'";
          $re1 = mysqli_query($this->conn, $q1);
          if (mysqli_num_rows($re1) == 0) {
          if ($job_category_id2) {
          $q2 = "INSERT INTO applicant_job_categories (applicant_id, job_category_id)";
          $q2 .= "values ('$user_id','$job_category_id2')";
          mysqli_query($this->conn, $q2);
          }
          }

          $q1 = "SELECT id FROM applicant_training_categories where applicant_id='$user_id' and training_category_id='$training_id'";
          $re1 = mysqli_query($this->conn, $q1);
          if (mysqli_num_rows($re1) == 0) {
          if ($training_id) {
          $q2 = "INSERT INTO applicant_training_categories (applicant_id, training_category_id)";
          $q2 .= "values ('$user_id','$training_id')";
          mysqli_query($this->conn, $q2);
          }
          }
         */
        return "SUCCESS";
    }

    function no_days($time) {
        $booking_time = strtotime($time);
        $init = time();
        $past = 0;
        if ($booking_time > $init) {
            $time = $booking_time - $init;
        } else {
            $past = 1;
            $time = $init - $booking_time;
        }
        $days = floor($time / (60 * 60 * 24));
        $time -= $days * (60 * 60 * 24);

        $hours = floor($time / (60 * 60));
        $time -= $hours * (60 * 60);

        $minutes = floor($time / 60);
        $time -= $minutes * 60;

        $seconds = floor($time);

        return $days;
    }

    function get_ap_jobc($user_id) {
        $return = array();
        $q1 = "SELECT job_category_id FROM applicant_job_categories ";
        $q1 .= " where applicant_id=$user_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['job_category_id'];
            }
        }
        $rt = "";
        if (!empty($return)) {
            $rt = implode(",", $return);
        }
        return $rt;
    }

    function get_ap_trac($user_id) {
        $return = array();
        $q1 = "SELECT training_category_id FROM applicant_training_categories ";
        $q1 .= " where applicant_id=$user_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['training_category_id'];
            }
        }
        $rt = "";
        if (!empty($return)) {
            $rt = implode(",", $return);
        }
        return $rt;
    }

    public function applicant_home($language_id, $user_id, $education_id, $salary_id = '', $state_id = '') {
        $return = array();
        $apsc = $this->get_ap_jobc($user_id);
        $q1 = "select jobs.id,jobs.created_on,applicant_jobs.applicant_id as applied_status,jobs.image,language_map_jobs.title,jobs.district_id,jobs.year_of_experience,jobs.salary_start,jobs.salary_end,job_categories.icon as job_image ";
        $q1 .= " ,job_details.responsibilities,job_details.job_description,job_details.company_profile,job_details.job_timings,language_map_states.content as state_name ";
        $q1 .= " from jobs ";
        $q1 .= " inner join language_map_jobs on jobs.id = language_map_jobs.job_id and language_map_jobs.language_id=$language_id";
        $q1 .= " inner join job_details on jobs.id = job_details.job_id and job_details.language_id=$language_id";
        $q1 .= " left join language_map_states on jobs.state_id = language_map_states.state_id and language_map_states.language_id=$language_id";
        $q1 .= " inner join job_categories on jobs.job_category_id = job_categories.id";
        if ($apsc) {
            $q1 .= " inner join applicant_job_categories on applicant_job_categories.job_category_id = job_categories.id";
        }

        $q1 .= " inner join job_educations on job_educations.job_id = jobs.id";
        $q1 .= " left join applicant_jobs on applicant_jobs.job_id = jobs.id and applicant_jobs.applicant_id=$user_id";

        $q1 .= " where job_details.language_id=$language_id and job_educations.education_id<=$education_id and language_map_jobs.language_id=$language_id "; //and applicant_job_categories.applicant_id=$user_id
        if ($apsc) {
            $q1 .= " and applicant_job_categories.applicant_id=$user_id";
        }
        if ($stids = $this->get_ap_states($user_id)) {
            $q1 .= " and jobs.state_id in (" . $stids . ")";
        }

        if ($salary_id) {
            $q12 = "SELECT min_range,max_range FROM salaries ";
            $q12 .= " where id=$salary_id";
            $re12 = mysqli_query($this->conn, $q12);
            if (mysqli_num_rows($re12) > 0) {
                $array2 = mysqli_fetch_assoc($re12);
                $min_range = $array2['min_range'];
                $max_range = $array2['max_range'];
                $q1 .= " and ((jobs.salary_start BETWEEN $min_range and $max_range) or (jobs.salary_end BETWEEN $min_range and $max_range) ) ";
            }
        }

        $q1 .= " group by jobs.id order by job_educations.education_id desc,rand() limit 6 ";

        //echo $q1; exit;
        $re1 = mysqli_query($this->conn, $q1);

        $jobs = array();
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $jobs[$i]['id'] = $array['id'];
                $jobs[$i]['title'] = $array['title'];
                $jobs[$i]['applied'] = $array['applied_status'] ? 1 : 0;
                $jobs[$i]['responsibilities'] = $this->job_education($array['id'], $language_id);
                $jobs[$i]['year_of_experience'] = $array['year_of_experience'];
                $jobs[$i]['job_description'] = $array['job_description'];
                $jobs[$i]['company_profile'] = $array['company_profile'];
                $jobs[$i]['job_timings'] = $array['job_timings'];
                $jobs[$i]['image'] = ICON_URL . $array['job_image'];
                $jobs[$i]['created_on'] = $this->no_days($array['created_on']);
                $jobs[$i]['salary_start'] = $array['salary_start'];
                $jobs[$i]['salary_end'] = $array['salary_end'];
                $jobs[$i]['state_name'] = $array['state_name'];
                $jobs[$i]['district_name'] = $array['district_id'] == "ALL" ? "All District" : $this->job_district($array['id'], $language_id);
                $i++;
            }
        }
        $return['jobs'] = $jobs;
        //check for trainings//

        /* $q2 = "SELECT id FROM applicant_training_categories ";
          $q2 .= " where applicant_id=$user_id and training_category_id >0 ";
          $re12 = mysqli_query($this->conn, $q2); */
        $q1 = "select trainings.id,trainings.last_date_apply,applicant_trainings.applicant_id as applied_status,language_map_states.content as state_name,language_map_trainings.training_name,language_map_trainings.description,trainings.duration,trainings.expected_salary,trainings.district_id,training_categories.icon as job_image ";
        $q1 .= " from trainings ";
        $q1 .= " inner join language_map_trainings on trainings.id = language_map_trainings.training_id and language_map_trainings.language_id=$language_id";
        $q1 .= " inner join training_categories on trainings.training_category_id = training_categories.id";

        $cond = "";
        $order_by = "";
//        if (mysqli_num_rows($re12) > 0) {
//            $q1 .= " inner join applicant_training_categories on applicant_training_categories.training_category_id = training_categories.id";
//            $cond = " and applicant_training_categories.applicant_id=$user_id";
//            $order_by = " order by trainings.id desc ";
//            $trainings_heading = 1;
//        } else {
//        $q1 .= " inner join training_category_binds_job_categories on training_category_binds_job_categories.training_category_id = training_categories.id";
//        $q1 .= " inner join job_categories on job_categories.id = training_category_binds_job_categories.job_category_id";
//        $q1 .= " inner join applicant_job_categories on applicant_job_categories.job_category_id = job_categories.id";
//        if ($apsc) {
//            $cond = " and applicant_job_categories.applicant_id=$user_id";
//        }
        $order_by = " order by training_educations.education_id desc,rand() ";
        $trainings_heading = 0;
        // }
        $q1 .= " left join applicant_trainings on applicant_trainings.training_id = trainings.id and applicant_trainings.applicant_id=$user_id";
        $q1 .= " inner join training_educations on training_educations.training_id = trainings.id";
        $q1 .= " inner join language_map_states on trainings.state_id = language_map_states.state_id and language_map_states.language_id=$language_id ";
        $q1 .= " where trainings.is_active=1 and training_educations.education_id <= $education_id " . $cond;

        //if ($stids = $this->get_ap_states($user_id)) {
        if ($state_id) {
            $q1 .= " and trainings.state_id in (" . $state_id . ")";
        }
        // }
        $q1 .= " group by trainings.id " . $order_by . " limit 2 ";


        $re1 = mysqli_query($this->conn, $q1);
        $trainings = array();
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $trainings[$i]['id'] = $array['id'];
                $trainings[$i]['applied'] = $array['applied_status'] ? 1 : 0;
                $trainings[$i]['title'] = $array['training_name'];
                $trainings[$i]['state_name'] = $array['state_name'];
                $trainings[$i]['duration'] = $array['duration'];
                $trainings[$i]['min_qualification'] = $this->training_education($array['id'], $language_id);
                $trainings[$i]['expected_salary'] = $array['expected_salary'];
                $trainings[$i]['image'] = $array['image'];
                $trainings[$i]['created_on'] = $array['created_on'];
                $trainings[$i]['last_date_apply'] = $array['last_date_apply'] ? date("d-m-Y", strtotime($array['last_date_apply'])) : "";
                $trainings[$i]['description'] = $array['description'];
                $trainings[$i]['image'] = ICON_URL . $array['job_image'];
                $trainings[$i]['district_name'] = $array['district_id'] == "ALL" ? "All Disctrict" : $this->training_district($array['id'], $language_id);

                $i++;
            }
        }
        $return['trainings'] = $trainings;
        $return['training_heading'] = $trainings_heading;


        return $return;
    }

    function applicant_info($user_id, $language_id) {
        $sel_user = "SELECT applicants.first_name,applicants.panchayat_id,applicants.profile_image, ";
        $sel_user .= " applicants.registered_mobile,applicants.cast_category,applicants.gender,applicants.date_of_birth,applicants.language_id,applicants.middle_name, ";
        $sel_user .= " applicants.last_name,applicants.secondary_mobile,applicants.aadhar_number,applicants.email,applicants.willing_to_relocate,";
        $sel_user .= " applicants.education_id,applicants.technical_course_id,applicants.state_id,applicants.district_id,applicants.block_id, ";
        $sel_user .= " expfl.village_name,expfl.house_number,expfl.father_name,expfl.pin_code,expfl.work_experience, ";
        $sel_user .= " language_map_districts.content as district_name,language_map_states.content as state_name, ";
        $sel_user .= " language_map_educations.name as edu_name,language_map_technical_courses.name as tech_name ";
        $sel_user .= " from applicants ";
        $sel_user .= " left join applicant_extended_profiles as expfl on expfl.applicant_id=applicants.id";
        $sel_user .= " left join language_map_educations on language_map_educations.education_id=applicants.education_id and language_map_educations.language_id=$language_id";
        $sel_user .= " left join language_map_technical_courses on language_map_technical_courses.technical_course_id=applicants.technical_course_id and language_map_technical_courses.language_id=$language_id";
        $sel_user .= " left join language_map_districts on language_map_districts.district_id=applicants.district_id and language_map_districts.language_id=$language_id";
        $sel_user .= " left join language_map_states on language_map_states.state_id=applicants.state_id and language_map_states.language_id=$language_id";
        //$sel_user .= " left join applicant_extended_profiles as expfl on expfl.applicant_id=applicants.id";
        $sel_user .= " WHERE applicants.id = '$user_id'";
        //echo $sel_user; exit;
        $user = mysqli_query($this->conn, $sel_user);
        if (mysqli_num_rows($user) > 0) {
            $res = mysqli_fetch_assoc($user);

            $return['appliicant_id'] = $user_id;
            $profile_completed = 30;
            $return['profile_image'] = $res['profile_image'] ? PROFILEPICPATHHTTP . $res['profile_image'] : "";
            if ($res['profile_image'] && $res['profile_image'] != null) {
                $profile_completed = $profile_completed + 20;
            }

            $return['first_name'] = $res['first_name'];
            $return['cast_category'] = $res['cast_category'];
            $return['registered_mobile'] = $res['registered_mobile'];
            $return['gender'] = $res['gender'];
            $return['date_of_birth'] = $res['date_of_birth'] ? date("d-m-Y", strtotime($res['date_of_birth'])) : "";
            $return['language_id'] = $res['language_id'] ? $res['language_id'] : 1;
            $return['middle_name'] = $res['middle_name'];
            $return['last_name'] = $res['last_name'];

            $return['secondary_mobile'] = $res['secondary_mobile'];
            $return['aadhar_number'] = $res['aadhar_number'];
            if ($res['aadhar_number'] && $res['father_name']) {
                $profile_completed = $profile_completed + 10;
            }

            $return['email'] = $res['email'];
            $return['willing_to_relocate'] = $res['willing_to_relocate'];

            $return['education_id'] = $res['education_id'];
            $return['technical_course_id'] = $res['technical_course_id'];

            $return['state_id'] = $res['state_id'];
            $return['district_id'] = $res['district_id'];
            $return['block_id'] = $res['block_id'];

            $return['village_name'] = $res['village_name'];
            $return['house_number'] = $res['house_number'];
            $return['father_name'] = $res['father_name'];

            $return['education_name'] = $res['edu_name'];
            $return['technical_course_name'] = $res['tech_name'];
            $return['district_name'] = $res['district_name'];
            $return['state_name'] = $res['state_name'];
            $return['panchayat_id'] = $res['panchayat_id'];


            if ($res['state_id'] && $res['pin_code'] && $res['district_id']) {
                $profile_completed = $profile_completed + 30;
            }



            $return['pin_code'] = $res['pin_code'];
            $return['work_experience'] = $res['work_experience'];
            $languages = array();
            $j = 0;

            $q1 = "SELECT language_id,proficiency_level_id FROM applicant_languages ";
            $q1 .= " where applicant_id=$user_id";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                $i = 0;
                while ($array = mysqli_fetch_array($re1)) {
                    $languages[$j]['language_id'] = $array['language_id'];
                    $languages[$j]['proficiency_level_id'] = $array['proficiency_level_id'];
                    $j++;
                }
            }
            if ($j > 0 && ($res['willing_to_relocate'] == 0 || $res['willing_to_relocate'] == 1)) {
                $profile_completed = $profile_completed + 10;
            }



            $return['profile_completed'] = $profile_completed;
            $return['languages'] = $languages;

            //print_r($return);exit;
            return $return;
        } else {
            return "NO_RECORDS";
        }
    }

    function state_list($language_id) {
        $q1 = "SELECT states.id,language_map_states.content FROM states ";
        $q1 .= "inner join language_map_states on language_map_states.state_id=states.id and language_map_states.language_id=$language_id";
        $q1 .= " where language_map_states.language_id=$language_id and states.is_active=1";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            $return[$i]['id'] = "";
            $return[$i]['name'] = "Select";
            $i++;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['content'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function applicant_states($user_id, $language_id) {
        $q1 = "SELECT applicant_job_locations.state_id,language_map_states.content FROM applicant_job_locations ";
        $q1 .= "inner join language_map_states on language_map_states.state_id=applicant_job_locations.state_id";
        $q1 .= " where language_map_states.language_id=$language_id and applicant_job_locations.applicant_id=$user_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['state_id'];
                $return[$i]['name'] = $array['content'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function applicant_add_state($user_id, $state_id) {
        $q1 = "SELECT id FROM applicant_job_locations where applicant_id='$user_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) < 5) {
            $q1 = "SELECT id FROM applicant_job_locations where applicant_id='$user_id' and state_id='$state_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) == 0) {
                $created_on = date("y-m-d H:i:s");
                $q2 = "INSERT INTO applicant_job_locations (applicant_id, state_id,created_on)";
                $q2 .= "values ('$user_id','$state_id','$created_on')";
                mysqli_query($this->conn, $q2);
                return 1;
            } else {
                return 'AlREADY_EXISTS';
            }
        } else {
            return 'LIMIT_REACHED';
        }
    }

    function applicant_remove_state($user_id, $state_id) {
        $sel_user = "SELECT state_id ";
        $sel_user .= " from applicants ";
        $sel_user .= " WHERE id = '$user_id'";
        $user = mysqli_query($this->conn, $sel_user);
        if (mysqli_num_rows($user) > 0) {
            $res = mysqli_fetch_assoc($user);
            //if ($res['state_id'] != $state_id) {

            $sql2 = "delete from applicant_job_locations where applicant_id=$user_id and state_id='$state_id'";
            $res = mysqli_query($this->conn, $sql2);
            return 1;
//            } else {
//                return 'CANNOT_DELETE';
//            }
        } else {
            return 'NO_RECORDS';
        }
    }

    function applicant_job_category($user_id, $language_id, $education_id, $page_type = '', $salary_id = '') {
        $page_type = $page_type ? $page_type : 0;

        if ($page_type == 1) {
            $apsc = $this->get_ap_jobc($user_id);
            if ($apsc) {
                $cond = "";
                if ($stids = $this->get_ap_states($user_id)) {
                    $cond .= " and jobs.state_id in (" . $stids . ")";
                }
                if ($salary_id) {
                    $q12 = "SELECT min_range,max_range FROM salaries ";
                    $q12 .= " where id=$salary_id";
                    $re12 = mysqli_query($this->conn, $q12);
                    if (mysqli_num_rows($re12) > 0) {
                        $array2 = mysqli_fetch_assoc($re12);
                        $min_range = $array2['min_range'];
                        $max_range = $array2['max_range'];
                        $cond .= " and ((jobs.salary_start BETWEEN $min_range and $max_range) or (jobs.salary_end BETWEEN $min_range and $max_range) ) ";
                    }
                }

                $cond .= " and job_educations.education_id<=$education_id ";
                $qins = "(select count(DISTINCT jobs.id) from jobs inner join job_educations on job_educations.job_id = jobs.id";
                $qins .= " where jobs.job_category_id=job_categories.id " . $cond . ") as total_jobs";

                $q1 = "SELECT applicant_job_categories.job_category_id,language_map_job_categories.title,job_categories.icon, ";
                $q1 .= " " . $qins;
                $q1 .= " FROM applicant_job_categories ";
                $q1 .= " inner join language_map_job_categories on language_map_job_categories.job_category_id=applicant_job_categories.job_category_id and language_map_job_categories.language_id=$language_id";
                $q1 .= " inner join job_categories on job_categories.id=applicant_job_categories.job_category_id";
                $q1 .= " where language_map_job_categories.language_id='$language_id' and applicant_job_categories.applicant_id=$user_id";
                $re1 = mysqli_query($this->conn, $q1);
            } else {
                $cond = "";
                if ($stids = $this->get_ap_states($user_id)) {
                    $cond .= " and jobs.state_id in (" . $stids . ")";
                }
                if ($salary_id) {
                    $q12 = "SELECT min_range,max_range FROM salaries ";
                    $q12 .= " where id=$salary_id";
                    $re12 = mysqli_query($this->conn, $q12);
                    if (mysqli_num_rows($re12) > 0) {
                        $array2 = mysqli_fetch_assoc($re12);
                        $min_range = $array2['min_range'];
                        $max_range = $array2['max_range'];
                        $cond .= " and ((jobs.salary_start BETWEEN $min_range and $max_range) or (jobs.salary_end BETWEEN $min_range and $max_range) ) ";
                    }
                }
                $cond .= " and job_educations.education_id<=$education_id ";
                $qins = "(select count(DISTINCT jobs.id) from jobs inner join job_educations on job_educations.job_id = jobs.id";
                $qins .= " where jobs.job_category_id=job_categories.id " . $cond . ") as total_jobs";

                $q1 = "select job_categories.id as job_category_id,job_categories.icon,language_map_job_categories.title,";
                $q1 .= " " . $qins;
                $q1 .= " from job_categories inner join language_map_job_categories on job_categories.id = language_map_job_categories.job_category_id";
                $q1 .= " where job_categories.is_active=1 and language_map_job_categories.language_id=$language_id"; // and job_categories.education_id=$education_id


                if ($ids = $this->get_job_category($education_id, $user_id)) {
                    $q1 .= " and job_categories.id in (" . $ids . ")";
                }
                $re1 = mysqli_query($this->conn, $q1);
            }
        } else {
            /* $cond = "";
              if ($stids = $this->get_ap_states($user_id)) {
              $cond .= " and jobs.state_id in (" . $stids . ")";
              }
              $cond .= " and job_educations.education_id<=$education_id ";
              $qins = "(select count(jobs.id) from jobs inner join job_educations on job_educations.job_id = jobs.id";
              $qins .= " where jobs.job_category_id=job_categories.id " . $cond . ") as total_jobs";
             */
            $q1 = "SELECT applicant_job_categories.job_category_id,language_map_job_categories.title,job_categories.icon ";
            //$q1 .= " ," . $qins;
            $q1 .= " FROM applicant_job_categories ";
            $q1 .= " inner join language_map_job_categories on language_map_job_categories.job_category_id=applicant_job_categories.job_category_id and language_map_job_categories.language_id=$language_id";
            $q1 .= " inner join job_categories on job_categories.id=applicant_job_categories.job_category_id";
            $q1 .= " where language_map_job_categories.language_id='$language_id' and applicant_job_categories.applicant_id=$user_id";
            $re1 = mysqli_query($this->conn, $q1);
        }
        $return = array();
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $show_cat = 1;
                if ($page_type == 1) {
                    if ($array['total_jobs'] == 0) {
                        $show_cat = 0;
                    } else {
                        $show_cat = 1;
                    }
                }
                if ($show_cat == 1) {
                    $return[$i]['id'] = $array['job_category_id'];
                    $return[$i]['name'] = $array['title'];
                    $return[$i]['total_jobs'] = @$array['total_jobs'];
                    $return[$i]['icon'] = ICON_URL . $array['icon'];
                    $i++;
                }
            }
        }
        if (!empty($return)) {
            return $return;
        } else {
            return "NO_RECORDS";
        }
    }

    function applicant_add_job_category($user_id, $job_category_id) {
        $q1 = "SELECT id FROM applicant_job_categories where applicant_id=' $user_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) < 5) {
            $q1 = "SELECT id FROM applicant_job_categories where applicant_id='$user_id' and job_category_id=' $job_category_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) == 0) {
                $created_on = date("y-m-d H:i:s");
                $q2 = "INSERT INTO applicant_job_categories (applicant_id, job_category_id,created_on)";
                $q2 .= "values ('$user_id','$job_category_id ','$created_on')";
                mysqli_query($this->conn, $q2);
                return 1;
            } else {
                return 'AlREADY_EXISTS';
            }
        } else {

            return 'LIMIT_REACHED';
        }
    }

    function applicant_remove_job_category($user_id, $job_category_id) {
        $sql2 = "delete from applicant_job_categories where applicant_id=$user_id and job_category_id=' $job_category_id'";
        $res = mysqli_query($this->conn, $sql2);
        return 1;
    }

    function technical_courses($language_id) {
        $q1 = "SELECT technical_courses.id,language_map_technical_courses.name FROM technical_courses ";
        $q1 .= " inner join language_map_technical_courses on language_map_technical_courses.technical_course_id=technical_courses.id and language_map_technical_courses.language_id=$language_id";
        $q1 .= " where language_map_technical_courses.language_id='$language_id' and technical_courses.is_active=1 and language_map_technical_courses.is_active=1 ";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            $return[$i]['id'] = 0;
            $return[$i]['name'] = "Select";
            $i = 1;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['name'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function applicant_update_name($user_id, $first_name, $middle_name = '', $last_name = '') {
        $modified_on = date("Y-m-d H:i:s");
        $q = "UPDATE applicants set first_name = '$first_name',middle_name='$middle_name',last_name='$last_name',modified_on='$modified_on ' where id='$user_id'";
        if (mysqli_query($this->conn, $q)) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }

    function update_education_details($user_id, $education_id, $technical_course_id = null) {
        $modified_on = date("Y-m-d H:i:s");
        $technical_course_id = $technical_course_id ? $technical_course_id : null;
        $q = "UPDATE applicants set education_id = '$education_id' ";
        if ($technical_course_id) {
            $q .= " ,technical_course_id='$technical_course_id' ";
        }
        $q .= " ,modified_on='$modified_on' where id='$user_id'";

        if (mysqli_query($this->conn, $q)) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }

    function update_applicant_language($user_id, $language_id) {
        $modified_on = date("Y-m-d H:i:s");
        $q = "UPDATE applicants set language_id = '$language_id',modified_on='$modified_on ' where id='$user_id'";
        if (mysqli_query($this->conn, $q)) {
            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }

    function district_list($language_id, $state_id) {
        $q1 = "SELECT districts.id,language_map_districts.content FROM districts ";
        $q1 .= "inner join language_map_districts on language_map_districts.district_id=districts.id and language_map_districts.language_id=$language_id";
        $q1 .= " where language_map_districts.language_id=$language_id and districts.is_active=1 and districts.state_id=' $state_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['content'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function update_languages($user_id, $language_id1, $language_id2 = '') {
        $sql2 = "delete from applicant_languages where applicant_id= $user_id";
        if (mysqli_query($this->conn, $sql2)) {
            $created_on = date("y-m-d H:i:s");
            if ($language_id1) {
                $q2 = "INSERT INTO applicant_languages (applicant_id, language_id,created_on)";
                $q2 .= "values ('$user_id','$language_id1 ','$created_on')";
                mysqli_query($this->conn, $q2);
            }
            if ($language_id2) {
                $q2 = "INSERT INTO applicant_languages (applicant_id, language_id,created_on)";
                $q2 .= "values ('$user_id','$language_id2 ','$created_on')";
                mysqli_query($this->conn, $q2);
            }
        } else {
            return 'ERROR';
        }
    }

    function update_profile($user_id, $first_name, $middle_name = '', $last_name = '', $gender, $date_of_birth, $aadhar_number = '') {
        $modified_on = date("Y-m-d H:i:s");
        $q = "UPDATE applicants set first_name = '$first_name',middle_name='$middle_name',last_name='$last_name',modified_on='$modified_on',gender='$gender',date_of_birth='$date_of_birth',aadhar_number='$aadhar_number ' where id='$user_id'";
        if (mysqli_query($this->conn, $q)) {
            return 'SUCCESS';
        } else {
            echo 'ERROR';
        }
    }

    public function resize($image_name, $width, $height = '', $folder_name, $thumb_folder) {
        $file_extension = $this->getFileExtension($image_name);
        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
                $image_src = imagecreatefromjpeg($folder_name . $image_name);
                break;
            case 'png':
                $image_src = imagecreatefrompng($folder_name . $image_name);
                break;
            case 'gif':
                $image_src = imagecreatefromgif($folder_name . $image_name);
                break;
        }
        $true_width = imagesx($image_src);
        $true_height = imagesy($image_src);

        if ($true_width > $true_height) {
            $height = ($true_height * $width ) / $true_width;
        } else {
            if ($height == '')
                $height = ($true_height * $width ) / $true_width;

            $width = ($true_width * $height) / $true_height;
        }
        $image_des = imagecreatetruecolor($width, $height);

        if ($file_extension == 'png') {
            $nWidth = intval($true_width / 4);
            $nHeight = intval($true_height / 4);
            imagealphablending($image_des, false);
            imagesavealpha($image_des, true);
            $transparent = imagecolorallocatealpha($image_des, 255, 255, 255, 127);
            imagefilledrectangle($image_des, 0, 0, $nWidth, $nHeight, $transparent);
        } imagecopyresampled($image_des, $image_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

        switch ($file_extension) {
            case 'jpg': case 'jpeg' : imagejpeg($image_des, $thumb_folder . $image_name, 100);
                break;
            case 'png' : imagepng($image_des, $thumb_folder . $image_name, 5);
                break;
            case 'gif' : imagegif($image_des, $thumb_folder . $image_name, 100);


                break;
        }
        return $image_des;
    }

    function getFileExtension($file) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        return $extension;
    }

    function update_profile_image($user_id) {
        if (!empty($_FILES['profile_image']['name'])) {

            $q2 = "SELECT profile_image ";
            $q2 .= " from applicants ";
            $q2 .= " WHERE id = ' $user_id'";
            $user = mysqli_query($this->conn, $q2);
            $profile_image = "";
            if (mysqli_num_rows($user) > 0) {
                $res = mysqli_fetch_assoc($user);
                $profile_image = $res['profile_image'];
            }
            $upload_folder = PROFILEPICPATHWEBROOT;
//echo $upload_folder;exit;
            $uploadImgArray = $_FILES['profile_image'];
            $file_name = '';
            if (isset($uploadImgArray) && $uploadImgArray['name'] != "") {
                $file_name = basename($uploadImgArray['name']);
                $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                $image_name = explode("." . $imgExtension, $file_name);
                $prefix = time();
                $file_name = base64_encode($prefix . $image_name[0]) . "." . $imgExtension;
                if (move_uploaded_file($uploadImgArray['tmp_name'], $upload_folder . $file_name)) {
                    $this->resize($file_name, 200, 164, $upload_folder, $upload_folder);
                    $modified_on = date("Y-m-d H:i:s");
                    $q = "UPDATE applicants set profile_image = '$file_name',modified_on='$modified_on' where id='$user_id'";
                    if (mysqli_query($this->conn, $q)) {
                        if ($profile_image) {
                            unlink($upload_folder . $profile_image);
                        }
                        return PROFILEPICPATHHTTP . $file_name;
                    } else {
                        return 'ERROR';
                    }
                } else {
                    return 'ERROR';
                }
            } else {
                return 'NO_FILE';
            }
        } else {
            return 'NO_FILE';
        }
    }

    function block_list($language_id, $district_id) {
        $q1 = "SELECT blocks.id,language_map_blocks.content FROM blocks ";
        $q1 .= "inner join language_map_blocks on language_map_blocks.block_id=blocks.id and language_map_blocks.language_id=$language_id";
        $q1 .= " where language_map_blocks.language_id=$language_id and blocks.is_active=1 and blocks.district_id=' $district_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['content'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function panchayat_list($language_id, $block_id) {
        $q1 = "SELECT panchayats.id,language_map_panchayats.name FROM panchayats ";
        $q1 .= "inner join language_map_panchayats on language_map_panchayats.panchayat_id=panchayats.id and language_map_panchayats.language_id=$language_id";
        $q1 .= " where language_map_panchayats.language_id=$language_id and panchayats.is_active=1 and panchayats.block_id=' $block_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['name'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function update_address($user_id, $state_id, $district_id, $block_id = '', $village_name, $house_number = '', $pin_code) {
        $modified_on = date("Y-m-d H:i:s");
        $q = "UPDATE applicants set state_id = '$state_id',district_id='$district_id',block_id='$block_id',modified_on='$modified_on ' where id='$user_id'";
        if (mysqli_query($this->conn, $q)) {
//check for other profile info//
            $q1 = "SELECT id FROM applicant_extended_profiles where applicant_id=' $user_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
//updates//
                $q = "UPDATE applicant_extended_profiles set village_name = '$village_name',house_number='$house_number',pin_code='$pin_code',modified_on='$modified_on' where applicant_id=' $user_id'";
                mysqli_query($this->conn, $q);
            } else {
//insert//
                $created_on = date("Y-m-d H:i:s");
                $q2 = "INSERT INTO applicant_extended_profiles (applicant_id, village_name,house_number,created_on,pin_code)";
                $q2 .= "values ('$user_id','$village_name','$house_number','$created_on ','$pin_code')";
                mysqli_query($this->conn, $q2);
            }


            return 'SUCCESS';
        } else {
            echo 'ERROR';
        }
    }

    function update_full_profile($user_id, $first_name, $middle_name = '', $last_name = '', $gender, $date_of_birth, $aadhar_number = '', $state_id, $district_id, $block_id = '', $village_name, $house_number = '', $pin_code = '', $language_id1, $language_id2 = '', $proficiency_level_id1 = '', $proficiency_level_id2 = '', $education_id, $technical_course_id = '', $work_experience = '', $willing_to_relocate = '', $cast_category = '', $father_name = '', $panchayat_id = '') {
        $modified_on = date("Y-m-d H:i:s");
        $date_of_birth = $date_of_birth ? date("Y-m-d", strtotime($date_of_birth)) : "";

        $q = "UPDATE applicants set first_name = '$first_name',cast_category='$cast_category',middle_name='$middle_name',last_name='$last_name',gender='$gender',date_of_birth='$date_of_birth',aadhar_number='$aadhar_number' ";
        $q.= " ,education_id = '$education_id' ";
        if ($technical_course_id) {
            $q.= ",technical_course_id = '$technical_course_id' ";
        }
        $q.= " ,willing_to_relocate='$willing_to_relocate'";

        $q.= " ,state_id = '$state_id'";
        $q.= " ,district_id='$district_id'";
        if ($panchayat_id) {
            $q.= " ,panchayat_id='$panchayat_id'";
        }
        if ($block_id) {
            $q.= " ,block_id='$block_id'";
        }
        $q.= " ,modified_on='$modified_on' where id='$user_id'";
        ///echo $q;exit;
        if (mysqli_query($this->conn, $q)) {
//check for other profile info//
            $q1 = "SELECT id FROM applicant_extended_profiles where applicant_id=' $user_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
//updates//
                $q = "UPDATE applicant_extended_profiles set village_name = '$village_name',father_name = '$father_name',house_number='$house_number',pin_code='$pin_code',work_experience='$work_experience',modified_on='$modified_on' where applicant_id=' $user_id'";
                mysqli_query($this->conn, $q);
            } else {
//insert//
                $created_on = date("Y-m-d H:i:s");
                $q2 = "INSERT INTO applicant_extended_profiles (applicant_id, village_name,house_number,created_on,pin_code,father_name)";
                $q2 .= "values ('$user_id','$village_name','$house_number','$created_on','$pin_code',' $father_name')";
                mysqli_query($this->conn, $q2);
            }

//update languages//
            $sql2 = "delete from applicant_languages where applicant_id= $user_id";
            if (mysqli_query($this->conn, $sql2)) {
                $created_on = date("y-m-d H:i:s");
                if ($language_id1) {
                    $q2 = "INSERT INTO applicant_languages (applicant_id, language_id,created_on,proficiency_level_id)";
                    $q2 .= "values ('$user_id','$language_id1','$created_on','$proficiency_level_id1 ')";
                    mysqli_query($this->conn, $q2);
                }
                if ($language_id2) {
                    $q2 = "INSERT INTO applicant_languages (applicant_id, language_id,created_on,proficiency_level_id)";
                    $q2 .= "values ('$user_id','$language_id2','$created_on','$proficiency_level_id2 ')";
                    mysqli_query($this->conn, $q2);
                }
            }


            return 'SUCCESS';
        } else {
            return 'ERROR';
        }
    }

    function language_proficiency_levels($language_id) {
        $q1 = "SELECT id,level FROM proficiency_levels ";
        $q1 .= " where language_id=$language_id  and is_active=1";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['level'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function job_education($job_id, $language_id) {
        $return = array();
        $q1 = "SELECT language_map_educations.name FROM job_educations ";
        $q1 .= " inner join language_map_educations on language_map_educations.education_id=job_educations.education_id";
        $q1 .= " where job_educations.job_id=$job_id and language_map_educations.language_id= $language_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['name'];
            }
        }
        if (!empty($return)) {
            return implode(", ", $return);
        } else {
            return "";
        }
    }

    function job_district($job_id, $language_id) {
        $return = array();
        $q1 = "SELECT language_map_districts.content FROM job_districts ";
        $q1 .= " inner join language_map_districts on language_map_districts.district_id=job_districts.district_id";
        $q1 .= " where job_districts.job_id=$job_id and language_map_districts.language_id= $language_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['content'];
            }
        }
        if (!empty($return)) {
            return implode(", ", $return);
        } else {
            return "";
        }
    }

    function get_ap_states($user_id) {
        $return = array();
        $q1 = "SELECT state_id FROM applicant_job_locations ";
        $q1 .= " where applicant_id= $user_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['state_id'];
            }
        }
        $rt = "";
        if (!empty($return)) {
            $rt = implode
                    (",", $return);
        }
        return $rt;
    }

    function jobs_list($user_id, $language_id, $job_category_id, $education_id, $page, $salary_id = '') {
        $page = $page ? $page : 1;
        $limit = 10;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }

        $return = array();
        $q1 = "select jobs.id,jobs.created_on,applicant_jobs.applicant_id as applied_status,jobs.image,language_map_jobs.title,jobs.district_id,jobs.year_of_experience,jobs.salary_start,jobs.salary_end,job_categories.icon as job_image ";
        $q1 .= " ,job_details.responsibilities,job_details.job_description,job_details.company_profile,job_details.job_timings,language_map_states.content as state_name ";
        $q1 .= " from jobs ";
        $q1 .= " inner join language_map_jobs on jobs.id = language_map_jobs.job_id and language_map_jobs.language_id=$language_id";
        $q1 .= " inner join job_details on jobs.id = job_details.job_id and job_details.language_id=$language_id";
        $q1 .= " left join language_map_states on jobs.state_id = language_map_states.state_id and language_map_states.language_id=$language_id";
//$q1 .= " left join language_map_districts on jobs.district_id = language_map_districts.district_id and language_map_districts.language_id=$language_id";
        $q1 .= " inner join job_categories on jobs.job_category_id = job_categories.id";
        $q1 .= " inner join job_educations on job_educations.job_id = jobs.id";
        $q1 .= " left join applicant_jobs on applicant_jobs.job_id = jobs.id and applicant_jobs.applicant_id=$user_id";

        $q1 .= " where jobs.job_category_id='$job_category_id' and job_educations.education_id<=$education_id and job_details.language_id=$language_id and language_map_jobs.language_id=$language_id";
        if ($stids = $this->get_ap_states($user_id)) {
            $q1 .= " and jobs.state_id in (" . $stids . ")";
        }
        if ($salary_id) {
            $q12 = "SELECT min_range,max_range FROM salaries ";
            $q12 .= " where id=$salary_id";
            $re12 = mysqli_query($this->conn, $q12);
            if (mysqli_num_rows($re12) > 0) {
                $array2 = mysqli_fetch_assoc($re12);
                $min_range = $array2['min_range'];
                $max_range = $array2['max_range'];
                $q1 .= " and ((jobs.salary_start BETWEEN $min_range and $max_range) or (jobs.salary_end BETWEEN $min_range and $max_range) ) ";
            }
        }


        $q1 .= " group by jobs.id order by job_educations.education_id desc ";

        $re1 = mysqli_query($this->conn, $q1);
        $jobs = array();
        $num_rows = mysqli_num_rows($re1);
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }
            $q1 .= " limit  $offset,$limit";
            $re12 = mysqli_query($this->conn, $q1);
            $i = 0;
            while ($array = mysqli_fetch_array($re12)) {
                $jobs[$i]['id'] = $array['id'];
                $jobs[$i]['title'] = $array['title'];
                $jobs[$i]['applied'] = $array['applied_status'] ? 1 : 0;
                $jobs[$i]['responsibilities'] = $this->job_education($array['id'], $language_id);
                $jobs[$i]['company_profile'] = $array['company_profile'];
                $jobs[$i]['job_timings'] = $array['job_timings'];
                $jobs[$i]['year_of_experience'] = $array['year_of_experience'];
                $jobs[$i]['salary_start'] = $array['salary_start'];
                $jobs[$i]['salary_end'] = $array['salary_end'];
                $jobs[$i]['state_name'] = $array['state_name'];
                $jobs[$i]['district_name'] = $array['district_id'] == "ALL" ? "All District" : $this->job_district($array['id'], $language_id);
                $jobs[$i]['job_description'] = $array['job_description'];
                $jobs[$i]['image'] = ICON_URL . $array['job_image'];
                $jobs[$i]['created_on'] = $this->no_days($array['created_on']);


                $i++;
            }
            $return['job_list'] = $jobs;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total_jobs'] = $num_rows;
            return $return;
        } else {
            return 'NO_RECORDS';
        }
    }

    function apply_job($language_id, $job_id, $user_id) {
        $q1 = "SELECT id FROM applicant_jobs ";
        $q1 .= " where job_id=$job_id and applicant_id=' $user_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $return = "ALREADY_APPLIED";
            return $return;
        } else {

            $q1 = "SELECT registered_mobile,first_name FROM applicants ";
            $q1 .= "  where id='$user_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                $userInfo = mysqli_fetch_assoc($re1);

//send message 
                $phone_no = $userInfo['registered_mobile'];
                $first_name = $userInfo['first_name'];
//job info//
                $q1 = "select language_map_jobs.title ";
                $q1 .= " from jobs ";
                $q1 .= " inner join language_map_jobs on jobs.id = language_map_jobs.job_id and language_map_jobs.language_id=$language_id";
                $q1 .= " where jobs.id='$job_id' and language_map_jobs.language_id= $language_id";
                $re1 = mysqli_query($this->conn, $q1);
                if (mysqli_num_rows($re1) > 0) {
                    $JobInfo = mysqli_fetch_assoc($re1);
                    $title = $JobInfo['title'];
                    $created_on = date("y-m-d H:i:s");
                    $q2 = "INSERT INTO applicant_jobs (job_id, applicant_id,created_on)";
                    $q2 .= "values ('$job_id','$user_id',' $created_on')";
                    mysqli_query($this->conn, $q2);
//end//
                    if ($language_id == 2) {
                        $msg = "प्रिय " . $first_name . ", " . $title . " की नौकरी हेतु आवेदन के लिए आपका धन्यवाद | हम आपको आगे की प्रक्रिया के बारे में सूचित करेंगे | अन्य किसी भी जानकारी के लिए +91 9650188330 पर संपर्क करें | आपके उज्जवल भविष्य की कामना में, SkillsHaat."; //स्किल्सहाट
                    } else {
                        $msg = "Dear " . $first_name . ", Thank you for applying for the role of " . $title . ".We will inform you about the next steps. For any further queries, please contact us on +919650188330. Wishing a bright future to you, SkillsHaat.";
                    }
                    $this->send_msg($phone_no, $msg, 1);

//insert into notification//
                    $q2 = "INSERT INTO applicant_notifications (message,notification_type_id, applicant_id,created_on)";
                    $q2 .= "values ('$msg','1','$user_id',' $created_on')";
                    mysqli_query($this->conn, $q2);


                    return 'SUCCESS';
                } else {
                    return 'ERROR';
                }
            } else {

                return 'ERROR';
            }
        }
    }

    function applicant_training_category($user_id, $language_id, $education_id, $page_type = '', $state_id = '') {
        $page_type = $page_type ? $page_type : 0;
        if ($page_type == 1) {
            /* $apsc = $this->get_ap_trac($user_id);
              if ($apsc) {
              $cond = "";
              if ($stids = $this->get_ap_states($user_id)) {
              $cond .= " and trainings.state_id in (" . $stids . ")";
              }

              $cond .= " and training_educations.education_id<=$education_id ";
              $qins = "(select count(trainings.id) from trainings inner join training_educations on training_educations.training_id = trainings.id";
              $qins .= " where trainings.training_category_id=training_categories.id " . $cond . ") as total_trainings";

              $q1 = "SELECT applicant_training_categories.training_category_id,language_map_training_categories.title,training_categories.icon, ";
              $q1 .= " " . $qins;
              $q1 .= " FROM applicant_training_categories ";
              $q1 .= " inner join language_map_training_categories on language_map_training_categories.training_category_id=applicant_training_categories.training_category_id and language_map_training_categories.language_id=$language_id";
              $q1 .= " inner join training_categories on training_categories.id=applicant_training_categories.training_category_id";
              $q1 .= " where language_map_training_categories.language_id='$language_id' and applicant_training_categories.applicant_id= $user_id";
              $re1 = mysqli_query($this->conn, $q1);
              } else {

              $cond = "";
              if ($stids = $this->get_ap_states($user_id)) {
              $cond .= " and trainings.state_id in (" . $stids . ")";
              } */
            if ($state_id) {
                $cond .= " and trainings.state_id in (" . $state_id . ")";
            }
            $cond .= " and training_educations.education_id<=$education_id ";
            $qins = "(select count(trainings.id) from trainings inner join training_educations on training_educations.training_id = trainings.id";
            $qins .= " where trainings.training_category_id=training_categories.id " . $cond . ") as total_trainings";


            $q1 = "select training_categories.icon,training_categories.id as training_category_id,language_map_training_categories.title ";
            $q1 .= ", " . $qins;
            $q1 .= " from training_categories inner join language_map_training_categories on training_categories.id = language_map_training_categories.training_category_id and language_map_training_categories.language_id=$language_id";

            $q1 .= " where training_categories.is_active=1 and language_map_training_categories.language_id=$language_id"; //and training_categories.education_id=$education_id

            /* if ($ids = $this->get_tr_category($education_id, $user_id)) {
              $q1 .= " and training_categories.id in (" . $ids . ")";
              } */
            // echo $q1;exit;

            $re1 = mysqli_query($this->conn, $q1);
            //}
        } else {
            /* $cond = "";
              if ($stids = $this->get_ap_states($user_id)) {
              $cond .= " and trainings.state_id in (" . $stids . ")";
              }

              $cond .= " and training_educations.education_id<=$education_id ";
              $qins = "(select count(trainings.id) from trainings inner join training_educations on training_educations.training_id = trainings.id";
              $qins .= " where trainings.training_category_id=training_categories.id " . $cond . ") as total_trainings";
             */
            $q1 = "SELECT applicant_training_categories.training_category_id,language_map_training_categories.title,training_categories.icon ";
            //$q1 .= " ," . $qins;
            $q1 .= " FROM applicant_training_categories ";
            $q1 .= " inner join language_map_training_categories on language_map_training_categories.training_category_id=applicant_training_categories.training_category_id and language_map_training_categories.language_id=$language_id";
            $q1 .= " inner join training_categories on training_categories.id=applicant_training_categories.training_category_id";
            $q1 .= " where language_map_training_categories.language_id='$language_id' and applicant_training_categories.applicant_id= $user_id";
            $re1 = mysqli_query($this->conn, $q1);
        }


        $return = array();
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $show_cat = 1;
                if ($page_type == 1) {
                    if ($array['total_trainings'] == 0) {
                        $show_cat = 0;
                    } else {
                        $show_cat = 1;
                    }
                }


                if ($show_cat == 1) {
                    $return[$i]['id'] = $array['training_category_id'];
                    $return[$i]['name'] = $array ['title'];
                    $return[$i]['icon'] = ICON_URL . $array['icon'];
                    $return[$i]['total_jobs'] = @$array['total_trainings'];
                    $i++;
                }
            }
        }
        if (!empty($return)) {
            return $return;
        } else {
            return 'NO_RECORDS';
        }
    }

    function applicant_add_training_category($user_id, $training_category_id) {
        $q1 = "SELECT id FROM applicant_training_categories where applicant_id=' $user_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) < 5) {
            $q1 = "SELECT id FROM applicant_training_categories where applicant_id='$user_id' and training_category_id=' $training_category_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) == 0) {
                $created_on = date("y-m-d H:i:s");
                $q2 = "INSERT INTO applicant_training_categories (applicant_id, training_category_id)";
                $q2 .= "values ('$user_id',' $training_category_id')";
                mysqli_query($this->conn, $q2);
                return 1;
            } else {
                return 'AlREADY_EXISTS';
            }
        } else {

            return 'LIMIT_REACHED';
        }
    }

    function applicant_remove_training_category($user_id, $training_category_id) {
        $sql2 = "delete from applicant_training_categories where applicant_id=$user_id and training_category_id=' $training_category_id'";
        $res = mysqli_query($this->conn, $sql2);
        return 1;
    }

    function training_education($job_id, $language_id) {
        $return = array();
        $q1 = "SELECT language_map_educations.name FROM training_educations ";
        $q1 .= " inner join language_map_educations on language_map_educations.education_id=training_educations.education_id";
        $q1 .= " where training_educations.training_id=$job_id and language_map_educations.language_id= $language_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['name'];
            }
        }
        if (!empty($return)) {
            return implode(", ", $return);
        } else {
            return "";
        }
    }

    function training_district($job_id, $language_id) {
        $return = array();
        $q1 = "SELECT language_map_districts.content FROM training_districts ";
        $q1 .= " inner join language_map_districts on language_map_districts.district_id=training_districts.district_id";
        $q1 .= " where training_districts.training_id=$job_id and language_map_districts.language_id= $language_id";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $return[] = $array['content'];
            }
        }
        if (!empty($return)) {
            return implode(", ", $return);
        } else {
            return "";
        }
    }

    function all_trainings_list($language_id, $page) {
        $page = $page ? $page : 1;
        $limit = 10;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }

        $return = array();
        $q1 = "select trainings.id,trainings.last_date_apply,language_map_states.content as state_name,language_map_trainings.training_name,language_map_trainings.description,trainings.duration,trainings.expected_salary,trainings.district_id,training_categories.icon as job_image ";
        $q1 .= " from trainings ";
        $q1 .= " inner join language_map_trainings on trainings.id = language_map_trainings.training_id and language_map_trainings.language_id=$language_id";
        $q1 .= " inner join training_categories on trainings.training_category_id = training_categories.id";
        $q1 .= " left join language_map_states on trainings.state_id = language_map_states.state_id and language_map_states.language_id=$language_id";
//$q1 .= " left join language_map_districts on trainings.district_id = language_map_districts.district_id and language_map_districts.language_id=$language_id";
        $q1 .= " where trainings.is_active=1";
// echo $q1; exit;
        $re1 = mysqli_query($this->conn, $q1);
        $jobs = array();
        $num_rows = mysqli_num_rows($re1);
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }
            $q1 .= " limit  $offset,$limit";
            $re12 = mysqli_query($this->conn, $q1);
            $i = 0;
            while ($array = mysqli_fetch_array($re12)) {
                $jobs[$i]['id'] = $array['id'];
                $jobs[$i]['title'] = $array['training_name'];
                $jobs[$i]['min_qualification'] = $this->training_education($array['id'], $language_id);
                $jobs[$i]['description'] = $array['description'];
                $jobs[$i]['duration'] = $array['duration'];
                $jobs[$i]['expected_salary'] = $array['expected_salary'];
                $jobs[$i]['district_name'] = $array['district_id'] == "ALL" ? "All Disctrict" : $this->training_district($array['id'], $language_id);
                $jobs[$i]['image'] = ICON_URL . $array['job_image'];
                $jobs[$i]['last_date_apply'] = $array['last_date_apply'];
                $jobs[$i]['state_name'] = $array['state_name'];


                $i++;
            }
            $return['job_list'] = $jobs;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total_jobs'] = $num_rows;
            return $return;
        } else {
            return 'NO_RECORDS';
        }
    }

    function trainings_list($user_id, $language_id, $training_category_id, $education_id, $page, $state_id = '') {
        $page = $page ? $page : 1;
        $limit = 10;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }

        $return = array();
        $q1 = "select trainings.id,trainings.last_date_apply,applicant_trainings.applicant_id as applied_status,language_map_states.content as state_name,language_map_trainings.training_name,language_map_trainings.description,trainings.duration,trainings.expected_salary,trainings.district_id,training_categories.icon as job_image ";
        $q1 .= " from trainings ";
        $q1 .= " inner join language_map_trainings on trainings.id = language_map_trainings.training_id and language_map_trainings.language_id=$language_id";
        $q1 .= " inner join training_categories on trainings.training_category_id = training_categories.id";
        $q1 .= " left join language_map_states on trainings.state_id = language_map_states.state_id and language_map_states.language_id=$language_id";
//$q1 .= " left join language_map_districts on trainings.district_id = language_map_districts.district_id and language_map_districts.language_id=$language_id";
        $q1 .= " inner join training_educations on training_educations.training_id = trainings.id";
        $q1 .= " left join applicant_trainings on applicant_trainings.training_id = trainings.id and applicant_trainings.applicant_id=$user_id";
        $q1 .= " where trainings.is_active=1 and training_educations.education_id <=$education_id  and trainings.training_category_id='$training_category_id'";
//        if ($stids = $this->get_ap_states($user_id)) {
//            $q1 .= " and trainings.state_id in (" . $stids . ")";
//        }
        if ($state_id) {
            $q1 .= " and trainings.state_id in (" . $state_id . ")";
        }
        $q1 .= " group by trainings.id desc order by training_educations.education_id desc ";



        $re1 = mysqli_query($this->conn, $q1);
        $jobs = array();
        $num_rows = mysqli_num_rows($re1);
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }
            $q1 .= " limit  $offset,$limit";
            $re12 = mysqli_query($this->conn, $q1);
            $i = 0;
            while ($array = mysqli_fetch_array($re12)) {
                $jobs[$i]['id'] = $array['id'];
                $jobs[$i]['title'] = $array['training_name'];
                $jobs[$i]['applied'] = $array['applied_status'] ? 1 : 0;
                $jobs[$i]['min_qualification'] = $this->training_education($array['id'], $language_id);
                $jobs[$i]['description'] = $array['description'];
                $jobs[$i]['duration'] = $array['duration'];
                $jobs[$i]['expected_salary'] = $array['expected_salary'];
                $jobs[$i]['district_name'] = $array['district_id'] == "ALL" ? "All Disctrict" : $this->training_district($array['id'], $language_id);
                $jobs[$i]['image'] = ICON_URL . $array['job_image'];
                $jobs[$i]['last_date_apply'] = $array['last_date_apply'] ? date("d-m-Y", strtotime($array['last_date_apply'])) : "";
                $jobs[$i]['state_name'] = $array['state_name'];


                $i++;
            }
            $return['job_list'] = $jobs;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total_jobs'] = $num_rows;
            return $return;
        } else {
            return 'NO_RECORDS';
        }
    }

    function apply_training($language_id, $training_id, $user_id) {
        $q1 = "SELECT id FROM applicant_trainings ";
        $q1 .= " where training_id=$training_id and applicant_id=' $user_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $return = "ALREADY_APPLIED";
            return $return;
        } else {
            $q1 = "SELECT registered_mobile,first_name FROM applicants ";
            $q1 .= "  where id='$user_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                $userInfo = mysqli_fetch_assoc($re1);

//send message 
                $phone_no = $userInfo['registered_mobile'];
                $first_name = $userInfo['first_name'];
                $q1 = "select language_map_trainings.training_name as title ";
                $q1 .= " from trainings ";
                $q1 .= " inner join language_map_trainings on trainings.id = language_map_trainings.training_id and language_map_trainings.language_id=$language_id";
                $q1 .= " where trainings.id='$training_id' and language_map_trainings.language_id= $language_id";
                $re1 = mysqli_query($this->conn, $q1);
                if (mysqli_num_rows($re1) > 0) {
                    $JobInfo = mysqli_fetch_assoc($re1);
                    $title = $JobInfo['title'];

                    $created_on = date("y-m-d H:i:s");
                    $q2 = "INSERT INTO applicant_trainings (training_id, applicant_id,applied_on)";
                    $q2 .= "values ('$training_id','$user_id',' $created_on')";
                    mysqli_query($this->conn, $q2);

                    if ($language_id == 2) {
                        $msg = "प्रिय " . $first_name . ", " . $title . " के कौशल प्रशिक्षण हेतु आवेदन के लिए आपका धन्यवाद | हम आपको आगे की प्रक्रिया के बारे में सूचित करेंगे | अन्य किसी भी जानकारी के लिए +91 9650188330 पर संपर्क करें | आपके उज्जवल भविष्य की कामना में, SkillsHaat.";
                    } else {
                        $msg = "Dear " . $first_name . ", Thank you for applying for skills training of " . $title . ".We will inform you about the next steps. For any further queries, please contact us on +919650188330. Wishing a bright future to you, SkillsHaat.";
                    }
                    $this->send_msg($phone_no, $msg, 1);

//insert into notification//
                    $q2 = "INSERT INTO applicant_notifications (message,notification_type_id, applicant_id,created_on)";
                    $q2 .= "values ('$msg','2','$user_id',' $created_on')";
                    mysqli_query($this->conn, $q2);


                    return 'SUCCESS';
                } else {
                    return 'ERROR';
                }
            } else {

                return 'ERROR';
            }
        }
    }

    function notification_list($user_id, $page) {
        $page = $page ? $page : 1;
        $limit = 10;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }

        $return = array();
        $q1 = "select anop.id,anop.message,anop.viewed_on,anop.created_on,ntpe.name as ntype";
        $q1 .= " from applicant_notifications as anop";
        $q1 .= " left join notification_types as ntpe on ntpe.id = anop.notification_type_id";
        $q1 .= " where anop.applicant_id='$user_id'";
// echo $q1; exit;
        $re1 = mysqli_query($this->conn, $q1);
        $jobs = array();
        $num_rows = mysqli_num_rows($re1);
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }
            $q1 .= " limit  $offset,$limit";
            $re12 = mysqli_query($this->conn, $q1);
            $i = 0;
            while ($array = mysqli_fetch_array($re12)) {
                $jobs[$i]['id'] = $array['id'];
                $jobs[$i]['message'] = $array['message'];
                $jobs[$i]['viewed_on'] = $array['viewed_on'];
                $jobs[$i]['created_on'] = date("d-m-Y h:i A", strtotime($array['created_on']));
                $jobs[$i]['ntype'] = $array['ntype'];
                $i++;
            }
            $return['noti_list'] = $jobs;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total_noti'] = $num_rows;
            return $return;
        } else {
            return 'NO_RECORDS';
        }
    }

    function experience_list($language_id) {
        $q1 = "SELECT experiences.id,language_map_experiences.name FROM experiences ";
        $q1 .= " inner join language_map_experiences on language_map_experiences.experience_id=experiences.id and language_map_experiences.language_id=$language_id";
        $q1 .= " where language_map_experiences.language_id='$language_id' and experiences.is_active=1 ";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            $return[$i]['id'] = 0;
            $return[$i]['name'] = "Select";
            $i = 1;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['name'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function salary_list($language_id) {
        $q1 = "SELECT salaries.id,language_map_salaries.name FROM salaries ";
        $q1 .= " inner join language_map_salaries on language_map_salaries.salary_id=salaries.id and language_map_salaries.language_id=$language_id";
        $q1 .= " where language_map_salaries.language_id='$language_id' and salaries.is_active=1 ";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $return[$i]['id'] = $array['id'];
                $return[$i]['name'] = $array['name'];
                $i++;
            }
        } else {
            $return = "NO_RECORDS";
        }
        return $return;
    }

    function employment_program_list($user_id, $language_id, $page) {
        $page = $page ? $page : 1;
        $limit = 10;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }

        $return = array();
        $q1 = "select empp.id,lempp.name,lempp.description,empp.created_on,empp.image,aempp.applicant_id as applied_status";
        $q1 .= " from employment_programs as empp";
        $q1 .= " inner join language_map_employment_programs as lempp on empp.id = lempp.employment_program_id and language_id=$language_id";
        $q1 .= " left join applicant_employment_programs as aempp on aempp.employment_program_id = empp.id and aempp.applicant_id=$user_id";
        $q1 .= " where empp.is_active=1 group by empp.id order by empp.id desc ";
// echo $q1; exit;
        $re1 = mysqli_query($this->conn, $q1);
        $jobs = array();
        $num_rows = mysqli_num_rows($re1);
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }
            $q1 .= " limit  $offset,$limit";
            $re12 = mysqli_query($this->conn, $q1);
            $i = 0;
            while ($array = mysqli_fetch_array($re12)) {
                $jobs[$i]['id'] = $array['id'];
                $jobs[$i]['name'] = $array['name'];
                $jobs[$i]['image'] = $array['image'] ? JOB_PROGRAM_HTTP . $array['image'] : "";
                $jobs[$i]['description'] = $array['description'];
                $jobs[$i]['created_on'] = date("d-m-Y h:i A", strtotime($array['created_on']));
                $jobs[$i]['applied'] = $array['applied_status'] ? 1 : 0;
                $i++;
            }
            $return['list'] = $jobs;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total'] = $num_rows;
            return $return;
        } else {
            return 'NO_RECORDS';
        }
    }

    function apply_employment_program($language_id, $employment_program_id, $user_id) {
        $q1 = "SELECT id FROM applicant_employment_programs ";
        $q1 .= " where employment_program_id=$employment_program_id and applicant_id=' $user_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $return = "ALREADY_APPLIED";
            return $return;
        } else {
            $q1 = "SELECT registered_mobile,first_name FROM applicants ";
            $q1 .= "  where id='$user_id'";
            $re1 = mysqli_query($this->conn, $q1);
            if (mysqli_num_rows($re1) > 0) {
                $userInfo = mysqli_fetch_assoc($re1);

//send message 
                $phone_no = $userInfo['registered_mobile'];
                $first_name = $userInfo['first_name'];
                $q1 = "select language_map_employment_programs.name as title ";
                $q1 .= " from language_map_employment_programs ";
                // $q1 .= " inner join language_map_trainings on trainings.id = language_map_trainings.training_id and language_map_trainings.language_id=$language_id";
                $q1 .= " where language_map_employment_programs.employment_program_id='$employment_program_id' and language_map_employment_programs.language_id= $language_id";
                $re1 = mysqli_query($this->conn, $q1);
                if (mysqli_num_rows($re1) > 0) {
                    $JobInfo = mysqli_fetch_assoc($re1);
                    $title = $JobInfo['title'];

                    $created_on = date("y-m-d H:i:s");
                    $q2 = "INSERT INTO applicant_employment_programs (employment_program_id, applicant_id,created_on)";
                    $q2 .= "values ('$employment_program_id','$user_id',' $created_on')";
                    mysqli_query($this->conn, $q2);

                    if ($language_id == 2) {
                        $msg = "प्रिय " . $first_name . ", " . $title . " हेतु आपका आवेदन हमें प्राप्त हो चुका है। हम आपको आगे की प्रक्रिया के बारे में सूचित करेंगे। किसी भी जानकारी के लिए आप हमें +919650188330 पर संपर्क कर सकते हैं। आपके उज्ज्वल भविष्य की कामना में, SkillsHaat.";
                    } else {
                        $msg = "Dear " . $first_name . ", Your application for " . $title . " has been received by us. We will get back to you regarding the next steps. For any queries, please call us at +919650188330. Wishing you a bright future, SkillsHaat.";
                    }
                    $this->send_msg($phone_no, $msg, 1);

//insert into notification//
                    $q2 = "INSERT INTO applicant_notifications (message,notification_type_id, applicant_id,created_on)";
                    $q2 .= "values ('$msg','3','$user_id',' $created_on')";
                    mysqli_query($this->conn, $q2);


                    return 'SUCCESS';
                } else {
                    return 'ERROR';
                }
            } else {

                return 'ERROR';
            }
        }
    }

    public function get_filters($language_id, $user_id, $salary_id = '') {

        $q1 = "SELECT states.id,language_map_states.content,ajl.applicant_id as selected FROM states ";
        $q1 .= "inner join language_map_states on language_map_states.state_id=states.id and language_map_states.language_id=$language_id";
        $q1 .= " left join applicant_job_locations as ajl on ajl.state_id = states.id and ajl.applicant_id=$user_id";
        $q1 .= " where language_map_states.language_id=$language_id and states.is_active=1 group by states.id order by states.name asc";
        $re1 = mysqli_query($this->conn, $q1);
        $retArr = array();
        $states = array();
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {
                $states[$i]['id'] = $array['id'];
                $states[$i]['name'] = $array['content'];
                $states[$i]['selected'] = $array['selected'] > 0 ? 1 : 0;
                $i++;
            }
        }
        $retArr['state_list'] = $states;

        $job_category_list = array();
        $q1 = "select job_categories.id,job_categories.icon,language_map_job_categories.title,ajc.applicant_id as selected ";
        $q1 .= " from job_categories inner join language_map_job_categories on job_categories.id = language_map_job_categories.job_category_id";
        $q1 .= " left join applicant_job_categories as ajc on ajc.job_category_id = job_categories.id and ajc.applicant_id=$user_id";
        $q1 .= " where job_categories.is_active=1 and language_map_job_categories.language_id=$language_id group by job_categories.id order by job_categories.title asc";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            while ($array = mysqli_fetch_array($re1)) {

                $job_category_list[$i]['id'] = $array['id'];
                $job_category_list[$i]['name'] = $array['title'];
                $job_category_list[$i]['icon'] = ICON_URL . $array['icon'];
                $job_category_list[$i]['selected'] = $array['selected'] > 0 ? 1 : 0;
                ;
                $i++;
            }
        }
        $retArr['job_category_list'] = $job_category_list;
        $salary_list = array();

        $q1 = "SELECT salaries.id,language_map_salaries.name FROM salaries ";
        $q1 .= " inner join language_map_salaries on language_map_salaries.salary_id=salaries.id and language_map_salaries.language_id=$language_id";
        $q1 .= " where language_map_salaries.language_id='$language_id' and salaries.is_active=1 ";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $i = 0;
            $salary_list[$i]['id'] = 0;
            $salary_list[$i]['name'] = "Select";
            $i++;
            while ($array = mysqli_fetch_array($re1)) {
                $salary_list[$i]['id'] = $array['id'];
                $salary_list[$i]['name'] = $array['name'];
                if ($salary_id == $array['id']) {
                    $salary_list[$i]['selected'] = 1;
                } else {
                    $salary_list[$i]['selected'] = 0;
                }

                $i++;
            }
        }

        $retArr['salary_list'] = $salary_list;
        return $retArr;
    }

    public function apply_filters($language_id, $user_id, $states = array(), $job_categories = array(), $salary_id = '') {

        $sql2 = "delete from applicant_job_locations where applicant_id=$user_id";
        if (mysqli_query($this->conn, $sql2)) {
            if (!empty($states)) {
                $counts = count($states);
                if ($counts <= 5) {

                    if (!empty($states)) {
                        $created_on = date("y-m-d H:i:s");
                        $stmt = $this->conn->prepare("INSERT INTO applicant_job_locations (applicant_id, state_id, created_on) VALUES (?, ?, ?)");
                        $stmt->bind_param("iis", $user_id, $state_id, $created_on);
                        foreach ($states as $index => $id) {
                            $user_id = $user_id;
                            $state_id = $id;
                            $created_on = $created_on;
                            $stmt->execute();
                        }
                        $stmt->close();
                    }
                } else {
                    return 'SLIMIT_REACHED';
                }
            }
        }
        $sql2 = "delete from applicant_job_categories where applicant_id=$user_id";
        if (mysqli_query($this->conn, $sql2)) {

            if (!empty($job_categories)) {
                $counts = count($job_categories);
                if ($counts <= 5) {

                    if (!empty($job_categories)) {
                        $created_on = date("y-m-d H:i:s");
                        $stmt = $this->conn->prepare("INSERT INTO applicant_job_categories (applicant_id, job_category_id, created_on) VALUES (?, ?, ?)");
                        $stmt->bind_param("iis", $user_id, $job_category_id, $created_on);
                        foreach ($job_categories as $index => $id) {
                            $user_id = $user_id;
                            $job_category_id = $id;
                            $created_on = $created_on;
                            $stmt->execute();
                        }
                        $stmt->close();
                    }
                } else {
                    return 'JLIMIT_REACHED';
                }
            }
        }

        $q = "UPDATE applicants set salary_id = '$salary_id' where id='$user_id'";
        mysqli_query($this->conn, $q);
        return 'SUCCESS';
    }

    public function forgot_password($mobile) {
        $sel_user = "SELECT * FROM users WHERE user_role_id='4' AND mobile = '$mobile'";
        $result = mysql_query($sel_user);
        $user = mysql_fetch_assoc($result);
        if (!empty($user)) {
            $newpass = rand(000000, 999999);
            $newpassdb = md5($newpass);
            $update_user = "UPDATE users set password='$newpassdb' where mobile='$mobile' AND user_role_id='4'";
            $result = mysql_query($update_user);
            if ($result) {
                $phone_no = "+91" . $mobile;
                $name = $user['firstname'] . " " . $user['lastname'];
                $name = ucfirst($name);
                $msg = "Dear " . $name . ", Your new password is:" . $newpass;
                $msg = urldecode($msg);
                $this->send_msg($phone_no, $msg, 1);

                return "SUCCESS";
            } else {
                return "UNABLE_TO_PROCEED";
            }
        } else {

            return "INVALID_USER_ACCESS";
        }
    }

    public function change_password($userid, $oldpassword, $newpassword) {
        $sel_user = "SELECT * FROM users WHERE id = $userid";
        $result = mysql_query($sel_user);
        $user = mysql_fetch_assoc($result);
        if (!empty($user)) {
            $oldpassword = md5($oldpassword);
            if ($user['password'] == $oldpassword) {
                $newpassword = md5($newpassword);
                $update_user = "UPDATE users set password='$newpassword' WHERE id = $userid";
                $update_result = mysql_query($update_user);

                if ($update_result) {
                    return "SUCCESS";
                } else {
                    return "UNABLE_TO_PROCEED";
                }
            } else {
                return "INVALID_OLD_PASSWORD";
            }
        } else {

            return "INVALID_USER_ACCESS";
        }
    }

    private function isEmailExists($email) {
        $save_user = "SELECT id from users WHERE email = '$email'";
        $result = mysql_query($save_user);
        $num_rows = mysql_num_rows($result);
        return $num_rows > 0;
    }

    public function validateUser($username, $password) {
        $sel_user = " SELECT id,language_id,education_id,salary_id,state_id from applicants WHERE registered_mobile = '$username' AND ((registered_mobile = '$password') OR (password = '" . md5($password) . "')  )";
        //echo $sel_user;exit;
        $user = mysqli_query($this->conn, $sel_user);
        $userid = mysqli_fetch_assoc($user);
        if (mysqli_num_rows($user) > 0) {
            return $userid;
        } else {
            return array();
        }
    }

    public function logout($user_id) {
        $check_valid_user = "SELECT COUNT(id) as cnt FROM users WHERE id = '" . $user_id . "'";
        $check_valid_user_res = mysql_query($check_valid_user);
        $check_valid_user_arr = mysql_fetch_array($check_valid_user_res);
        if ($check_valid_user_arr['cnt'] > 0) {
            $select_user = "UPDATE users set is_online = 'N', modified = NOW() where id = $user_id";

            if ($user_res = mysql_query($select_user)) {
                $result = mysql_affected_rows();
                return $result;
            } else {
                return 'UNABLE_TO_PROCEED';
            }
        } else {

            return 'INVALID_USER_ACCESS';
        }
    }

    function applicant_update_mobile($user_id, $mobile) {
        $q1 = "SELECT registered_mobile FROM applicants where id='$user_id'";
        $re1 = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re1) > 0) {
            $array = mysqli_fetch_assoc($re1);
            $registered_mobile = $array['registered_mobile'];
            $password_md5 = md5($mobile);
            $modified_on = date("Y-m-d H:i:s");
            $q = "UPDATE applicants set registered_mobile = '$mobile',password='$password_md5',modified_on='$modified_on ' where id='$user_id'";
            if (mysqli_query($this->conn, $q)) {
                //insert into logs old number//
                $created_on = date("y-m-d H:i:s");
                $stmt = $this->conn->prepare("INSERT INTO applicant_mobile_update_logs (applicant_id, mobile, created_on) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $applicant_id, $registered_mobile, $created_on);
                $applicant_id = $user_id;
                $created_on = $modified_on;
                $mobile_no = $mobile;
                if ($stmt->execute()) {
                    $stmt->close();
                    return 'SUCCESS';
                } else {
                    return 'ERROR';
                }
            } else {
                return 'ERROR';
            }
        } else {
            return 'ERROR';
        }
    }

    public function sendnotification_android($message, $device_token, $booking_id = null) {

        $i = 0;
        $registrationIds = $device_token;
        $registrationIds = array($registrationIds);
        $title = 'Hi!';
        $msg = array(
            'message' => $message,
            'title' => $title,
            'booking_id' => $booking_id,
            //
            'tickerText' => $message,
            'vibrate' => 1,
            'sound' => 1
        );

        $fields = array(
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array(
            'Authorization: key=AIzaSyAqZ5q9r0f16irv5LmnKkFSZLyOL6iN9Zs',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
// let's check the response
        $data = json_decode($result);
//print_r($data);
        if ($data->success == 1) {
            $i = 1;
        } else if ($data->failure == 1) {
//$return = 'FAILURE';
        }
// return $return;

        if ($i == 1) {
            return 'SUCCESS';

            exit;
        } else {

            return 'FAILURE';
            exit;
        }
    }

    public function sendnotification_iphone($message, $device_token, $booking_id = null) {

//echo $user['devicetoken'];die;
        if (strlen($device_token) > 62) {
            $deviceToken = $device_token;
//$deviceToken='dfd4c47ff22e518fa08a5274d8095af82aeb52104ffae370325110ac0d702b61';
            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
            stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');
// Open a connection to the APNS server
            $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT |
                    STREAM_CLIENT_PERSISTENT, $ctx);

            if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);

// echo 'Connected to APNS' . PHP_EOL;
// Create the payload body
            $body['aps'] = array(
                'alert' => 'Hi',
                'data' => $message,
                'booking_id' => $booking_id,
                'sound' => 'default',
            );
//pr($body);die;
// Encode the payload as JSON
            $payload = json_encode($body);

// Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
            $result = fwrite($fp, $msg, strlen($msg)); //pr($result);die;
// Close the connection to the server
            fclose($fp);


            if ($result) {
                return 'SUCCESS';
            } else {

                return 'FAILURE';
            }
        }
    }

    public function SendPushNotification($deviceToken = '', $API_KEY = '', $msg) {


        $fields = array();
//$API_KEY = 'AIzaSyD6qtUxHZfVIwHkzry0Rjuxs1P4-PFj0So';			
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => array($deviceToken),
            'data' => array("message" => $msg)
        );
        $fields = json_encode($fields);

        $headers = array('Authorization: key=' . $API_KEY, 'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
//print_r($result); exit;
        curl_close($ch);

//return $result;

        return true;
    }

    public function send_msg($phone_no, $msg, $no_response = '') {
//return true;
//echo $phone_no; exit;
        if ($phone_no) {
            $msg = urlencode($msg);
            $url = "http://www.onextelbulksms.in/shn/api/pushsms.php?usr=621708&key=010Bs0BM003kiGZBElNV40iLv9JhqD&sndr=ALERTS&ph=" . $phone_no . "&text=" . $msg . "&rpt=1";
//echo $url; exit; 

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, true);
            $data = curl_exec($ch);
            if ($no_response == 1) {
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            }

            if ($data)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');

        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');

        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR')
            ;
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv(
                    'HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function SendInventoryPushNotification($deviceToken = '', $API_KEY = '', $message) {
        $fields = array();
//$API_KEY = 'AIzaSyD6qtUxHZfVIwHkzry0Rjuxs1P4-PFj0So';			
        $url = 'https://fcm.googleapis.com/fcm/send';
        $msg = array(
            'message' => $message,
            'title' => 'inventory'
        );
        $registrationIds = array($deviceToken);
        $fields = array(
            'registration_ids' => $registrationIds,
            'data' => $msg
        );
        $fields = json_encode($fields);
        $headers = array('Authorization: key=' . $API_KEY, 'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
//print_r($result); exit;
        curl_close($ch);
        return $result;
    }

}
?>
	 



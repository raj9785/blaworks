<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

    public function categorytitle($id) {
        return ClassRegistry::init('Category')->find('first', array('conditions' => array('Category.id' => $id)));
    }

    public function cancelbooking($id) {
        return ClassRegistry::init('CancellationReason')->find('first', array('conditions' => array('CancellationReason.id' => $id)));
    }

    public function userbookingdetials($username, $mobile_no) {

        return ClassRegistry::init('Booking')->find('all', array('conditions' => array('Booking.customer_name' => $username, 'Booking.customer_mobile' => $mobile_no,), 'limit' => 5, 'ORDER' => 'DESC'));
    }

    public function getUserId($mobile_no) {
        //return $mobile_no;
        return ClassRegistry::init('Customer')->find('first', array('conditions' => array('Customer.mobile' => $mobile_no,), 'limit' => 1));
    }

    public function CountTotalCab($motyer_type_id, $id, $zone_id) {
        //return $mobile_no;
        return ClassRegistry::init('ZoneInventory')->find('all', array('conditions' => array('ZoneInventory.motor_category_id' => $motyer_type_id, 'ZoneInventory.zone_priority_vendor_id' => $id, 'ZoneInventory.zone_id' => $zone_id,), 'fields' => array('sum(ZoneInventory.cabs) AS total_cab')));
    }

    public function InventoryCab($motyer_type_id, $id, $zone_id) {
        //return $mobile_no;
        return ClassRegistry::init('ZoneInventory')->find('all', array('conditions' => array('ZoneInventory.motor_category_id' => $motyer_type_id, 'ZoneInventory.zone_priority_vendor_id' => $id, 'ZoneInventory.zone_id' => $zone_id,), 'fields' => array('sum(ZoneInventory.cabs) AS total_cab', 'ZoneInventory.cabs', 'sum(ZoneInventory.spoke_to_hub) AS total_spoke_to_hub', 'ZoneInventory.spoke_to_hub', 'ZoneInventory.average_cabs')));
    }

    public function CountInventoryTotalCab($motyer_type_id, $id, $zone_id) {
        //return $mobile_no;
        return ClassRegistry::init('ZoneInventory')->find('all', array('conditions' => array('ZoneInventory.zone_priority_vendor_id' => $id, 'ZoneInventory.zone_id' => $zone_id,), 'fields' => array('sum(ZoneInventory.cabs) AS total_cab', 'sum(ZoneInventory.spoke_to_hub) AS total_spoke_to_hub')));
    }

    public function getZoneStreaming($date_slot, $motor_cat, $zone_id, $spoke_type, $time_slot) {
        //return $mobile_no;
        return ClassRegistry::init('VehicleLiveStreaming')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'taxis',
                            'alias' => 'Taxi',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'VehicleLiveStreaming.taxi_id = Taxi.id'
                            )
                        ),
                        array(
                            'table' => 'motor_types',
                            'alias' => 'MotorType',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.id = Taxi.motor_type_id'
                            )
                        ),
                        array(
                            'table' => 'motor_categories',
                            'alias' => 'MotorCategory',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.motor_category_id = MotorCategory.id'
                            )
                        )
                    ),
                    'conditions' => array(
                        'VehicleLiveStreaming.zone_id' => $zone_id,
                        'MotorCategory.id' => $motor_cat,
                        'VehicleLiveStreaming.time_slot' => $time_slot,
                        'VehicleLiveStreaming.zone_hub_type' => $spoke_type,
                        'VehicleLiveStreaming.booking_type' => 4,
                        'VehicleLiveStreaming.current_status' => 1,
                        'VehicleLiveStreaming.date_slot' => $date_slot
                    ),
                    'fields' => array('VehicleLiveStreaming.id', 'VehicleLiveStreaming.taxi_id'),
                        )
        );
    }

    public function getBooking($date_slot, $slot, $motor_cat, $zone_id, $spoke_type, $time_slot, $status = '') {
        $slotArr = explode('to', $slot);
        $time1 = $slotArr[0];
        $time2 = $slotArr[1];
        $time1 = date("Y-m-d H:i:s", strtotime($time1));
        $time2 = date("Y-m-d H:i:s", strtotime($time2));
        if ($date_slot == 2) {
            $time1 = date("Y-m-d H:i:s", strtotime($time1 . "+1 days"));
            $time2 = date("Y-m-d H:i:s", strtotime($time2 . "+1 days"));
        }
        $timeArr1 = explode(' ', $time1);
        $times1 = explode(':', $timeArr1[1]);
        if ($times1[0] == '00') {
            $times1[0] = '24';
        }
        $t1 = $timeArr1[0] . ' ' . $times1[0] . ':' . $times1[1] . ':' . $times1[2];

        $timeArr2 = explode(' ', $time2);
        $times2 = explode(':', $timeArr2[1]);
        if ($times2[0] == '00') {
            $times2[0] = '24';
        }
        $t2 = $timeArr2[0] . ' ' . $times2[0] . ':' . $times2[1] . ':' . $times2[2];

        $conditions = array();
        if ($status == 2) {
            array_push($conditions, array('Booking.booking_status' => trim($status)));
        }
        array_push($conditions, array(
            'VehicleLiveStreaming.zone_id' => $zone_id,
            'MotorCategory.id' => $motor_cat,
            'VehicleLiveStreaming.time_slot' => $time_slot,
            'VehicleLiveStreaming.zone_hub_type' => $spoke_type,
            'VehicleLiveStreaming.booking_type' => 4,
            'VehicleLiveStreaming.current_status' => 1,
            'VehicleLiveStreaming.date_slot' => $date_slot,
            'DATE_FORMAT(Booking.pickup_time, "%Y-%m-%d %H:%i:%s") >=' => $t1,
            'DATE_FORMAT(Booking.pickup_time, "%Y-%m-%d %H:%i:%s") <=' => $t2,
            'Booking.farecategory_id !=' => 4,
			'Booking.assured_booking' => 0
        ));

        return ClassRegistry::init('VehicleLiveStreaming')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'taxis',
                            'alias' => 'Taxi',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'VehicleLiveStreaming.taxi_id = Taxi.id'
                            )
                        ),
                        array(
                            'table' => 'motor_types',
                            'alias' => 'MotorType',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.id = Taxi.motor_type_id'
                            )
                        ),
                        array(
                            'table' => 'bookings',
                            'alias' => 'Booking',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.id = Booking.motor_type_id'
                            )
                        ),
                        array(
                            'table' => 'motor_categories',
                            'alias' => 'MotorCategory',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.motor_category_id = MotorCategory.id'
                            )
                        )
                    ),
                    'conditions' => $conditions,
                    'fields' => array('Booking.id'),
                    'group' => array('Booking.id'),
                        )
        );
    }

	public function getBookingAssured($date_slot, $slot, $motor_cat, $zone_id, $spoke_type, $time_slot, $status = '') {
        $slotArr = explode('to', $slot);
        $time1 = $slotArr[0];
        $time2 = $slotArr[1];
        $time1 = date("Y-m-d H:i:s", strtotime($time1));
        $time2 = date("Y-m-d H:i:s", strtotime($time2));
        if ($date_slot == 2) {
            $time1 = date("Y-m-d H:i:s", strtotime($time1 . "+1 days"));
            $time2 = date("Y-m-d H:i:s", strtotime($time2 . "+1 days"));
        }
        $timeArr1 = explode(' ', $time1);
        $times1 = explode(':', $timeArr1[1]);
        if ($times1[0] == '00') {
            $times1[0] = '24';
        }
        $t1 = $timeArr1[0] . ' ' . $times1[0] . ':' . $times1[1] . ':' . $times1[2];

        $timeArr2 = explode(' ', $time2);
        $times2 = explode(':', $timeArr2[1]);
        if ($times2[0] == '00') {
            $times2[0] = '24';
        }
        $t2 = $timeArr2[0] . ' ' . $times2[0] . ':' . $times2[1] . ':' . $times2[2];

        $conditions = array();
        if ($status == 2) {
            array_push($conditions, array('Booking.booking_status' => trim($status)));
        }
        array_push($conditions, array(
            'VehicleLiveStreaming.zone_id' => $zone_id,
            'MotorCategory.id' => $motor_cat,
            'VehicleLiveStreaming.time_slot' => $time_slot,
            'VehicleLiveStreaming.zone_hub_type' => $spoke_type,
            'VehicleLiveStreaming.booking_type' => 4,
            'VehicleLiveStreaming.current_status' => 1,
            'VehicleLiveStreaming.date_slot' => $date_slot,
            'DATE_FORMAT(Booking.pickup_time, "%Y-%m-%d %H:%i:%s") >=' => $t1,
            'DATE_FORMAT(Booking.pickup_time, "%Y-%m-%d %H:%i:%s") <=' => $t2,
            'Booking.farecategory_id !=' => 4,
			'Booking.assured_booking' => 1
        ));

        return ClassRegistry::init('VehicleLiveStreaming')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'taxis',
                            'alias' => 'Taxi',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'VehicleLiveStreaming.taxi_id = Taxi.id'
                            )
                        ),
                        array(
                            'table' => 'motor_types',
                            'alias' => 'MotorType',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.id = Taxi.motor_type_id'
                            )
                        ),
                        array(
                            'table' => 'bookings',
                            'alias' => 'Booking',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.id = Booking.motor_type_id'
                            )
                        ),
                        array(
                            'table' => 'motor_categories',
                            'alias' => 'MotorCategory',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'MotorType.motor_category_id = MotorCategory.id'
                            )
                        )
                    ),
                    'conditions' => $conditions,
                    'fields' => array('Booking.id'),
                    'group' => array('Booking.id'),
                        )
        );
    }
	
	
	
    function get_customer_cashback($fare_category = '', $user_id = '') {
        $array_return = array();
        if ($user_id) {
            // $this->loadModel('BookingWalletCashback');
            //$this->loadModel('BookingWalletCashback');
            ClassRegistry::init('BookingWalletCashback')->virtualFields = array(
                'total_trip_count' => 'select COUNT(customer_soas.id) from customer_soas where customer_soas.cashback_offer_id=BookingWalletCashback.cashback_offer_id AND customer_soas.type=2 limit 1',
            );

            if ($fare_category == 1) {
                $conditions = array(
                    'BookingWalletCashback.customer_id' => $user_id,
                    'BookingWalletCashback.status' => 2,
                    'Booking.farecategory_id >=' => $fare_category,
                );
            } else {
                $conditions = array(
                    'BookingWalletCashback.customer_id' => $user_id,
                    'BookingWalletCashback.status' => 2,
                );
            }

            $SoaRecords = ClassRegistry::init('BookingWalletCashback')->find("first", array(
                'conditions' => $conditions,
                'joins' => array(
                    array(
                        'table' => 'bookings',
                        'alias' => 'Booking',
                        'type' => 'LEFT',
                        'conditions' => array('Booking.id = BookingWalletCashback.booking_id')
                    )
                ),
                "group" => 'BookingWalletCashback.id HAVING BookingWalletCashback__total_trip_count < BookingWalletCashback.no_of_trips',
                'order' => array('id' => 'ASC')
            ));

            if (!empty($SoaRecords)) {
                $BookingWalletCashback = $SoaRecords['BookingWalletCashback'];
                if (!empty($BookingWalletCashback)) {
                    // $this->loadModel('CustomerSoa');
                    //insert to customer seo//
                    $SoaLast = ClassRegistry::init('CustomerSoa')->find("first", array(
                        'conditions' => array(
                            'CustomerSoa.customer_id' => $user_id,
                        ),
                        'order' => array('id' => 'DESC')
                    ));
                    if (!empty($SoaLast)) {
                        $current_amount = $SoaLast['CustomerSoa']['current_amount'];
                        $cashback_amount = $BookingWalletCashback['cashback_per_trip'];
                        if ($current_amount >= $cashback_amount) {
                            $current_amount = $current_amount - $cashback_amount;
                            $array_return['cashback_amount'] = $cashback_amount;
                            $array_return['remaining_wallet_amount'] = $current_amount;
                            $array_return['cashback_offer_id'] = $BookingWalletCashback['cashback_offer_id'];
                        }
                    }
                }
            }
        }
        return $array_return;
    }	
	public function CityNameByID($id) {
        //return $mobile_no;
        return ClassRegistry::init('City')->find('all', array('conditions' => array('City.id' => $id),'fields' => array('City.id','City.name')));
		
		
    }
	
	public function TotalCIByMotorCat($id) {
        //return $mobile_no;
        return ClassRegistry::init('VehicleLiveRound')->find('count', array('conditions' => 
		array(
			'VehicleLiveRound.taxi_id' => $id,
			'VehicleLiveRound.status' => 1,
			
		),
		'fields' => array('City.id','City.name')));
    }
	
	public function TotalBookingCI($cities,$motor_type_id){
	
		 $taxice = ClassRegistry::init('VehicleLiveRound')->find('all', array(
            'conditions' => array('VehicleLiveRound.cities' => $cities,'DATE_FORMAT(VehicleLiveRound.last_updated, "%Y-%m-%d") ' => date('Y-m-d'),),
			'fields' => array('VehicleLiveRound.taxi_id')
            )
         );
		  if($taxice){
		///pr($taxice); exit;
		 $TaxiID = array();
		 if($taxice){
			 foreach($taxice as $taxid){
				 $TaxiID[] = $taxid['VehicleLiveRound']['taxi_id'];				
			 }
		 }
		 
				$totalBooking = ClassRegistry::init('MotorCategory')->find('all', array(
				'conditions' => array('Taxi.id' => $TaxiID,'MotorCategory.id' => $motor_type_id),
				'joins' => array(
								array(
									'table' => 'motor_types',
									'alias' => 'MotorType',
									'type' => 'LEFT',
									'conditions' => array(
										'MotorType.motor_category_id = MotorCategory.id',
									)
								),
								array(
									'table' => 'taxis',
									'alias' => 'Taxi',
									'type' => 'LEFT',
									'conditions' => array(
										'Taxi.motor_type_id = MotorType.id'
									)
								)
							),
						
						'fields' => array('MotorCategory.id',"count('MotorCategory.id') as total",'MotorType.id','MotorType.motor_category_id','Taxi.id','Taxi.motor_type_id')
					)
				);
				//pr($totalBooking); exit;
			return $totalBooking[0][0]['total'];
		 }else{
			 
			 return 0;
		 }
		 
	
	}
	public function TotalBookingByMotorCat($id,$motor_type_id,$vendor_id) {
        //return $mobile_no;
      /*  return ClassRegistry::init('Booking')->find('count', array('conditions' => 
		array(
			'Booking.city_id' => $id,
			//'Booking.motor_type_id' => $motor_type_id,
			//'Booking.vendor_id' => $vendor_id,
			'OR'=>array('Booking.booking_status' => 0,'Booking.booking_status' => 1,'Booking.farecategory_id' => 3,'Booking.farecategory_id' => 5,'Booking.farecategory_id' => 6)
		),
		'fields' => array('City.id','City.name')));  */
		
		
			ClassRegistry::init('Booking')->unbindModel(array('hasOne' => array('Timemgmt','Airport','Customer','Driver','City','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi')));
			
			ClassRegistry::init('Booking')->unbindModel(array('belongsTo' => array('Timemgmt','Airport','Customer','Driver','City','Vendor','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi','Taxi','MotorType')));
			
			ClassRegistry::init('Booking')->unbindModel(array('hasMany' => array('BookingFare','BookingVendorFare','BookingLocation','TransactionDetail')));
		
		
		 return ClassRegistry::init('Booking')->find('all', array(
				'conditions' => array('Booking.city_id' => $id,'MotorCategory.id' => $motor_type_id, 
				'DATE_FORMAT(Booking.pickup_time, "%Y-%m-%d") ' => date('Y-m-d'),
				'OR'=>array('Booking.farecategory_id' => array(3,5,6))),
				'joins' => array(
						array(
							'table' => 'motor_types',
							'alias' => 'MotorType',
							'type' => 'LEFT',
							'conditions' => array(
								'MotorType.id = Booking.motor_type_id',
							)
						),
						 
						array(
							'table' => 'motor_categories',
							'alias' => 'MotorCategory',
							'type' => 'LEFT',
							'conditions' => array(
								'MotorCategory.id = MotorType.motor_category_id',
							)
						),
						
					),
				
				
				'fields' => array('Booking.booking_status','Booking.farecategory_id','Booking.pickup_time',"count('Booking.id') as total",'Booking.motor_type_id','Booking.id','MotorType.id','MotorType.motor_category_id','MotorCategory.id')
			)
		  );
		
		
		
		
    }
	public function TotalAssignedBookingByMotorCat($id,$motor_type_id,$vendor_id) {
        //return $mobile_no;
        /* return ClassRegistry::init('Booking')->find('count', array('conditions' => 
		array(
			'Booking.city_id' => $id,
			//'Booking.motor_type_id' => $motor_type_id,
			//'Booking.vendor_id' => $vendor_id,
			'OR'=>array('Booking.booking_status' => 2,'Booking.farecategory_id' => 3,'Booking.farecategory_id' => 5,'Booking.farecategory_id' => 6)
		),
		'fields' => array('City.id','City.name'))); */
		
		ClassRegistry::init('Booking')->unbindModel(array('hasOne' => array('Timemgmt','Airport','Customer','Driver','City','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi')));
			
			ClassRegistry::init('Booking')->unbindModel(array('belongsTo' => array('Timemgmt','Airport','Customer','Driver','City','Vendor','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi','Taxi','MotorType')));
			
			ClassRegistry::init('Booking')->unbindModel(array('hasMany' => array('BookingFare','BookingVendorFare','BookingLocation','TransactionDetail')));
		
		
		 return ClassRegistry::init('Booking')->find('all', array(
				'conditions' => array('Booking.city_id' => $id,'MotorCategory.id' => $motor_type_id, 'Booking.booking_status' => '2','DATE_FORMAT(Booking.pickup_time, "%Y-%m-%d") ' => date('Y-m-d'),
				'OR'=>array('OR'=>array('Booking.farecategory_id' => array(3,5,6)))),
				'joins' => array(
						array(
							'table' => 'motor_types',
							'alias' => 'MotorType',
							'type' => 'LEFT',
							'conditions' => array(
								'MotorType.id = Booking.motor_type_id',
							)
						),
						 
						array(
							'table' => 'motor_categories',
							'alias' => 'MotorCategory',
							'type' => 'LEFT',
							'conditions' => array(
								'MotorCategory.id = MotorType.motor_category_id',
							)
						),
						
					),
				
				
				'fields' => array('Booking.booking_status','Booking.pickup_time',"count('Booking.id') as total",'Booking.motor_type_id','Booking.id','MotorType.id','MotorType.motor_category_id')
			)
		  );
		
		
		
		
    }
	
	public function TotalBookingCITB($cities,$motor_type_id){
		
		
			//pr($cities); exit;
		 $taxice = ClassRegistry::init('VehicleLiveRound')->find('all', array(
            'conditions' => array('VehicleLiveRound.cities' => $cities),
			'fields' => array('VehicleLiveRound.taxi_id')
            )
         );
		///pr($taxice); exit;
		 
		 if($taxice){
			 
			 $TaxiID = array();
			 foreach($taxice as $taxid){
				 $TaxiID[] = $taxid['VehicleLiveRound']['taxi_id'];
				//pr($taxid);
				 
				 //array_push($TaxiID, array($taxid['VehicleLiveRound']['taxi_id']));
			 }
			//pr($TaxiID); 
						 
			ClassRegistry::init('Booking')->unbindModel(array('hasOne' => array('Timemgmt','Airport','Customer','Driver','City','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi')));
			
			ClassRegistry::init('Booking')->unbindModel(array('belongsTo' => array('Timemgmt','Airport','Customer','Driver','City','Vendor','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi','Taxi','MotorType')));
			
			ClassRegistry::init('Booking')->unbindModel(array('hasMany' => array('BookingFare','BookingVendorFare','BookingLocation','TransactionDetail')));
			
			
			$totalBooking = ClassRegistry::init('Booking')->find('all', array(
				'conditions' => array('Booking.city_id' => $cities),							
				'fields' => array('Booking.booking_status','Booking.motor_type_id','Booking.id')
			)
		  );
			//pr($totalBooking);
			//return $totalBooking[0][0]['total'];
			
			$TaxiData = ClassRegistry::init('Taxi')->find('all', array(
				'conditions' => array('Taxi.id' => $TaxiID),							
				
			)
		  );
			
				//spr($TaxiData);
			
			ClassRegistry::init('Booking')->unbindModel(array('hasOne' => array('Timemgmt','Airport','Customer','Driver','City','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi')));
			
			ClassRegistry::init('Booking')->unbindModel(array('belongsTo' => array('Timemgmt','Airport','Customer','Driver','City','Vendor','Farecategory','BookingCharge','Invoice','VendorInvoice','AssignedDriver','Taxi','Taxi','MotorType')));
			 
			$totalBooking = ClassRegistry::init('Booking')->find('all', array(
				'conditions' => array('Taxi.id' => $TaxiID,'MotorCategory.id' => $motor_type_id,'Booking.city_id' => $cities
				, 'DATE_FORMAT(Booking.pickup_time, "%Y-%m-%d") ' => date('Y-m-d'),
				),
				'joins' => array(
						array(
							'table' => 'motor_types',
							'alias' => 'MotorType',
							'type' => 'LEFT',
							'conditions' => array(
								'MotorType.id = Booking.motor_type_id',
							)
						),
						array(
							'table' => 'taxis',
							'alias' => 'Taxi',
							'type' => 'LEFT',
							'conditions' => array(
								'Taxi.motor_type_id = MotorType.id'
							)
						), 
						array(
							'table' => 'motor_categories',
							'alias' => 'MotorCategory',
							'type' => 'LEFT',
							'conditions' => array(
								'MotorCategory.id = MotorType.motor_category_id',
							)
						),
						
					),
				
				
				'fields' => array('Booking.booking_status','Booking.pickup_time',
				"count('Booking.booking_status') as total",'Booking.motor_type_id','Booking.id','MotorType.id','MotorType.motor_category_id','Taxi.id','Taxi.motor_type_id')
			)
		  );
			//pr($totalBooking); exit;
			return $totalBooking[0][0]['total'];
		 }else{
			 
			 return 0;
		 }
		
	}
	
	public function TotalTransaction($id) {
        //return $mobile_no;
        return ClassRegistry::init('TransactionDetail')->find('first', array('conditions' => array('TransactionDetail.booking_id' => $id,'TransactionDetail.paid_type' => 0), 'fields' => array('SUM(TransactionDetail.amount) AS total_paid_amount')));
    }
	

}

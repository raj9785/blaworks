<?php
App::uses('Security', 'Utility');
class AccessPermission extends AccessRightUserAppModel {

	public $name = 'AccessPermission';
	public $validate = array();

	 public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		
		}
 
	function savePermission($userId,$postData){
	//echo $userId;
		//pr($postData);
		//die;  
		if(isset($postData['AccessRightUser']['dashboard'])){
			$userDetails['dashboard']									= 	$postData['AccessRightUser']['dashboard'];
		}
	
		if(isset($postData['AccessRightUser']['booking'])){
			$userDetails['booking']										= 	$postData['AccessRightUser']['booking'];
		}
	
		if(isset($postData['AccessRightUser']['customer_invoice'])){
			$userDetails['customer_invoice']							= 	$postData['AccessRightUser']['customer_invoice'];
		}
	
		if(isset($postData['AccessRightUser']['vendor_invoice'])){
			$userDetails['vendor_invoice']								= 	$postData['AccessRightUser']['vendor_invoice'];
		}
		
		
		
		if(isset($postData['AccessRightUser']['receipts'])){
			$userDetails['receipts']								= 	$postData['AccessRightUser']['receipts'];
		}
		
		if(isset($postData['AccessRightUser']['vendor_payment'])){
			$userDetails['vendor_payment']								= 	$postData['AccessRightUser']['vendor_payment'];
		}
		
		/*if(isset($postData['AccessRightUser']['payu_panel'])){
			$userDetails['payu_panel']									= 	$postData['AccessRightUser']['payu_panel'];
		}
		
		if(isset($postData['AccessRightUser']['ezetap_panel'])){
			$userDetails['ezetap_panel']								= 	$postData['AccessRightUser']['ezetap_panel'];
		}*/
		
		if(isset($postData['AccessRightUser']['customer'])){
			$userDetails['customer']									= 	$postData['AccessRightUser']['customer'];
		}
		
		if(isset($postData['AccessRightUser']['driver'])){
			$userDetails['driver']										= 	$postData['AccessRightUser']['driver'];
		}
		
		if(isset($postData['AccessRightUser']['corporatebusiness'])){
			$userDetails['corporatebusiness']							= 	$postData['AccessRightUser']['corporatebusiness'];
		}
		
		if(isset($postData['AccessRightUser']['vehicle_category'])){
			$userDetails['vehicle_category']							= 	$postData['AccessRightUser']['vehicle_category'];
		}
		
		if(isset($postData['AccessRightUser']['vehicle_manufacturer'])){
			$userDetails['vehicle_manufacturer']						= 	$postData['AccessRightUser']['vehicle_manufacturer'];
		}
	
		if(isset($postData['AccessRightUser']['vehicle_model'])){
			$userDetails['vehicle_model']								= 	$postData['AccessRightUser']['vehicle_model'];
		}
		if(isset($postData['AccessRightUser']['team'])){
			$userDetails['team']										= 	$postData['AccessRightUser']['team'];
		}
		if(isset($postData['AccessRightUser']['country'])){
			$userDetails['country']										= 	$postData['AccessRightUser']['country'];
		}
		if(isset($postData['AccessRightUser']['state'])){
			$userDetails['state']										= 	$postData['AccessRightUser']['state'];
		}
		if(isset($postData['AccessRightUser']['city'])){
			$userDetails['city']										= 	$postData['AccessRightUser']['city'];
		}
		if(isset($postData['AccessRightUser']['airport'])){
			$userDetails['airport']										= 	$postData['AccessRightUser']['airport'];
		}
		if(isset($postData['AccessRightUser']['superdestination'])){
			$userDetails['superdestination']							= 	$postData['AccessRightUser']['superdestination'];
		}
		if(isset($postData['AccessRightUser']['moredestination'])){
			$userDetails['moredestination']								= 	$postData['AccessRightUser']['moredestination'];
		}
		if(isset($postData['AccessRightUser']['fare_category'])){
			$userDetails['fare_category']								= 	$postData['AccessRightUser']['fare_category'];
		}
		if(isset($postData['AccessRightUser']['fare_time_management'])){
			$userDetails['fare_time_management']						= 	$postData['AccessRightUser']['fare_time_management'];
		}
		if(isset($postData['AccessRightUser']['customer_fare'])){
			$userDetails['customer_fare']								= 	$postData['AccessRightUser']['customer_fare'];
		}
	
		if(isset($postData['AccessRightUser']['vendor_fare'])){
			$userDetails['vendor_fare']									= 	$postData['AccessRightUser']['vendor_fare'];
		}
		if(isset($postData['AccessRightUser']['charges_management'])){
			$userDetails['charges_management']							= 	$postData['AccessRightUser']['charges_management'];
		}
		if(isset($postData['AccessRightUser']['promotion_code'])){
			$userDetails['promotion_code']								= 	$postData['AccessRightUser']['promotion_code'];
		}
		if(isset($postData['AccessRightUser']['feedback_rating'])){
			$userDetails['feedback_rating']								= 	$postData['AccessRightUser']['feedback_rating'];
		}
		if(isset($postData['AccessRightUser']['transaction'])){
			$userDetails['transaction']									= 	$postData['AccessRightUser']['transaction'];
		}
		if(isset($postData['AccessRightUser']['testimonial'])){
			$userDetails['testimonial']									= 	$postData['AccessRightUser']['testimonial'];
		}
		if(isset($postData['AccessRightUser']['moredestination'])){
			$userDetails['moredestination']								= 	$postData['AccessRightUser']['moredestination'];
		}
		if(isset($postData['AccessRightUser']['pages'])){
			$userDetails['pages']										= 	$postData['AccessRightUser']['pages'];
		}
		if(isset($postData['AccessRightUser']['terms'])){
			$userDetails['terms']										= 	$postData['AccessRightUser']['terms'];
		}
		if(isset($postData['AccessRightUser']['faqs'])){
			$userDetails['faqs']										= 	$postData['AccessRightUser']['faqs'];
		}
		if(isset($postData['AccessRightUser']['refund_management'])){
			$userDetails['refund_management']							= 	$postData['AccessRightUser']['refund_management'];
		}
		if(isset($postData['AccessRightUser']['taxi_management'])){
			$userDetails['taxi_management']							= 	$postData['AccessRightUser']['taxi_management'];
		}
		
	
	
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'access_right_user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['AccessPermission']['access_right_user_id'] = $userId;
				$newDetail['AccessPermission']['field_name'] = $field;
				$newDetail['AccessPermission']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['AccessPermission']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
}

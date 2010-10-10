<?php 
class ControllerPaymentOkpay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/okpay');

		$this->document->title = $this->language->get('heading_title');
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('okpay', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
	
		$this->data['entry_receiver'] = $this->language->get('entry_receiver');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');

		$this->data['entry_order_status'] = $this->language->get('entry_order_status');	
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['receiver'])) {
			$this->data['error_receiver'] = $this->error['receiver'];
		} else {
			$this->data['error_receiver'] = '';
		}
		
		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_payment'),
      		'separator' => ' :: '
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=payment/okpay&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/okpay&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];
		
		
		// Receiver Email, Phone Number or Wallet Designation ID
		if (isset($this->request->post['okpay_receiver'])) {
			$this->data['okpay_receiver'] = $this->request->post['okpay_receiver'];
		} else {
			$this->data['okpay_receiver'] = $this->config->get('okpay_receiver');
		}
		
		if (isset($this->request->post['okpay_order_status_id'])) {
			$this->data['okpay_order_status_id'] = $this->request->post['okpay_order_status_id'];
		} else {
			$this->data['okpay_order_status_id'] = $this->config->get('okpay_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		

		if (isset($this->request->post['okpay_geo_zone_id'])) {
			$this->data['okpay_geo_zone_id'] = $this->request->post['okpay_geo_zone_id'];
		} else {
			$this->data['okpay_geo_zone_id'] = $this->config->get('okpay_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		
		if (isset($this->request->post['okpay_status'])) {
			$this->data['okpay_status'] = $this->request->post['okpay_status'];
		} else {
			$this->data['okpay_status'] = $this->config->get('okpay_status');
		}

		
		if (isset($this->request->post['okpay_sort_order'])) {
			$this->data['okpay_sort_order'] = $this->request->post['okpay_sort_order'];
		} else {
			$this->data['okpay_sort_order'] = $this->config->get('okpay_sort_order');
		}
		
		$this->template = 'payment/okpay.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/okpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['okpay_receiver']) {
			$this->error['receiver'] = $this->language->get('error_receiver');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_user_model');
		$this->model = $this->Admin_user_model;
	}

	public function index($id = null)
	{
		$data = array();
		$this->page('welcome/dashboard_view', $data);
	}

	function login()
	{


		$form = $this->input->post('form');
		if ($form) {

			$result =	$this->model->get(array(
				'username' => $form['username'],
				'password' => hash('sha256',  $form['password']),
			));

			if ($result['data']) {
				$result['data'][0]->is_login = true;
				$this->session->set_userdata('user', $result['data'][0]);
				redirect(base_url());
				exit;
			}

			$this->session->set_flashdata('error', 'Invalid username or password');
		}

		$data = array('content' => $this->load->view('welcome/login_view', [], true));
		$this->load->view('UI/templates/blank_page_view', $data);
	}

	function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url() . 'welcome/login');
	}

	function register()
	{
		$form = $this->input->post('form');
		$data = array('content' => $this->load->view('welcome/register_view', [], true));

		if ($form) {
			
			$this->model->add(array(
				'organisation' => $form['organisation'],
				'username' => $form['username'],
				'password' => hash('sha256',  $form['password']),
				'site'	   => ''
			));

			$data = array('content' => $this->load->view('welcome/after_register_view', $form, true));
		
		}


		$this->load->view('UI/templates/blank_page_view', $data);
	}
}

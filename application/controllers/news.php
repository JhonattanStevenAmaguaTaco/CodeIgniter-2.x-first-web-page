<?php
	class News extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model("news_model");
		}
		public function loadDefaultNewsView($data=NULL,$methodName="")
		{
			this->load->view("templates/header",$data);
			this->load->view("news/".$methodName,$data);
			this->load->view("templates/footer");
		}
		public function index()
		{
			$methodName="index";
			$data['title'] = 'News archive';
			$data["news"]=$this->news_model->get_news();
				loadDefaultNewsView($data);
		}
		public function view($slug)
		{
			$data["news"]=$this->news_model->get_news($slug);
			if (empty($data['news_item']))
			{
				show_404();
			}
			$data['title'] = $data['news_item']['title'];
			$methodName="view";
			loadDefaultNewsView($data,$methodName);
		}
	}
?>
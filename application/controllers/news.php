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
		public function create()
		{
			$this->load->helper("form");
			$this->load->library("form_validation");
			$data["title"] = "Create a news item"
			$this->form_validation->set_rules("title","Title","required");
			$this->form_validation->set_rules("text","text","required");
			if ($this->form_validation->run()===FASLE)
			{
				$this->load->view('templates/header', $data);	
				$this->load->view('news/create');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->news_model->set_news();
				$this->load->view('news/success');
			}
		}
	}
?>

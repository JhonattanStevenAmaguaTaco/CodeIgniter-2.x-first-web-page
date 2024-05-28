<?php

class Pages extends CI_Controller
{

	public function view($page="home")
	{
		//Does exists the page we looking for	
		if(!file_exists(APPPATH."views/pages/".$page.".php"))//if No
		{
			show_404;//whe dont have that
		}
		// Capitalize the first letter
		$data["title"]=ucfirst($page);

		this->load->view("templates/header",$data);
		this->load->view("pages/".$page,$data)
		this->load->view("templates/footer",$data);
			
	}
}


?>
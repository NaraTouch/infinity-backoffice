<?php
namespace App\Controller;

class TournamentController extends AppController
{
	public function tournament()
	{
		$request_data = $this->request->getQuery();
		if (isset($request_data) && isset($request_data['title'])) {
			$id = $request_data['id'];
			$title = $request_data['title'];
			$this->set('breadcrumbs', $title);
		}
		
	}
	
	public function teams()
	{

	}
	public function teammate()
	{
		$request_data = $this->request->getQuery();
		$teammate_name = $request_data['teammate_id'];
		$this->set('breadcrumbs', $teammate_name);
	}
}

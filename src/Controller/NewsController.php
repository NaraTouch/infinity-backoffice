<?php
namespace App\Controller;

class NewsController extends AppController
{
	public function blogs()
	{

	}
	public function blogArticle()
	{
		$request_data = $this->request->getQuery();
		$id = $request_data['id'];
		$title = $request_data['title'];
		$this->set('breadcrumbs', $title);
	}
}

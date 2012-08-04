<?php
/**
 * 
 */
class IndexAction extends CAction {

	private $controller= null;

	public function run($slug)
	{
		$this->controller= $this->getController();
		$forum=$this->controller->loadForumModel($slug);
		$this->controller->render('index',array(
										'forumModel'=>$forum,
										'model' =>new Topic('getTopicsByForum')
									));
	}
}

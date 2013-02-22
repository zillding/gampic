<?php
// for debug only
// need to be deleted later
 class DebugController extends Controller
{
	public function actionIndex()
	{

		if (!isset($_SESSION)) {
			session_start();
		}
		Helper::pprint($_SESSION);

		if (!user()->isGuest) {
			Helper::pprint(user());
			// Helper::pprint($_SESSION);
		}
	}
		
	public function actionShow()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		// session_start();
		Helper::pprint($_SESSION);
	}

	public function actionEnd()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		session_destroy();
		print 'session cleared';
	}

}

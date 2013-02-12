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

}

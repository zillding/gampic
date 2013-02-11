<?php
// for debug only
// need to be deleted later
 class DebugController extends Controller
{
	public function actionIndex()
	{
		if (!user()->isGuest) {
			Helper::pprint(UserIdentity::generateGravatar(user()->id));
			Helper::pprint(user());
		}
	}

}

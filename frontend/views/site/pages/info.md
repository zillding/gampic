#Info

####This is the info page of Gampic

This web site is developed by **Ding Zeyu** as the **Final Year Project**.

The objective of this project is not only to simply develop a website, but most importantly, learn the cutting-edge technology and write **quality** code. The design process is thought highly of and should be refined during the implementation process.

Some of the features are under development and can only be tested on the local machine through localhost, for example, the disqus
integration.

#####Notes:

Should consider using OOP in javascript.
The current implementation has some flaws.

the "viewport" in the jquery waypoint means the top of the windew!!!

finally fix the performance issue.
use "height" attribute on the "img" is useless.
in order to reserver space for an image, has to adjust the css of the container of the image

when trying some new features, a big development step, especially when there is a need to change sth, can try using
branching in git

jquery on is not working properly. or i haven't figure out how to use it

the z-index property in html is "auto" by default which means equal to the z-index of the parent. the root "html"
z-index is 0!

Two ways of defining a javascript class

*	constructor version
*	literal version

if only need one object of its kind, then use an object literal, but if need several instances of an object, where each instance
is independent of the other and can have different properties or methods depending on the way it’s constructed, then use a constructor function.

when a change is made to an Object Literal it affects that object across the entire script, whereas when
a Constructor function is instantiated and then a change is made to that instance, it won’t affect any
other instances of that object.

callback function is a very important concept in js

the comment should be a weak entity. the database design need to be re-considered

some bug in the navigation bar observed! the style is werid, need to be fixed manually
note: the 'url' has to be a array in order to let it highlight after click. be careful with the url, so the nav bar can show
the highlight correctly

Yii url doesnot recognize the trailing slash

should use lazy instantiation

use Yii::app()->getGlobalState() to get global variable

in yii, the common config override the frontend config

should add some error handling for different scenarios

there is a global.php file under common/lib, in it defined some shortcut functions
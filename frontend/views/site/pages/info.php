<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Info';
?>
<h1>Info</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>

<h4 id="thisistheinfopageofgampic">This is the info page of Gampic</h4>

<p>This web site is developed by Ding Zeyu as the Final Year Project.</p>

<p>The objective of this project is not only to simply develop a website, but most importantly, learn the cutting-edge technology and write <strong>quality</strong> code. The design process is thought highly of and should be refined during the implementation process.</p>

<p>Some of the features are under development and can only be tested on the local machine through localhost, for example, the disqus
integration.</p>

<h5 id="notes:">Notes:</h5>

<p>Should consider using OOP in javascript.
The current implementation has some flaws.</p>

<p>the &#8220;viewport&#8221; in the jquery waypoint means the top of the windew!!!</p>

<p>finally fix the performance issue.
use &#8220;height&#8221; attribute on the &#8220;img&#8221; is useless.
in order to reserver space for an image, has to adjust the css of the container of the image</p>

<p>when trying some new features, a big development step, especially when there is a need to change sth, can try using
branching in git</p>

<p>jquery on is not working properly. or i haven&#8217;t figure out how to use it</p>

<p>the z-index property in html is &#8220;auto&#8221; by default which means equal to the z-index of the parent. the root &#8220;html&#8221;
z-index is 0!</p>

<p>Two ways of defining a javascript class</p>

<ul>
<li>constructor version</li>
<li>literal version</li>
</ul>

<p>if only need one object of its kind, then use an object literal, but if need several instances of an object, where each instance
is independent of the other and can have different properties or methods depending on the way it’s constructed, then use a constructor function.</p>

<p>when a change is made to an Object Literal it affects that object across the entire script, whereas when
a Constructor function is instantiated and then a change is made to that instance, it won’t affect any
other instances of that object.</p>

<p>callback function is a very important concept in js</p>

<p>the comment should be a weak entity. the database design need to be re-considered</p>

<p>some bug in the navigation bar observed! the style is werid, need to be fixed manually
note: the &#8216;url&#8217; has to be a array in order to let it highlight after click. be careful with the url, so the nav bar can show
the highlight correctly</p>

<p>Yii url doesnot recognize the trailing slash</p>

<!-- should use the content wrote in info.md -->

<?php
$this->loadDisqus();
?>
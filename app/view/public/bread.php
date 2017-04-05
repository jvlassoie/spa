<?php
if ($GLOBALS['requestGlobal']!= null) {
$controller = $GLOBALS['requestGlobal']->getController();
$action = $GLOBALS['requestGlobal']->getAction();
?>
<ul class='breadcrumb'>
  <li><a href='/''>Home</a></li>
  <?= '<li><a href="/'.$controller.'/view" title="'.$controller.'">'; ?>
  <?= $controller ?>       
</a></li>  
<li class="active">
  <?= $action ?>         
</a></li>  
</ul>
<?php
}
?>
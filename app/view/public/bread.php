<?php
$glob = new SuperGlobal();
if ($glob->getGlob('request') != null) {
	$controller = $glob->getGlob('request')->getController();
	$action = $glob->getGlob('request')->getAction();
	$parameters = $glob->getGlob('request')->getParams();
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
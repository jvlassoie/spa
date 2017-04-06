<?php
$glob = new SuperGlobal();
$controller = ($glob->getGlob('request') != null)? $glob->getGlob('request')->getController() : 'Home';
?>
<title><?= 'Spa : '.$controller ?></title>

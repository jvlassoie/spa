<h1>Une erreur est survenue :(</h1><br>
<?= (!empty($error))?"<h3>$error</h3>":null; ?>
<h6>Vous allez être redirigé dans quelques secondes...</h6>
<input type="hidden" name="link" id="link" value="<?= (!empty($link))?$link:null; ?>" />
<script type="text/javascript" src="/js/redirect.js"></script>
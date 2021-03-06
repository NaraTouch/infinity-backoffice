<!DOCTYPE html>
<html lang="en">
    <head>
		<?php $image_url = $this->Url->build('/', ['escape' => false,'fullBase' => true,]);?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GoodGames | Community and Store HTML Game Template</title>
        <meta name="description" content="GoodGames - Bootstrap template for communities and games store">
        <meta name="keywords" content="game, gaming, template, HTML template, responsive, Bootstrap, premium">
        <meta name="author" content="_nK">
        <link rel="icon" type="image/png" href="<?= $image_url.'images/favicon.png'?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7cOpen+Sans:400,700" rel="stylesheet" type="text/css">
        <?php
        echo $this->Html->css([
            'vendor/bootstrap/dist/css/bootstrap.min',
            'vendor/ionicons/css/ionicons.min',
            'vendor/flickity/dist/flickity.min',
            'vendor/photoswipe/dist/photoswipe',
            'vendor/photoswipe/dist/default-skin/default-skin',
            'vendor/bootstrap-slider/dist/css/bootstrap-slider.min',
            'vendor/summernote/dist/summernote-bs4',
            'goodgames',
            'custom',
        ]);
        echo $this->fetch('css');
        ?>
    </head>

    <body>
		<?= $this->Flash->render() ?>
		<?= $this->element('component/menu'); ?>
		<?= $this->fetch('content'); ?>
		<?= $this->element('component/footer'); ?>
		<!-- START: Page Background -->
		<img class="nk-page-background-top" src="<?= $image_url.'images/bg-top.png'?>" alt="">
		<img class="nk-page-background-bottom" src="<?= $image_url.'images/bg-bottom.png'?>" alt="">
		<!-- END: Page Background -->
	</body>
	<?= $this->element('modal_search'); ?>
	<?= $this->element('login'); ?>
<?php
    echo $this->Html->script([
        'vendor/fontawesome-free/js/all',
        'vendor/fontawesome-free/js/v4-shims',
        'vendor/jquery/dist/jquery.min',
        'vendor/object-fit-images/dist/ofi.min',
        'vendor/gsap/src/minified/TweenMax.min',
        'vendor/gsap/src/minified/plugins/ScrollToPlugin.min',
        'vendor/popper.js/dist/umd/popper.min',
        'vendor/bootstrap/dist/js/bootstrap.min',
        'vendor/sticky-kit/dist/sticky-kit.min',
        'vendor/imagesloaded/imagesloaded.pkgd.min',
        'vendor/flickity/dist/flickity.pkgd.min',
        'vendor/photoswipe/dist/photoswipe.min',
        'vendor/photoswipe/dist/photoswipe-ui-default.min',
        'vendor/jquery-validation/dist/jquery.validate.min',
        'vendor/jquery-countdown/dist/jquery.countdown.min',
        'vendor/moment/min/moment.min',
        'vendor/moment-timezone/builds/moment-timezone-with-data.min',
        'vendor/hammerjs/hammer.min',
        'vendor/soundmanager2/script/soundmanager2-nodebug-jsmin',
        'vendor/bootstrap-slider/dist/bootstrap-slider.min',
        'vendor/summernote/dist/summernote-bs4.min',
        'plugins/nk-share/nk-share',
        'goodgames.min',
        'goodgames-init',
    ]);
    echo $this->fetch('script');
?>
</html>

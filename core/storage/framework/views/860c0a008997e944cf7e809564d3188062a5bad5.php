<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
        <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
        <?php if (!isset($__inertiaSsr)) { $__inertiaSsr = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsr instanceof \Inertia\Ssr\Response) { echo $__inertiaSsr->head; } ?>
    </head>
    <body class="font-sans antialiased">
        <?php if (!isset($__inertiaSsr)) { $__inertiaSsr = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsr instanceof \Inertia\Ssr\Response) { echo $__inertiaSsr->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
        <script src="<?php echo e(mix('js/app.js')); ?>"></script>
        <script src="<?php echo e(mix('js/theme.js')); ?>"></script>

        <?php if(app()->environment('local')): ?>
            
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        <?php endif; ?>
    </body>
</html>
<?php /**PATH C:\Users\TRS 37\Desktop\Work\aamearning\resources\views/app.blade.php ENDPATH**/ ?>
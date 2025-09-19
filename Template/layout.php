<!DOCTYPE html>
<html lang="<?= $this->app->jsLang() ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
        <meta name="mobile-web-app-capable" content="yes">
        
        <!-- Inter font from Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <meta name="robots" content="noindex,nofollow">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="referrer" content="no-referrer">

        <?php if (isset($board_public_refresh_interval)): ?>
            <meta http-equiv="refresh" content="<?= $board_public_refresh_interval ?>">
        <?php endif ?>
        
        <?= $this->asset->colorCss() ?>
        <?= $this->asset->css('assets/css/vendor.min.css') ?>
        <?= $this->asset->css('assets/css/light.min.css') ?>
        <?= $this->asset->css('assets/css/print.min.css', true, 'print') ?>
        <?= $this->asset->customCss() ?>

        <?php if (! isset($not_editable)): ?>
            <?= $this->asset->js('assets/js/vendor.min.js') ?>
            <?= $this->asset->js('assets/js/app.min.js') ?>
            <?= $this->asset->js('plugins/ThemeRevision/Asset/dev/js/zenscroll.min.js') ?>
        <?php endif ?>

        <?= $this->hook->asset('css', 'template:layout:css') ?>
        <?= $this->hook->asset('js', 'template:layout:js') ?>

        <link rel="icon" type="image/png" href="<?= $this->url->dir() ?>assets/img/favicon.png">
        <link rel="apple-touch-icon" href="<?= $this->url->dir() ?>assets/img/touch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->url->dir() ?>assets/img/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= $this->url->dir() ?>assets/img/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= $this->url->dir() ?>assets/img/touch-icon-ipad-retina.png">

        <title>
            <?php if (isset($page_title)): ?>
                <?= $this->text->e($page_title) ?>
            <?php elseif (isset($title)): ?>
                <?= $this->text->e($title) ?>
            <?php else: ?>
                Kanboard
            <?php endif ?>
        </title>

        <?= $this->hook->render('template:layout:head') ?>
    </head>
    <body data-status-url="<?= $this->url->href('UserAjaxController', 'status') ?>"
          data-login-url="<?= $this->url->href('AuthController', 'login') ?>"
          data-keyboard-shortcut-url="<?= $this->url->href('DocumentationController', 'shortcuts') ?>"
          data-timezone="<?= $this->app->getTimezone() ?>"
          data-js-date-format="<?= $this->app->getJsDateFormat() ?>"
          data-js-time-format="<?= $this->app->getJsTimeFormat() ?>"
          class="TR"
    >

    <?php if (isset($no_layout) && $no_layout): ?>
        <?= $this->app->flashMessage() ?>
        <?= $content_for_layout ?>
    <?php else: ?>
        <?= $this->hook->render('template:layout:top') ?>
        <?= $this->render('header', array(
            'title' => $title,
            'description' => isset($description) ? $description : '',
            'board_selector' => isset($board_selector) ? $board_selector : array(),
            'project' => isset($project) ? $project : array(),
        )) ?>
        <section class="page">
            <?= $this->app->flashMessage() ?>
            <?= $content_for_layout ?>
        </section>
        <?= $this->hook->render('template:layout:bottom') ?>
        
        <!-- Trianglify Background Patterns -->
        <script src="https://cdn.jsdelivr.net/npm/trianglify@4.1.1/dist/trianglify.min.js"></script>
        <script>
        /**
         * Trianglify Background Initialization
         * Creates beautiful low-poly animated backgrounds for task boards
         */
        (function() {
            'use strict';
            
            // Configuration for different elements
            const configs = {
                boardTaskList: {
                    cellSize: 60,
                    variance: 0.75,
                    strokeWidth: 0,
                    colorFunction: trianglify.colorFunctions.shadows(),
                    xColors: ['#8A2BE2', '#FF1493', '#00BFFF', '#FFD700'],
                    yColors: ['#8A2BE2', '#FF1493', '#00BFFF', '#FFD700']
                },
                taskSummary: {
                    cellSize: 80,
                    variance: 0.6,
                    strokeWidth: 0,
                    colorFunction: trianglify.colorFunctions.shadows(),
                    xColors: ['#8A2BE2', '#FF1493', '#00BFFF'],
                    yColors: ['#8A2BE2', '#FF1493', '#00BFFF']
                },
                pageHeader: {
                    cellSize: 100,
                    variance: 0.5,
                    strokeWidth: 0,
                    colorFunction: trianglify.colorFunctions.shadows(),
                    xColors: ['#8A2BE2', '#FF1493', '#00BFFF'],
                    yColors: ['#8A2BE2', '#FF1493', '#00BFFF']
                }
            };
            
            // Performance optimization
            let animationId;
            let isAnimating = false;
            
            // Check if device can handle animations
            function canAnimate() {
                return window.innerWidth > 768 && 
                       !window.matchMedia('(prefers-reduced-motion: reduce)').matches &&
                       navigator.hardwareConcurrency > 2;
            }
            
            // Create trianglify pattern
            function createPattern(element, config) {
                if (!element || !trianglify) return;
                
                const rect = element.getBoundingClientRect();
                if (rect.width === 0 || rect.height === 0) return;
                
                const pattern = trianglify({
                    width: rect.width,
                    height: rect.height,
                    ...config
                });
                
                // Set background
                element.style.backgroundImage = `url(${pattern.toSVG().dataURI})`;
                element.style.backgroundSize = 'cover';
                element.style.backgroundPosition = 'center';
                element.style.backgroundRepeat = 'no-repeat';
            }
            
            // Animate pattern (subtle movement)
            function animatePattern(element, config) {
                if (!canAnimate() || !element) return;
                
                let offset = 0;
                const speed = 0.5; // Very slow movement
                
                function animate() {
                    if (!isAnimating) return;
                    
                    offset += speed;
                    const rect = element.getBoundingClientRect();
                    
                    const pattern = trianglify({
                        width: rect.width,
                        height: rect.height,
                        ...config,
                        seed: Math.floor(offset / 100) // Change pattern slowly
                    });
                    
                    element.style.backgroundImage = `url(${pattern.toSVG().dataURI})`;
                    
                    animationId = requestAnimationFrame(animate);
                }
                
                isAnimating = true;
                animate();
            }
            
            // Initialize patterns for elements
            function initPatterns() {
                // Board task list
                const boardTaskList = document.querySelector('.board-task-list');
                if (boardTaskList) {
                    createPattern(boardTaskList, configs.boardTaskList);
                    if (canAnimate()) {
                        animatePattern(boardTaskList, configs.boardTaskList);
                    }
                }
                
                // Task summary
                const taskSummary = document.querySelector('#task-summary');
                if (taskSummary) {
                    createPattern(taskSummary, configs.taskSummary);
                }
                
                // Page headers
                const pageHeaders = document.querySelectorAll('.page-header, .sidebar-content > h2, .sidebar-content > h3, .accordion-title');
                pageHeaders.forEach(header => {
                    if (header && !header.style.backgroundImage) {
                        createPattern(header, configs.pageHeader);
                    }
                });
            }
            
            // Handle window resize
            function handleResize() {
                if (animationId) {
                    cancelAnimationFrame(animationId);
                    isAnimating = false;
                }
                
                // Debounce resize
                clearTimeout(window.trianglifyResizeTimeout);
                window.trianglifyResizeTimeout = setTimeout(initPatterns, 300);
            }
            
            // Handle visibility change (pause when tab is not visible)
            function handleVisibilityChange() {
                if (document.hidden) {
                    isAnimating = false;
                    if (animationId) {
                        cancelAnimationFrame(animationId);
                    }
                } else if (canAnimate()) {
                    initPatterns();
                }
            }
            
            // Initialize when DOM is ready
            function init() {
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initPatterns);
                } else {
                    initPatterns();
                }
                
                // Event listeners
                window.addEventListener('resize', handleResize);
                document.addEventListener('visibilitychange', handleVisibilityChange);
                
                // Cleanup on page unload
                window.addEventListener('beforeunload', function() {
                    isAnimating = false;
                    if (animationId) {
                        cancelAnimationFrame(animationId);
                    }
                });
            }
            
            // Start initialization
            init();
            
        })();
        </script>
    <?php endif ?>
    </body>
</html>

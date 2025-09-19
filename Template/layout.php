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
        
        <!-- Animated Gradient Backgrounds -->
        <script>
        /**
         * Simple CSS Gradient Backgrounds
         * Creates beautiful gradient backgrounds for task boards
         */
        (function() {
            'use strict';
            
            // Simple gradient configurations
            const gradients = {
                boardTaskList: 'linear-gradient(135deg, rgba(138, 43, 226, 0.08) 0%, rgba(255, 20, 147, 0.08) 50%, rgba(0, 191, 255, 0.08) 100%)',
                taskSummary: 'linear-gradient(135deg, rgba(138, 43, 226, 0.06) 0%, rgba(255, 20, 147, 0.06) 50%, rgba(0, 191, 255, 0.06) 100%)',
                pageHeader: 'linear-gradient(135deg, rgba(138, 43, 226, 0.04) 0%, rgba(255, 20, 147, 0.04) 50%, rgba(0, 191, 255, 0.04) 100%)'
            };
            
            // Apply gradient backgrounds
            function applyGradients() {
                // Board task list
                const boardTaskLists = document.querySelectorAll('.board-task-list');
                boardTaskLists.forEach(boardTaskList => {
                    if (boardTaskList) {
                        boardTaskList.style.backgroundImage = gradients.boardTaskList;
                        boardTaskList.style.backgroundSize = '200% 200%';
                        boardTaskList.style.backgroundPosition = '0% 0%';
                        boardTaskList.style.animation = 'gradientShift 90s ease infinite';
                    }
                });
                
                // Task summary
                const taskSummaries = document.querySelectorAll('#task-summary');
                taskSummaries.forEach(taskSummary => {
                    if (taskSummary) {
                        taskSummary.style.backgroundImage = gradients.taskSummary;
                        taskSummary.style.backgroundSize = '200% 200%';
                        taskSummary.style.backgroundPosition = '0% 0%';
                        taskSummary.style.animation = 'gradientShift 120s ease infinite';
                    }
                });
                
                // Page headers
                const pageHeaders = document.querySelectorAll('.page-header, .sidebar-content > h2, .sidebar-content > h3, .accordion-title');
                pageHeaders.forEach(header => {
                    if (header) {
                        header.style.backgroundImage = gradients.pageHeader;
                        header.style.backgroundSize = '200% 200%';
                        header.style.backgroundPosition = '0% 0%';
                        header.style.animation = 'gradientShift 150s ease infinite';
                    }
                });
            }
            
            // Add CSS animation keyframes
            function addAnimationCSS() {
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes gradientShift {
                        0% { background-position: 0% 0%; }
                        100% { background-position: 100% 100%; }
                    }
                    
                    .board-task-list, #task-summary, .page-header, .sidebar-content > h2, .sidebar-content > h3, .accordion-title {
                        will-change: background-position;
                    }
                    
                    @media (prefers-reduced-motion: reduce) {
                        .board-task-list, #task-summary, .page-header, .sidebar-content > h2, .sidebar-content > h3, .accordion-title {
                            animation: none !important;
                        }
                    }
                    
                    @media (max-width: 768px) {
                        .board-task-list, #task-summary, .page-header, .sidebar-content > h2, .sidebar-content > h3, .accordion-title {
                            animation: none !important;
                        }
                    }
                `;
                document.head.appendChild(style);
            }
            
            // Initialize when DOM is ready
            function init() {
                addAnimationCSS();
                
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', applyGradients);
                } else {
                    applyGradients();
                }
            }
            
            // Start initialization
            init();
            
        })();
        </script>
    <?php endif ?>
    </body>
</html>

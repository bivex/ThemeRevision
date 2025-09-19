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

<?php
// loading_screen.php - Separate loading screen component
?>
<style>
    /* Loading Screen Styles */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        transition: all 0.8s ease;
    }

    .loading-overlay.fade-out {
        opacity: 0;
        visibility: hidden;
    }

    .loading-container {
        text-align: center;
        position: relative;
        animation: slideIn 1s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .loading-logo {
        width: 120px;
        height: 120px;
        margin: 0 auto 30px;
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
        animation: logoFloat 3s ease-in-out infinite;
    }

    @keyframes logoFloat {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .loading-logo::before {
        content: '';
        position: absolute;
        width: 140px;
        height: 140px;
        border: 3px solid transparent;
        border-top: 3px solid rgba(102, 126, 234, 0.4);
        border-right: 3px solid rgba(102, 126, 234, 0.4);
        border-radius: 50%;
        animation: logoRotate 2s linear infinite;
    }

    @keyframes logoRotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .loading-logo i {
        font-size: 3.5rem;
        color: white;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        animation: iconPulse 2s ease-in-out infinite;
    }

    @keyframes iconPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .loading-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
        animation: titleGlow 2s ease-in-out infinite alternate;
    }

    @keyframes titleGlow {
        from {
            filter: brightness(1);
        }

        to {
            filter: brightness(1.2);
        }
    }

    .loading-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 40px;
        opacity: 0.8;
        animation: subtitleFade 3s ease-in-out infinite;
    }

    @keyframes subtitleFade {

        0%,
        100% {
            opacity: 0.8;
        }

        50% {
            opacity: 0.5;
        }
    }

    .loading-progress {
        width: 300px;
        height: 6px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        margin: 0 auto 25px;
        overflow: hidden;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .loading-progress-bar {
        height: 100%;
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        border-radius: 10px;
        width: 0%;
        animation: progressFill 5s ease-out forwards;
        position: relative;
    }

    @keyframes progressFill {
        0% {
            width: 0%;
        }

        20% {
            width: 15%;
        }

        40% {
            width: 35%;
        }

        60% {
            width: 60%;
        }

        80% {
            width: 85%;
        }

        100% {
            width: 100%;
        }
    }

    .loading-progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: progressShine 2s ease-in-out infinite;
    }

    @keyframes progressShine {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .loading-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .loading-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        animation: dotBounce 1.4s ease-in-out infinite both;
    }

    .loading-dot:nth-child(1) {
        animation-delay: -0.32s;
    }

    .loading-dot:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes dotBounce {

        0%,
        80%,
        100% {
            transform: scale(0.8);
            opacity: 0.5;
        }

        40% {
            transform: scale(1.2);
            opacity: 1;
        }
    }

    .loading-status {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.9rem;
        color: #6c757d;
        opacity: 0.8;
        transition: all 0.3s ease;
        min-height: 20px;
    }

    .loading-stats {
        position: absolute;
        bottom: 50px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 30px;
        opacity: 0.7;
    }

    .loading-stat {
        text-align: center;
        animation: statFloat 2s ease-in-out infinite;
    }

    .loading-stat:nth-child(2) {
        animation-delay: 0.5s;
    }

    .loading-stat:nth-child(3) {
        animation-delay: 1s;
    }

    @keyframes statFloat {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-3px);
        }
    }

    .loading-stat i {
        font-size: 1.5rem;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: block;
        margin-bottom: 5px;
    }

    .loading-stat span {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
    }

    /* Dashboard content initially hidden */
    .dashboard-content {
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .dashboard-content.loaded {
        opacity: 1;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .loading-logo {
            width: 100px;
            height: 100px;
        }

        .loading-logo i {
            font-size: 2.5rem;
        }

        .loading-title {
            font-size: 2rem;
        }

        .loading-subtitle {
            font-size: 1rem;
        }

        .loading-progress {
            width: 250px;
        }

        .loading-stats {
            flex-direction: column;
            gap: 15px;
        }

        .loading-status {
            bottom: 120px;
            font-size: 0.8rem;
        }
    }
</style>

<!-- Loading Screen HTML -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-container">
        <div class="loading-logo">
            <i class="fas fa-chart-pie"></i>
        </div>

        <h1 class="loading-title">Dashboard</h1>
        <p class="loading-subtitle">Memuat data penjualan, pembelian dan analisis...</p>

        <div class="loading-progress">
            <div class="loading-progress-bar"></div>
        </div>

        <div class="loading-dots">
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
        </div>

        <div class="loading-status" id="loadingStatus">
            Menginisialisasi...
        </div>
    </div>

    <div class="loading-stats">
        <div class="loading-stat">
            <i class="fas fa-store"></i>
            <span>Swalayan</span>
        </div>
        <div class="loading-stat">
            <i class="fas fa-warehouse"></i>
            <span>Grosir</span>
        </div>
        <div class="loading-stat">
            <i class="fas fa-chart-line"></i>
            <span>Analisis</span>
        </div>
    </div>
</div>

<script>
    // Loading screen management functions
    function updateLoadingStatus(message) {
        const statusElement = document.getElementById('loadingStatus');
        if (statusElement) {
            statusElement.innerHTML = message;
        }
    }

    function hideLoadingScreen() {
        const loadingOverlay = document.getElementById('loadingOverlay');
        const dashboardContent = document.getElementById('dashboardContent');

        if (loadingOverlay && dashboardContent) {
            loadingOverlay.classList.add('fade-out');
            dashboardContent.classList.add('loaded');

            setTimeout(function() {
                loadingOverlay.style.display = 'none';
            }, 800);
        }
    }

    // Auto-hide when page is fully loaded
    window.addEventListener('load', function() {
        setTimeout(hideLoadingScreen, 500);
    });

    // Fallback: Hide loading screen after maximum time (10 seconds)
    setTimeout(function() {
        hideLoadingScreen();
    }, 10000);
</script>
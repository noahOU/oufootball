<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg" style="background-color: #841617;">
    <div class="container">
        <a class="navbar-brand text-white" href="index.html">OU Football Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'index.html' ? 'active text-warning' : 'text-white'; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'roster.php' ? 'active text-warning' : 'text-white'; ?>" href="roster.php">Roster</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'schedule.php' ? 'active text-warning' : 'text-white'; ?>" href="schedule.php">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'fans.php' ? 'active text-warning' : 'text-white'; ?>" href="fans.php">Fans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'transfer-portal.php' ? 'active text-warning' : 'text-white'; ?>" href="transfer-portal.php">Transfer Portal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


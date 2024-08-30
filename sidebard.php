<?php
function isActive($data)
{
	/*
    $array = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_search("adminPages", $array);
    $name = $array[$key + 1];
    return $name === $data ? 'active' : '';
    */
    
    $strpos = strpos($_SERVER['REQUEST_URI'],$data);
    
    return gettype($strpos) === "integer" ? 'active' : '';
}
?>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-store-alt bx-md'></i>
        <!-- <i class='bx bxs-smile'></i> -->
        <span class="text">AdminHub</span>
    </a>
    <ul class="side-menu top">
        <li class="<?php echo isActive('dashboard.php'); ?>">
            <a href="dashboard.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="<?php echo isActive('mystore.php'); ?>">
            <a href="mystore.php">
                <i class='bx bxs-shopping-bag-alt'></i>
                <span class="text">My Store</span>
            </a>
        </li>
        <li class="<?php echo isActive('Analytics.php'); ?>">
            <a href="#">
                <i class='bx bxs-doughnut-chart'></i>
                <span class="text">Analytics</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-message-dots'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-group'></i>
                <span class="text">Team</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu top">
        <li>
            <a href="#">
                <i class='bx bxs-cog'></i>
                <span class="text">Settings</span>
            </a>
        </li>
        <li>
            <a href="#" class="logout">
                <i class='bx bx-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->
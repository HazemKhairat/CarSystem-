<?php

include_once 'C:\xampp\htdocs\cars\admin\vendors\functions.php';

?>



<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="<?= url('/') ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('ListAdmins.php') ?>">
        <i class="bi bi-person"></i>
        <span>Admins</span>
      </a>
    </li>
    <!-- End Admin Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('ListRules.php') ?>">
        <i class="bi bi-person"></i>
        <span>Rules</span>
      </a>
    </li>
    <!-- End Rules Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('ListPositions.php') ?>">
        <i class="bi bi-person"></i>
        <span>Positions</span>
      </a>
    </li><!-- End Position Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('ListBrand.php') ?>">
        <i class="bi bi-person"></i>
        <span>Brands</span>
      </a>
    </li><!-- End Brand Page Nav -->


    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('profile.php') ?>">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->




  

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('register.php') ?>">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
      </a>
    </li>End Register Page Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('login.php') ?>">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
      </a>
    </li>End Login Page Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('error-404.php') ?>">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li>End Error 404 Page Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="<?= url('blank.php') ?>">
        <i class="bi bi-file-earmark"></i>
        <span>Blank</span>
      </a>
    </li>End Blank Page Nav -->

  </ul>

</aside><!-- End Sidebar-->
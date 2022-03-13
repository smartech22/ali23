<?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "gr";
  }
?>
<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         @if($lang == 'en')
        <i class="flag-icon flag-icon-us" title="us"></i> <span class="ms-1 me-1 d-none d-md-inline-block">English</span>
        @else
          <i class="flag-icon flag-icon-om mt-1" title="om"></i> <span class="ms-1 me-1 d-none d-md-inline-block">Germany</span>
        @endif
        </a>
        @if ($lang == 'en')
        <div class="dropdown-menu"  @if($lang == 'en') style="left: -110px;"@endif aria-labelledby="languageDropdown">
          <a href="/change-language/en" class="dropdown-item py-2"><i class="flag-icon flag-icon-om" title="ad" id="om"></i> <span class="ms-1"> English </span></a>
          <a href="/change-language/gr" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> Germany </span></a>
        </div>
        @else
        <div class="dropdown-menu"  @if($lang == 'en') style="left: -110px;"@endif aria-labelledby="languageDropdown">
          <a href="/change-language/en" class="dropdown-item py-2"><i class="flag-icon flag-icon-om" title="ad" id="om"></i> <span class="ms-1"> English </span></a>
          <a href="/change-language/gr" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> Germany </span></a>
        </div>
        @endif
      </li>


   

    </ul>
  </div>
</nav>
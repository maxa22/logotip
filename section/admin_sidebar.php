<div class="sidebar-overlay"></div>
<aside class="sidebar">
    <ul>
        <li class="sidebar__border">
            <a href="<?php base(); ?>index" class="sidebar__menu-link d-flex ai-c relative  ">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-home"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Index</span>
            </a>
        </li>
        <li class="sidebar__dropdown-toggle">
            <div class="sidebar__menu-link d-flex ai-c relative  sidebar__border">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Dashboard <i class="sidebar__arrow  fas fa-angle-left"></i></span>
            </div>
            <ul class="sidebar__menu-dropdown list-style-none">
                <li class="sidebar__border">
                    <a href="<?php base(); ?>calculators" class="sidebar__menu-link d-flex ai-c pl-s">
                        <span class=" ">
                            <span class="sidebar__menu-icon">
                            <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Calculators</span>
                    </a>
                </li>
                <li class="sidebar__border">
                    <a href="<?php base(); ?>create_calculator" class="sidebar__menu-link d-flex ai-c pl-s">
                    <span class="d-iblock">
                        <span class="sidebar__menu-icon">
                        <i class="fas fa-plus"></i>
                        </span>
                    </span>
                    <span class="sidebar__menu-text">Create calculator</span>
                    </a>
                </li>
                <li class="sidebar__border">
                    <a href="<?php base(); ?>archive" class="sidebar__menu-link d-flex ai-c pl-s">
                    <span class="d-iblock">
                        <span class="sidebar__menu-icon">
                        <i class="fas fa-archive"></i>
                        </span>
                    </span>
                    <span class="sidebar__menu-text">Archived calculators</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar__border">
            <a href="<?php base(); ?>calculator_users" class="sidebar__menu-link d-flex ai-c relative  ">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-users"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Calculator form users</span>
            </a>
        </li>
        <li class="sidebar__border">
            <a href="<?php base(); ?>examples" class="sidebar__menu-link d-flex ai-c relative  ">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-folder"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Examples</span>
            </a>
        </li>
        <li class="sidebar__border">
            <a href="<?php base(); ?>include/logout.inc.php" class="sidebar__menu-link d-flex ai-c relative  ">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Logout</span>
            </a>
        </li>
    </ul>
</aside>

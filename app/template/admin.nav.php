<header>
    <div>
        <div onclick="toggleNav()"><i class="fa fa-bars"></i></div>
    </div>
    <span><?= $_SESSION['CnAdmin'] ?></span>
    <nav>
        <ul>
            <li><a href="dashboard.php">النشاطات</a></li>
            <li><a href="/admin/control">لوحة التحكم</a></li>
            <li><a href="/" target="_blank">الموقع</a></li>
            <li><a href="/admin/logout">تسجيل الخروج</a></li>
        </ul>
    </nav>
</header>
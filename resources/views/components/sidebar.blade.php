<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item">
                <a href="/home" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link"><i class="fas fa-user"></i><span>Users</span></a>
            </li>

            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link"><i class="fas fa-tags"></i><span>Category</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link"><i class="fas fa-paper-plane"></i><span>Products</span></a>
            </li>
        </ul>
    </aside>
</div>

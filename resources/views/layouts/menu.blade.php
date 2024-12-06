<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i> <!-- Dashboard icon -->
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('allowances.index') }}" class="nav-link {{ Request::is('allowances*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-hand-holding-usd"></i> <!-- Allowances icon -->
        <p>Allowances</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('attendances.index') }}" class="nav-link {{ Request::is('attendances*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Attendances</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('banks.index') }}" class="nav-link {{ Request::is('banks*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-university"></i> <!-- Banks icon -->
        <p>Banks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('deductions.index') }}" class="nav-link {{ Request::is('deductions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-minus-circle"></i> <!-- Deductions icon -->
        <p>Deductions</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('documentations.index') }}" class="nav-link {{ Request::is('documentations*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i> <!-- Documentations icon -->
        <p>Documentations</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('employees.index') }}" class="nav-link {{ Request::is('employees*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-tie"></i>
        <p>Employees</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('leaves.index') }}" class="nav-link {{ Request::is('leaves*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-leaf"></i> <!-- Leaves icon -->
        <p>Leaves</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('offs.index') }}" class="nav-link {{ Request::is('offs*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-bed"></i> <!-- Offs icon -->
        <p>Offs</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('payrolls.index') }}" class="nav-link {{ Request::is('payrolls*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-credit-card"></i> <!-- Payrolls icon -->
        <p>Payrolls</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('promotions.index') }}" class="nav-link {{ Request::is('promotions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-arrow-up"></i> <!-- Promotions icon -->
        <p>Promotions</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('records.index') }}" class="nav-link {{ Request::is('records*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard-list"></i> <!-- Records icon -->
        <p>Records</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salaries.index') }}" class="nav-link {{ Request::is('salaries*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-money-bill-wave"></i> <!-- Salaries icon -->
        <p>Salaries</p>
    </a>
</li>






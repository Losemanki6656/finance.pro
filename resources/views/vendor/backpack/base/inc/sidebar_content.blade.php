<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-title"> Балансы и Обороты</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('consolidated') }}'><i class='nav-icon la la-balance-scale'></i> Балансы</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('consolidateoboroti') }}'><i class='nav-icon la la-coins'></i> Обороты</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('info') }}'><i class='nav-icon la la-info'></i> Инструкция</a></li>



{{-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('vgo-import') }}"><i class="la la-file-excel nav-icon"></i> Import </a></li> --}}
{{-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tasks') }}"><i class="la la-file-excel nav-icon"></i> Tasks </a></li> --}}


<li class="nav-title"> Админ</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-chart-pie nav-icon"></i> Статистика</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('consolyear') }}'><i class='nav-icon la la-calendar-check'></i> Год ВГО</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('consolidateoboroti') }}'><i class='nav-icon la la-archive'></i> Архив</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('organization') }}'><i class='nav-icon la la-sitemap'></i> Организацие</a></li>

<li class="nav-title">Супер - Админ</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('railway') }}'><i class='nav-icon la la-sitemap'></i> Предприятие</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('management') }}'><i class='nav-icon la la-sitemap'></i> АЖ</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
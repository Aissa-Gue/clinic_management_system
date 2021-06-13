<div class="my_sidebar position-fixed">
    <div class="list-group">
        <a href="/" class="list-group-item list-group-item-action py-3 {{Request::is('/') ? 'active' : ''}}" aria-current="true">
            <i class="fas fa-clinic-medical fs-5"></i> Dashboard
        </a>

        <a href="/patients" class="list-group-item list-group-item-action py-3 {{Request::is('patients') || Request::is('patients/*') ? 'active' : ''}}">
            <i class="fas fa-hospital-user fs-5"></i> Patients
        </a>

        @if(Auth::id() === 1)
            <a href="/doctors" class="list-group-item list-group-item-action py-3 {{Request::is('doctors') || Request::is('doctors/*') ? 'active' : ''}}">
                <i class="fas fa-user-md fs-5"></i> Doctors
            </a>
        @endif

        <a href="/medications" class="list-group-item list-group-item-action py-3 {{Request::is('medications') || Request::is('medications/*') ? 'active' : ''}}">
            <i class="fas fa-capsules fs-5"></i> Medications
        </a>

        <a href="/planning" class="list-group-item list-group-item-action py-3 {{Request::is('planning') || Request::is('planning/*') ? 'active' : ''}}">
            <i class="fas fa-calendar-alt fs-5"></i> Planning
        </a>

        <a href="/appointments/3" class="list-group-item list-group-item-action py-3 {{Request::is('appointments') || Request::is('appointments/*') ? 'active' : ''}}">
            <i class="fas fa-calendar-check fs-5"></i> Appointments
        </a>

        @if(Auth::id() > 2)
            <a href="/consultations/3" class="list-group-item list-group-item-action py-3 {{Request::is('consultations') || Request::is('consultations/*') ? 'active' : ''}}">
                <i class="fas fa-stethoscope fs-5"></i> Consultations
            </a>
        @endif

        <!-- <a href="/secretary" class="list-group-item list-group-item-action my_sidebar_py {{Request::is('secretary') || Request::is('secretary/*') ? 'active' : ''}}">
            <i class="fas fa-user-nurse fs-5"></i> Secretaire
        </a> -->

        <a href="/account/updateAccount" class="list-group-item list-group-item-action py-3 {{Request::is('account') || Request::is('account/*') ? 'active' : ''}}">
            <i class="fas fa-user fs-5"></i> Account
        </a>

        @if(Auth::id() === 1)
            <a href="/settings" class="list-group-item list-group-item-action py-3 {{Request::is('settings') || Request::is('settings/*') ? 'active' : ''}}">
                <i class="fas fa-cog fs-5"></i> Setting
            </a>
        @endif

        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action py-3">
            <i class="fas fa-power-off fs-5"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

<div class="my_sidebar position-fixed">
    <div class="list-group">
        <a href="/" class="list-group-item list-group-item-action py-3 {{Request::is('/') ? 'active' : ''}}" aria-current="true">
            <i class="fas fa-clinic-medical fs-5"></i> Dashboard
        </a>
        <a href="/patients" class="list-group-item list-group-item-action py-3 {{Request::is('patients') || Request::is('patients/*') ? 'active' : ''}}">
            <i class="fas fa-hospital-user fs-5"></i> Patients
        </a>
        <a href="/doctors" class="list-group-item list-group-item-action py-3 {{Request::is('doctors') || Request::is('doctors/*') ? 'active' : ''}}">
            <i class="fas fa-user-md fs-5"></i> Doctors
        </a>
        <a href="/specialisations" class="list-group-item list-group-item-action py-3 {{Request::is('specialisations') || Request::is('specialisations/*') ? 'active' : ''}}">
            <i class="fas fa-tags fs-5"></i> Specialisations
        </a>
        <a href="/medications" class="list-group-item list-group-item-action py-3 {{Request::is('medications') || Request::is('medications/*') ? 'active' : ''}}">
            <i class="fas fa-capsules fs-5"></i> Medications
        </a>
        <a href="/planning" class="list-group-item list-group-item-action py-3 {{Request::is('planning') || Request::is('planning/*') ? 'active' : ''}}">
            <i class="fas fa-calendar-alt fs-5"></i> Planning
        </a>
        <a href="/appointments/1" class="list-group-item list-group-item-action py-3 {{Request::is('appointments') || Request::is('appointments/*') ? 'active' : ''}}">
            <i class="fas fa-calendar-check fs-5"></i> Appointments
        </a>
        <a href="/consultations" class="list-group-item list-group-item-action py-3 {{Request::is('consultations') || Request::is('consultations/*') ? 'active' : ''}}">
            <i class="fas fa-stethoscope fs-5"></i> Consultations
        </a>
        <a href="/secretary" class="list-group-item list-group-item-action py-3 {{Request::is('secretary') || Request::is('secretary/*') ? 'active' : ''}}">
            <i class="fas fa-user-nurse fs-5"></i> Secretary
        </a>
        <a href="/setting" class="list-group-item list-group-item-action py-3 {{Request::is('setting') || Request::is('setting/*') ? 'active' : ''}}">
            <i class="fas fa-cog fs-5"></i> Setting
        </a>
    </div>
</div>

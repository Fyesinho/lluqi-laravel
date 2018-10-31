<li>
    <a href="#" style="margin-bottom: -10px"><i class="fa fa-edit"></i><span>Parámetros generales</span></a>
    <ul class="menu-ul">
        <li class="{{ Request::is('genders*') ? 'active' : '' }}">
            <a href="{!! route('genders.index') !!}"><i class="fa fa-edit"></i> <span>Géneros</span></a>
        </li>
        <li class="{{ Request::is('countries*') ? 'active' : '' }}">
            <a href="{!! route('countries.index') !!}"><i class="fa fa-edit"></i> <span>Países</span></a>
        </li>
        <li class="{{ Request::is('cities*') ? 'active' : '' }}">
            <a href="{!! route('cities.index') !!}"><i class="fa fa-edit"></i> <span>Ciudades</span></a>
        </li>
        <li class="{{ Request::is('languages*') ? 'active' : '' }}">
            <a href="{!! route('languages.index') !!}"><i class="fa fa-edit"></i> <span>Idiomas</span></a>
        </li>
        <li class="{{ Request::is('months*') ? 'active' : '' }}">
            <a href="{!! route('months.index') !!}"><i class="fa fa-edit"></i> <span>Months</span></a>
        </li>

    </ul>
</li>

<li class="{{ Request::is('travelers*') ? 'active' : '' }}">
    <a href="{!! route('travelers.index') !!}"><i class="fa fa-edit"></i><span>Viajeros</span></a>
</li>

<li class="{{ Request::is('hostels*') ? 'active' : '' }}">
    <a href="{!! route('hostels.index') !!}"><i class="fa fa-edit"></i><span>Hostales</span></a>
</li>

<li class="{{ Request::is('needActivities*') ? 'active' : '' }}">
    <a href="{!! route('needActivities.index') !!}"><i class="fa fa-edit"></i><span>Actividades</span></a>
</li>

<li class="{{ Request::is('offers*') ? 'active' : '' }}">
    <a href="{!! route('offers.index') !!}"><i class="fa fa-edit"></i><span>Ofrecimientos</span></a>
</li>
<li class="{{ Request::is('hostelActivities*') ? 'active' : '' }}">
    <a href="{!! route('hostelActivities.index') !!}"><i class="fa fa-edit"></i><span>Hostel Activities</span></a>
</li>

<li class="{{ Request::is('hostelOffers*') ? 'active' : '' }}">
    <a href="{!! route('hostelOffers.index') !!}"><i class="fa fa-edit"></i><span>Hostel Offers</span></a>
</li>

<li class="{{ Request::is('images*') ? 'active' : '' }}">
    <a href="{!! route('images.index') !!}"><i class="fa fa-edit"></i><span>Images</span></a>
</li>



<li class="{{ Request::is('hostelMonths*') ? 'active' : '' }}">
    <a href="{!! route('hostelMonths.index') !!}"><i class="fa fa-edit"></i><span>Hostel Months</span></a>
</li>

<style>
    .menu-ul li{
        margin-top:10px;
    }
</style>
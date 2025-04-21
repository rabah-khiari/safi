
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('safiFire.jpg') }}" alt="Logo" width="50" height="50">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          
          <li class="nav-item">
            <a class="nav-link" href="/clients">Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/extincteur">Extincteur</a>
          </li>
          <li class="nav-item" hidden>
            <a class="nav-link" href="/purchases">Affectation Extincteur</a>
          </li>

          @php
            use Illuminate\Support\Facades\Cache;

          if (!isset($expiringInterventions)){
            $notificationDays = Cache::get('alert_days', 10); // Default to 10 days
            
            $today = Carbon\Carbon::today();
            // Get all interventions and filter with collection (easier logic)
            $expiringInterventions = App\Models\Intervention::with('client')->get()->filter(function ($intervention) use ($today, $notificationDays) {
                $expiryDate = Carbon\Carbon::parse($intervention->intervention_date)->addMonths(6);
                $alertStartDate = $expiryDate->copy()->subDays($notificationDays);
                return $today->between($alertStartDate, $expiryDate);
            });
          }
          if (!isset($expiringExtincteur)){
            $notificationDays = Cache::get('alert_days', 10); // Default to 10 days
            
            $today = Carbon\Carbon::today();
            // Get all interventions and filter with collection (easier logic)
            $expiringExtincteur = App\Models\Purchase::with('client')->get()->filter(function ($intervention) use ($today, $notificationDays) {
                $expiryDate = Carbon\Carbon::parse($intervention->intervention_date)->addMonths(6);
                $alertStartDate = $expiryDate->copy()->subDays($notificationDays);
                return $today->between($alertStartDate, $expiryDate);
            });
          }
          $total_Expiring= $expiringExtincteur->count()+$expiringInterventions->count();
          @endphp

          <li class="nav-item"> 
            @if ($total_Expiring > 0)
              <a href="/interventions" class="notification">
                <span>interventions </span>
                <span class="badge"> {{$total_Expiring}} </span>
              </a>
            @else

            <a class="nav-link" href="/interventions">interventions</a>
            @endif
          </li>
          
          <li class="nav-item">
            @if (auth()->check()) 
                <a class="nav-link" href="/logout">déconnexion</a>
            @else
                <a class="nav-link" href="/login">se connecter</a>
            @endif
            
          </li>
          
        </ul>
      </div>
    </div>
  </nav>

  <style>
    
    .notification {
      background-color: #ffffffc4;
      color: rgb(0, 0, 0);
      text-decoration: none;
      padding: 10px 10px;
      position: relative;
      display: inline-block;
      border-radius: 2px;
    }
    
    /* .notification:hover {
      background: rgb(255, 255, 255);
    } */
    
    .notification .badge {
      position: absolute;
      top: -7px;
      right: -8px;
      padding: 5px 10px;
      border-radius: 50%;
      background-color: rgba(249, 81, 81, 0.805);
      color: white;
    }
    </style>
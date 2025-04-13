
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          @if (auth()->check()) 
                <li class="nav-item">
                  <a class="nav-link" href="/dashboard">dashboard</a>
                </li>
          @endif
          
          <li class="nav-item">
            <a class="nav-link" href="/clients">client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/extincteur">extincteur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/purchases">purchases</a>
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
              
          @endphp

          <li class="nav-item"> 
            @if ($expiringInterventions->count() > 0)
              <a href="/interventions" class="notification">
                <span>interventions </span>
                <span class="badge"> {{$expiringInterventions->count()}} </span>
              </a>
            @else

            <a class="nav-link" href="/interventions">interventions</a>
            @endif
          </li>
          
          <li class="nav-item">
            @if (auth()->check()) 
                <a class="nav-link" href="/logout">logout</a>
            @else
                <a class="nav-link" href="/login">login</a>
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
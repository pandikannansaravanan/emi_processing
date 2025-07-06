@if(Route::currentRouteName() != 'login')
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="{{ route('loans') }}" class="nav-link px-2  {{Route::currentRouteName() == 'loans'?'link-primary':'link-dark'}}">Loan Details</a></li>
      <li><a href="{{ route('emi') }}" class="nav-link px-2 {{Route::currentRouteName() == 'emi'?'link-primary':'link-dark'}}">EMI Details</a></li>
    </ul>

    <div class="col-md-3 text-end me-3">
        <button type="button" class="btn btn-outline-primary me-2" onclick="window.location.href='{{ route('logout') }}'">Logout</button>
    </div>
</header>
@endif
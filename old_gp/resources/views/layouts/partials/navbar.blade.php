@if (!Auth::guest())
<header>
  <h3 style="text-align:center;">Grannypinion</h3>
  <nav class="navbar navbar-default" role="navigation" style="background-color:white;">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/{{Auth::user()->id}}"> <h3> Mein Profil </h3> </a></li>
        <li><a href="/ranking"> <h3> Ranking </h3> </a></li>
        <li><a href="/{{Auth::user()->id}}/myconversations"> <h3> Nachrichten </h3> </a></li>
        <li> <a href="{{ url('/logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <h3> Logout </h3>
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST">
          {{ csrf_field() }}
        </form>
      </li>
    </ul>
    <div class="col-sm-3 col-md-3 pull-right">
      <form class="navbar-form" role="search" action="/searchuser" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Vorname" name="firstname">
          <input type="text" class="form-control" placeholder="Nachname" name="lastname">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>
</header>

@endif
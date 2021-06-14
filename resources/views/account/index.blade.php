Добро пожаловать :  {{ Auth::user()->name }}
@if(Auth::user()->avatar)
    <br>
    Ваш аватар: <img src="{{ Auth::user()->avatar }}" style="width: 200px">
@endif
<br>
<a href='{{ route('news.index') }}'>В админку</a><br>
<a href='{{ route('account.logout') }}'>Выход</a>
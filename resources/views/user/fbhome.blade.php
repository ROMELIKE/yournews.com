<body>
<div class="container">
    <div class="content">
        <div class="title">
            laravel5
        </div>
        You are login
        <div>
            <h4>your name:{{Auth::user()->username}}</h4>
            <h4>yourmail:{{Auth::user()->email}}</h4>
            <img src="{{Auth::user()->avatar}}" height="200" width="200" alt="">
        </div>
    </div>
</div>
</body>
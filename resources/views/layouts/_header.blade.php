<header class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="col-md-offset-1 col-md-10">
      <a href="{{ route('home') }}" id="logo">
          <img src="../img/sosad-logo.png" alt="废文网">
          <!-- 废文网 -->
      </a>
      <input type="hidden" id="baseurl" name="baseurl" value= "{{route('home')}}"/>
      <nav>
          <div class="navbar-header">
              <!-- <div class="search-container">
                  <form method="GET" action="{{ route('search') }}">
                      <input type="textarea" placeholder="搜索……" name="search">
                      <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
              </div> -->
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                  <span class="sr-only">切换导航</span>
                  <i class="fa fa-bars"></i>
              </button>
          </div>
          <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-right text-right">

               @if (Auth::check()&&(Auth::user()->admin))
                   <li><a href="{{ route('admin.index') }}" class="admin-symbol">管理员</a></li>
               @endif

               @if (Auth::check()&&(Auth::user()->lastrewarded_at <= Carbon\Carbon::today()->toDateTimeString()))
                <li><a href="{{ route('qiandao') }}" style="color:#d66666">我要签到</a></li>
               @endif

               <li><a href="{{ route('books.index') }}">
                   <i class="fa fa-book"></i>
                   文库</a></li>
               <li class="dropdown">
                 <a href="" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-comment"></i>
                   论坛 <b class="caret"></b>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-right">
                   <li><a href="{{ route('threads.index') }}">全部讨论</a></li>
                   <li><a href="{{ route('longcomments.index') }}">长评列表</a></li>
                   <li><a href="{{ route('users.index') }}">全部用户</a></li>
                   <li><a href="{{ route('statuses.index') }}">全部动态</a></li>
                 </ul>
               </li>
              @if (Auth::check())
              <?php $user = Auth::user();
              $unreadmessages = $user->message_reminders
              +$user->post_reminders
              +$user->reply_reminders
              +$user->postcomment_reminders
              +$user->upvote_reminders;
              $unreadupdates = $user->collection_books_updated
              + $user->collection_threads_updated
              + $user->collection_statuses_updated;
              $linkedaccounts = $user->linkedaccounts();
              ?>
                <li><a href="{{ route('collections.books') }}">
                    <i class="fa fa-star"></i>
                    收藏<span class="badge">{{ $unreadupdates!=0? $unreadupdates :''}}</span></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="{{$unreadmessages>0? 'blink_me reminder-sign':''}}">
                    <span class="glyphicon glyphicon-bell {{$unreadmessages>0? :'hidden'}}"></span>
                    <i class="fa fa-user-circle"></i>
                    {{ $user->name }} <b class="caret"></b></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route('user.show', $user->id) }}">个人主页</a></li>
                    <li><a href="{{ route('users.edit') }}">编辑资料</a></li>
                    <li><a href="{{ route('book.create') }}">我要发文</a></li>
                    <li><a href="{{ route('messages.unread') }}">消息中心<span class="badge">{{ $unreadmessages!=0? $unreadmessages :''}}</span></a></li>
                   @foreach($linkedaccounts as $account)
                   <li><a href="{{ route('linkedaccounts.switch', $account->id) }}">切换：{{ $account->name }}</a></li>
                   @endforeach
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">退出</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>
              @else
                <li><a href="{{ route('register') }}">
                    <i class="fa fa-edit"></i>
                    注册</a></li>
                <li><a href="{{ route('login') }}">
                    <i class="fa fa-key"></i>
                    登录</a></li>
              @endif
            </ul>
          <div>
      </nav>
  </div>
  </div>

</header>

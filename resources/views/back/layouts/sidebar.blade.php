<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			<aside class="app-sidebar sidebar-scroll">
				<div class="main-sidebar-header active">
					<a class="desktop-logo logo-light active" href="index.html"><img src="{{ asset('back') }}/assets/img/brand/logo.png" class="main-logo" alt="logo"></a>
					<a class="desktop-logo logo-dark active" href="index.html"><img src="{{ asset('back') }}/assets/img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-light active" href="index.html"><img src="{{ asset('back') }}/assets/img/brand/favicon.png" class="logo-icon" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-dark active" href="index.html"><img src="{{ asset('back') }}/assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
				</div>
				<div class="main-sidemenu">
					<div class="app-sidebar__user clearfix">
						<div class="dropdown user-pro-body">
							{{-- <div class="">
								<img alt="user-img" class="avatar brround" src="{{ asset('back') }}/assets/img/faces/6.jpg"><span class="avatar-status profile-status bg-green"></span>
							</div> --}}
							<div class="user-info">
								<img alt="user-img" class="avatar brround" src="{{ asset('back') }}/images/users/{{ $userInfoFromAdminTable->image }}" style="display: inline;">
								<h4 class="font-weight-bold mt-3 mb-0" style="display: inline;position: relative;top: 2px;right: 4px;text-decoration: underline;color: #065fda;">{{ auth()->user()->name }}</h4>
								<br>
								{{-- <span class="mb-0 text-muted">
									@if (auth()->user()->user_status == 1)
										مدير
									@elseif (auth()->user()->user_status == 2)
										موظف
									@elseif (auth()->user()->user_status == 4)
										مدرس
									@endif
								</span> --}}
							</div>
						</div>
					</div>
					<ul class="side-menu">
						{{-- <li class="side-item side-item-category">إدارة علاقات العملاء</li> --}}
						
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#">
								<i class="fas fa-chart-pie sidebar_icon"></i>
								<span class="side-menu__label">إدارة علاقات العملاء</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ url('back/crm_columns_names') }}">قسم جديد لإدارة العملاء</a></li>
								<li><a class="slide-item" href="{{ url('back/crm_columns_values') }}">
									إسناد قيمة الي قسم في إدارة العملاء 
								</a></li>
							</ul>
						</li>

						{{-- <li class="side-item side-item-category">أولياء الأمور + الطلاب</li> --}}
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#">
								<i class="fas fa-user-tie sidebar_icon"></i>
								<span class="side-menu__label">أولياء الأمور</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ url('parents') }}">جميع أولياء الأمور</a></li>
								<li><a class="slide-item" href="{{ url('') }}">اضافة</a></li>
							</ul>
						</li>

						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#">
								<i class="fas fa-graduation-cap sidebar_icon"></i>
								<span class="side-menu__label">الطلاب</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ url('parents') }}">جميع الطلاب</a></li>
								<li><a class="slide-item" href="{{ url('groups') }}">المجموعات التعليمية</a></li>
							</ul>
						</li>

						{{-- <li class="side-item side-item-category">جدول الحصص + الأوقات</li> --}}
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#">
								<i class="fas fa-calendar-alt sidebar_icon"></i>
								<span class="side-menu__label">جدول الحصص / الأوقات</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ url('time_table') }}">جدول الحصص</a></li>
								<li><a class="slide-item" href="{{ url('times') }}">الأوقات</a></li>
							</ul>
						</li>
						
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#">
								<i class="fas fa-users-cog sidebar_icon"></i>
								<span class="side-menu__label">المستخدمين</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ url('users') }}">المستخدمين</a></li>
							</ul>
						</li>


					</ul>
				</div>
			</aside>
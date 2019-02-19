<div class="c-user js-user">
    <div class="exit"></div>
    <div class="user-inner">
      <div class="col-6 left">
        <div class="inner">
          <div class="content">
            <div class="welcome">Chào mừng tới</div>
            <div class="img"><img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/images/logo-user-1.png' }}" alt=""></div>
            <div class="text">Hãy cùng Học Plus mang tri thức tới hàng triệu học sinh Việt Nam đồng thời xây dựng và
              củng cố thương hiệu cá nhân cũng như tạo ra một nguồn thu nhập không giới hạn.</div>
          </div>
          <div class="form form-log-in">
            <form class="teacher" id="form-login form-login-teacher" method="post" action="{{ route('hocplus.frontend.auth.login-teacher') }}">
              <div class="form-group notification" id="login-notification-teacher" style="display: none;">
                  <div class="text">Thông tin đăng nhập không chính xác.
                      <br>Vui lòng kiểm tra lại.</div>
                  <span class="hiddenLabel"></span>
              </div>
              <div class="form-group email">
                  <input class="form-control form-control-user" type="email,phone" id="login-email login-email-teacher" placeholder="Email hoặc số điện thoại">
              </div>
              <div class="form-group password">
                  <input class="form-control form-control-password" type="password" id="login-password login-password-teacher" placeholder="Mật khẩu">
              </div>
              <div class="form-group form-check">
                  <span>
                    <input class="form-check-input" type="checkbox" id="login-remember login-remember-teacher">
                    <label class="form-check-label" for="login-remember login-remember-teacher">Ghi nhớ mật khẩu</label>
                  </span>
                  <span>
                    <span class="btn-forgot-password">Quên mật khẩu?</span>
                  </span>
              </div>
              <button class="btn btn-log-in" type="submit" id="login-btn-submit login-teacher-btn-submit">Đăng nhập</button>
            </form>
          </div>
        </div>
      </div> <!-- / left -->
      <div class="col-6 right">
        <div class="bg">
          <span><img src="images/bg-user.png" alt=""></span>
        </div>

        <div class="content">
          <img src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/images/logo-user-2.png' }}" alt="">
          <p>Dễ dàng mở lớp, có học sinh ở khắp mọi nơi,<br>không hạn chế về địa lý.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="over-body"></div> <!-- / over body -->
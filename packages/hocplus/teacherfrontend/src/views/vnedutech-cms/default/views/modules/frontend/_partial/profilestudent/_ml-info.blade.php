<div class="ml-info">
    <div class="inner-info">
        <div class="info">
        <a href="" class="btn-modify">Sửa</a>
        <div class="avatar">
            <img src="{{ config('site.url_static') . $member->avatar }}" alt="avatar">
        </div>
        <div class="content">
            <div class="name">{{ $member->name }}</div>
            <div class="work">{{ $member->address }}</div>
        </div>
        <div class="info-class">
            {{-- <div class="degree">
            <div class="title">Học vị</div>
            <div class="content">{{ $member->degree }}</div>
            </div>
            <div class="class">
            <div class="title">Bộ môn giảng dạy</div>
            <div class="content">
                @if(!empty($member->getSubject))
                @foreach($member->getSubject as $item)
                    @if(isset($item->name)) {{ $item->name . ',' }} @endif
                @endforeach
                @endif
            </div>
            </div> --}}
        </div>
        </div>
        <nav class="list">
        <ul class="nav">
            <li class="nav-item">
            <a href="quan-ly-giao-vien-bang-thong-tin.html" class="nav-link">
                <i class="fa fa-dashboard"></i>
                <span>Bảng thông tin</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ route('hocplus.get.my.course.student') }}" class="nav-link">
                <i class="fa fa-briefcase"></i>
                <span>Khóa học của tôi</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-money"></i>
                <span>Ví của tôi</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="quan-ly-quan-ly-tai-lieu.html" class="nav-link">
                <i class="fa fa-folder-open"></i>
                <span>Quản lý tài liệu</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="quan-ly-quan-ly-de-thi.html" class="nav-link">
                <i class="fa fa-layers"></i>
                <span>Quản lý bộ đề</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="quan-ly-cau-hoi.html" class="nav-link">
                <i class="fa fa-question"></i>
                <span>Quản lý câu hỏi</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-document-time"></i>
                <span>Lịch sử học</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="quan-ly-tai-khoa.html" class="nav-link">
                <i class="fa fa-gear"></i>
                <span>Quản lý tài khoản</span>
            </a>
            </li>
            <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-comments"></i>
                <span>Quản lý bình luận</span>
            </a>
            </li>
        </ul>
        </nav>
    </div>

</div>
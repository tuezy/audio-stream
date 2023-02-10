@extends("index.main")
@section("content")
    <div class="py-4" style="height: 90px"></div>
    <div class="container">
        <div class="row">
                <div class="">
                    <div class="card-header">
                        <ul class="nav" role="tablist">
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" data-bs-toggle="tab" href="#changePassword" role="tab">--}}
{{--                                    <i class="fas fa-home"></i> Đổi mật khẩu--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#playlistStatus" role="tab">
                                    <i class="far fa-user"></i> Playlist Status
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#m3u8" role="tab">
                                    <i class="far fa-user"></i> M3u8
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
{{--                            <div class="tab-pane active" id="changePassword" role="tabpanel">--}}
{{--                                <form action="{{ route("customers.changePassword") }}">--}}
{{--                                    <div class="row g-2">--}}
{{--                                        <div class="col-lg-4">--}}
{{--                                            <div>--}}
{{--                                                <label for="oldpasswordInput" class="form-label">Old Password*</label>--}}
{{--                                                <input name="current" type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end col-->--}}
{{--                                        <div class="col-lg-4">--}}
{{--                                            <div>--}}
{{--                                                <label for="newpasswordInput" class="form-label">New Password*</label>--}}
{{--                                                <input name="password" type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end col-->--}}
{{--                                        <div class="col-lg-4">--}}
{{--                                            <div>--}}
{{--                                                <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>--}}
{{--                                                <input name="repassword" type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end col-->--}}
{{--                                        <div class="col-lg-12">--}}
{{--                                            <div class="text-end">--}}
{{--                                                <button type="submit" class="btn btn-success">Change Password</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end row-->--}}
{{--                                </form>--}}
{{--                            </div>--}}

                            <div class="tab-pane active" id="playlistStatus" role="tabpanel">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Ngày phát</th>
                                        <th>Buổi phát</th>
                                        <th style="width: 138px;text-align: center">Tình trạng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($playlists)

                                        @foreach($playlists as $playlist)
                                            <tr>
                                                <td>{{ $playlist->broadcast_date }}</td>
                                                <td>{{ $playlist->broadcast_on }}</td>
                                                <td style="width: 138px;text-align: center">
                                                    @php
                                                        echo ($playlist->status == 'completed' ? '<span class="badge badge-soft-primary text-uppercase">Ready</span>' : '<span class="badge badge-soft-danger text-uppercase">Chưa sẵn sàng</span>');
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif
                                    </tbody>
                                </table>

                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane " id="m3u8" role="tabpanel">
                                <div class="media-form">
                                    <label for="media_type">Buổi sáng</label>

                                    <div class="input-group">
                                        <input type="text"
                                               class="form-control"
                                               aria-describedby="button-addon2"
                                               value="{{
                                                    asset(implode('/',[
                                                        'hls',
                                                        'audio',
                                                        \App\Models\Playlist::PLAYLIST_TYPE_MORNING,
                                                        \Illuminate\Support\Facades\Auth::guard("customers")->user()->id,
                                                        'playlist.m3u8'
                                                ])) }}">
                                        <button class="btn btn-outline-success" type="button" id="button-addon2">
                                            {{$playlist_status[\App\Models\Playlist::PLAYLIST_TYPE_MORNING] ?? "Chưa sẵn sàng"}}</button>
                                    </div>
                                </div>
                                <div class="media-form">
                                    <label for="media_type">Buổi trưa</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ asset(implode('/',[
    'hls','audio',\App\Models\Playlist::PLAYLIST_TYPE_AFTERNOON, \Illuminate\Support\Facades\Auth::guard("customers")->user()->id,'playlist.m3u8'
])) }}">
                                        <button class="btn btn-outline-success" type="button" id="button-addon2">
                                            {{$playlist_status[\App\Models\Playlist::PLAYLIST_TYPE_AFTERNOON] ?? "Chưa sẵn sàng"}}</button>
                                    </div>
                                </div>

                                <div class="media-form">
                                    <label for="media_type">Buổi tối</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ asset(implode('/',[
    'hls','audio',\App\Models\Playlist::PLAYLIST_TYPE_EVENING, \Illuminate\Support\Facades\Auth::guard("customers")->user()->id,'playlist.m3u8'
])) }}">
                                        <button class="btn btn-outline-success" type="button" id="button-addon2">
                                            {{$playlist_status[\App\Models\Playlist::PLAYLIST_TYPE_EVENING] ?? "Chưa sẵn sàng"}}</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!--end tab-pane-->
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection
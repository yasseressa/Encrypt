@extends('layouts.app')

@section('content')
    <!--**********************************
            Sidebar start
        ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li><a href="{{ route('email-inbox') }}">Inbox</a></li>
                <li><a href="{{ route('email-sent') }}">Sent</a></li>
                <li><a href="{{ route('email-compose') }}">Compose</a></li>
            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-list m-t-15">
                                @forelse($messages as $message)
                                    <div class="message">
                                        <a href="{{ route('email-read',['id'=> $message->id])}}">

                                            <div class="col-mail col-mail-2">
                                                <div class="subject">{{$message->subject}}</div>
                                                <div class="date">{{$message->created_at}}</div>
                                            </div>
                                        </a>
                                    </div>
                                    <hr/>
                                @empty
                                    <p>No Message</p>
                            @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
@endsection

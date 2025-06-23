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
                            <div>
                                <div class="compose-content mt-5">
                                    @if(session()->get('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="item_category">Select Encryption: </label>
                                            <select id="encrypt" name="encrypt">
                                                <option value="AES">AES</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control bg-transparent" placeholder=" To" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control bg-transparent" placeholder=" Subject">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="text" class="textarea_editor form-control bg-light" rows="15" placeholder="Enter text ..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h5 class="m-b-20"><i class="fa fa-paperclip m-r-5 f-s-18"></i> Attatchment</h5>
                                            <div class="fallback">
                                                <input class="l-border-1" name="file" type="file" multiple="multiple">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary m-b-30 m-t-15 f-s-14 p-l-20 p-r-20 m-r-10" type="submit"><i class="fa fa-paper-plane m-r-5"></i> Send</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    <!-- #/ container -->
    <!--**********************************
    Content body end
    ***********************************-->
@endsection

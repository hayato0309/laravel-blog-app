@extends('layouts.admin')

@section('admin.content')
    <div class="container">
        <div class="mb-5">
            <div class="mb-3">
                <h3>Total number</h3>
            </div>
            <div class="d-flex flex-row">
                <h5 class="mr-3">Users</h5 class="mr-3">
                <h5 class="mr-3">{{ $num_of_total_users }}</h5 class="mr-3">
                <h5 class="mr-3">Posts</h5 class="mr-3">
                <h5 class="mr-3">{{ $num_of_total_posts }}</h5 class="mr-3">
            </div>
        </div>
        <div class="mb-5">
            <div class="mb-3">
                <h3>By period</h3>
            </div>
            <table class="table">
                <tr>
                    <th></th>
                    <th colspan="2">Day</th>
                    <th colspan="2">Week</th>
                    <th colspan="2">Month</th>
                    <th colspan="2">Year</th>
                </tr>
                <tr>
                    <td>Users</td>
                    @foreach($users_per_period as $users)
                        <td>{{ $users[0] }}</td>
                        <td>{{ $users[1] }} %</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Posts</td>
                    @foreach($posts_per_period as $posts)
                        <td>{{ $posts[0] }}</td>
                        <td>{{ $posts[1] }} %</td>
                    @endforeach
                </tr>
            </table>
        </div>
        <div>
            <h3 class="mb-3">Ranking</h3>
            <div class="card-deck">
                <div class="card border-0 shadow-sm px-3">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Popular users Top5</h5>
                        <hr>

                        @foreach($popular_users_top5 as $popular_user)
                            <div class="row d-flex justify-content-between mb-2">
                                <div>
                                    <span class="mr-2">{{ $loop->iteration }}</span>
                                    <img class="rounded-circle" src="{{ asset('storage/'.$popular_user->avatar) }}" alt="avatar" style="width: 25px;">
                                </div>
                                
                                <div><a href="{{ route('user.show', $popular_user->id) }}" class="text-body">{{ Str::limit($popular_user->name, 12, '...') }}</a></div>
                                <div>{{ $popular_user->followers_count }} <span class="small"> followers</span></div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="card border-0 shadow-sm px-3">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Contributors Top5</h5>
                        <hr>

                        @foreach($contributors_top5 as $contributor)
                            <div class="row d-flex justify-content-between mb-2">
                                <div>
                                    <span class="mr-2">{{ $loop->iteration }}</span>
                                    <img class="rounded-circle" src="{{ asset('storage/'.$contributor->avatar) }}" alt="avatar" style="width: 25px;">
                                </div>
                                
                                <div><a href="{{ route('user.show', $contributor->id) }}" class="text-body">{{ Str::limit($contributor->name, 12, '...') }}</a></div>
                                <div>{{ $contributor->posts_count }} <span class="small"> posts</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card border-0 shadow-sm px-3">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Popular posts Top5</h5>
                        <hr>

                        @foreach($popular_posts_top5 as $popular_post)
                            <div class="row d-flex justify-content-between mb-2">
                                <div>{{ $loop->iteration }}</div>
                                <div><a href="{{ route('post.show', $popular_post->id) }}" class="text-body">{{ Str::limit($popular_post->title, 12, '...') }}</a></div>
                                <div>{{ $popular_post->likes_count }} <span class="small"> likes</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card border-0 shadow-sm px-3">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Ensembles Top5</h5>
                        <hr>
                        
                        @foreach($popular_ensembles_top5 as $ensemble)
                            <div class="row d-flex justify-content-between mb-2">
                                <div>{{ $loop->iteration }}</div>
                                <div><a href="{{ route('ensemble.show', $ensemble->id) }}" class="text-body">{{ Str::limit($ensemble->headline, 12, '...') }}</a></div>
                                <div>{{ $ensemble->ensemble_applications_count }} <span class="small"> applications</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
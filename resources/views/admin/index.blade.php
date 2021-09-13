@extends('layouts.admin')

@section('admin.content')
    <div class="container">
        <div class="mb-5">
            <div class="mb-3">
                <h3>Total number</h3>
            </div>
            <div class="d-flex flex-row">
                <h5 class="mr-3">Users</h5 class="mr-3">
                <h5 class="mr-3">{{ $num_of_users }}</h5 class="mr-3">
                <h5 class="mr-3">Posts</h5 class="mr-3">
                <h5 class="mr-3">{{ $num_of_posts }}</h5 class="mr-3">
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
                    <td>1</td>
                    <td>+10%</td>
                    <td>2</td>
                    <td>+10%</td>
                    <td>3</td>
                    <td>+10%</td>
                    <td>4</td>
                    <td>+10%</td>
                </tr>
                <tr>
                    <td>Posts</td>
                    <td>1</td>
                    <td>+10%</td>
                    <td>2</td>
                    <td>+10%</td>
                    <td>3</td>
                    <td>+10%</td>
                    <td>4</td>
                    <td>+10%</td>
                </tr>
            </table>
        </div>
        <div>
            <h3 class="mb-3">Weekly ranking</h3>
            <div class="card-deck">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5>Popular users Top5</h5>
                        <div class="small text-muted">*Based on the number of followers</div>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5>Contributers Top5</h5>
                        <div class="small text-muted">*Based on the number of posts</div>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5>Popular posts Top5</h5>
                        <div class="small text-muted">*Based on the number of likes</div>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5>Ensembles Top5</h5>
                        <div class="small text-muted">*Based on the number of participants</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
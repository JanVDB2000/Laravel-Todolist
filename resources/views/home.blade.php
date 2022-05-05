@extends('layouts.app')

@section('content')
    <section class="vh-100 rounded-3 ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-2 col-xl-2">
                    <img class="img-fluid" src="https://media.discordapp.net/attachments/440827544057544704/718959939158278194/iron_men_2020.gif" alt="">
                </div>
                <div class="col col-lg-8 col-xl-8">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                            <h4 class="text-center my-3 pb-3">To Do App</h4>

                            @if(Auth::id() == null)
                                <div class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                                    <div class="col-6">
                                        <div class="form-control">
                                            <label class="form-label" for="form1">Enter a task here</label>
                                            <input type="text" id="form1" disabled class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary" disabled>Save</button>
                                    </div>
                                </div>
                            @else
                                @if(Auth::id())
                                    <form method="post" action="{{action('App\Http\Controllers\FrontEndController@store')}}" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                                        @csrf
                                        @method('POST')
                                        <div class="col-6">
                                            <div class="form-control">
                                                <label class="form-label" for="form1">Enter a task here</label>
                                                <input type="text" id="form1" name="input" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                @endif
                            @endif





                            <table class="table mb-4">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Todo item</th>
                                    <th scope="col">Name User</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($todolists as $todolist)
                                <tr>
                                    <th scope="row">{{$todolist->id}}</th>
                                    <td>{{$todolist->text}}</td>
                                    <td>{{ $todolist->User->name}}</td>
                                    <td>
                                        @if(Auth::id() == null)
                                            <button type="submit"  disabled class="btn btn-danger ">Delete</button>
                                        @else
                                            @if($todolist->User->id == Auth::id())
                                                <form method="POST" action="{{action('App\Http\Controllers\FrontEndController@destroy', $todolist->id)}}">
                                                    @csrf

                                                    @method('DELETE')
                                                    <button type="submit"  class="btn btn-danger">Delete</button>
                                                </form>

                                            @elseif(Auth::User()->roles->first()->name == 'administrator')


                                                <form method="POST" action="{{action('App\Http\Controllers\FrontEndController@destroy', $todolist->id)}}">
                                                    @csrf

                                                    @method('DELETE')
                                                    <button type="submit"  class="btn btn-danger">Delete</button>
                                                </form>
                                            @else
                                                <button type="submit"  disabled class="btn btn-danger ">Delete</button>

                                            @endif
                                        @endif
                                    </td>
                                </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{$todolists->links()}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-2 col-xl-2">
                    <img class="img-fluid" src="https://media.discordapp.net/attachments/440827544057544704/718959939158278194/iron_men_2020.gif" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection

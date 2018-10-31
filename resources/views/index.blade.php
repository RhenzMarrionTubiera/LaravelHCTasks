@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  .center {
    margin:auto;
    display:block;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
  <a href="{{ route('tasks.create') }}"><button class="btn btn-primary">Create Task</button></a>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Edit Details</td>
          <td>ID</td>
          <td>Title</td>
          <td>Description</td>
          <td>Status</td>
          <td>Update Status</td>
          <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
        <td><a href="{{ route('tasks.edit',$task->id)}}" class="btn btn-link">Edit</a></td>
            <td>{{$task->id}}</td>
            <td>{{$task->title}}</td>
            <td>{{$task->description}}</td>
            <td>{{$task->status}}</td>
            <td>
                <form method="post" action="{{ route('status.update', $task->id) }}">
                @method('PATCH')
                @csrf
                <select class="form-control" name="status">
                    <option></option>
                    <option>Not Completed</option>
                    <option>Completed</option>
                </select>
                <button type="submit" class="btn btn-primary center">Update</button>
                </form>
            </td>
            <td>
                <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger center" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
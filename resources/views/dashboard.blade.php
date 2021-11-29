
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
</head>

<style>
.blue-color {
color:blue;
}
.green-color {
color:green;
}
.teal-color {
color:teal;
}
.yellow-color {
color:yellow;
}
.red-color {
color:red;
}

</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('To-Do-List') }}
        </h2>
    </x-slot>

    <!--Add Task -->
    <div class="container w-30 mt-5">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('delete'))
            <div class="alert alert-danger">
                {{ session()->get('delete') }}
            </div>
        @endif
        <div class="card shadow-sm">
            <div class="card-body shadow-md">
                <h3>To-do-List</h3>
                <form action="{{ route('storelist') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="content" class="form-control" placeholder="Add your new todo">
                        <button type="submit" class="btn btn-dark btn-sm px-4"><i class="fas fa-plus"></i></button>
                    </div>
                </form>

                {{-- if tasks count --}}
                @if (count($todolists))
                <ul class="list-group list-group-flush mt-3">
                    @foreach ($todolists as $todolist)
                    <li class="list-group-item">
                        <form method="POST">
                            <a href="{{route('task', ['list_id' => $todolist->id])}}">{{ $todolist->content }}</a>
                            @csrf
                            <button formaction="{{ url('destroylist') }}/{{ $todolist->id}}" type="submit" class="btn btn-link btn-sm float-end"><i class="fas fa-trash red-color fa-lg"></i></button>
                            <button formaction="{{ url('listedit') }}/{{ $todolist->id}}" type="edit" class="btn btn-link btn-sm float-end"><i class="fas fa-edit fa-lg"></i></button>
                        </form>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-center mt-3">No Tasks!</p>
                @endif
            </div>
            @if (count($todolists))
            <div class="card-footer">
                You have {{ count($todolists) }} pending list
            </div>
            @else

            @endif
        </div>
    </div>
 <!--end list-->


</x-app-layout>
</html>

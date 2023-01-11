@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row row p-4 pt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-gradient-primary d-flex align-items-center">
                                <h3 class="card-title flex-grow-1"><i class="fas fa-user-lock fa-2x"></i> Liste des
                                    permissions</h3>
                                <div class="card-tools d-flex align-items-center ">
                                    <a class="btn btn-link text-white mr-4 d-block"
                                       href="{{route("permission.create")}}"><i class="fas fa-lock"></i> Nouvelle
                                        permission</a>
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Crée</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($permissions as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td><span
                                                    class="tag tag-success">{{date_format(date_create($item->created_at),"d M,Y")}}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-link"><a href="{{route('permission.edit',$item->id)}}"><i class="far fa-edit"></i></a></button>
                                                <form id="{{$item->id}}"
                                                      action="{{ route('permission.destroy', $item->id) }}"
                                                      method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-link"><i class="fa fa-trash "></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    {{ $permissions->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@extends('admin.admin_master')
@section('admin')




<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Notes
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Uploaded By</th>
                    <th>Description</th>
                    <th>Download</th>
                   
                </tr>
            </thead>
            
            <tbody>
                @foreach ($notes as $key=>$note)
                    
               
                <tr>
                    <td>{{ $key+1}}</td>
                    <td>{{ $note->user_type}}</td>
                    <td> {{ $note->description }}</td>
                    {{-- <td><a href="{{route('admin.removeFile',$note->id) }}">Delete</a></td> --}}
                    {{-- <td><a href="{{ route('download', $note->id) }}">Download</a></td> --}}
                    <td><a href="{{route('admin.download',$note->id) }}">Download</a></td>
                  
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>






@endsection
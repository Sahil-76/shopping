@extends('layouts.master')
@push('title')
    <title>Products</title>
@endpush
@section('content')

<div class="container">
<div class="row">
<div class="col d-flex" style="justify-content: space-between;">
        <a href="{{ url()->previous() }}" class="btn btn-warning" >Go Back</a>

        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
</div>
</div>
    <div class="table-responsive">
        <table class="table" id="roles">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                @php
                $img=Crypt::decrypt($product->image);
                $id=Crypt::encrypt($product->id);
                @endphp
                <tr class="">
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ Str::words(ucfirst($product->name), 5 )}}</td>

                    {{-- @dd($product) --}}
                    <td style="mix-blend-mode: multiply;" ><img src="{{ $img }}" alt="" style="width: 5rem;cursor:pointer;" id="showImage"
                                        data-toggle="modal" data-target="#imageModal" id="image"></td>
                                        @php
$color='';
if($product->products_status==='active'){
    $color="color:green";
}
else{
    $color="color:red";
}
@endphp
                    <td style="{{$color}}">{{ ucfirst($product->products_status) }}</td>

                    <td>{{ \Carbon\Carbon::parse($product->created_at)->setTimeZone('Asia/KolKata')->format('d-M-Y h:i: A') }}</td>
                    <td><a href="{{ route('products.edit',$id) }}" class="btn btn-danger">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImagePreview" src="" alt="Image Preview" style="width: 100%;" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#showImage', function() {
            var imageUrl = $(this).attr('src');
            if (imageUrl) {
                $('#modalImagePreview').attr('src', imageUrl);
                $('#imageModal').modal('show');
            }
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#roles').DataTable({
                "columnDefs": [{
                        "width": "20%",
                        "targets": 0
                    },
                    {
                         "width": "25%",
                        "targets": 1
                    }
                    ],
                     "autoWidth": false,  
            "responsive": true,
            });

        });
    </script>
@endsection



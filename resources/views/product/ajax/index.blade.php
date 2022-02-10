@section('script')

    <script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>


    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                cache: true,
                order: [[0, 'desc']],
                ajax: '{{route("products")}}',
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                    }
                    ,{
                        data: 'company_id',
                        name: 'company_id',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]

            });
        });

        $('#create-product').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{route("product.store")}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#create-product-modal').modal('hide');
                    $('.datatable').DataTable().ajax.reload(null, false);
                    toastr.success(response.message);
                    $('#create-product')[0].reset();
                },
                error: function (error) {
                    toastrErrors(error);
                }
            });

        });

        $('body').on('click', '.action-product-delete', function (e) {
            e.preventDefault();

            productId = $(this).data('id');
            $.ajax({
                url: '{{ url("/product/delete") }}' + '/' + productId,
                method: 'GET',

                success: function (response) {
                    $('.datatable').DataTable().ajax.reload(null, false);
                    toastr.success(response.message);
                },

                error: function (error) {
                    toastrErrors(error)
                }
            });
        });

        $(document).on('click', '.action-product-edit', function (e) {
            $('#edit-product-modal').modal('show');
            productId = $(this).data("id");

            $.ajax({
                url: "{{url('product/edit')}}" + "/" + productId,
                type: 'get',
                success: function (response) {
                    $('#edit_company_name').val(response.product.name);
                    $('#edit_company_quantity').val(response.product.quantity);
                    $('#edit_company_id').val(response.product.company_id);
                    $('#edit_company_id').trigger('change');
                },

                error: function (error) {
                    toastrErrors(error);
                }
            });
        });

        $('body').on('submit', '#update-product-form', function (e) {
            e.preventDefault();
            /* var self = $(this);
             loading(self, true);*/
            $.ajax({
                url: '{{ url("/product/update") }}' + '/' + productId,
                method: 'POST',
                data: $(this).serialize(),

                success: function (response) {
                    $('#edit-product-modal').modal('hide');
                    $('.datatable').DataTable().ajax.reload(null, false);
                    // loading(self, false);
                    toastr.success(response.message);
                },

                error: function (error) {
                    toastrErrors(error)
                    loading(self, false);
                }
            });
        });

    </script>
@endsection

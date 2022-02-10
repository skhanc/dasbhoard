@section('script')

    <script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

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
                ajax: '{{route("companies")}}',
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]

            })
        })


        $('#create-company').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{route("company.store")}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#create-user-modal').modal('hide');
                    $('.datatable').DataTable().ajax.reload(null, false);
                    toastr.success(response.message);
                    $('#create-company')[0].reset();
                },
                error: function (error) {
                    toastrErrors(error);
                }
            });

        });

        $('body').on('click', '.action-company-delete', function (e) {
            e.preventDefault();

            companyId = $(this).data('id');
            $.ajax({
                url: '{{ url("/company/delete") }}' + '/' + companyId,
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

        $(document).on('click', '.action-company-edit', function (e) {
            $('#edit-company-modal').modal('show');
            companyId = $(this).data("id");

            $.ajax({
                url: "{{url('company/edit')}}" + "/" + companyId,
                type: 'get',
                success: function (response) {
                    $('#edit_company_name').val(response.company.name);
                },

                error: function (error) {
                    toastrErrors(error);
                }
            });
        });

        $('body').on('submit', '#update-company-form', function (e) {
            e.preventDefault();
           /* var self = $(this);
            loading(self, true);*/
            $.ajax({
                url: '{{ url("/company/update") }}' + '/' + companyId,
                method: 'POST',
                data: $(this).serialize(),

                success: function (response) {
                    $('#edit-company-modal').modal('hide');
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

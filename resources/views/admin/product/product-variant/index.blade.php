@extends( 'admin.layouts.master' )

@section( 'content' )
    <section class="section">
        <div class="section-header">
            <h1>Manage Product Variant</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                <div class="breadcrumb-item"><a href="#">Manage Product Variant</a></div>
                <div class="breadcrumb-item">{{ ucwords($product->name) }}</div>
            </div>
        </div>
        <div class="mb-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product: {{ ucwords($product->name) }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.products-variant.create', ['product' => $product->id]) }}"
                                   class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push( 'scripts' )
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        ($ => {
            $(() => {
                $("body").on("click", ".change-status", e => {
                    const $this = $(e.currentTarget);

                    const isChecked = $this.is(':checked');
                    const idToggle = $this.data('id');

                    $.ajax({
                        url: "{{ route('admin.products-variant.change-status') }}",
                        method: "PUT",
                        data: {
                            isChecked: isChecked,
                            idToggle: idToggle
                        },
                        success: res => {
                            toastr.success(res.message);
                        },
                        error: (xhr, status, error) => {
                            console.log(error);
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endpush

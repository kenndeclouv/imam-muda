<x-app>
    @php
        $permissions = Auth::user()->getPermissionCodes();
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quote</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between">
                <div>
                    <h5 class="card-title mb-0">Quote</h5>
                </div>
            </div>
            <div class="card-body pb-0">
                @if ($permissions->contains('quote_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.quote.create') }}" class="btn btn-primary ms-auto">Tambah Quote</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                @include('components.alert')
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Konten</th>
                            <th>Sumber</th>
                            @if ($permissions->contains('quote_edit') || $permissions->contains('quote_delete'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotes as $quote)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $quote->content }}</td>
                                <td>{{ $quote->source }}</td>
                                @if ($permissions->contains('quote_edit') || $permissions->contains('quote_delete'))
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="d-flex gap-2" aria-label="Basic example">
                                                <a href="{{ route('admin.quote.edit', $quote->id) }}"
                                                    class="btn btn-warning"><i class="fa-solid fa-edit"></i></a>
                                            </div>
                                            <x-confirm-delete :route="route('admin.quote.destroy', $quote->id)" title="Hapus Quote"
                                                message="Apakah anda yakin ingin menghapus quote ini?" />
                                            <div class="d-flex gap-2" aria-label="Basic example">
                                                @if (!$quote->status)
                                                    <form action="{{ route('admin.quote.status', $quote->id) }}" method="POST" class="d-inline" data-bs-toggle="tooltip" data-bs-placement="top" title="Tampilkan Quote">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa-solid fa-toggle-on"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-label-success m-0">Quote Ditampilkan</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>

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
                        <li class="breadcrumb-item"><a href="{{ route('admin.bayaran.index') }}">Grup Bayaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Bayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Bayaran</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')

                <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                    data-bs-target="#dataModal">
                    Tambah Bayaran
                </button>
                <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="featureModalLabel">Pilih Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.bayaran.list.store', $fee->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="data_id">Data</label>
                                        <select class="form-control select2" id="data_id" name="data_id[]" required multiple>
                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->fullname ?? $item->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="fee_id" value="{{ $fee->id }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>terakhir diubah</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listFees as $listFee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $listFee->Imam->fullname }}</td> --}}
                                @if ($listFee->Fee->type == 'imam' )
                                    <td>{{ $listFee->Imam->fullname  ?? ''}}</td>
                                @elseif ($listFee->Fee->type == 'masjid')
                                    <td>{{ $listFee->Masjid->name  ?? ''}}</td>
                                @elseif ($listFee->Fee->type == 'shalat')
                                    <td>{{ $listFee->Shalat->name  ?? ''}}</td>
                                @endif
                                <td>{{ $listFee->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <x-confirm-delete :route="route('admin.bayaran.list.destroy', $listFee->id)" title="Hapus Bayaran"
                                            message="Apakah anda yakin ingin menghapus bayaran ini?" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    }
                });
                $('.select2').select2({
                    dropdownParent: $('#dataModal')
                });
            });
        </script>
    </x-slot:js>
</x-app>

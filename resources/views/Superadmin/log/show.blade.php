<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Log</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Log {{ $filename }}</h5>
            </div>
        </div>

        <div class="accordion accordion-popout" id="logAccordion">
            @foreach ($logs as $index => $log)
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $index }}">
                        <button class="accordion-button collapsed gap-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $index }}" aria-expanded="false"
                            aria-controls="collapse-{{ $index }}">
                            @if ($log['env'] == 'local')
                                <span class="badge bg-label-primary">LOCAL</span>
                            @else
                                <span class="badge bg-label-success">PRODUCTION</span>
                            @endif
                            @if ($log['type'] == 'INFO')
                                <span class="badge bg-label-info">INFO</span>
                            @elseif ($log['type'] == 'ERROR')
                                <span class="badge bg-label-danger">ERROR</span>
                            @endif
                            {{ $log['timestamp'] }}
                            {{-- <span class="badge bg-label-warning">{{ $log['level']['name'] }}</span> --}}
                        </button>
                    </h2>
                    <div id="collapse-{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ $index }}" data-bs-parent="#logAccordion">
                        <div class="accordion-body">
                            <pre>{{ $log['message'] }}</pre>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-slot:js>
        <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>
    </x-slot:js>
</x-app>

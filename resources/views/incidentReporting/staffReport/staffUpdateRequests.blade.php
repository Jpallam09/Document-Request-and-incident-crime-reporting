<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - Update Requests</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/css/staffCss/staffUpdateRequests.css')
    @vite('resources/css/componentsCss/ModalCss/viewRequestModal.css')

    @vite('resources/js/staffJs/staffUpdateRequests.js')
    @vite('resources/js/componentsJs/navbar.js')
    @vite('resources/js/componentsJs/viewRequestModal.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.Shared-navbar')
        <section class="page-content">
            <h1>Edit Requests</h1>

           <div class="table-container">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Original Title</th>
                        <th>Requested Title</th>
                        <th>Requested Description</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($requests as $index => $request)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        {{-- User name (with fallback) --}}
                        <td>{{ $request->user->user_name ?? 'Unknown' }}</td>

                        {{-- Original report title (with fallback) --}}
                        <td>{{ $request->report->report_title ?? 'No Title' }}</td>

                        {{-- Requested title & description --}}
                        <td>{{ $request->requested_title ?? '—' }}</td>
                        <td>{{ $request->requested_description ?? '—' }}</td>

                        {{-- Requested at (safely parsed and formatted) --}}
                        <td>
                            {{ $request->requested_at ? \Carbon\Carbon::parse($request->requested_at)->format('M d, Y') : 'N/A' }}
                        </td>

                        {{-- Status --}}
                        <td>{{ ucfirst($request->status) }}</td>

                        {{-- Actions button --}}
                        <td>
                <button class="btn-view-request" data-request-id="{{ $request->id }}">
                View Request
                </button>
                @endforeach
                </tbody>
            </table>
        </div>
        </section>
    </main>

@foreach ($requests as $request)
  @include('components.modals.request-modal', ['report' => $request->report, 'request' => $request])
@endforeach


</body>
</html>

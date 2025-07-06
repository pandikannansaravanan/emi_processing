@extends('common.template')

@section('title', 'EMI Details Page')

@section('content')
<div class="container mt-3">
<h1 class="text-center mb-4">Run Emi Details</h1>
<p>Hi, <b>{{ Auth::user()->name }}!</b> click the below button to process the emi details:</p>
<button type="button" id="process-button" class="btn btn-primary">Process Data</button>
<div id="show_emi" class="d-none">
<h3 class="mt-3">EMI Details</h3>
<div class="container mt-3 table-responsive" style="">
    <table class="table">
        <thead>
            <tr>
                @if(count($emiDetails) > 0)
                    @foreach(array_keys((array)$emiDetails[0]) as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($emiDetails as $row)
                <tr>
                    @foreach((array)$row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

</div>
@endsection

@push('scripts')
    <script>
        console.log('This script only runs on the home page!');
        $(document).ready(function() {
            $('#process-button').click(function() {
                // Show loading message
                $(this).text('Processing...').prop('disabled', true);

                // Send AJAX request to process EMI
                $.ajax({
                    url: '/process-emi',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        // Update the EMI details table with the response data
                        $('#show_emi').removeClass('d-none');
                        $('tbody').empty();
                        $('thead').empty();
                        let thead = $('<tr></tr>');
                        thead.append($('<th></th>').text('S.no'));
                        for (let key in response.emiDetails[0]) {
                            thead.append($('<th></th>').text(key));
                        }
                        $('thead').append(thead);
                        response.emiDetails.forEach(function(row,index) {
                            let tr = $('<tr></tr>');
                            tr.append($('<td></td>').text(index + 1)); // Add index as first column
                            for (let key in row) {
                                tr.append($('<td></td>').text(row[key]));
                            }
                            $('tbody').append(tr);
                        });
                        $('#process-button').text('Process Data').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        alert('Error processing EMI: ' + error);
                        $('#process-button').text('Process Data').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush

@props(['url'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" type="text/css">
<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    const exportUrl = "{{ $url }}";

    $(document).ready(function () {
        let start, end;

        @if(request('date'))
            const oldDate = "{{ request('date') }}".split(' - ');
            start = moment(oldDate[0], 'YYYY-MM-DD');
            end = moment(oldDate[1], 'YYYY-MM-DD');
        @else
            start = moment().startOf('month');
            end = moment().endOf('month');
        @endif

        function updateExportLink(startDate, endDate) {
            const formattedStart = startDate.format('YYYY-MM-DD');
            const formattedEnd = endDate.format('YYYY-MM-DD');
            $('#exportpdf').attr('href', `/${exportUrl}/laporan/periode/${formattedStart}+${formattedEnd}`);

            $('#created_at').val(`${formattedStart} - ${formattedEnd}`);
        }

        $('#created_at').daterangepicker({
            startDate: start,
            endDate: end,
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function (start, end) {
            updateExportLink(start, end);
        });

        updateExportLink(start, end);
    });
</script>

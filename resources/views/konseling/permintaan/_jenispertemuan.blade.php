@if ($peserta->jenispertemuan=='Virtual Meet')
    <div class="text-center"><i class="fa fa-circle text-success"></i> Virtual Meet</div>
@elseif($peserta->jenispertemuan=='Offline')
    <div class="text-center"><i class="fa fa-circle"></i> Offline</div>
@else
    <div class="text-center"><i class="fa fa-question text-warning"></i> Belum Ditetapkan</div>
@endif
@if ($peserta->status=='approve')
    <div class="text-center"><i class="fa fa-check-double text-success"></i> Disetujui</div>
@elseif($peserta->status=='rejected')
    <div class="text-center"><i class="fa fa-times-circle text-danger"></i> Ditolak</div>
@else
    <div class="text-center"><i class="fa fa-question text-warning"></i> Pending</div>
@endif


<div>
    <div class="font-bold text-xs pl-8">{{date('Y')}}   Published Articles Count: {{array_sum($currentYearData)}}</div>
    <div class="font-bold text-xs pl-8">{{date('Y')}}   Upload Articles Count: {{array_sum($uncurrentYearData)}}</div>
    <div class="font-bold text-xs pl-8">{{date('Y')-2}} Published Articles Count: {{array_sum($twoYearagoData)}}</div>
    <div class="font-bold text-xs pl-8">{{date('Y')-1}} Published Articles Count: {{array_sum($lastYearData)}}</div>
    {!!$FYChart -> render()!!}
</div>

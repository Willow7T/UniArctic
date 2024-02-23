<div>
    <div class="font-bold text-xs pl-8">{{date('Y')-2}} Articles Count: {{array_sum($twoYearagoData)}}</div>
    <div class="font-bold text-xs pl-8">{{date('Y')-1}} Articles Count: {{array_sum($lastYearData)}}</div>
    <div class="font-bold text-xs pl-8">{{date('Y')}}   Articles Count: {{array_sum($currentYearData)}}</div>
    {!!$Chart -> render()!!}
</div>

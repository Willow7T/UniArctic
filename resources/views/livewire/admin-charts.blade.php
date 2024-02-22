<div>
    <div class="font-bold text-sm pl-8">Last Year: {{array_sum($lastYearData)}}</div>
    <div class="font-bold text-sm pl-8">Current Year: {{array_sum($currentYearData)}}</div>
    {!!$Chart -> render()!!}
  </div>

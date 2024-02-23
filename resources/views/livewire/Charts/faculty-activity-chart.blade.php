<div> 
    <div class="font-bold text-xs pl-8">Users Count: {{array_sum($users)}}</div>
    <div class="font-bold text-xs pl-8">Articles Count: {{array_sum($articles)}}</div>
    {!!$Fchart -> render()!!} 
</div>

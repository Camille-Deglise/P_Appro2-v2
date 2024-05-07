<h2 class="text-center  bg-gray-200 mb-6">Graphiques des mesures </h2>
<div class="inline-flex space-x-40">

    @if($tempchart instanceof \App\Util\NoChartData)
        <p>{{ $tempchart->message }}</p>
    @else
        <div class="temp-chart">
            {!! $tempchart->container() !!}
            {!! $tempchart->script() !!} 
        </div>
    @endif

    @if ($satchart instanceof \App\Util\NoChartData)
        <p>{{$satchart->message}}</p>
    @else
         <div class='sat-chart'>

            {!! $satchart->container() !!}
            
            {!! $satchart->script() !!} 
        </div>
    @endif
        
   
   @if ($bschart instanceof \App\Util\NoChartData)
        <p>{{$bschart->message}}</p>
   @else
       <div class="bs-chart">
            {!! $bschart->container() !!}
            
            {!! $bschart->script() !!} 
    </div>
   @endif
</div>

<div class="inline-flex space-x-40">
   @if ($tenschart instanceof \App\Util\NoChartData)
        <p>{{$tenschart->message}}</p>
   @else
        <div class="tens-chart">
            {!! $tenschart->container() !!}
            
            {!! $tenschart->script() !!}  
        </div>
   @endif

   @if ($pulsechart instanceof \App\Util\NoChartData)
   <p>{{$pulsechart->message}}</p>
    @else
   <div class="pulse-chart">

       {!! $pulsechart->container() !!}
       
       {!! $pulsechart->script() !!} 
   </div>
    @endif
</div>

